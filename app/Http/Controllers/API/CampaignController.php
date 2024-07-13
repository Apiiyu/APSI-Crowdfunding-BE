<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = request()->input('title');
        $description = request()->input('description');
        $page = request()->input('page', 1);
        $limit = request()->input('limit', 10);

        $campaign = Campaign::query();

        if ($title) {
            $campaign->where('title', 'like', '%' . $title . '%');
        }

        if ($description) {
            $campaign->where('description', 'like', '%' . $description . '%');
        }

        if ($page) {
            $campaign->skip(($page - 1) * $limit);
        }

        // ? Show relationship data
        $campaign->with(['category', 'organization']);

        return ResponseFormatter::success(
            $campaign->paginate($limit),
            'Data list campaign berhasil',
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'organization_id' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'image',
            'target_fund' => 'required|integer',
            'current_fund' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // ? Check if the campaign logo is uploaded
        $image = null;

        if ($request->file('image')) {
            $image = $request->file('image')->store('uploads/campaigns', 'public');
        }

        $campaign = Campaign::create([
            'category_id' => $request->category_id,
            'organization_id' => $request->organization_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'target_fund' => $request->target_fund,
            'current_fund' => $request->current_fund,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return ResponseFormatter::success($campaign, 'Data campaign berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ? Find campaign by ID and show their relationship data
        $campaign = Campaign::with(['category', 'organization'])->find($id);

        if ($campaign) {
            return ResponseFormatter::success($campaign, 'Data campaign berhasil diambil');
        } else {
            return ResponseFormatter::error(null, 'Data campaign tidak ada', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campaign = Campaign::find($id);

        if ($campaign) {
            $request->validate([
                'category_id' => 'required|integer',
                'organization_id' => 'required|integer',
                'title' => 'required|string',
                'description' => 'required|string',
                'image' => 'image',
                'target_fund' => 'required|integer',
                'current_fund' => 'required|integer',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            // ? Check if the campaign logo is uploaded
            $image = $campaign->image;

            if ($request->file('image')) {
                Storage::delete('public/storage/' . $image);
                $image = $request->file('image')->store('uploads/campaigns', 'public');
            }

            $campaign->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $image,
                'target_fund' => $request->target_fund,
                'current_fund' => $request->current_fund,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return ResponseFormatter::success($campaign, 'Data campaign berhasil diperbarui');
        } else {
            return ResponseFormatter::error(null, 'Data campaign tidak ada', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = Campaign::find($id);

        if ($campaign) {
            Storage::delete('public/storage/' . $campaign->image);
            $campaign->delete();

            return ResponseFormatter::success(null, 'Data campaign berhasil dihapus');
        } else {
            return ResponseFormatter::error(null, 'Data campaign tidak ada', 404);
        }
    }
}
