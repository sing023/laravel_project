<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

use Cviebrock\EloquentSluggable\Services\SlugService;
use  Illuminate\Support\Facades\Validator;




class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.show')
        ->with('comments', Comment::orderBy('updated_at', 'DESC')->get());
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
       
        $newImageName = uniqid() . '.' . $request->image->extension();

        $request->image->move(public_path('comment_images'), $newImageName);
        
        Comment::create([
            
            'description' => $request->input('comment_body'),
            'slug' => SlugService::createSlug(Comment::class, 'slug',$request->input('comment_body')),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id,
            'post_id' => $request->input('post_id'),
        ]);
         //return View('comment.show');
         /*
        $comment = new Comment;
        $comment->description = $request->input('comment_body');
        $comment->image_path = $newImageName;
        $comment->slug = SlugService::createSlug(Comment::class, 'slug',$request->input('comment_body'));
        $comment->user_id = auth()->user()->id;

        $post = Post::find($request->input('post_id'));
        $comment->post_id = $post->id;
        $post->comments()->save($comment);
        */
        
        $comments = Comment::get()->where('post_id', $request->input('post_id'));
        return view('blog.show')
         ->with('post', Post::where('id',  $request->input('post_id'))->first());
        //return view('blog.show',compact($comments));
        //->with('comments', Comment::orderBy('updated_at', 'DESC')->get());
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
    public function edit($slug)
    {
        return view('comment.edit')
        ->with('comment', Comment::where('slug', $slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $comment=Comment::get()->where('slug', $slug)->first();
        $post_id = $comment->post_id;
        $post= Post::get()->where('id',$post_id)->first();
        

        $newImageName = uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        Comment::where('slug', $slug)
            ->update([
                'description' => $request->input('description'),
                'slug' => SlugService::createSlug(Comment::class, 'slug', $request->description),
                'user_id' => auth()->user()->id,
                'image_path' => $newImageName,
            ]);
        return view('blog.show')->with('post',$post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $comment=Comment::get()->where('slug', $slug)->first();
        $post_id = $comment->post_id;
        $post= Post::get()->where('id',$post_id)->first();
        $comment = Comment::where('slug', $slug);
        $comment->delete();
        return view('blog.show')->with('post',$post);

    }
}
