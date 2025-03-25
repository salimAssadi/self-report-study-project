<?php

namespace App\Http\Controllers;

use App\Models\MainStandard;
use App\Models\SubStandard;
use Illuminate\Http\Request;

class MainStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainStandards = MainStandard::with(['subStandards.criteria'])->get();
        return view('self-study.main_standards.index', compact('mainStandards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainStandards =  MainStandard::with(['subStandards.criteria'])->get();
        // dd( $mainStandards);
        return view('self-study.main_standards.create', compact('mainStandards'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'type' => 'required|in:main,sub', // Type: 'main' for Main Standard, 'sub' for Sub-Standard
            'main_standard_id' => 'nullable|required_if:type,sub|exists:main_standards,id',
            'sequence' => 'required|numeric|min:0',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'introduction_ar' => 'nullable|string',
            'introduction_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'summary_ar' => 'nullable|string',
            'summary_en' => 'nullable|string',
        ]);

        // Determine if the type is Main Standard or Sub-Standard
        if ($request->type === 'main') {
            MainStandard::create([
                'sequence' => $validated['sequence'],
                'name_ar' => $validated['name_ar'],
                'name_en' => $validated['name_en'],
                'introduction_ar' => $validated['introduction_ar'],
                'introduction_en' => $validated['introduction_en'],
                'description_ar' => $validated['description_ar'],
                'description_en' => $validated['description_en'],
                'summary_ar' => $validated['summary_ar'],
                'summary_en' => $validated['summary_en'],
                'completion_status' => 'incomplete',

            ]);
        } elseif ($request->type === 'sub') {
            // Create a Sub-Standard
            SubStandard::create([
                'main_standard_id' => $validated['main_standard_id'],
                'sequence' => $validated['sequence'],
                'name_ar' => $validated['name_ar'],
                'name_en' => $validated['name_en'],
                'description_ar' => $validated['description_ar'],
                'description_en' => $validated['description_en'],
                'completion_status' => 'incomplete',
            ]);
        }
        return redirect()->route('admin.main-standards.index')->with('success', __('Standard created successfully.'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'type' => 'required|in:main,sub', // Type: 'main' for Main Standard, 'sub' for Sub-Standard
            'main_standard_id' => 'nullable|required_if:type,sub|exists:main_standards,id',
            'sequence' => 'required|numeric|min:0',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'introduction_ar' => 'nullable|string',
            'introduction_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'summary_ar' => 'nullable|string',
            'summary_en' => 'nullable|string',
        ]);

        // Find the standard by ID
        
        // Determine if the type is Main Standard or Sub-Standard
        $standard = MainStandard::findOrFail($id);
        if ($request->type === 'main') {
            // Update a Main Standard
            $standard->update([
                'sequence' => $validated['sequence'],
                'name_ar' => $validated['name_ar'],
                'name_en' => $validated['name_en'],
                'introduction_ar' => $validated['introduction_ar'],
                'introduction_en' => $validated['introduction_en'],
                'description_ar' => $validated['description_ar'],
                'description_en' => $validated['description_en'],
                'summary_ar' => $validated['summary_ar'],
                'summary_en' => $validated['summary_en'],
                'completion_status' => $standard->completion_status ?? 'incomplete', // Preserve existing status
            ]);
        } elseif ($request->type === 'sub') {
            // Ensure the standard is a Sub-Standard
            if ($standard instanceof SubStandard) {
                // Update a Sub-Standard
                $standard->update([
                    'main_standard_id' => $validated['main_standard_id'],
                    'sequence' => $validated['sequence'],
                    'name_ar' => $validated['name_ar'],
                    'name_en' => $validated['name_en'],
                    'description_ar' => $validated['description_ar'],
                    'description_en' => $validated['description_en'],
                    'completion_status' => $standard->completion_status ?? 'incomplete', // Preserve existing status
                ]);
            } else {
                return redirect()->back()->with('error', __('The selected standard is not a sub-standard.'));
            }
        }

        return redirect()->route('admin.main-standards.index')->with('success', __('Standard updated successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(MainStandard $mainStandard)
    {
        // Fetch the Main Standard and its Sub-Standards
        $subStandards = $mainStandard->subStandards;
        return view('self-study.main_standards.show', compact('mainStandard', 'subStandards'));
    }
    /**
     * Show the form for editing the specified resource.
     */

    public function edit(MainStandard $mainStandard)
    {
        $standard = MainStandard::findOrFail($mainStandard->id);
        $mainStandards = MainStandard::pluck('name_ar', 'id'); // Fetch all main standards

        return view('self-study.main_standards.edit', compact('mainStandards', 'standard'));
    }


    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, MainStandard $mainStandard)
    // {
    //     $validated = $request->validate([
    //         'sequence' => 'required|integer',
    //         'name_ar' => 'required|string',
    //         'name_en' => 'required|string',
    //         'introduction_ar' => 'nullable|string',
    //         'introduction_en' => 'nullable|string',
    //         'description_ar' => 'nullable|string',
    //         'description_en' => 'nullable|string',
    //         'summary_ar' => 'nullable|string',
    //         'summary_en' => 'nullable|string',
    //     ]);

    //     $mainStandard->update($validated);
    //     return redirect()->route('admin.main-standards.index')->with('success', 'Main Standard updated successfully.');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainStandard $mainStandard)
    {
        $mainStandard->delete();
        return redirect()->route('admin.main-standards.index')->with('success', 'Main Standard deleted successfully.');
    }


    public function getStandardsByType(Request $request)
    {
        // Validate the request
        $request->validate([
            'type' => 'required|string|in:main,sub', // Ensure valid type
        ]);

        $type = $request->input('type');

        if ($type === 'main') {
            // Fetch main standards with sub-standards
            $standards = MainStandard::with(['subStandards' => function ($query) {
                $query->select('id', 'main_standard_id', 'name_ar', 'name_en');
            }])
                ->select('id', 'name_ar', 'name_en')
                ->get()
                ->map(function ($standard) {
                    return [
                        'id' => $standard->id,
                        'name' => $standard->name_ar ?? $standard->name_en,
                        'sub_standards' => $standard->subStandards->map(function ($sub) {
                            return [
                                'id' => $sub->id,
                                'name' => $sub->name_ar ?? $sub->name_en,
                            ];
                        }),
                    ];
                });
        } elseif ($type === 'sub') {
            // Fetch sub-standards with their main standard
            $standards = SubStandard::with(['mainStandard' => function ($query) {
                $query->select('id', 'name_ar', 'name_en');
            }])
                ->select('id', 'main_standard_id', 'name_ar', 'name_en')
                ->get()
                ->map(function ($sub) {
                    return [
                        'id' => $sub->id,
                        'name' => ($sub->mainStandard->name_ar ?? $sub->mainStandard->name_en) . ' / ' . ($sub->name_ar ?? $sub->name_en),
                    ];
                });
        } else {
            // Return empty response for invalid type
            return response()->json(['message' => 'Invalid type'], 400);
        }

        return response()->json($standards);
    }
}
