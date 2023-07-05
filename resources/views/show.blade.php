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
            <div class="mt-3 mx-3">
                @if($post->user->profile_photo !== null)
                <img src="{{asset('storage/uploads/'.$post->user->profile_photo)}}" alt=""
                    class="mx-2 rounded-circle border border-primary" width="50px" height="50px">
                @else
                <img src="{{asset('avatar2.png')}}" alt="" class="mx-2 rounded-circle border border-primary"
                    width="50px" height="50px">
                @endif
                Posted By <span class="text-primary">{{ $post->user->name}} on {{$post->created_at}}</span>
            </div>
            <div class="mb-3">
                <img src="{{asset('storage/'.$post->post_image)}}" class="w-100 mt-3" alt="">
            </div>
            <div class="mb-3 mx-3">
                {!! $post->body!!}
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
                        <div class="fw-bold">
                            @if($comment->user->profile_photo !== null)
                            <img src="{{asset('storage/uploads/'.$comment->user->profile_photo)}}" alt=""
                                class="mx-2 rounded-circle border border-primary" width="50px" height="50px">
                            @else
                            <img src="{{asset('avatar2.png')}}" alt="" class="mx-2 rounded-circle border border-primary"
                                width="50px" height="50px">
                            @endif
                            {{$comment->user->name}}
                        </div>
                        {{$comment->body}}
                    </div>
                    <span class=" mx-3">
                        <form action="{{ route('comment.delete', $comment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')


                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you Sure to Delete this?')">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </form>
                    </span>
                    <span class="badge bg-primary rounded-pill">{{$comment->created_at->diffForHumans()}}</span>
                </li>
                @endforeach

            </ul>

        </div>
    </div>
</div>
<!-- ===================== -->

@endsection