<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Relative;
use App\Models\User;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RelativesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relatives = Relative::all();
        $user = User::pluck('name', 'id');

        $statuses = Status::whereIn('id',[3,4])->get();
        return view('relatives.index',compact('relatives', 'user', 'statuses'));

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
            'name'=>'required'
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $genders = new Relative();
        $genders->name = $request['name'];
        $genders->slug = Str::slug($request['name']);
        $genders->status_id = $request['status_id'];
        $genders->user_id = $user_id;

        $genders->save();

        session()->flash("success", "New Relative Created");
        return redirect(route('relatives.index'));
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
        $relatives = Relative::findOrFail($id);
        $relatives->delete();

        session()->flash("error", "Delete Successfully"); 
        return redirect()->back();
    }
}
