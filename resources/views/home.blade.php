@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
    $user_name = $user->name;
@endphp
<head>

</head>
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
                <div class="card-header"><a href='{{url('/createp')}}'style='color:#0303ff'>Create Post</a></div>
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
                        You're not an admin. So please keep memes out of general.
                    @endif
                </div>
                <div class="card-footer">
                    <a href='{{url('/example')}}'style='color:#0303ff'>Cat Fact!</a>
                </div>
            </div>

            @foreach ($multi_posts as $multi_post)
                <p></p>
                <div class="card">
                    <div class="card-header">
                        <img src="http://127.0.0.1:8000/storage/images/horse.jpg" alt="image"title="Father Ted">
                    </div>
                    <div class="card-header">
                        <h4>{{$multi_post->users}} - Multi Post! </h4>
                    </div>
                    <div class="card-body"><a href='{{url('/multi_post',['id'=>$multi_post->id])}}'style='color:#0303ff'>{{$multi_post->content}} </a></div>
                    <div class="card-footer"><i><a href='{{url('/multi_post/upvote',['id'=>$multi_post->id])}}'style='color:#000000'>Upvote?</a>
                        : {{$multi_post->upvotes->count()}}</i></div>
                    <div class="list-group-item">
                        @foreach ($comments as $comment)
                            @if ($comment->multi_post_id==$multi_post->id)
                                <p class="tab">{{$comment_user=$comment->user}}: {{$comment->content}} &emsp;&emsp;
                                    <i><a href='{{url('/comment/upvote',['id'=>$comment->id])}}'style='color:#000000'>Upvote?</a>
                                        : {{$comment->upvotes->count()}}
                                @if ($comment_user == $user_name || $user->is_admin)
                                    &emsp;&emsp;<a href='{{url('/comment/edit',['id'=>$comment->id])}}'style='color:#000000'>edit comment</a></i>
                                @endif</p>

                            @endif
                        @endforeach

                    </div>
                </div>
            @endforeach

            @foreach ($posts as $post)
                <p></p>
                <div class="card" >
                    <div class="card-header">
                        <img src="http://127.0.0.1:8000/storage/images/father.jpg" alt="image"title="FATHER!!!!">
                    </div>
                    <div class="card-header"><h4>{{$post_user = $post->user}} </h4>
                        @if ($post_user == $user_name || $user->is_admin)
                        <i><a href='{{url('/post/edit',['id'=>$post->id])}}'style='color:#000000'>edit post</a></i>
                        @endif
                    </div>
                    <div class="card-body"><a href='{{url('/post',['id'=>$post->id])}}'style='color:#0303ff'>{{$post->content}}</a></div>
                    <div class="card-footer"><i><a href='{{url('/post/upvote',['id'=>$post->id])}}'style='color:#000000'>Upvote?</a>
                        : {{$post->upvotes->count()}}</i></div>
                    <div class="list-group-item">
                    @foreach ($comments as $comment)
                        @if ($comment->post_id==$post->id)
                                <p class="tab">{{$comment_user=$comment->user}}: {{$comment->content}}&emsp;&emsp;
                                    <i><a href='{{url('/comment/upvote',['id'=>$comment->id])}}'style='color:#000000'>Upvote?</a>
                                        : {{$comment->upvotes->count()}}</i>
                                @if ($comment_user == $user_name || $user->is_admin)
                                    <i>&emsp;&emsp;&emsp;<a href='{{url('/comment/edit',['id'=>$comment->id])}}'style='color:#000000'>edit comment</a></i>
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
