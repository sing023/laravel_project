<?php 
use App\Models\Comment;
$comments = Comment::get()->where('post_id', $post_id);

?>

@foreach($comments as $comment)
<div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
        <div>
            <img src="{{ asset('comment_images/' . $comment->image_path) }}" alt="">
        </div>
        <div>
            <h2 class="text-gray-700 font-bold text-5xl pb-4">
                {{ $comment->title }}
            </h2>

            <span class="text-gray-500">
                By <span class="font-bold italic text-gray-800">{{ $comment->user->name }}</span>, Created on {{ date('jS M Y', strtotime($comment->updated_at)) }}
            </span>

            <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                {{ $comment->description }}
            </p>


            @if (isset(Auth::user()->id) && Auth::user()->id == $comment->user_id)
                <span class="float-right">
                    <a 
                        href="/comment/{{ $comment->slug }}/edit"
                        class="text-gray-700 italic  pb-1 border-b-2">
                        Edit
                    </a>
                </span>

                <span class="float-right">
                     <form 
                        action="/comment/{{ $comment->slug }}"
                        method="POST">
                        @csrf
                        @method('delete')

                        <button
                            class="text-red-500 pr-3"
                            type="submit">
                            Delete
                        </button>

                    </form>
                </span>
            @endif
        </div>
    </div>    
@endforeach 