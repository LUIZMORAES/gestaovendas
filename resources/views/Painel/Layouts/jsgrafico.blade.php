<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI -->
<script src="{{asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('AdminLTE/dist/js/demo.js')}}"></script>
<!-- FLOT CHARTS -->
<script src="{{asset('AdminLTE/plugins/flot/jquery.flot.js')}}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{asset('AdminLTE/plugins/flot-old/jquery.flot.resize.min.js')}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{asset('AdminLTE/plugins/flot-old/jquery.flot.pie.min.js')}}"></script>
<!-- Page script -->

<script>
$(window).on('load', function() {
    $('#preloader .inner').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
        'overflow': 'visible'
    });
})
</script>

<style>
body {
    overflow: hidden;
}

/* ini: Preloader */

#preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #F27620;
    /* cor do background que vai ocupar o body */
    z-index: 999;
    /* z-index para jogar para frente e sobrepor tudo */
}

#preloader .inner {
    position: absolute;
    top: 50%;
    /* centralizar a parte interna do preload (onde fica a animação)*/
    left: 50%;
    transform: translate(-50%, -50%);
}

.bolas>div {
    display: inline-block;
    background-color: #fff;
    width: 25px;
    height: 25px;
    border-radius: 100%;
    margin: 3px;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    animation-name: animarBola;
    animation-timing-function: linear;
    animation-iteration-count: infinite;

}

.bolas>div:nth-child(1) {
    animation-duration: 0.75s;
    animation-delay: 0;
}

.bolas>div:nth-child(2) {
    animation-duration: 0.75s;
    animation-delay: 0.12s;
}

.bolas>div:nth-child(3) {
    animation-duration: 0.75s;
    animation-delay: 0.24s;
}

@keyframes animarBola {
    0% {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 1;
    }

    16% {
        -webkit-transform: scale(0.1);
        transform: scale(0.1);
        opacity: 0.7;
    }

    33% {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 1;
    }
}

/* end: Preloader */
</style>

<style>
.loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite;
    /* Safari */
    animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>