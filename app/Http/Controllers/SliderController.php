<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = slider::all();


        return view('backend.Slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.Slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request for each image and other necessary fields
        $validated = $request->validate([
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title1' => 'nullable|string|max:255',
            'title2' => 'nullable|string|max:255',
            'title3' => 'nullable|string|max:255',
            'title4' => 'nullable|string|max:255',
            'title5' => 'nullable|string|max:255',
        ]);

        // Prepare an array to store file paths
        $sliderData = [];

        // Loop through each image field to store the file path
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
                $sliderData['image' . $i] = $request->file('image' . $i)->store('sliderCategories', 'public');
            }

            // Also handle titles (if provided)
            if ($request->has('title' . $i)) {
                $sliderData['title' . $i] = $request->input('title' . $i);
            }
        }

        // Create a new slider with the prepared data
        Slider::create($sliderData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Slider created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('backend.Slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, slider $slider)
    {
        $validated = $request->validate([
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title1' => 'nullable|string|max:255',
            'title2' => 'nullable|string|max:255',
            'title3' => 'nullable|string|max:255',
            'title4' => 'nullable|string|max:255',
            'title5' => 'nullable|string|max:255',
        ]);

        // Prepare an array to store file paths
        $sliderData = [];

        // Loop through each image field to store the file path
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
                $sliderData['image' . $i] = $request->file('image' . $i)->store('sliderCategories', 'public');
            }

            // Also handle titles (if provided)
            if ($request->has('title' . $i)) {
                $sliderData['title' . $i] = $request->input('title' . $i);
            }
        }

        // Create a new slider with the prepared data
        $slider->update($sliderData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Slider update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(slider $slider)
    {
        //
    }
}
