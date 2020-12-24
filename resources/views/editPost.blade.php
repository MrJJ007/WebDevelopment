@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                    @if (session('message'))
                        <div class="card">
                        <div class="card-header">
                            <p><b>{{session('message')}}</b></p>
                        </div>
                        </div>
                    @endif
                    <div class="card-header">Edit your post: {{$post->user}}&emsp;&emsp;&emsp;
                        <i> <a href="{{url('/post/delete',['id'=>$post->id])}}"style='color:#000000'>delete post</a></i>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('post.edit.store')}}">
                            @csrf<p>Content: <input type="text" name="content" size="35"
                                value="{{$post->content}}"autofocus></p>
                            <input type="submit" value="Post edition">
                            <a href="{{url('/home')}}">Back</a>
                        </form>
                    </div>
                    <div class="p-3 mb-2 bg-white text-dark">
                        @foreach ($comments as $comment)
                                @if ($comment->post_id==$post->id)
                                    <p class="tab">{{$comment->user}}: {{$comment->content}}</p>
                                @endif
                        @endforeach
                        </div>
                </div>
        </div>
    </div>
</div>
@endsection
