<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Models\MainStandard;
use App\Models\Standard;
use App\Models\SubStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CriterionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $status = $request->query('status', 'all'); 

        $query = Criterion::with(['standard']);
        
        if ($filter === 'matching') {
            $query->where('is_met', true);
        } elseif ($filter === 'non_matching') {
            $query->where('is_met', false);
        }
        if ($status !== 'all') {
            $query->where('fulfillment_status', $status);
        }
        $criteria = $query->orderBy('sequence', 'asc')->paginate(10);
        return view('self-study.criteria.index', compact('criteria', 'filter','status'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        // Fetch Main Standards and Sub-Standards for dropdowns
        $mainStandards = Standard::whereNull('parent_id')->get();

        return view('self-study.criteria.create', compact('mainStandards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'main_standard_id' => 'required',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'sequence' => 'required|string|regex:/^\d+(\.\d+)*$/',

        ]);

        if (isset($request->sub_standard_id)) {
            $validated['standard_id'] = $request->sub_standard_id;
        } else {
            $validated['standard_id'] = $request->main_standard_id;
        }

        $criterion = Criterion::create([
            'standard_id' => $validated['standard_id'],
            'sequence' => $validated['sequence'],
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'],
            'is_met' => false,
            'fulfillment_status' => 1,
        ]);

        return redirect()->back()->with('success', 'Criterion created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Criterion $criterion)
    {
        $criteria = Criterion::with(['standard'])->first();
        return view('self-study.criteria.show', compact('criteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $criterion = Criterion::with(['standard.parent', 'links', 'attachments'])->where('id', $id)->first();
        $mainStandards = Standard::whereNull('parent_id')->get();
        if (!$criterion) {
            return redirect()->route('criteria.index')->with('error', __('العنصر المحدد غير موجود.'));
        }

        return view('self-study.criteria.edit', compact('criterion', 'mainStandards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criterion $criterion)
    {
        // Validate the request
        $validated = $request->validate([
            'main_standard_id' => 'required',
            'sequence' => 'required|string|regex:/^\d+(\.\d+)*$/',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'links' => 'nullable|array',
            'links.*.id' => 'nullable|exists:links,id',
            'links.*.name_ar' => 'required|string|max:255',
            'links.*.name_en' => 'required|string|max:255',
            'links.*.url' => 'required|url',
            'deleted_links' => 'nullable|array',
            'deleted_links.*' => 'exists:links,id',
            'attachments' => 'nullable|array',
            'attachments.*.id' => 'nullable|exists:attachments,id',
            'attachments.*.name_ar' => 'required|string|max:255',
            'attachments.*.name_en' => 'required|string|max:255',
            'attachments.*.evidence_code' => 'required|string|max:255',
            'attachments.*.file' => 'nullable|file',
            'deleted_attachments' => 'nullable|array',
            'deleted_attachments.*' => 'exists:attachments,id',
            'is_met' => 'required|boolean:in,1,0',
            'fulfillment_status' => 'required|integer:in,1,2,3,4,5',
        ]);
        if (isset($request->sub_standard_id)) {
            $validated['standard_id'] = $request->sub_standard_id;
        } else {
            $validated['standard_id'] = $request->main_standard_id;
        }
       
        // Update criterion details
        $criterion->update([
            'standard_id' => $validated['standard_id'],
            'sequence' => $validated['sequence'],
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'],
            'content_ar' => $validated['content_ar'] ?? null,
            'content_en' => $validated['content_en'] ?? null,
            'is_met' => $validated['is_met'] ?? 0,
            'fulfillment_status' => $validated['fulfillment_status'] ?? 1,
        ]);

        DB::transaction(function () use ($criterion, $validated, $request) {
            // Delete removed links
            if ($request->has('deleted_links')) {
                $criterion->links()->whereIn('id', $request->deleted_links)->delete();
            }

            // Handle links
            if (isset($validated['links'])) {
                foreach ($validated['links'] as $linkData) {
                    if (isset($linkData['id'])) {
                        $link = $criterion->links()->find($linkData['id']);
                        if ($link) {
                            $link->update([
                                'name_ar' => $linkData['name_ar'],
                                'name_en' => $linkData['name_en'],
                                'url' => $linkData['url'],
                            ]);
                        }
                    } else {
                        $criterion->links()->create([
                            'name_ar' => $linkData['name_ar'],
                            'name_en' => $linkData['name_en'],
                            'url' => $linkData['url'],
                        ]);
                    }
                }
            }

            if ($request->has('deleted_attachments')) {
                $criterion->attachments()->whereIn('id', $request->deleted_attachments)->delete();
            }

            if (isset($validated['attachments'])) {
                foreach ($validated['attachments'] as $attachmentData) {

                    if (isset($attachmentData['id'])) {
                        $attachment = $criterion->attachments()->find($attachmentData['id']);
                        if ($attachment) {
                            $updateData = [
                                'name_ar'       => $attachmentData['name_ar'],
                                'name_en'       => $attachmentData['name_en'],
                                'evidence_code' => $attachmentData['evidence_code'],
                            ];

                            if (isset($attachmentData['file']) && $attachmentData['file']->isValid()) {
                                $filePath = $attachmentData['file']->store('attachments', 'public');
                                $updateData['file_path'] = $filePath;
                            }

                            $attachment->update($updateData);
                        }
                    } elseif (isset($attachmentData['file']) && $attachmentData['file']->isValid()) {
                        $filePath = $attachmentData['file']->store('attachments', 'public');
                        $criterion->attachments()->create([
                            'name_ar' => $attachmentData['name_ar'],
                            'name_en' => $attachmentData['name_en'],
                            'evidence_code' => $attachmentData['evidence_code'],
                            'file_path' => $filePath,
                        ]);
                    }
                }
            }
        });

        return redirect()->back()->with('success', 'Criterion updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function getStandard(Request $request)
    {
        $main_standard_id = $request->input('main_standard_id');
        $subStandards = SubStandard::where('main_standard_id', $main_standard_id)->get();
        $subStandards = $subStandards->map(function ($subStandard) {
            return [
                'id' => $subStandard->id,
                'name' => $subStandard->name,
                'sequence' => $subStandard->sequence,
            ];
        });
        return response()->json($subStandards);
    }
}
