<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

        $category = Category::query();

        if ($name) {
            $category->where('name', 'like', '%' . $name . '%');
        }

        if ($description) {
            $category->where('description', 'like', '%' . $description . '%');
        }

        if ($page) {
            $category->skip(($page - 1) * $limit);
        }

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data list category berhasil',
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
            'description' => 'required|string',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return ResponseFormatter::success(
            $category,
            'Data category berhasil ditambahkan',
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if ($category) {
            return ResponseFormatter::success(
                $category,
                'Data category berhasil ditemukan',
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data category tidak ditemukan',
                404,
            );
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
            'description' => 'required|string',
        ]);

        $category = Category::find($id);

        if ($category) {
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return ResponseFormatter::success(
                $category,
                'Data category berhasil diperbarui',
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data category tidak ditemukan',
                404,
            );
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
        $category = Category::find($id);

        if ($category) {
            $category->delete();

            return ResponseFormatter::success(
                null,
                'Data category berhasil dihapus',
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data category tidak ditemukan',
                404,
            );
        }
    }
}
