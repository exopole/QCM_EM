<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class FrontController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = DB::table('posts')
                ->where('status', '=','published')
                ->orderBy('date', 'desc')
                ->get();
        //$posts = Post::orderBy('date', 'DESC')->get(); // permet de trier les posts en fonction de la date
        $authors = User::all();
        //return view('home', ['posts' => $posts, 'students'=> $students, 'categories' => $categories]);
        return view('front.home', compact('posts', 'authors'));
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPost()
    {
        $posts = Post::all();
        //$posts = Post::orderBy('date', 'DESC')->get(); // permet de trier les posts en fonction de la date
        $authors = User::all();
        
        //return view('home', ['posts' => $posts, 'students'=> $students, 'categories' => $categories]);
        return view('front.posts', compact('posts', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $posts = Post::all();
        $post = Post::find($id); // permet de trier les posts en fonction de la date
        $author = User::find($post->user_id);
        //return view('home', ['posts' => $posts, 'students'=> $students, 'categories' => $categories]);
        return view('front.post', compact('post', 'author', 'posts'));
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
}
