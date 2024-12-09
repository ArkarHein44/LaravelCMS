<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tags;
use App\Models\Status;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tags::all();        
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('tags.index', compact('tags', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:tags,name',
            
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $tags = new Tags();
        $tags->name = $request['name'];
        $tags->slug = Str::slug($request['name']);
        $tags->status_id = $request['status_id'];
        $tags->user_id = $user_id;

        $tags->save();

        return redirect(route('tags.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tags = Tags::findOrFail($id);
        $tags->delete();

        return redirect()->back();
    }
}
