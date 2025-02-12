<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tags;
use App\Models\Status;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

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

        session()->flash("success", "New Tag Created");
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
        
        session()->flash("success", "Update Successfully");
        return redirect(route('statuses.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tags = Tags::findOrFail($id);
        $tags->delete();

        session()->flash("error", "Delete Successfully"); 
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Tags::whereIn('id', $getselectedids)->delete();

            return Response::json(["success"=>"Selected data have been successfully"]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return Response::json(["status"=>"Failed", "message"=>$e->getMessage()]);
        }
    }
}
