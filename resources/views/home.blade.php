@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
    $user_name = $user->name;
@endphp
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('message'))
                <div class="card">
                    <div class="card-header">
                        <p><b>{{session('message')}}</b></p>
                    </div>
                </div>
            @endif
            <p></p>
            <div class="card">
                <div class="card-header"><a href='{{url('/createp')}}'>Create Post</div></a>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Whats on your ruddy mind {{$user_name }}?
                    @if ($user->is_admin==1)
                        You are an admin!
                    @else
                        You aren't an admin. So please keep memes out of general.
                    @endif
                </div>
            </div>

            @foreach ($posts as $post)
                <p></p>
                <div class="card" >
                    <div class="card-header"><h4>{{$post_user = $post->user}}</h4>
                        @if ($post_user == $user_name || $user->is_admin)
                        <i><a href='{{url('/post/edit',['id'=>$post->id])}}'style='color:#000000'> edit post</a></i>
                        @endif
                    </div>
                    <div class="card-body"><a href='{{url('/post',['id'=>$post->id])}}'>{{$post->content}}</a></div>
                    <div class="list-group-item">
                    @foreach ($comments as $comment)
                        @if ($comment->post_id==$post->id)
                                <p class="tab">{{$comment_user=$comment->user}}: {{$comment->content}}
                                @if ($comment_user == $user_name || $user->is_admin)
                                    <i>&emsp;&emsp;&emsp;<a href='{{url('/comment/edit',['id'=>$comment->id])}}'style='color:#000000'> edit comment</a></i>
                                @endif</p>
                        @endif
                    @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
@endsection
