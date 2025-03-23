<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Models\MainStandard;
use App\Models\SubStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CriterionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $criteria = Criterion::with(['standard'])->paginate(10);
        return view('self-study.criteria.index', compact('criteria'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        // Fetch Main Standards and Sub-Standards for dropdowns
        $mainStandards = MainStandard::all();
        $subStandards = SubStandard::all();

        return view('self-study.criteria.create', compact('mainStandards', 'subStandards'));
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
            'sequence' => 'required|numeric|min:0',

        ]);

        if(isset($request->sub_standard_id)){
            $validated['standard_type'] = 'sub';
            $validated['standard_id'] = $request->sub_standard_id;
        }else{
            $validated['standard_type'] ='main';
            $validated['standard_id'] = $request->main_standard_id;
        }
        
        $criterion = Criterion::create([
            'standard_id' => $validated['standard_id'],
            'standard_type' => $validated['standard_type'],
            'sequence' => $validated['sequence'],
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'],
            'is_met' => false,
            'fulfillment_status' => 1,
        ]);

        return redirect()->back()->with('success', 'Criterion created successfully.');
    }

    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $validated = $request->validate([
    //         'standard_type' => 'required|in:App\Models\MainStandard,App\Models\SubStandard',
    //         'standard_id' => 'required|exists:'.$request->standard_type.',id',
    //         'name_ar' => 'required|string|max:255',
    //         'name_en' => 'required|string|max:255',
    //         'content_ar' => 'nullable|string',
    //         'content_en' => 'nullable|string',
    //         'compliance' => 'required|in:yes,no',
    //         'fulfillment_status' => 'required|in:1,2,3,4,5',
    //         'completion_status' => 'required|in:incomplete,partially_complete,complete',
    //         'links' => 'nullable|array',
    //         'links.*.name_ar' => 'nullable|string|max:255',
    //         'links.*.name_en' => 'nullable|string|max:255',
    //         'links.*.url' => 'nullable|url',
    //         'attachments' => 'nullable|array',
    //         'attachments.*.name_ar' => 'nullable|string|max:255',
    //         'attachments.*.name_en' => 'nullable|string|max:255',
    //         'attachments.*.file' => 'nullable|file',
    //     ]);

    //     // Create the criterion
    //     $criterion = Criterion::create([
    //         'standard_type' => $validated['standard_type'],
    //         'standard_id' => $validated['standard_id'],
    //         'name_ar' => $validated['name_ar'],
    //         'name_en' => $validated['name_en'],
    //         'content_ar' => $validated['content_ar'],
    //         'content_en' => $validated['content_en'],
    //         'compliance' => $validated['compliance'],
    //         'fulfillment_status' => $validated['fulfillment_status'],
    //         'completion_status' => $validated['completion_status'],
    //     ]);

    //     // Store links
    //     if (isset($validated['links'])) {
    //         foreach ($validated['links'] as $linkData) {
    //             $criterion->links()->create([
    //                 'name_ar' => $linkData['name_ar'],
    //                 'name_en' => $linkData['name_en'],
    //                 'url' => $linkData['url'],
    //             ]);
    //         }
    //     }

    //     // Store attachments
    //     if (isset($validated['attachments'])) {
    //         foreach ($validated['attachments'] as $attachmentData) {
    //             if (isset($attachmentData['file'])) {
    //                 $filePath = $attachmentData['file']->store('attachments', 'public');
    //                 $criterion->attachments()->create([
    //                     'name_ar' => $attachmentData['name_ar'],
    //                     'name_en' => $attachmentData['name_en'],
    //                     'file_path' => $filePath,
    //                 ]);
    //             }
    //         }
    //     }

    //     return redirect()->route('criteria.index')->with('success', __('Criterion created successfully.'));
    // }
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
        $criteria = Criterion::with(['standard','links','attachments'])->where('id', $id)->first();
        // $criteria = Criterion::with(['standard',])->where('id', $id)->first();
        if (!$criteria) {
            return redirect()->route('criteria.index')->with('error', __('العنصر المحدد غير موجود.'));
        }
        if ($criteria->standard_type == "main") {
            $Standards = MainStandard::all();
        } else {
            $Standards =  SubStandard::all();;
        }
        return view('self-study.criteria.edit', compact('criteria', 'Standards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criterion $criterion)
    {
        
        // Validate the request
        $validated = $request->validate([
            'main_standard_id' => 'required',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'links' => 'nullable|array',
            'links.*.id' => 'nullable|exists:links,id', // Ensure link IDs exist if provided
            'links.*.name_ar' => 'nullable|string|max:255',
            'links.*.name_en' => 'nullable|string|max:255',
            'links.*.url' => 'nullable|url',
            'attachments' => 'nullable|array',
            'attachments.*.id' => 'nullable|exists:attachments,id', // Ensure attachment IDs exist if provided
            'attachments.*.name_ar' => 'nullable|string|max:255',
            'attachments.*.name_en' => 'nullable|string|max:255',
            'attachments.*.file' => 'nullable|file|mimes:pdf,jpg,png|max:5120', // Max 5MB
        ]);
        if(isset($request->sub_standard_id)){
            $validated['standard_type'] = 'sub';
            $validated['standard_id'] = $request->sub_standard_id;
        }else{
            $validated['standard_type'] ='main';
            $validated['standard_id'] = $request->main_standard_id;
        }
        // Update criterion details
        $criterion->update([
            'standard_id' => $validated['standard_id'],
            'standard_type' => $validated['standard_type'],
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'],
            'content_ar' => $validated['content_ar'] ?? null,
            'content_en' => $validated['content_en'] ?? null,
        ]);

        DB::transaction(function () use ($criterion, $validated) {
            // Delete removed links
            $existingLinkIds = $criterion->links()->pluck('id')->toArray();
            $submittedLinkIds = array_filter(array_column($validated['links'] ?? [], 'id'));
            $removedLinkIds = array_diff($existingLinkIds, $submittedLinkIds);
        
            if (!empty($removedLinkIds)) {
                $criterion->links()->whereIn('id', $removedLinkIds)->delete();
            }
        
            // Delete removed attachments
            $existingAttachmentIds = $criterion->attachments()->pluck('id')->toArray();
            $submittedAttachmentIds = array_filter(array_column($validated['attachments'] ?? [], 'id'));
            $removedAttachmentIds = array_diff($existingAttachmentIds, $submittedAttachmentIds);
        
            if (!empty($removedAttachmentIds)) {
                $criterion->attachments()->whereIn('id', $removedAttachmentIds)->delete();
            }
        
            // Handle attachments
            if (isset($validated['attachments'])) {
                foreach ($validated['attachments'] as $attachmentData) {
                    if (isset($attachmentData['id'])) {
                        // Update existing attachment
                        $attachment = $criterion->attachments()->find($attachmentData['id']);
                        if ($attachment) {
                            // Check if a new file is provided
                            if (isset($attachmentData['file']) && $attachmentData['file']->isValid()) {
                                // Store the new file and update the file_path
                                $filePath = $attachmentData['file']->store('attachments', 'public');
                                $attachment->update([
                                    'name_ar' => $attachmentData['name_ar'],
                                    'name_en' => $attachmentData['name_en'],
                                    'file_path' => $filePath, // Update file_path if a new file is uploaded
                                ]);
                            } else {
                                // Only update names if no new file is uploaded
                                $attachment->update([
                                    'name_ar' => $attachmentData['name_ar'],
                                    'name_en' => $attachmentData['name_en'],
                                ]);
                            }
                        }
                    } elseif (isset($attachmentData['file'])) {
                        // Create new attachment if no ID is provided
                        if ($attachmentData['file']->isValid()) {
                            $filePath = $attachmentData['file']->store('attachments', 'public');
                            $criterion->attachments()->create([
                                'name_ar' => $attachmentData['name_ar'],
                                'name_en' => $attachmentData['name_en'],
                                'file_path' => $filePath,
                            ]);
                        }
                    }
                }
            }
        });
      
        return redirect()->back()->with('success', __('Criterion updated successfully.'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function getStandard(Request $request) {
        $main_standard_id = $request->input('main_standard_id');
        $subStandards = SubStandard::where('main_standard_id', $main_standard_id)->get();
    
        return response()->json($subStandards);
    }
}
