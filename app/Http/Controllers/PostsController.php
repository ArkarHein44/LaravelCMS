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
        
        $gettoday = Carbon::today()->format('Y-m-d');

        $attshows = Status::whereIn('id',[3,4])->get();
        $days = Day::where('status_id',3)->get();
        $statuses = Status::whereIn('id',[7,10,11])->get();
        $tags = Tags::where('status_id',3)->get();
        $types = Types::whereIn('id',[1,2])->get();

        return view('post.create',compact('attshows','days', 'statuses', 'tags', 'types', 'gettoday'));

    }

    public function store(Request $request)
    {
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
        $post->user_id = $request['user_id'];

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

        return redirect(route('post.index'));
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
        return view('posts.edit')->with('post',$post)->with('attshows',$attshows)->with('days',$days)->with('statuses',$statuses)->with('tags',$tags)->with('types', $types);
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
        $post->user_id = $request['user_id'];

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

        return redirect(route('post.index'));
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
        return redirect()->back();
    }
}
