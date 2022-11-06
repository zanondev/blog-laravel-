<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostGallery;

class PostGalleryController extends Controller
{
    public function index($post_id)
    {
        $images = PostGallery::where('status', 1)->where('post_id', $post_id)->get();
        $post = Post::find($post_id);
        return view("admin.dashboard.post_gallery.index", [
            'images' => $images,
            'post' => $post,
        ]);
    }
    public function createMultipleImages(Request $request)
    {
        $alt = explode(",", $request->image_alt);
        $validated = true;
        for ($i = 0; $i < $request->image_count; $i++) {
            $image_name = "image{$i}";
            $geral_gallery = new PostGallery();
            $geral_gallery['image'] = UploadFile($request->$image_name, "img/uploads/post_gallery");
            $geral_gallery['alt_text'] = $alt[$i] != "" ? $alt[$i] : "";
            $geral_gallery['post_id'] = $request->post_id;
            $geral_gallery['status'] = 1;
            if (!$geral_gallery->save()) {
                $validated = false;
            }
        }
        if ($validated) {
            echo json_encode(array(
                'status' => 1,
                'msg' => 'Adicionado com sucesso!',
            ));
        } else {
            echo json_encode(array(
                'status' => 0,
                'msg' => 'Ocorreu um erro ao adicionar. Tente novamente mais tarde.',
            ));
        }
    }
    public function updateGalleryImageAlt(Request $request)
    {
        try {
            $data = array();
            $data['alt_text'] = $request->alt_text != '' ? $request->alt_text : "";
            PostGallery::findOrFail($request->id)->update($data);
            echo json_encode(array(
                'status' => 1,
            ));
        } catch (\Throwable $e) {
            echo json_encode(array(
                'status' => 0,
                'msg' => 'Ocorreu um erro ao alterar. Tente novamente mais tarde.',
                'error' => $e->getMessage(),
            ));
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            PostGallery::findOrFail($request->id)->update(['status' => 0]);
            echo json_encode(array(
                'status' => 1,
                'msg' => 'Removido com sucesso',
            ));
        } catch (\Throwable $e) {
            echo json_encode(array(
                'status' => 0,
                'msg' => 'Ocorreu um erro ao alterar. Tente novamente mais tarde.',
                'error' => $e->getMessage(),
            ));
        }
    }
}
