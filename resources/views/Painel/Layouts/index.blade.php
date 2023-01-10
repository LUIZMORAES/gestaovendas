<!DOCTYPE html>
<html lang="pt-br">

@includeIf('Painel.Layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @includeIf('Painel.Layouts.header')

        @includeIf('Painel.Layouts.sidebar_lateral')

        <div class="content-wrapper">

            @includeIf('Painel.Layouts.conteudo')

        </div>

        @includeIf('Painel.Layouts.footer')

    </div>

    @include('sweetalert::alert')
    @includeIf('Painel.Layouts.javascript')

</body>

</html>