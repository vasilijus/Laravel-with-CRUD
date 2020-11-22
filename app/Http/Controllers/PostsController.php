<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

use Carbon\Carbon; // To make the folder convention
use Illuminate\Support\Facades\Hash; // To hide the user ID num

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
        $auth_user = auth()->user();
        $auth_user_id = $auth_user->id;
        $time = Carbon::now();

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        
        // Handle File Upload
        if($request->hasFile('cover_image')){

            $cover_image = $request->file('cover_image');
            $filename = 'production' . '-' . time() . '.' . $cover_image->getClientOriginalExtension();

            $path = $request->file('cover_image')
                ->storeAs(
                    'public/'
                    // . Hash::make($auth_user->id).'/'            // User Folder Dir
                    . $auth_user->id .'/'            // User Folder Dir
                    . $time->format('Y/m')                    // Folder Date
                    , $filename                                 // New Name
                );


        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = $auth_user_id;
        $post->cover_image = $path;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created.');
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
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        // Check for correct user id
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
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
        $auth_user = auth()->user();
        $auth_user_id = $auth_user->id;
        $time = Carbon::now();
        
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        // Handle File Upload
        if($request->hasFile('cover_image')){

            $cover_image = $request->file('cover_image');
            $filename = 'production' . '-' . time() . '.' . $cover_image->getClientOriginalExtension();

            $path = $request->file('cover_image')
                ->storeAs(
                    'public/'
                    // . Hash::make($auth_user->id).'/'            // User Folder Dir
                    . $auth_user->id .'/'            // User Folder Dir
                    . $time->format('Y/m')                    // Folder Date
                    , $filename                                 // New Name
                );


        }
       
        //Update Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image'))
        {
            $post->cover_image = $path;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated.');
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
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg')
        {
            //Delete Image
            Storage::delete('public/cover_image/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted.');
    }
}
