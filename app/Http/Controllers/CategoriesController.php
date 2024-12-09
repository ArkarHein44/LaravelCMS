<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = category::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('categories.index',compact('categories','statuses'));
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

        $categories = new category();
        $categories->name = $request['name'];
        $categories->slug = Str::slug($request['name']);
        $categories->status_id = $request['status_id'];
        $categories->user_id = $user_id;

        $categories->save();

        return redirect(route('categories.index'));
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

        $categories = category::findOrFail($id);
        $categories->name = $request['name'];
        $categories->slug = Str::slug($request['name']);
        $categories->status_id = $request['status_id'];
        $categories->user_id = $user_id;

        $categories->save();

        return redirect(route('categories.index'));

    }

    public function destroy(string $id)
    {
        $categories = category::findOrFail($id);
        $categories->delete();

        return redirect()->back();
    }
}
