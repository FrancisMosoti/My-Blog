<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>{{config('app.name')}}- @yield('title')</title>
</head>

<body>
    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <div class="me-auto">
                    <a class="navbar-brand" href="#">My Blog</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a class="nav-link active" aria-current="page" href="{{route('back')}}">Home</a>
                        <a class="nav-link active" aria-current="page"
                            href="{{route('profile', ['user' => Auth::User()->id])}}">Profile</a>
                        <a class="nav-link" href="{{route('add',['user' => Auth::User()->id])}}">New Post</a>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @foreach($categories as $category)
                                <li><a class="dropdown-item" href="#">{{$category->categories}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <a class="nav-link" href="{{route('logout')}}">Logout</a>
                        <a class="nav-link disabled" href="#" tabindex="-1"
                            aria-disabled="true">{{Auth::User()->name}}</a>
                    </div>
                </div>
            </div>
        </nav>

    </div>
    @yield('content')

    <footer class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>Copyright &copy; 2023</p>
                    <p>Developed By Francis Mosoti</p>
                </div>
                <div class="col-md-6 text-right">
                    <h3>Quick links</h3>
                    <a class="nav-link active" aria-current="page" href="{{route('back')}}">Home</a>
                    <a class="nav-link" href="{{route('profile', ['user' => Auth::User()->id])}}" class="">Profile</a>
                    <a class="nav-link" href="{{route('add',['user' => Auth::User()->id])}}">New Post</a>
                    <a class="nav-link" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>

    </footer>
    </footer>
</body>

</html>