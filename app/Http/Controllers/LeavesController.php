<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Leave;
use App\Models\Post;
use App\Models\Tags;
use App\Models\User;

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
        return redirect(route('leaves.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();

        return redirect()->back();
    }
}

// HW 
// tag crud 
// post crud 