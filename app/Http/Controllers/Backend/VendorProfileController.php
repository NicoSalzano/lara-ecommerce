<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use File;

class VendorProfileController extends Controller
{
    public function index()
    {
        return view('Vendor.dashhboard.profile');
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
            'image' => ['image', 'max:2048']
        ]);

        $user = Auth::user();
        // con l utilizo di fle e dell if cancello la foto che e stata modificata cosi salvo solo la foto corrente
        if ($request->hasFile('image')) {
            if(File::exists(public_path($user->image))){
                File::delete(public_path($user->image));
            }
            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            
            $path = "uploads/".$imageName;
        
            $user->image = $path;
            
        }
        
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        // toaste per mpstrarer gli errori o il successo della modifica ma non mi piacciono
        toastr()->success('Profilo modificato');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed','min:8'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);


        toastr()->success('Profilo modificato');
        return redirect()->back();
    }
}
