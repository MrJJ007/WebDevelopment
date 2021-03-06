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
                    <div class="card-header">Edit your Comment: {{$post->user}}&emsp;&emsp;&emsp;
                        <i> <a href="{{url('/comment/delete',['id'=>$comment->id])}}"style='color:#000000'>delete comment</a></i>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('comment.edit.store')}}">
                            @csrf
                            <p>Content: <input type="text" name="content" size="75"
                                value="{{$comment->content}}"autofocus></p>
                            <input type="submit" value="Comment edition">
                            <a href="{{url('/home')}}">Back</a>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
