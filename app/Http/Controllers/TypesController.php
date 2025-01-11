<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Types;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class TypesController extends Controller
{
    public function index()
    {
        $types = Types::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('types.index',compact('types','statuses'));
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:50|unique:types,name',
            'status_id'=>'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $type = new Types();
        $type->name = $request['name'];
        $type->slug = Str::slug($request['name']);
        $type->status_id = $request['status_id'];
        $type->user_id = $user_id;

        $type->save();

        session()->flash("success", "New Type Created");
        return redirect(route('types.index'));
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

        $type = Types::findOrFail($id);
        $type->name = $request['name'];
        $type->slug = Str::slug($request['name']);
        $type->status_id = $request['status_id'];
        $type->user_id = $user_id;

        $type->save();

        session()->flash("success", "Update Successfully");
        return redirect(route('types.index'));

    }

    public function destroy(string $id)
    {
        $type = Types::findOrFail($id);
        $type->delete();

        session()->flash("error", "Delete Successfully"); 
        return redirect()->back();
    }
}
