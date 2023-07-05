@extends('layouts.app')

@section('title', 'Post Add')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto mt-3">
        <div class="card p-3 m-2">
            <h5 class="card-header">
                Create a post
            </h5>
            @if(Session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>{{Session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="{{route('add',['user' => Auth::user()->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title')?old('title'):'' }}" id="title">
                    @error('title')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile04"
                            aria-describedby="inputGroupFileAddon04" aria-label="Upload" value="{{ old('image')?old('image'):'' }}">
                    </div>
                    @error('image')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <select name="category" class="form-select @error('category') is-invalid @enderror"
                        aria-label="Default select example" value="{{ old('category')?old('category'):'' }}">
                        <option Value="" selected>Select post category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->categories}}">{{$category->categories}}</option>
                        @endforeach
                    </select>
                    @error('category')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-2">
                    <label for="body" class="form-label">Body Content</label>
                    <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="body"
                        value="{{ old('body')?old('body'):'' }}" rows="3""></textarea>
                    @error('body')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection