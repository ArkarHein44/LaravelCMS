<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Religion;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

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
        $this->validate($request,[
            'name'=>'required'
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $religions = new Religion();
        $religions->name = $request['name'];
        $religions->slug = Str::slug($request['name']);
        $religions->status_id = $request['status_id'];
        $religions->user_id = $user_id;

        $religions->save();

        session()->flash("success", "New relogion Created");
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

        session()->flash("success", "Update Successfully");
        return redirect(route('religions.index'));

    }

    public function destroy(string $id)
    {
        $religions = Religion::findOrFail($id);
        $religions->delete();

        session()->flash("error", "Delete Successfully"); 
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Religion::whereIn('id', $getselectedids)->delete();

            return Response::json(["success"=>"Selected data have been successfully"]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return Response::json(["status"=>"Failed", "message"=>$e->getMessage()]);
        }
    }

}
