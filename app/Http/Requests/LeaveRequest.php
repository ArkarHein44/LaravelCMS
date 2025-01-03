<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // dd($this->method()()); // POST PUT
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if($this->method() == "POST"){

            return [
                'post_id'=>'required|array',

                // post_id က database ထည်းက မှာ ရှိတဲ့ data ကိုပဲလက်ခံမယ် 
                'post_id.*'=>'exists:posts,id',
                'startdate'=>'required|date',
                'enddate'=>'required|date|after_or_equal:startdate',
                'tag'=>'required|array',
                'tag*'=>'exists:users,id',
                'title'=>'required|max:100',
                "image" => "nullable|file|mimes:jpg,jpeg,png|max:1024",
                'content'=>'required'
            ];
        }else{
            return [
                // post_id က မဖြစ်မနေလိုအပ်တယ် | array ဖြစ်ရမယ် 
                'post_id'=>'required|array',

                // post_id က database ထည်းက မှာ ရှိတဲ့ data ကိုပဲလက်ခံမယ် 
                'post_id.*'=>'exists:posts,id',
                'startdate'=>'required|date',
                'enddate'=>'required|date|after_or_equal:startdate',
                'tag'=>'required|array',
                'tag*'=>'exists:users,id',
                'title'=>'required|max:100',
                "image" => "nullable|file|mimes:jpg,jpeg,png|max:1024",
                'content'=>'required'
            ];
        }
        
    }

    public function attributes(){
        return[
            'post_id'=>"class name ",
            'tag'=>'authorize person'
        ];
    }

    public function messages(){
        return[
            'post_id.required'=>"class name can\'t be empty",
            'tag.required'=>'authorize person must be choose'
        ];
    }
}


// php artisan make:request LeaveRequest