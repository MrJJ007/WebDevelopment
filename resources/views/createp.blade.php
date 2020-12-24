@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                    <div class="card-header">What ruddy post is on your mind?</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('post.store')}}">
                            @csrf
                            <p>Content: <input type="text" name="content" size="35"
                                value="{{old('content')}}"autofocus></p>
                                <input type="checkbox" name="multiPost" id="multiPost" value="multiPost">
                                <label for="multiPost">Allow others to edit this post, and only allow one comment</label><br />
                            <input type="submit" value="Post">
                            <a href="{{url('/home')}}">Back</a>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
