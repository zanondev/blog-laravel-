<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use GuzzleHttp\Psr7\UploadedFile;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 1)->get();
        return view('admin.dashboard.posts.index', compact(['posts']));
    }

    public function create()
    {
        $post_categories = PostCategory::where('status', 1)->get();
        return view('admin.dashboard.posts.add', compact(['post_categories']));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $post_categories = PostCategory::where('status', 1)->get();
        return view('admin.dashboard.posts.edit', compact(['post', 'post_categories']));
    }

    public function updateStatus(Request $request)
    {
        try {
            Post::findOrFail($request->id)->update(['status' => 0]);
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
            if (!Post::findOrFail($id)->update(['status' => 0])) {
                $validated = false;
            }
        }
        if ($validated) {
            return response()->json([
                'status' => 1,
                'msg' => 'Removidos com sucesso!',
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'msg' => 'Ocorreu um erro ao remover. Tente novamente mais tarde.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $post = new Post();
            $post->title = $request->title;
            $post->url = friendlyUrl($request->title);
            $post->text = $request->text;
            $post->brief = $request->brief;
            $post->image = UploadFile($request->image, "img/uploads/posts/");
            $post->post_category_id = $request->post_category_id;
            $post->status = 1;
            $post->save();
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

    public function update(Request $request)
    {
        try {

            $data = $request->all();
            $data['url'] = friendlyUrl($request->title);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $data['image'] = UploadFile($request->image, "img/uploads/posts/");
            }

            Post::findOrFail($request->id)->update($data);

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
}
