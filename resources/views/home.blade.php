@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">

    <!-- ================================ -->
    <form action="{{route('categories')}}" method="post">
        @csrf
        <div class="row d-flex align-items-center mt-2 just">
            <div class="col-md-2">
                <label for="categories" class="form-label">Categories</label>
            </div>
            <div class="col-md-5">
                <div class="mb-3">

                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" id="categories">
                    @error('category')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-5">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>

    <!-- ====================================== -->
    @if(Session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>{{Session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

    <div class="p-4 p-md-5 mb-4 mt-4 rounded text-bg-light  bg-light">
        <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic">My Blog</h1>
            <p class="lead my-3">This is my first blog project using laravel framework</p>
            <p class="lead mb-0"><a href="#" class=" fw-bold">Continue reading...</a></p>
        </div>
    </div>
</div>

@foreach ($posts as $post)

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
                        <img src="{{asset('storage/uploads/'.$post->user->profile_photo)}}" alt=""
                            class="mx-2 rounded-circle border border-primary" width="70px" height="70px">
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
                    <div class="">
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="post-meta my-4 mx-2"
                                onclick="return confirm('Are you Sure to Delete this?')">Delete</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Divider-->
            <hr class="my-4">
        </div>
    </div>
</div>

@endforeach
@endsection