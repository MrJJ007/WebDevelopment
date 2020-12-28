@extends('layouts.app')
@php
    $user = Auth::user();
    $user_name = $user->name;
    $num_of_comments = 0;
    foreach ($comments as $comment) {
        if ($comment->multi_post_id==$multi_post->id){
            $num_of_comments += 1;
        }
    }
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
                    <div class="card-header">
                        <h4>{{$multi_post->users}} - Multi Post!</h4>
                    <i><a href='{{url('/multi_post/edit',['id'=>$multi_post->id])}}'style='color:#000000'>edit post</a></i>

                    </div>
                    <div class="card-body">{{$multi_post->content}}</div>
                    @if ($num_of_comments<1)
                    <div class="card-footer">
                        <i><a href='{{url('/multi_post/upvote',['id'=>$multi_post->id])}}'style='color:#000000'>Upvote?</a>
                            : {{$multi_post->upvotes->count()}}</i>
                        <form method="POST" action="{{route('multi.comment.store')}}">
                            @csrf
                            <p>Comment: <input type="text" name="comment" size="35"
                                value="{{old('comment')}}"></p>
                            <input type="submit" value="Post">
                        </form>
                    </div>
                    @endif
                    <div class="p-3 mb-2 bg-white text-dark">
                        @foreach ($comments as $comment)
                            @if ($comment->multi_post_id==$multi_post->id)
                                <p class="tab">
                                    {{$comment_user=$comment->user}}: {{$comment->content}}&emsp;&emsp;
                                     <i><a href='{{url('/comment/upvote',['id'=>$comment->id])}}'style='color:#000000'>Upvote?</a>
                                        : {{$comment->upvotes->count()}}&emsp;&emsp;
                                        @if ($comment_user == $user_name || $user->is_admin)
                                        <a href='{{url('/comment/edit',['id'=>$comment->id])}}'style='color:#000000'>edit comment</a></i>
                                        @endif</p>
                            @endif
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
