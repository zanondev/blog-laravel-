<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;

class PostCategoryController extends Controller
{
    public function index()
    {
        $post_categories = PostCategory::where('status', 1)->get();

        return view('Admin.dashboard.post_categories.index', compact(['post_categories']));
    }

    public function create()
    {
        return view('Admin.dashboard.post_categories.add');
    }

    public function store(Request $request)
    {
        try {
            $post_category = new PostCategory();

            $post_category->title = $request->title;
            $post_category->url = friendlyUrl($request->title);
            $post_category->status = 1;
            $post_category->save();
            return response()->json([
                'status' => 1,
                'msg' => "Operação realizada com sucesso!",
            ], 200);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => 0,
                'msg' => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $post_category = PostCategory::find($id);

        return view('Admin.dashboard.post_categories.edit', compact(['post_category']));
    }

    public function update(Request $request)
    {
        try {

            $data = $request->all();
            $data['url'] = friendlyUrl($request->title);

            PostCategory::findOrFail($request->id)->update($data);

            return response()->json([
                'status' => 1,
                'msg' => "Editado com sucesso!",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg' => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function updateStatus(Request $request)
    {
        try {
            PostCategory::findOrFail($request->id)->update(['status' => 0]);

            return response()->json([
                'status' => 1,
                'msg' => "Removido com sucesso!",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'msg' => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateMultipleStatus(Request $request)
    {

        $validated = true;

        foreach ($request->inputs as $id) {
            if (!PostCategory::findOrFail($id)->update(['status' => 0])) {
                $validated = false;
            }
        }

        if ($validated) {
            return response()->json([
                'status' => 1,
                'msg'    => 'Removidos com sucesso!',
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'msg'    => 'Ocorreu um erro ao remover. Tente novamente mais tarde.',
            ], 500);
        }
    }
}
