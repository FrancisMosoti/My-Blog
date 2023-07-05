@extends('layouts.admin')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Comments</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{route('admin.index')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Comments</li>
            </ol>
            @if(Session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>{{Session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card mb-4">
                <div class="card-body">
                    <!-- This page is an example of using the light side navigation
                    option. By appending the
                    <code>.sb-sidenav-light</code>
                    class to the
                    <code>.sb-sidenav</code>
                    class, the side navigation will take on a light color
                    scheme. The
                    <code>.sb-sidenav-dark</code>
                    is also available for a darker option. -->

                </div>
            </div>
            <!-- list -->

            <!-- records -->

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    My Blog App Comments
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>##</th>
                                <th>Body</th>
                                <th>Posted By</th>
                                <th>created_at</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>##</th>
                                <th>Body</th>
                                <th>Posted By</th>
                                <th>created_at</th>
                                <th>action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($comments as $comment)
                            <tr>
                                <td>{{$comment->id}}</td>
                                <td>{{$comment->body}}</td>
                                <td>{{$comment->user->name}}</td>
                                <td>{{$comment->created_at->diffForHumans()}}</td>
                                <td>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')


                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you Sure to Delete this?')">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; My Blog 2023</div>
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