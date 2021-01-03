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
                    @if ($user->is_admin)
                        You are an admin!
                    @else
                        You're not an admin. So please keep memes out of general.
                    @endif
                </div>
                <div class="card-footer">
                    <a href='{{url('/catFact')}}'style='color:#0303ff'>Cat Fact!</a>
                </div>
            </div>

            @foreach ($multi_posts as $multi_post)
                <p></p>
                <div class="card">
                    <div class="card-header">
                        <h4>{{$multi_post->users}} - Multi Post! </h4>
                    </div>
                    <div class="card-body"><a href='{{url('/multi_post',['id'=>$multi_post->id])}}'style='color:#0303ff'>{{$multi_post->content}} </a></div>
                    <div class="card-footer"><i><a href='{{url('/multi_post/upvote',['id'=>$multi_post->id])}}'style='color:#000000'>Upvote?</a>
                        : {{$multi_post->upvotes->count()}}</i></div>
                </div>
            @endforeach

            @foreach ($posts as $post)
                <p></p>
                <div class="card">
                    <div class="card-header"><h4>{{$post_user = $post->user}} </h4>
                        @if ($post_user == $user_name || $user->is_admin)
                        @endif
                    </div>
                    @if($post->post_image != null)
                        <div class="card-header">
                            <img src="{{asset($post->post_image)}}" alt="image"title="FATHER!!!!">
                        </div>
                    @endif
                    <div class="card-body"><a href='{{url('/post',['id'=>$post->id])}}'style='color:#0303ff'>{{$post->content}}</a></div>
                    <div class="card-footer"><i><a href='{{url('/post/upvote',['id'=>$post->id])}}'style='color:#000000'>Upvote?</a>
                        : {{$post->upvotes->count()}}</i></div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
@endsection
