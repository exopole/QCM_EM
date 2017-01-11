<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Post;
use App\User;
use File;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(15);

        
        return view('teacher.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers =  DB::table('users')
             ->where('role', '=', 'teacher')
             ->get(); 
        $auth = Auth::user();

        return view('teacher.posts.create', compact('teachers', 'auth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $request->all();
        $message = "";
        if (array_key_exists('postsID', $result) && array_key_exists('action', $result) ) {
            
            $postsID = $result['postsID'];
            $action = $result['action'];
            $message .= $action." ";

            foreach ($postsID as $postID) {
                $post = Post::find($postID);

                $message .= $post->title.';';
                if ($action == 'published') {
                    $post->setToPublished();
                    $post->save(); 
                }
                else if ($action == 'unpublished') {
                    $post->setToUnpublished();
                    $post->save(); 
                }
                else {
                    $filename = public_path(env('UPLOAD_PATH', './images/posts')).'/'.$post->url_thumbnail;
                    if(File::exists($filename)){
                        File::delete($filename);
                    }
                    Post::destroy($postID);
                }
            }
        }

        else{
            $this->validate($request, [
                'title'=> 'required|max:100',
                'user_id' => 'integer',
                'status' => 'in:published,unpublished',
                'date' => 'required|date',
                'url_thumbnail' => 'image|max:5000'
                ]);
            $post = Post::create($request->all());

            $in = $request->file('url_thumbnail');
            if(!empty($in))
            {

                $ext = $in->getClientOriginalExtension();
                $uri = str_random(12).".".$ext;

                $post->url_thumbnail = $uri;

                $in->move(env('UPLOAD_PATH', './images'), $uri);
                
                $post->save();
            }


        }

        return redirect('teacher/posts')->with( ['message' => $message]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $teachers =  DB::table('users')
             ->where('role', '=', 'teacher')
             ->get(); 
        $auth = Auth::user();

        return view('teacher.posts.edit', compact('post', 'teachers', 'auth'));
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
        $this->validate($request, [
            'title'=> 'required|max:100',
            'user_id' => 'integer',
            'status' => 'in:published,unpublished',
            'date' => 'required|date',
            'url_thumbnail' => 'image|max:5000'
        ]);
        $post = Post::find($id);
        $post->update($request->all());

        $filename = public_path(env('UPLOAD_PATH', './images')).'/'.$post->url_thumbnail;


        if(!empty($request->input('deleteImage'))){
            if(File::exists($filename)){
                File::delete($filename);
            }
            $post->url_thumbnail = null;

            $post->save(); // => update sur la table posts
        }
        $in = $request->file('url_thumbnail');
        if(!empty($in))
        {
            if(File::exists($filename)){
                File::delete($filename);
            }            
            $ext = $in->getClientOriginalExtension();
            $uri = str_random(12).".".$ext;

            $post->url_thumbnail = $uri;

            $in->move(env('UPLOAD_PATH', './images'), $uri);
            $post->save();
        }
        return redirect('teacher/posts')->with(['message' => 'edition réussie']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $filename = public_path(env('UPLOAD_PATH', './images')).'/'.$post->url_thumbnail;
        if(File::exists($filename)){
            File::delete($filename);
        }
        Post::destroy($id);
    }
}
