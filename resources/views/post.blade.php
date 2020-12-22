@extends('layouts.app')
@php
    $user = Auth::user();
    $user_name = $user->name;
@endphp
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
                    <div class="card-header">{{$post_user_name = $post->user}}
                        @if ($post_user_name == $user_name || $user->is_admin)
                        <i><a href='{{url('/post/edit',['id'=>$post->id])}}'style='color:#000000'> edit post</a></i>
                        @endif
                    </div>
                    <div class="card-body">{{$post->content}}</div>
                    <div class="card-footer">
                        <form method="POST" action="{{route('comment.store')}}">
                            @csrf
                            <p>Comment: <input type="text" name="comment" size="35"
                                value="{{old('comment')}}"></p>
                            <input type="submit" value="Post">
                        </form>
                    </div>
                    <div class="p-3 mb-2 bg-white text-dark">
                        @foreach ($comments as $comment)
                            @if ($comment->post_id==$post->id)
                                    <p class="tab">{{$comment_user = $comment->user}}: {{$comment->content}}&emsp;&emsp;&emsp;
                                    @if ($comment_user == $user_name || $user->is_admin)
                                    <i><a href='{{url('/comment/edit',['id'=>$comment->id])}}'style='color:#000000'> edit comment</a></i>
                                    @endif</p>
                            @endif
                        @endforeach
                        </div>
                </div>
        </div>
    </div>
</div>
@endsection
