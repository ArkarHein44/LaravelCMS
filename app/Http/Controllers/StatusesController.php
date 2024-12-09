<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Status;
use Illuminate\Support\Str;

class StatusesController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('statuses.index',compact('statuses'));
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:statuses,name',
            
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $status = new Status();
        $status->name = $request['name'];
        $status->slug = Str::slug($request['name']);
        $status->user_id = $user_id;

        $status->save();

        return redirect(route('statuses.index'));
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

        $status = Status::findOrFail($id);
        $status->name = $request['name'];
        $status->slug = Str::slug($request['name']);
        $status->user_id = $user_id;

        $status->save();

        return redirect(route('statuses.index'));

    }

    public function destroy(string $id)
    {
        $status = Status::findOrFail($id);
        $status->delete();

        return redirect()->back();
    }
}

// php artisan make:controller StatusesController -r
// alt + enter 