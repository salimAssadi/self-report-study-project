<?php

namespace App\Http\Controllers;

use App\Models\SubStandard;
use Illuminate\Http\Request;

class SubStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainStandards = MainStandard::with(['subStandards.criteria'])->get();
        return view('main_standards.index', compact('mainStandards'));
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
        $validated = $request->validate([
            'main_standard_id' => 'required|exists:main_standards,id',
            'sequence' => 'required|integer',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        SubStandard::create($validated);
        return redirect()->back()->with('success', 'Sub Standard created successfully.');
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
    public function update(Request $request, SubStandard $subStandard)
    {
        $validated = $request->validate([
            'main_standard_id' => 'required|exists:main_standards,id',
            'sequence' => 'required|integer',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $subStandard->update($validated);
        return redirect()->back()->with('success', 'Sub Standard updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
