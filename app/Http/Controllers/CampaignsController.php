<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\OrganizationModel;
use Illuminate\Http\Request;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $campaigns = Campaign::with([
            'category',
            'organization'
        ])->get();
        $categories = Category::all();
        $organizations = OrganizationModel::all();

        return view('content.master-data.campaigns', compact([
            'campaigns',
            'categories',
            'organizations'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'category_id' => 'required',
            'organization_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'target_fund' => 'required',
            'current_fund' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $request->merge([
                'image' => $request->file('image')->store('uploads/campaigns', 'public')
            ]);
        }


        Campaign::create($request->all());

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
