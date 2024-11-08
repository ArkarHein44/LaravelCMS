<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Religion;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReligionsController extends Controller
{
    public function index()
    {
        $religions = Religion::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('religions.index',compact('religions','statuses'));
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $religions = new Religion();
        $religions->name = $request['name'];
        $religions->slug = Str::slug($request['name']);
        $religions->status_id = $request['status_id'];
        $religions->user_id = $user_id;

        $religions->save();

        return redirect(route('religions.index'));
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

        $religions = Religion::findOrFail($id);
        $religions->name = $request['name'];
        $religions->slug = Str::slug($request['name']);
        $religions->status_id = $request['status_id'];
        $religions->user_id = $user_id;

        $religions->save();

        return redirect(route('religions.index'));

    }

    public function destroy(string $id)
    {
        $religions = Religion::findOrFail($id);
        $religions->delete();

        return redirect()->back();
    }
}
