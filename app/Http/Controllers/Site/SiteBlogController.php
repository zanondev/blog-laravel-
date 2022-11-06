<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostGallery;

class SiteBlogController extends Controller
{
    public function index($category_url = "")
    {
        $posts = Post::Join('post_categories', "post_categories.id", "=", "posts.post_category_id")
            ->select('posts.*', 'post_categories.title AS category_title')
            ->where('posts.status', 1)
            ->orderBy('posts.id', 'DESC');

        $active_url = 0;

        if (strlen($category_url) > 0) {
            $posts = $posts->where('post_categories.url', $category_url);

            $active_url = $category_url;
        }

        $posts = $posts->get();


        return view('site.blog.index', compact([['posts', 'active_url']]));
    }

    public function details($url)
    {
        if (strlen($url) > 0) {
            $post = Post::join('post_categories', 'post_categories.id', '=', 'posts.post_category_id')
                ->select('posts.*', 'post_categories.title as category_title')
                ->where('posts.url', $url)
                ->first();

            if ($post) {
                $related_posts = Post::join('post_categories', 'post_categories.id', '=', 'posts.post_category_id')
                    ->select('posts.*', 'post_categories.title as category_title')
                    ->where('posts.status', 1)
                    ->where('posts.id', '<>', $post->id)
                    ->where('posts.post_category_id', $post->post_category_id)
                    ->orderBy('posts.id', 'DESC')
                    ->get();

                    $post_images = PostGallery::where('status', 1)->where('post_id', $post->id)->get();

                return view('site.blog.details', compact('post', 'related_posts','post_images'));
            } else {
                return redirect()->route('site.blog_list');
            }
        } else {
            return redirect()->route('site.blog_list');
        }
    }

    public function search($search)
    {
        $posts = Post::join('post_categories', 'post_categories.id', '=', 'posts.post_category_id')
            ->select('posts.*', 'post_categories.title as category_title')
            ->whereRaw('posts.status = 1 AND (posts.title LIKE "%' . urldecode($search) . '%" OR posts.text LIKE "%' . urldecode($search) . '%")')
            ->orderBy('posts.id', 'DESC')
            ->get();

        $active_url = 0;

        return view('site.blog.index', compact('posts', 'active_url'));
    }
}
