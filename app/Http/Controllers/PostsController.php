<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));

    }

    public function ownPosts(){
        $posts = Post::where('user_id', auth()->id())->get();

        return view('home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //user_id -> models
        $post = new Post($request->all());

        $request->validate([
            'fish' => 'required',
            'description' => 'required',
            'content_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('content_image')) {
            $destinationPath = 'content_image/';
            $contentImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $contentImage);
            $input['content_image'] = "$contentImage";
        }

//        Auth::user()->posts()->save($post); //save post met user id maar zonder foto
        $input['user_id']=Auth::user()->id;
        Post::create($input); // save post met alles in input variabele zonder user id


        return redirect()->route('posts.index')
            ->with('success','Fish added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

//        if (Auth::user()->id==Post::find($post)->user->id){
//            return view('posts.edit', compact('post'));
//        } else {
//            return back();
//        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'fish' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('content_image')) {
            $destinationPath = 'content_image/';
            $contentImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $contentImage);
            $input['content_image'] = "$contentImage";
        }else{
            unset($input['content_image']);
        }

        $post->update($input);

        return redirect()->route('posts.index')
            ->with('success','Fish updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

    public function adminDash()
    {
        $posts = Post::all();
        return view('adminDash', compact('posts'));
    }


    public function visibilityUpdate(Post $post)
    {
        $post->visibility=!$post->visibility;
        $post->save();

        return back();
    }

    public function search(Request $request)
    {

        $posts = Post::all();
        return view('posts.search-results', compact('posts'));
    }

//    public function ownerName(){
//        $posts = Post::where('user_id', auth()->id())->get();
//
//        return view('home', compact('posts'));
//    }
}




