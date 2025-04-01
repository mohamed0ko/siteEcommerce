<?php

namespace App\Http\Controllers;

use App\Models\Contact_info;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Contact_info = Contact_info::all();
        return view('backend.ContactInfo.index', compact('Contact_info'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ContactInfo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name_webSite' => 'required|string|max:255',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:12',
            'phone2' => 'required|string|max:12',
            'address' => 'required|string|max:255',
            'support' => 'required|email|max:100',
            'contact__map' => 'required|string|max:255',


        ]);
        $existingSlider = Contact_info::first();
        if ($existingSlider) {
            return redirect()->back()->with('error', 'info already exists.');
        }

        Contact_info::create($validation);
        return redirect()->back()->with('success', 'info create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact_info $contact_info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact_info $contact_info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact_info $contact_info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact_info $contact_info)
    {
        //
    }
}
