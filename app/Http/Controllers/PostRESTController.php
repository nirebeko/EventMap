<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Post;

use Request;
use Auth;
use Hash;

class PostRESTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    	$posts = Post::all();
    	$response = new \stdClass;
    	$response->success = true;
    	$response->total = count($posts);
    	$response->data = $posts;

    	return response()->json($response);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        echo 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
        $post = new Post();
        $post->user_id = Request::input('user_id');
        $post->content = Request::input('content');
        $post->title = Request::input('title');
        $post->link = Request::input('link');
        $post->save();
        $response = new \stdClass;
    	$response->success = true;
    	$response->total = 1;
    	$response->data = $post;

    	return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        echo 'show: '.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        echo 'edit: '.$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
        $post = Post::find($id);
        $post->user_id = Request::input('user_id');
        $post->content = Request::input('content');
        $post->title = Request::input('title');
        $post->link = Request::input('link');
        $post->save();
        $response = new \stdClass;
    	$response->success = true;
    	$response->total = 1;
    	$response->data = $post;

    	return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        
        $post = Post::find($id);
        $post->delete();
        $response = new \stdClass;
    	$response->success = true;

    	return response()->json($response);
    
    }
}