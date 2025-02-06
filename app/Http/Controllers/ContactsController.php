<?php

namespace App\Http\Controllers;

use App\Notifications\LeaveTagPersonNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

// Models 
use App\Models\Contact;
use App\Models\Gender;
use App\Models\Relative;
use App\Models\User;

use Notification;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        $genders = Gender::orderBy("name","asc")->pluck("name","id");
        $relatives = Relative::orderBy("name","asc")->pluck("name","id");
        $users = User::all();

        return view('contacts.index', compact('contacts', 'genders', 'relatives', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['relatives'] = Relative::orderBy('name','asc')->get();
        $data['genders'] = Gender::orderBy('name','asc')->get();
        $data['birthday'] = Carbon::today()->format('Y-m-d');

        return view('contacts.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'firstname'=>'required|max:50',
            'lastname'=>'nullable|string|max:50',
            'birthday'=>'nullable|date|before:today',            
            'gender_id'=>'nullable|exists:genders,id',
            'relative_id'=>'nullable|exists:relatives,id',            
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        
        $contact = new Contact();       
        $contact->firstname = $request['firstname'];
        $contact->lastname = $request['lastname'];
        $contact->birthday = $request['birthday'];
        $contact->gender_id = $request['gender_id'];
        $contact->relative_id = $request['relative_id'];
        $contact->user_id = $user_id;

        $contact->save();

        session()->flash("success", "New Contact Created");

        return redirect(route('contacts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);       
        $users = User::pluck('name','id');
        $genders = Gender::pluck('name','id');
        $relatives = Relative::pluck('name', 'id');
       
        return view('contacts.show',[ "contact"=>$contact, "users"=>$users, "genders"=>$genders, "relatives"=>$relatives]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);       
        $users = User::pluck('name','id');
        $genders = Gender::pluck('name','id');
        $relatives = Relative::pluck('name', 'id');
        
        return view('contacts.edit',[ "contact"=>$contact, "users"=>$users, "genders"=>$genders, "relatives"=>$relatives]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'editfirstname'=>'required|max:50',
            'editlastname'=>'nullable|string|max:50',
            'editbirthday'=>'nullable|date|before:today',            
            'editgender_id'=>'nullable|exists:genders,id',
            'editrelative_id'=>'nullable|exists:relatives,id',            
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        
        $contact = Contact::findOrFail($id);      
        $contact->firstname = $request['editfirstname'];
        $contact->lastname = $request['editlastname'];
        $contact->birthday = $request['editbirthday'];
        $contact->gender_id = $request['editgender_id'];
        $contact->relative_id = $request['editrelative_id'];
        $contact->user_id = $user_id;

        $contact->save();

        session()->flash("success", "Update Successfully");
        return redirect(route('contacts.index'));        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contacts = Contact::findOrFail($id);
        $contacts->delete();

        session()->flash("error", "Delete Successfully"); 
        return redirect()->back();
    }
}
