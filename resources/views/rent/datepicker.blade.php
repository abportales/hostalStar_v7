<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
</head>

<body>
    {{-- <input class="date form-control" type="text"> --}}
    {{ Form::text('start_date', $rent->start_date, [
        'class' => 'date ' . 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''),
        'placeholder' => 'Fecha de inicio',
        'maxlength' => '10',
    ]) }}

    <script type="text/javascript">
        $('.date').datepicker({
            language: "es",
            format: "dd-mm-yyyy"
        });
    </script>
</body>
