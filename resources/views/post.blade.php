@extends('layouts.app')
@php
    $user = Auth::user();
    $user_name = $user->name;
@endphp
@section('content')
<body>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<div id="root">
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
                        <div class="card-header"><h4 id="post_user_name" ref="post_user_name">{{$post_user_name = $post->user}}</h4>
                            @if ($post_user_name == $user_name || $user->is_admin)
                            <i><a href='{{url('/post/edit',['id'=>$post->id])}}'style='color:#000000'>edit post</a></i>
                            @endif
                        </div>
                        @if($post->post_image != null)
                            <div class="card-header">
                                <div class="panel panel-default">
                                    <img src="{{asset($post->post_image)}}" alt="image"title="FATHER!!!!">
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            {{$post->content}}
                        </div>
                        <div class="card-footer">
                            <i><a href='{{url('/post/upvote',['id'=>$post->id])}}'style='color:#000000'>Upvote?</i></a>
                                : {{$post->upvotes->count()}} <i>&emsp;&emsp;</i>

                                <i><a href="{{url('/home')}}"style="color:#000000">Back</a></i>
                        </div>
                        <div class="p-3 mb-2 bg-white text-dark">
                                Comment as: <span id="user_name" ref="user_name" user_name="{{$user_name}}">{{$user_name}}</span><input type="text" id="input" v-model="newCommentContent">
                                <button @click="createComment">Create</button>
                                <p>
                                    <p v-for="comment in comments"><span id="comment_user" ref="comment_user">@{{comment.user}}:</span> @{{comment.content}}
                                        &emsp;&emsp;
                                        <i><a :href="'/comment/upvote/' + comment.id" style='color:#000000'>Upvote?</a></i>
                                            <span v-if="comment.upvotes">&emsp;@{{comment.upvotes.length}}&emsp;&emsp;</span>
                                            <span v-else="comment.upvotes">&emsp;0&emsp;&emsp;</span>
                                        @if($user->is_admin)
                                            <i><a :href="'/comment/edit/' + comment.id" style='color:#000000'>edit comment</a></i>
                                        @else
                                            <span v-if="user === comment.user ">
                                                <i><a :href="'/comment/edit/' + comment.id" style='color:#000000'>edit comment</a></i>
                                            </span>
                                        @endif
                                        </p>
                                </p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
    <script>
        var app = new Vue({
            el: "#root",
            data:{
                comments:[],
                food:['bread','pizza'],
                newCommentContent:'',
                user:'<?php Print(Auth::user()->name);?>',
                user_id:'<?php Print(Auth::id());?>',
                url:'',
            },
            mounted(){
                axios.get("{{route('api.comments.index') }}")
                .then(response => {
                    this.comments=response.data;
                })
                .catch(response=>{
                    console.log(response);
                    console.log('seeing the comments failed');
                })
            },
            methods: {
                createComment: function() {
                    axios.post("{{ route ('api.comments.store') }}", {
                        content: this.newCommentContent,
                        user: this.$refs.user_name.innerText,
                        user_id: this.user_id
                    })
                    .then(response=>{
                        console.log(response);
                        console.log(response.data);
                        this.comments.push(response.data);
                        this.newCommentContent ='';
                        console.log('it worked');
                    })
                    .catch(response=>{
                        console.log(response);
                        console.log(response.data);
                        console.log('creating a comment failed');
                    })
                }

            }
        });

    </script>
</body>
@endsection
