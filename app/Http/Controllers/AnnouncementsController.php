<?php

namespace App\Http\Controllers;

use App\Notifications\AnnouncementEmailNotify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class AnnouncementsController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('announcements.index',compact('announcements'));

    }

  
    public function create()
    {
        // $posts = Post::whereIn('attshow',3)->orderBy(column: 'title','asc')->get()->pluck('title','id');
        $posts = \DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        return view('announcements.create',compact('posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'image'=>'image|mimes:jpg,jpeg,png|max:1024',
            'title'=>'required|max:100',
            'content'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $announcement = new Announcement();
        $announcement->title = $request['title'];
        $announcement->content = $request['content'];
        $announcement->post_id = $request['post_id'];
        $announcement->user_id = $user_id;

        // Single Image Upload
        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);
            $imagenewname = uniqid($user_id).$announcement['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/announcements/'),$imagenewname);

            $filepath = 'assets/img/announcements/'.$imagenewname;
            $announcement->image = $filepath;
        }
        // dd($announcement);
        $announcement->save();

        // => Sent Email Notify to all users
        $users = User::all();

        Notification::send($users,new AnnouncementEmailNotify($announcement->id, $announcement->title, $announcement->content));

        session()->flash('success', 'New Annoucement Created');
        return redirect(route('announcements.index'));
    }

 
    public function show(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.show',compact('announcement'));
        
    }

    public function edit(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        $posts = \DB::table('posts')->where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        return view('announcements.edit')->with('announcement',$announcement)->with('posts',$posts);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'image'=>'image|mimes:jpg,jpeg,png|max:1024',
            'title'=>'required|max:100',
            'content'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $announcement = Announcement::findOrFail($id);
        $announcement->title = $request['title'];
        $announcement->content = $request['content'];
        $announcement->post_id = $request['post_id'];
        $announcement->user_id = $user_id;
        
        // Remove Old Single Upload 
       
        if($request->hasFile('image')){
            $path = $announcement->image;

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
            $imagenewname = uniqid($user_id).$announcement['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/announcements/'),$imagenewname);

            $filepath = 'assets/img/announcements/'.$imagenewname;
            $announcement->image = $filepath;
        }

        $announcement->save();

        session()->flash("success", "Update Successfully");
        return redirect(route('announcements.index'));
    }

 
    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);

        // Remove Old Single Image 
        $path = $announcement->image;
        if(File::exists($path)){
            FIle::delete($path);
        }

        $announcement->delete();
        
        session()->flash("error", "Delete Successfully"); 
        return redirect()->back();

    }
}
