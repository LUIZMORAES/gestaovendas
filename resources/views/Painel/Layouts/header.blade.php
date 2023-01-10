<header>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('Painel.principal.index')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('Admin.logout')}}" class="nav-link">Sair do
                    sistema</a>
                {{--@stop--}}
                @csrf
            </li>
        </ul>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('Painel.principal.index')}}">Home</a></li>
                <li class="breadcrumb-item active">

                    @if(isset($urlAtual))
                    <small>{{$urlAtual}}</small>
                    @else
                    <small>Página Principal</small>
                    @endif

                </li>
            </ol>
        </div><!-- /.col -->
    </nav>
</header>