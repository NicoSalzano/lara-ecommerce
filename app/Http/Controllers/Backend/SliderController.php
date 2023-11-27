<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'banner' => ['required','max:2028','image'],
            'type' => ['string','max:200'],
            'title' => ['required','max:200'],
            'starting_price' =>['max:200'],
            'btn_url' =>['url'],
            'serial' =>['required', 'integer'],
            'status' =>['required']
        ]);

        // $slider = new Slider();

        // $slider->type = $request->type;
        // $slider->title = $request->title;
        // $slider->starting_price = $request->starting_price;
        // $slider->btn_url = $request->btn_url;
        // $slider->serial = $request->serial;
        // $slider->status = $request->status;
        // $slider->save();

        $imagePath = $this->uploadImage($request, 'banner','uploads');

        $slider = Slider::create([
            'banner' => $imagePath,
            'type' => $request->type,
            'title' => $request->title,
            'starting_price' => $request->starting_price,
            'btn_url' => $request->btn_url,
            'serial' => $request->serial,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('message', 'tutto ok');

        
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
