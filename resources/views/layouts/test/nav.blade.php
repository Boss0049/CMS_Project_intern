@section('nav')
	<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbaritem">
        <a class="navbar-brand" href="/">Laravel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/cms')}}">CMS <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>       
@endsection