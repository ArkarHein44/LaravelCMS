<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Day;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DaysController extends Controller
{
    public function index()
    {
        $days = Day::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('days.index',compact('days','statuses'));
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>"required"
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $days = new Day();
        $days->name = $request['name'];
        $days->slug = Str::slug($request['name']);
        $days->status_id = $request['status_id'];
        $days->user_id = $user_id;

        $days->save();
        session()->flash("success", "New Day Created");
        return redirect(route('days.index'));
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $days = Day::findOrFail($id);
        $days->name = $request['name'];
        $days->slug = Str::slug($request['name']);
        $days->status_id = $request['status_id'];
        $days->user_id = $user_id;

        $days->save();

        session()->flash("success", "Update Successfully");
        return redirect(route('days.index'));

    }

    public function destroy(string $id)
    {
        $days = Day::findOrFail($id);
        $days->delete();

        session()->flash("error", "Delete Successfully"); 
        return redirect()->back();
    }
}
