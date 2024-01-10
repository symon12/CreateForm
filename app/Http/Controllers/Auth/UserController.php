<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{

    
    public function registration(Request $registration){
        $this->validate($registration,[
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users,email|max:250',
            'password' => [
                'required','confirmed',
                Password::min(5)->letters()->numbers()->symbols()->mixedCase()
            ]
        
        ]);

       
        
       
        


        User::create([
            "name"=>$registration->input("name"),
            "email"=>$registration->input("email"),
            "password"=>Hash::make($registration->input("password"))

        ]);
        
        
        auth()->attempt($registration->only("email","password"));
        return redirect()->route("list_item");
        
    }

    // login====>

    public function login(Request $login){
        $this->validate($login,[

            "email"=>"required|string|max:250",
            "password"=>"required|string|min:4"

        ]);

        User::created([
            "email"=> $login->input("email"),
            "password"=>Hash::make($login->input("password"))
        ]);
        
        if(!auth()->attempt($login->only("email","password"),"remember")){
            return back()->with("status","Invalid email or password");
        }
        
        return redirect()->route("list_item");

    }

    public function __invoke()
    {
      
        auth()->logout();
        return redirect()->route("login");
    }

    public function forget(Request $forget) {
        $this->validate($forget, [
            "oldPassword" => "required|min:4|string",
            "password" => "required|min:4|string|confirmed"
        ]);
    
        if (auth()->check()) {
            if (!Hash::check($forget->oldPassword, auth()->user()->password)) {
                return back()->with("error", "Old Password & New Password doesn't match!");
            }
    
            // No need to check password_confirmation against hash, Laravel's 'confirmed' rule does that
    
            User::whereId(auth()->user()->id)->update([
                "password" => Hash::make($forget->input("password"))
            ]);
    
            return redirect()->route("list_item");
        } else {
            return back()->with("error", "User not authenticated");
        }
    }
    }

