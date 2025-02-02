<?php

namespace App\Http\Controllers;

use App\Notifications\LeaveTagPersonNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\Leave;
use App\Models\LeaveFile;
use App\Models\Post;
use App\Models\Tags;
use App\Models\User;
use App\Models\stages;
use Illuminate\Support\Facades\File;
use App\Http\Requests\LeaveRequest;

use Notification;

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
    public function store(LeaveRequest $request)    {

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

                $leavefile = new LeaveFile();
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

        // => Database Notification to multi tag users 
        $tags = $request['tag'];
        $tagpersons = User::whereIn('id', $tags)->get(); // fetch all users at once
        Notification::send($tagpersons, new LeaveTagPersonNotification($leave->id, $leave->title, $leave->user_id));

        session()->flash("success", "New Leave Created");

        return redirect(route('leaves.index'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leave = Leave::findOrFail($id);
        $leavefiles = LeaveFile::where("leave_id",$id)->get(); // load all associated images
        $users = User::pluck('name','id');
        $stages = Stages::whereIn('id',[1,2,4])->where('status_id', 3)->get();
        $allleaves = Leave::where('user_id', $leave->user_id)->orderBy('created_at', 'desc')->get();
       
        return view('leaves.show',["leave"=>$leave,"leavefiles"=>$leavefiles, "users"=>$users, "stages"=>$stages, "allleaves"=>$allleaves]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['leaves'] = Leave::findOrFail($id);
        $data['leavefiles'] = LeaveFile::where("leave_id",$id)->get(); // load all associated images
        $data['posts'] = Post::where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        $data['tags'] = User::orderBy('name','asc')->get()->pluck('name','id');

        return view('leaves.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveRequest $request, string $id)
    {

        $user = Auth::user();
        $user_id = $user->id;
        
        $leave = Leave::findOrFail($id);
        $leave->post_id = $request['post_id'];
        $leave->startdate = $request['startdate'];
        $leave->enddate = $request['enddate'];
        $leave->tag = $request['tag'];
        $leave->title = $request['title'];
        $leave->content = $request['content'];

        if($leave->isconverted()){
            return redirect()->back()->with('info', "Already been converted to an authorize stage. Editing is disabled.");
        }

        $leave->save();
        if($request->hasFile('images')){

            $leavefiles = LeaveFile::where('leave_id',$leave->id)->get();

            // Delete associated records from the database
            foreach($leavefiles as $leavefile){

                $path = $leavefile->image;

                if(File::exists($path)){
                    File::delete($path);
                }

            }

            // Delete associated records from the database
            LeaveFile::where('leave_id',$leave->id)->delete();


            // Multi Images Upload 

            foreach($request->file('images') as $image){

                $leavefile = new LeaveFile(); 
                $leavefile->leave_id = $leave->id;

                $file = $image;
                $fname = $file->getClientOriginalName();
                $imagenewname = uniqid($user_id).$leave['id'].$fname;
                $file->move(public_path('assets/img/leaves/'),$imagenewname);

                $filepath = 'assets/img/leaves/'.$imagenewname;
                $leavefile->image = $filepath;

                $leavefile->save();
            }
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

        if($leave->isconverted()){
            return redirect()->back()->with('error', "Already been converted to an authorize stage. Delete is disabled.");
        }

        // Remove Old multi images 
        foreach($leavefiles as $leavefile){

            $path = $leavefile->image;

            if(File::exists($path)){
                FIle::delete($path);
            }
        }     
        // Delete associated records from the database
        LeaveFile::where('leave_id',$leave->id)->delete();

        $leave->delete();

        session()->flash("error", "Delete Successfully");
        return redirect()->back();
    }

    public function updatestage(Request $request, $id){
        $leave = Leave::findOrFail($id);
        $leave->stage_id = $request->stage_id;
        $leave->save();

        session()->flash("info", "Changed Stage");
        return redirect()->back();
    }
}

// HW 
// tag crud 
// post crud 
// oom057895
// 089507

// mmtt0680
// 123456