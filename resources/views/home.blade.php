@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">

    <div class="p-4 p-md-5 mb-4 mt-4 rounded text-bg-light  bg-light">
        <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic">My Blog</h1>
            <p class="lead my-3">This is my first blog project using laravel framework</p>
            <p class="lead mb-0"><a href="https://github.com/FrancisMosoti" class=" fw-bold">Continue reading...</a></p>
        </div>
    </div>
</div>

@forelse ($posts as $post)

<div class="container">

    <!-- ============== -->
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-xl-10">

            <!-- Post preview-->

            <div class="post-preview">
                <div class="row">
                    @if($post->post_image == null)
                    <div class="col-md-10 mx-auto">
                        <a href="{{route('show', ['post' => $post->id])}}">
                            <h2 class="post-title">{{$post->title}}</h2>
                        </a>
                        <span class="badge rounded-pill bg-primary my-2">{{$post->category}}</span>

                        <div style="max-height: 45px; overflow: hidden;">
                            <p class="post-subtitle">{{$post->body}}</p>
                        </div>
                    </div>

                    @else

                    <div class="col-md-4">
                        <img src="{{asset('storage/'.$post->post_image)}}" class="w-100" alt="">
                    </div>

                    <div class="col-md-8">
                        <a href="{{route('show', ['post' => $post->id])}}">
                            <h2 class="post-title">{{$post->title}}</h2>
                        </a>
                        <span class="badge rounded-pill bg-primary my-2">{{$post->category}}</span>

                        <div style="max-height: 45px; overflow: hidden;">
                            <p class="post-subtitle">{{$post->body}}</p>
                        </div>
                    </div>
                </div>
                @endif




                <div class="d-flex align-items-center">
                    <p class="post-meta my-3">
                        @if($post->user->profile_photo !== null)
                        <img src="{{asset('storage/uploads/'.$post->user->profile_photo)}}" alt=""
                            class="mx-2 rounded-circle border border-primary" width="50px" height="50px">
                        @else
                        <img src="{{asset('avatar2.png')}}" alt="" class="mx-2 rounded-circle border border-primary"
                            width="50px" height="50px">
                        @endif
                        <span class="text-secondary">{{$post->user->name}}</span>
                        <span class="badge rounded-pill bg-primary mx-2">{{$post->comments_count}}</span><span
                            class="text-primary">Comments</span>
                        <span class="text-secondary mx-2">{{$post->created_at->diffForHumans()}}</span>
                    </p>
                    @if(Auth::User()->name == $post->user->name)
                    <div class="">
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="post-meta my-4 mx-2"
                                onclick="return confirm('Are you Sure to Delete this?')">Delete</button>
                        </form>
                    </div>
                    <!-- <div class="">
                        <form action="" method="POST">
                        @csrf

                            <button type="button" class="post-meta my-4 mx-2">Edit</button>
                        </form>
                    </div> -->
                    @endif
                </div>
            </div>
            <!-- Divider-->
            <hr class="my-4">


        </div>
    </div>

</div>
@empty
<div class="container">
    <h1 class="text-info text-center bg-dark rounded">No Posts found</h1>
</div>

@endforelse
@endsection