@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto my-4">
        <div class="card p-5">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <h3 class="card-header">My Profile</h3>
            
            <div class="row my-3">
                <div class="col-md-4">
                @if(Auth::User()->profile_photo !== null)
                    <img src="{{asset('storage/uploads/'.Auth::User()->profile_photo)}}" class="img-fluid rounded"
                        alt="Profile Photo " width="300px">
                @else
                <img src="{{asset('avatar2.png')}}" class="img-fluid rounded"
                        alt="Profile Photo " width="300px">
                @endif

                </div>
                <div class="col-md-8 p-3">
                    <p>Name: {{ Auth::User()->name }}</p>
                    <div class="mb-3">
                        <p>Email: {{ Auth::User()->email }}</p>
                        <p>Phone: {{ Auth::User()->phone }}</p>
                    </div>
                    <!-- ============================== -->
                    <form method="POST" action="{{route('profile', ['user' => Auth::User()->id])}}"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- =========== -->
                        <div class="input-group">
                            <input type="file" name="image" class="form-control" id="inputGroupFile04"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            <button class="btn btn-outline-secondary" type="submit"
                                id="inputGroupFileAddon04">Upload</button>
                        </div>
                        @error('image')<div class="text-danger">{{ $message }}</div>@enderror
                        <!-- =========== -->
                    </form>
                </div>
            </div>




        </div>
    </div>
</div>
@endsection