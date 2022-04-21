

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
</br>
<div class="col-md-8">
            <div class="card" >
                <div class="card-body sm:grid grid-cols-2 gap-20 w-4/5 py-15  style=width: 0px border-b border-gray-200" >
                    <hr />
                    
                    <form method="POST" action="{{ route('comment.add') }}" enctype="multipart/form-data">
                        @csrf
                        <h class="text-3xl">Add comment</h>
                        </br>
                        <div class="form-group">
                            <!--input type="text" name="comment_body" class="form-control" /-->
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            <textarea name="comment_body" placeholder="Description..."
                                class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl border-gray-800">
                            </textarea> 
                        </div>
                        </br>
                        <div class="form-group">            
                            <input 
                                type="file"
                                name="image"
                                class="btn btn-warning"
                                value="Select a file">
                        </div>
                        </br>
                        <div class="form-group">
                            <input type="submit" class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl" value="Submit a comment" />
                        </div>
                    </form>
                </div>
            </div>
            <hr />
            </br>
    <h4 text-10xl text-align:center;>Comments</h4>
    </br>
   
    @include('comment.show',[ 'post_id' => $post->id])
<hr />
<div>
@yield('second_content')
</div>

@endsection

