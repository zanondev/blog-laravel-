<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostGallery;

class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.blog.detail');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
                    
                return view('site.blog.details', compact('post', 'related_posts', 'post_images'));
            } else {
                return redirect()->route('site.blog_list');
            }
        } else {
            return redirect()->route('site.blog_list');
        }
    }
}
