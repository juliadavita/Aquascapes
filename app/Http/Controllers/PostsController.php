<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\User;
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
        // Checks if request has 'category' in URL and returns the posts with the matching category
        if(request()->has('category')) {
            $posts = Post::where(function($post) {
                // Checks if there is a category request
                $post->where('category', request('category'));
                // Checks if post is '1' in boolean
                $post->where('visibility', '1');
            })->get();
        } else {
            $posts = Post::where('visibility', '1')->get();
        }
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
        //Check if user is logged in, else redirect to login
        if(Auth::guest()) {
            // Return back with error
            return view('auth.login')->with('error', "You must be logged in");
        } else {
            return view('posts.create');
        }

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
            'category' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('content_image')) {
            $destinationPath = 'content_image/';
            $contentImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $contentImage);
            $input['content_image'] = "$contentImage";
        }

        $input['username']=Auth::user()->name;
        $input['user_id']=Auth::user()->id;
        Post::create($input);


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
        //Check if user is logged in, else redirect to login
        if(!Auth::guest()) {
            if(Auth::user()->is_admin == 1) {
                return view('posts.edit', compact('post'));
            }
            //Check if user id matches user_id in post
            else if (Auth::user()->id === $post->user_id){
                return view('posts.edit', compact('post'));
            } else {
                // Return to overview page
                $posts = Post::all();
                return view('posts.index', compact('posts'));

            }
        } else {
            // Return back with error
            return view('auth.login')->with('error', "You must be logged in");
        }
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
        $query = $request->input('query');
        // Checks if query matches fish, category or description
        $posts = Post::where('fish', 'LIKE', '%' .$query. '%')
            ->orWhere('category', 'LIKE', '%' .$query. '%')
            ->orWhere('description', 'LIKE', '%' .$query. '%')->get();

        if(count($posts) > 0) {
            return view('posts.search-results', compact('posts'));
        } else {
            return view('posts.search-results', ['error' => 'Geen resultaten, bitch!']);
        }

        return view('posts.search-results', compact('posts'));
    }

}




