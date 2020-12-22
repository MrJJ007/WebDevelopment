@php
    use App\Models\User;
    use App\Models\Post;

    $post_id = substr(url()->previous(),27);
    $post = Post::findOrFail($post_id);
    $post_user_id = $post->user_id;
    $post_user = User::findOrFail($post_user_id);
    $name = $post_user->name;
@endphp
Hi,  {{$name}},
{{Auth::user()->name}} just commented on your post.
SwackBook Ruddyposting


