<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Status;
use App\Models\Tags;
use App\Models\Types;
use App\Models\Day;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('post.index',compact('posts'));
    }

    public function create()
    {

        $attshows = Status::whereIn('id',[3,4])->get();
        $days = Day::where('status_id',3)->get();
        $statuses = Status::whereIn('id',[7,10,11])->get();
        $tags = Tags::where('status_id',3)->get();
        $types = Types::whereIn('id',[1,2])->get();

        $gettoday = Carbon::today()->format("Y-m-d");
        $gettime = Carbon::now()->format("H:i");

        return view('post.create',compact('attshows','days', 'statuses', 'tags', 'types', 'gettoday','gettime'));

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            "image" => "image|mimes:jpg,jpeg,png|max:1024",
            "title" => "required|max:50|unique:posts,title",
            "content" => "required",
            "fee" => "required|numeric",
            "startdate" => "required",
            "enddate" => "required",
            "starttime" => "required",
            "endtime" => "required",
            "type_id" => "required|in:1,2",
            "tag_id" => "required",
            "attshow" => "required|in:3,4",
            "status_id" => "required|in:7,10,11",   
            "day_id"=>"required|array",
            'day_id.*'=>"exists:days,id"
        ]);

        $user = Auth::user();
        $user_id = $user['id'];

        $post = new Post();
        $post->title = $request['title'];
        $post->slug = Str::slug($request['name']);
        $post->content = $request['content'];
        $post->fee = $request['fee'];
        $post->startdate = $request['startdate'];
        $post->enddate = $request['enddate'];
        $post->starttime = $request['starttime'];
        $post->endtime = $request['endtime'];
        $post->type_id = $request['type_id'];
        $post->tag_id = $request['tag_id'];
        $post->attshow = $request['attshow'];
        $post->status_id = $request['status_id'];
        $post->user_id = $user_id;

        // Remove Old Single Upload 
       
        if($request->hasFile('image')){
            $path = $post->image;

            if(File::exists($path)){
                FIle::delete($path);
            }
        } 
        

        // Single Image Upload
        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);
            $imagenewname = uniqid($user_id).$post['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/posts/'),$imagenewname);

            $filepath = 'assets/img/posts/'.$imagenewname;
            $post->image = $filepath;
        }

        $post->save();

        session()->flash("success", "New Post Created");
        return redirect(route('posts.index'));
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        
       
        $attshows = Status::whereIn('id',[3,4])->get();
      
        $days = Day::where('status_id',3)->get();
        $statuses = Status::whereIn('id',[7,10,11])->get();
        $tags = Tags::where('status_id',3)->get();
        $types = Types::whereIn('id',[1,2])->get();
        return view('post.edit')->with('post',$post)->with('attshows',$attshows)->with('days',$days)->with('statuses',$statuses)->with('tags',$tags)->with('types', $types);
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $user_id = $user['id'];

        $post = Post::findOrFail($id);
        $post->title = $request['title'];
        $post->slug = Str::slug($request['name']);
        $post->content = $request['content'];
        $post->fee = $request['fee'];
        $post->startdate = $request['startdate'];
        $post->enddate = $request['enddate'];
        $post->starttime = $request['starttime'];
        $post->endtime = $request['endtime'];
        $post->type_id = $request['type_id'];
        $post->tag_id = $request['tag_id'];
        $post->attshow = $request['attshow'];
        $post->status_id = $request['status_id'];
        $post->user_id = $user_id;

        // Remove Old Single Upload 
       
        if($request->hasFile('image')){
            $path = $post->image;

            if(File::exists($path)){
                FIle::delete($path);
            }
        } 
        

        // Single Image Upload
        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);
            $imagenewname = uniqid($user_id).$post['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/posts/'),$imagenewname);

            $filepath = 'assets/img/moves/'.$imagenewname;
            $post->image = $filepath;
        }

        $post->save();

        session()->flash("success", "Update Successfully");
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Remove Old Image
        $path = $post->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $post->delete();

        session()->flash("danger", "Delete Successfully");
        return redirect()->back();
    }
}
