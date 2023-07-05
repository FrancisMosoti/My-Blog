@extends('layouts.admin')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Posts</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Posts</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <p class="mb-0">
                        This page is an example of using static navigation. By removing the
                        <code>.sb-nav-fixed</code>
                        class from the
                        <code>body</code>
                        , the top navigation and side navigation will become static on scroll. Scroll down this
                        page to see an example.
                    </p>
                </div>
            </div>
            <!-- <div style="height: 100vh"></div> -->
            <!-- <div class="card mb-4">
                <div class="card-body">When scrolling, the navigation stays at the top of the page. This is the
                    end of the static navigation demo.</div>
            </div> -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    My Blog App Posts
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>##</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Posted By</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>##</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Posted By</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->body}}</td>
                                <td>{{$post->user->name}}</td>
                                <th>{{$post->created_at->diffForHumans()}}</th>
                                <th>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you Sure to Delete this?')">Delete</button>
                                    </form>
                                </th>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- trashed -->
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2023</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>

@endsection