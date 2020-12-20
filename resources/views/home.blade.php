@extends('layouts.app')
<head>
    <script>

    </script>
    <style>

    </style>
</head>
@section('content')
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
                <div class="card-header"><a href='{{url('/createp')}}'>Create Post</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Whats on your ruddy mind {{$user = Auth::user()->name }}?</a>
                </div>
            </div>

            @foreach ($posts as $post)
                <p></p>
                <div class="card" >
                    <div class="card-header"><h4>{{$post_user = $post->user}}{{$post->id}}</h4>
                        @if ($post_user == Auth::user()->name)
                        <i><a href='{{url('/post/edit',['id'=>$post->id])}}'style='color:#000000'> edit post</a></i>
                        @endif
                    </div>
                    <div class="card-body"><a href='{{url('/post',['id'=>$post->id])}}'>{{$post->content}}</a></div>
                    <div class="list-group-item">
                    @foreach ($comments as $comment)
                        @if ($comment->post_id==$post->id)
                                <p class="tab">{{$comment_user=$comment->user}}: {{$comment->content}} &emsp;&emsp;&emsp;
                                @if ($comment_user == $user)
                                    <i><a href='{{url('/comment/edit',['id'=>$comment->id])}}'style='color:#000000'> edit comment</a></i>
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
