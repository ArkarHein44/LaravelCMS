<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class GendersController extends Controller
{
    public function index()
    {
        $genders = Gender::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('genders.index',compact('genders','statuses'));
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

        $genders = new Gender();
        $genders->name = $request['name'];
        $genders->slug = Str::slug($request['name']);
        $genders->status_id = $request['status_id'];
        $genders->user_id = $user_id;

        $genders->save();

        session()->flash("success", "New Gender Created");
        return redirect(route('genders.index'));
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

        $genders = Gender::findOrFail($id);
        $genders->name = $request['name'];
        $genders->slug = Str::slug($request['name']);
        $genders->status_id = $request['status_id'];
        $genders->user_id = $user_id;

        $genders->save();

        session()->flash("success", "Update Successfully");
        return redirect(route('genders.index'));

    }

    public function destroy(string $id)
    {
        $genders = Gender::findOrFail($id);
        $genders->delete();

        session()->flash("error", "Delete Successfully"); 
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Gender::whereIn('id', $getselectedids)->delete();

            return Response::json(["success"=>"Selected data have been successfully"]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return Response::json(["status"=>"Failed", "message"=>$e->getMessage()]);
        }
    }
}
