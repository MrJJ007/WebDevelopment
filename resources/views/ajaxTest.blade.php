
@extends('layouts.app')

<head>
    <title>Testing</title>
</head>
@section('content')
<body>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <h1>Testing</h1>

    <div id="root">
        <div id="user_name" ref="user_name">{{Auth::user()->name}}</div>
        <ul>
            <li v-for="comment in comments">@{{comment.user}}: @{{comment.content}}</li>
            @{{comments[13]}}
        </ul>
        Comment: <input type="text" id="input" v-model="newCommentContent">
        <button @click="createComment">Create</button>
    </div>
    <script>
        var app = new Vue({
            el: "#root",
            data:{
                comments:[],
                newCommentContent:'',
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
                        user_name: this.$refs.user_name.innerText

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
@endSection

