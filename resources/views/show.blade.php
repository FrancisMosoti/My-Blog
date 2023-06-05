@extends('layouts.app')

@section('title', 'Post')

@section('content')
<!-- +++++++++++++++++++++ -->
<div class="row">
    <div class="col-md-8 mx-auto my-4">
        <div class="card p-5">
            @if(Session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>{{Session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <h3 class="card-header bg-primary">{{$post->title}}</h3>
            <div class="mb-3">
            <img src="{{asset('storage/'.$post->post_image)}}" class="w-100 mt-3" alt="">
            </div>
            <div class="mb-3 mx-3">
                {!! $post->body!!}
            </div>
            <div class="mb-3 mx-3">
                Posted By <span class="text-primary">{{ $post->user->name}}</span>
            </div>
            <hr>
            <form action="{{route('comment', ['post' => $post->id])}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="body" class="form-control @error('body') is-invalid @enderror"
                        placeholder="Leave a comment" aria-label="Leave a comment" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Send</button>

                </div>
            </form>

            @foreach ($post->comments as $comment)
            <!-- ============== -->
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-start mb-2">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{$comment->user->name}}</div>
                        {{$comment->body}}
                    </div>
                    <span class="badge bg-primary rounded-pill">{{$comment->created_at->diffForHumans()}}</span>
                </li>
                @endforeach

            </ul>

        </div>
    </div>
</div>
<!-- ===================== -->

@endsection