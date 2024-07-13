<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrganizationModel;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = request()->input('name');
        $description = request()->input('description');
        $page = request()->input('page', 1);
        $limit = request()->input('limit', 10);

        $organization = OrganizationModel::query();

        if ($name) {
            $organization->where('name', 'like', '%' . $name . '%');
        }

        if ($description) {
            $organization->where('description', 'like', '%' . $description . '%');
        }

        if ($page) {
            $organization->skip(($page - 1) * $limit);
        }

        return ResponseFormatter::success(
            $organization->paginate($limit),
            'Data list organization berhasil',
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
            'name' => 'required|string',
            'username' => 'required|string',
            'description' => 'required|string',
            'logo' => 'image',
        ]);

        // ? Check if the organization logo is uploaded
        $logo = null;

        if ($request->file('logo')) {
            $logo = $request->file('logo')->store('uploads/organization', 'public');
        }

        $organization = OrganizationModel::create([
            'name' => $request->name,
            'username' => $request->username,
            'description' => $request->description,
            'logo' => $logo,
        ]);

        return ResponseFormatter::success($organization, 'Data organization berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Show organization data based on id and their relationship using row query
        $organization = OrganizationModel::with(['campaigns', 'campaigns.category'])->find($id);

        if ($organization) {
            return ResponseFormatter::success($organization, 'Data organization berhasil diambil');
        } else {
            return ResponseFormatter::error(null, 'Data organization tidak ada', 404);
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
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'description' => 'required|string',
            'logo' => 'image',
        ]);

        // ? Check if the organization logo is uploaded
        $logo = null;

        if ($request->file('logo')) {
            $logo = $request->file('logo')->store('uploads/organization', 'public');
        }

        $organization = OrganizationModel::find($id);

        if ($organization) {
            $organization->update([
                'name' => $request->name,
                'username' => $request->username,
                'description' => $request->description,
                'logo' => $logo,
            ]);

            return ResponseFormatter::success($organization, 'Data organization berhasil diubah');
        } else {
            return ResponseFormatter::error(null, 'Data organization tidak ada', 404);
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
        $organization = OrganizationModel::find($id);

        if ($organization) {
            $organization->delete();

            return ResponseFormatter::success(null, 'Data organization berhasil dihapus');
        } else {
            return ResponseFormatter::error(null, 'Data organization tidak ada', 404);
        }
    }
}
