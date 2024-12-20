<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Leave;
use App\Models\LeaveFile;
use App\Models\Post;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Support\Facades\File;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::all();
        $users = User::pluck('name','id');
        // dd($user);
        return view('leaves.index',compact('leaves', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['posts'] = Post::where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        $data['tags'] = User::orderBy('name','asc')->get();
        $data['gettoday'] = Carbon::today()->format('Y-m-d');

        return view('leaves.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            // post_id က မဖြစ်မနေလိုအပ်တယ် | array ဖြစ်ရမယ် 
            'post_id'=>'required|array',

            // post_id က database ထည်းက မှာ ရှိတဲ့ data ကိုပဲလက်ခံမယ် 
            'post_id.*'=>'exists:posts,id',
            'startdate'=>'required|date',
            'enddate'=>'required|date|after_or_equal:startdate',
            'tag'=>'required|array',
            'tag*'=>'exists:users,id',
            'title'=>'required|max:100',
            'content'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        
        $leave = new Leave();
        $leave->post_id = json_encode($request['post_id']) ;
        $leave->startdate = $request['startdate'];
        $leave->enddate = $request['enddate'];
        $leave->tag = json_encode($request['tag']) ;
        $leave->title = $request['title'];
        $leave->content = $request['content'];
        $leave->user_id = $user_id;

        $leave->save();

        // Multi Images Upload 
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){

                $leavefile = new Leave();
                $leavefile->leave_id = $leave->id;
              
                $file = $image;
                // dd($file);
                $fname = $file->getClientOriginalName();
                // dd($fname);
                $imagenewname = uniqid($user_id).$leave['id'].$fname;
                // dd($imagenewname);
                $file->move(public_path('assets/img/leaves/'),$imagenewname);
    
                $filepath = 'assets/img/leaves/'.$imagenewname;
                $leavefile->image = $filepath;
               
                $leavefile->save();
            }
        }

        session()->flash("success", "New Leave Created");

        return redirect(route('leaves.index'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leave = Leave::findOrFail($id);
        $users = User::pluck('name','id');
        return view('leaves.show',["leave"=>$leave], ["users"=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['leaves'] = Leave::findOrFail($id);
        $data['posts'] = Post::where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        $data['tags'] = User::orderBy('name','asc')->get()->pluck('name','id');

        return view('leaves.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[

            // post_id က မဖြစ်မနေလိုအပ်တယ် | array ဖြစ်ရမယ် 
            'post_id'=>'required|array',

            // post_id က database ထည်းက မှာ ရှိတဲ့ data ကိုပဲလက်ခံမယ် 
            'post_id.*'=>'exists:posts,id',
            'startdate'=>'required|date',
            'enddate'=>'required|date|after_or_equal:startdate',
            'tag'=>'required|array',
            'tag*'=>'exists:users,id',
            'title'=>'required|max:100',
            'content'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        
        $leave = Leave::findOrFail($id);
        $leave->post_id = $request['post_id'];
        $leave->startdate = $request['startdate'];
        $leave->enddate = $request['enddate'];
        $leave->tag = $request['tag'];
        $leave->title = $request['title'];
        $leave->content = $request['content'];

        $leave->save();

        $leavefiles = LeaveFile::where('leave_id',$leave->id)->get();
       
        if($request->hasFile('images')){

            // Remove Old Multi Upload
             
            foreach($leavefiles as $leavefile){
                $path = $leavefile->image;
                if(File::exists($path)){
                    FIle::delete($path);
                }
            }          
            
        } 

      
        // Multi Images Upload 
        foreach($request->file('images') as $image){

            $leavefile = new Leave();
            $leavefile->leave_id = $leave->id;
              
            $file = $image;
            // dd($file);
            $fname = $file->getClientOriginalName();
                // dd($fname);
            $imagenewname = uniqid($user_id).$leave['id'].$fname;
                // dd($imagenewname);
            $file->move(public_path('assets/img/leaves/'),$imagenewname);
    
            $filepath = 'assets/img/leaves/'.$imagenewname;
            $leavefile->image = $filepath;
               
            $leavefile->save();
        }

        session()->flash("success", "Update Successfully");
        return redirect(route('leaves.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leave = Leave::findOrFail($id);
        $leavefiles = LeaveFile::where('leave_id',$id)->get();

        // Remove Old multi images 
        foreach($leavefiles as $leavefile){
            $path = $leavefile->image;
            if(File::exists($path)){
                FIle::delete($path);
            }
        }     

        $leave->delete();

        session()->flash("danger", "Delete Successfully");
        return redirect()->back();
    }
}

// HW 
// tag crud 
// post crud 