<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;



class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birthday' => 'nullable|date|before:today',
            'gender' => 'in:Male,Female',
            'country' => 'required|string|max:255'
        ]);
        $user = $request->user();

        //$profile = $user->profile;
        
        $user->profile->fill( $request->all() )->save();   //fill for insert OR update data

        return redirect()->route('dashboard.profile.edit')
              ->with('success', 'Profile Updated');     
        /* 
        fill[
            'name'=>
        ]
        methode two
        if ($profile->user_id)//is not true {
            $profile->update($request->all());
        } else {
            /*Create Profile 
            $request->merge([
                'user_id' => $user->id,
            USE RELATIONSHIP:
            */

            /*$user->profile()->create($request->all());
        }*/
    }
}
