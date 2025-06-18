<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{

    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $query = Standard::whereNull('parent_id');

        // Check if user is super admin
        if (!auth()->user()->hasRole('super admin')) {
            $query->whereHas('users', function($q) {
                $q->where('users.id', auth()->id());
            });
        }

        $query->with([
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
        $mainStandards = Standard::where('type', 'main')
            ->get()
            ->map(function($standard) {
                return [
                    'id' => $standard->id,
                    'text' => $standard->sequence . ' - ' . ($standard->name)
                ];
            })
            ->pluck('text', 'id');
        $mainStandards->prepend(__('Select Main Standard'), null);
        return view('self-study.standards.create', compact('mainStandards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = \Validator::make($request->all(), [
            'type' => 'required|in:main,sub', // Type: 'main' for Main Standard, 'sub' for Sub-Standard
            'parent_id' => 'nullable|required_if:type,sub|exists:standards,id', // Parent ID required for sub-standards
            'sequence' => 'required|string|regex:/^\d+(\.\d+)*$/',
            'name_ar' => 'required|string',
            'name_en' => 'nullable|string',
            'introduction_ar' => 'nullable|string',
            'introduction_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'summary_ar' => 'nullable|string',
            'summary_en' => 'nullable|string',
            'completion_status' => 'required|in:incomplete,partially_completed,completed'

        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $validated = $validated->validated();



        // Create the standard
        Standard::create([
            'type' => $validated['type'],
            'parent_id' => $validated['parent_id'] ?? null,
            'sequence' => $validated['sequence'],
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'] ?? null,
            'introduction_ar' => $validated['introduction_ar'],
            'introduction_en' => $validated['introduction_en'],
            'description_ar' => $validated['description_ar'],
            'description_en' => $validated['description_en'],
            'summary_ar' => $validated['summary_ar'],
            'summary_en' => $validated['summary_en'],
            'completion_status' => $validated['completion_status']
        ]);

        return redirect()->route('standards.index')->with('success', __('Standard created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if($id == null) {
            return redirect()->route('standards.index')->with('error', __('Standard not found.'));
        }
        $standard = Standard::with(['children', 'criteria'])->findOrFail($id);
        return view('self-study.standards.show', compact('standard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the standard by ID
        $standard = Standard::with(['children', 'criteria'])->findOrFail($id);
        $mainStandards = Standard::whereNot('id', $id)
            ->get()
            ->map(function($standard) {
                return [
                    'id' => $standard->id,
                    'text' => $standard->sequence . ' - ' . ($standard->name)
                ];
            })
            ->pluck('text', 'id');
        if ($mainStandards->isNotEmpty()) {
            $mainStandards->prepend(__('Select Main Standard'), null);
        } else {
            $mainStandards->prepend(__('Not Found Main Standard'), null);
        }
        return view('self-study.standards.edit', compact('mainStandards', 'standard'));
    }

    public function getChildren(Request $request)
    {
        $validated =  $request->validate([
            'parent_id' => 'required', // Ensure valid type
        ]);
        $subStandards = Standard::where('parent_id', $validated['parent_id'])->get();
        $subStandards = $subStandards->map(function ($subStandard) {
            return [
                'id' => $subStandard->id,
                'name' => $subStandard->name,
                'sequence' => $subStandard->sequence,
            ];
        });
        return response()->json($subStandards);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = \Validator::make($request->all(), [
            'type' => 'required|in:main,sub', // Type: 'main' for Main Standard, 'sub' for Sub-Standard
            'parent_id' => 'nullable|required_if:type,sub|exists:standards,id', // Parent ID required for sub-standards
            'sequence' => 'required|string|regex:/^\d+(\.\d+)*$/',
            'name_ar' => 'required|string',
            'name_en' => 'nullable|string',
            'introduction_ar' => 'nullable|string',
            'introduction_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'summary_ar' => 'nullable|string',
            'summary_en' => 'nullable|string',
            'completion_status' => 'required|in:incomplete,partially_completed,completed' // Validate completion status
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $validated = $validated->validated();


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
            'name_en' => $validated['name_en'] ?? null,
            'introduction_ar' => $validated['introduction_ar'],
            'introduction_en' => $validated['introduction_en'],
            'description_ar' => $validated['description_ar'],
            'description_en' => $validated['description_en'],
            'summary_ar' => $validated['summary_ar'],
            'summary_en' => $validated['summary_en'],
            'completion_status' => $validated['completion_status']

        ]);

        return redirect()->route('standards.index')->with('success', __('Standard updated successfully.'));
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $standard = Standard::findOrFail($id);

        if ($standard->children()->count() > 0) {
            return redirect()->route('standards.index')->with('error', __('Cannot delete a standard that has sub-standards. Please delete all sub-standards first.'));
        }

        $standard->criteria()->delete();
        $standard->users()->detach();
        $standard->delete();
        return redirect()->route('standards.index')->with('success', __('Standard deleted successfully.'));
    }
}
