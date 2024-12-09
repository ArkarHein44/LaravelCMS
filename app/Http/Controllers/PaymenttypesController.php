<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paymenttype;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymenttypesController extends Controller
{
    public function index()
    {
        $paymenttypes = Paymenttype::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('paymenttypes.index',compact('paymenttypes','statuses'));
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

        $paymenttypes = new Paymenttype();
        $paymenttypes->name = $request['name'];
        $paymenttypes->slug = Str::slug($request['name']);
        $paymenttypes->status_id = $request['status_id'];
        $paymenttypes->user_id = $user_id;

        $paymenttypes->save();

        return redirect(route('paymenttypes.index'));
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

        $paymenttypes = Paymenttype::findOrFail($id);
        $paymenttypes->name = $request['name'];
        $paymenttypes->slug = Str::slug($request['name']);
        $paymenttypes->status_id = $request['status_id'];
        $paymenttypes->user_id = $user_id;

        $paymenttypes->save();

        return redirect(route('paymenttypes.index'));

    }

    public function destroy(string $id)
    {
        $paymenttypes = Paymenttype::findOrFail($id);
        $paymenttypes->delete();

        return redirect()->back();
    }
}
