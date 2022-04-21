

@extends('layouts.app')

@section('content')


<div class="w-4/5 m-auto text-left">
    <div class="py-15">
        <h1 class="text-6xl">
            {{ $post->title }}
        </h1>
    </div>
</div>

<div class="w-4/5 m-auto pt-20">
    <span class="text-gray-500">
        By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
    </span>

    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
        {{ $post->description }}
    </p>
</div>

<div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <hr />
                    <h>Add comment</h>
                    <form method="POST" action="{{ route('comment.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="comment_body" class="form-control" />
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">            
                            <input 
                                type="file"
                                name="image"
                                class="btn btn-warning"
                                value="Select a file">
           
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" value="Add Comment" />
                        </div>
                    </form>
                </div>
            </div>
            <hr />
    <h4>Display Comments</h4>
   
    @include('comment.show',[ 'post_id' => $post->id])
<hr />
<div>
@yield('second_content')
</div>

@endsection

