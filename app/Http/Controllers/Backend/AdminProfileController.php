<?php

namespace App\Http\Controllers\Backend;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('Admin.vendor-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
       $request->validate([
        'phone' => ['required', 'max:50'],
        'banner'=>['nullable','image', 'max:3000' ],
        'email'=>['required', 'max:200'],
        'address'=>['required'],
        'description'=>['required'],
        'fb_link'=>['nullable', 'url'],
        'fw_link'=>['nullable', 'url'],
        'insta_link'=>['nullable', 'url'],
       ]);
       $profile = Vendor::where('user_id', Auth::user()->id)->first();
       $bannerPath = $this->updateImage($request,'banner', 'uploads', $profile->banner );

       $profile = Vendor::where('user_id', Auth::user()->id)->first()->update([
        'banner' => empty(!$bannerPath) ? $bannerPath : $profile->banner,
        'phone' => $request->phone,
        'address' =>$request->address,
        'email'=>$request->email,
        'description'=>$request->description,
        'fb_link'=>$request->fb_link,
        'tw_link'=>$request->tw_link,
        'inta_link'=>$request->inta_link,
       ]);
       return redirect()->back()->with('message', 'Profilo modificato');
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
        //
    }
}
