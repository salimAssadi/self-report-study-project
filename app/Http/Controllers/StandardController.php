<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{
   
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $query = Standard::whereNull('parent_id')
            ->with([
                'children' => function ($childQuery) use ($filter) {
                    if ($filter !== 'all') {
                        $childQuery->where('completion_status', $filter);
                    }
                    $childQuery->orderBy('sequence', 'asc');
                },
                'criteria' => function ($query) {
                    $query->orderBy('sequence', 'asc');
                }
            ])
            ->orderBy('sequence', 'asc');

        if ($filter !== 'all') {
            $query->where(function ($q) use ($filter) {
                $q->where('completion_status', $filter) // Parent matches the filter
                    ->orWhereHas('children', function ($childQuery) use ($filter) {
                        $childQuery->where('completion_status', $filter); // Child matches the filter
                    });
            });
        }

        $standards = $query->get();

        return view('self-study.standards.index', compact('standards', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainStandards = Standard::where('type', 'main')->pluck('name_ar', 'id'); // Fetch all main standards
        $mainStandards->prepend('Select Main Standard', null);
        return view('self-study.standards.create', compact('mainStandards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'type' => 'required|in:main,sub', // Type: 'main' for Main Standard, 'sub' for Sub-Standard
            'parent_id' => 'nullable|required_if:type,sub|exists:standards,id', // Parent ID required for sub-standards
            'sequence' => 'required|string|regex:/^\d+(\.\d+)*$/',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'introduction_ar' => 'nullable|string',
            'introduction_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'summary_ar' => 'nullable|string',
            'summary_en' => 'nullable|string',
            'completion_status' => 'required|in:incomplete,partially_completed,completed'

        ]);

        // Create the standard
        Standard::create([
            'type' => $validated['type'],
            'parent_id' => $validated['parent_id'] ?? null,
            'sequence' => $validated['sequence'],
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'],
            'introduction_ar' => $validated['introduction_ar'],
            'introduction_en' => $validated['introduction_en'],
            'description_ar' => $validated['description_ar'],
            'description_en' => $validated['description_en'],
            'summary_ar' => $validated['summary_ar'],
            'summary_en' => $validated['summary_en'],
            'completion_status' => $validated['completion_status']
        ]);

        return redirect()->route('admin.standards.index')->with('success', __('Standard created successfully.'));
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
        // Fetch the standard by ID
        $standard = Standard::with(['children', 'criteria'])->findOrFail($id);
        $mainStandards = Standard::whereNot('id', $id)->pluck('name_ar', 'id');
        if ($mainStandards->isNotEmpty()) {
            $mainStandards->prepend('Select Main Standard', null);
        } else {
            $mainStandards->prepend('Not Found', null);
        }
        return view('self-study.standards.edit', compact('mainStandards', 'standard'));
    }

    public function getChildren(Request $request)
    {
        $validated =  $request->validate([
            'parent_id' => 'required', // Ensure valid type
        ]);
        $subStandards = Standard::where('parent_id', $validated['parent_id'])->get();
        return response()->json($subStandards);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'type' => 'required|in:main,sub', // Type: 'main' for Main Standard, 'sub' for Sub-Standard
            'parent_id' => 'nullable|required_if:type,sub|exists:standards,id', // Parent ID required for sub-standards
            'sequence' => 'required|string|regex:/^\d+(\.\d+)*$/',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'introduction_ar' => 'nullable|string',
            'introduction_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'summary_ar' => 'nullable|string',
            'summary_en' => 'nullable|string',
            'completion_status' => 'required|in:incomplete,partially_completed,completed' // Validate completion status
        ]);


        // Find the standard by ID
        $standard = Standard::findOrFail($id);

        // Ensure the type matches the existing record's type (optional validation)
        if ($standard->type !== $validated['type']) {
            return redirect()->back()->with('error', __('You cannot change the type of an existing standard.'));
        }

        // Update the standard
        $standard->update([
            'type' => $validated['type'],
            'parent_id' => $validated['parent_id'] ?? null,
            'sequence' => $validated['sequence'],
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'],
            'introduction_ar' => $validated['introduction_ar'],
            'introduction_en' => $validated['introduction_en'],
            'description_ar' => $validated['description_ar'],
            'description_en' => $validated['description_en'],
            'summary_ar' => $validated['summary_ar'],
            'summary_en' => $validated['summary_en'],
            'completion_status' => $validated['completion_status']

        ]);

        return redirect()->route('admin.standards.index')->with('success', __('Standard updated successfully.'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
