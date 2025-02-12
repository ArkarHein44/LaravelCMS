<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stages;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class StagesController extends Controller
{
    public function index()
    {
        $stages = stages::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('stages.index',compact('stages','statuses'));
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

        $stages = new stages();
        $stages->name = $request['name'];
        $stages->slug = Str::slug($request['name']);
        $stages->status_id = $request['status_id'];
        $stages->user_id = $user_id;

        $stages->save();
        
        session()->flash("success", "New Stage Created");
        return redirect(route('stages.index'));
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

        $stages = stages::findOrFail($id);
        $stages->name = $request['name'];
        $stages->slug = Str::slug($request['name']);
        $stages->status_id = $request['status_id'];
        $stages->user_id = $user_id;

        $stages->save();

        session()->flash("success", "Update Successfully");
        return redirect(route('stages.index'));

    }

    public function destroy(string $id)
    {
        $stages = stages::findOrFail($id);
        $stages->delete();

        session()->flash("error", "Delete Successfully"); 
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            stages::whereIn('id', $getselectedids)->delete();

            return Response::json(["success"=>"Selected data have been successfully"]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return Response::json(["status"=>"Failed", "message"=>$e->getMessage()]);
        }
    }

}
