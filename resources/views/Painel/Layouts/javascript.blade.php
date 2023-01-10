<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('AdminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('AdminLTE/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
<!-- ChartJS -->
<script src="{{asset('AdminLTE/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('AdminLTE/plugins/sparklines/sparkline.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('AdminLTE/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('AdminLTE/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('AdminLTE/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- page script -->
<script>
$(function() {

    //Data emissão
    $('#dataEmissao').inputmask('99/99/9999', {
        'placeholder': '99/99/9999'
    });
    //Data Vencimento
    $('#dataVencimento').inputmask('99/99/9999', {
        'placeholder': '99/99/9999'
    });
    //Data Pagamento
    $('#dataPagamento').inputmask('99/99/9999', {
        'placeholder': '99/99/9999'
    });
    //Telefone
    $('#telefone').inputmask('(9999) 99999-9999', {
        'placeholder': '(9999) 99999-9999'
    })
    //Celular 0
    $('#celular').inputmask('(9999) 99999-9999', {
        'placeholder': '(9999) 99999-9999'
    })
    //Celular 1
    $('#celular1').inputmask('(9999) 99999-9999', {
        'placeholder': '(9999) 99999-9999'
    })
    //Celular 2
    $('#celular2').inputmask('(9999) 99999-9999', {
        'placeholder': '(9999) 99999-9999'
    })
    //E-mail
    $("#email1").inputmask({
        alias: "email"
    });
    $("#email2").inputmask({
        alias: "email"
    });
    //CPF
    $('#cpf').inputmask('999.999.999-99', {
        'placeholder': '999.999.999-99'
    })
    //RG
    $('#rg').inputmask('99.999.999-99', {
        'placeholder': '99.999.999-99'
    })
    //PIS
    $('#pis').inputmask('999.99999.99-9', {
        'placeholder': '999.99999.99-9'
    })
    //CNH
    $('#cnh').inputmask('999.999.999-99', {
        'placeholder': '999.999.999-99'
    })
    //tituloeleitoral
    $('#tituloeleitor').inputmask('9999.9999.9999-999-9999', {
        'placeholder': '9999.9999.9999-999-9999'
    })
    //reservista
    $('#reservista').inputmask('99.99.99.9999-99', {
        'placeholder': '99.99.99.9999-99'
    })
    //cep
    $('#end_cep').inputmask('99999-999', {
        'placeholder': '99999-999'
    })
    //Plano de conta : codigo conta
    $('#codigoconta').inputmask('9.9.99.99.99', {
        'placeholder': '9.9.99.99.99'
    })

    //Money Real
    $("#precocusto").inputmask('currency', {
        "autoUnmask": true,
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: 'R$ ',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: false
    });

    $("#precovenda").inputmask('currency', {
        "autoUnmask": true,
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: 'R$ ',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: false
    });

    $("#vlrTsDesconto").inputmask('currency', {
        "autoUnmask": true,
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: 'R$ ',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: false
    });

    $("#vlrTDesconto").inputmask('currency', {
        "autoUnmask": true,
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: 'R$ ',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: false
    });

    $("#vlrTPedido").inputmask('currency', {
        "autoUnmask": true,
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: 'R$ ',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: false
    });

    $("#vlrUnitario").inputmask('currency', {
        "autoUnmask": true,
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: 'R$ ',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: false
    });

    $("#vlrDesconto").inputmask('currency', {
        "autoUnmask": true,
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: 'R$ ',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: false
    });

    $("#vlrJuros").inputmask('currency', {
        "autoUnmask": true,
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: 'R$ ',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: false
    });

    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $('#example2').DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $('#example3').DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $('#example4').DataTable({
        "responsive": true,
        "autoWidth": false,
    });

    $('#example5').DataTable({
        "responsive": true,
        "autoWidth": false,
    });

});
</script>

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