<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>:- Exam Portal-:</title>
    <!--Required styles-->
    <link href="{{url('/')}}/exam2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/exam2/css/reset.css" rel="stylesheet">
    <link href="{{url('/')}}/exam2/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="{{url('/')}}/exam2/font-awesome/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!-- Confirm CSS files -->
    <link type='text/css' href='{{url('/')}}/confirm/css/confirm.css' rel='stylesheet' media='screen' />
    <link type='text/css' href='{{url('/')}}/confirm/css/demo.css' rel='stylesheet' media='screen' />

    <script src="{{url('/')}}/exam2/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
<!-- Header Start-->
<?php

use Illuminate\Support\Facades\Auth;
$uid = Auth::user()->id;
$name = \App\User::where('id',$uid)->value('name');
$date = date('d/m/Y');


?>
<section id="main-area1">
    <div class="container">
        <div class="col-md-6 col-xs-6">
            <h1>Exam Portal</h1>
        </div>

        <div class="col-md-6 col-xs-6">
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="https://banner2.kisspng.com/20180630/ltq/kisspng-computer-icons-user-avatar-clip-art-skincare-cartoon-5b371025a6d8a7.5354815915303352696834.jpg" class="img-responsive img-circle"/> {{$name}} <b class="caret"></b>
                        <i class="fa fa-"></i></a>
                    <ul class="dropdown-menu">
                        <li><a onclick="exit()">Log Out <span class="glyphicon glyphicon-log-out"></span> </a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</section>


@yield('content')
<!------------------------------------------------------------------- Submit Confirm ------------------------------------>

<div id='container'>
    <div id='content'>
        <!-- modal content -->

        <!-- preload the images -->
        <div style='display:none'>
            <img src='{{url('/')}}/confirm/img/confirm/header.gif' alt='' />
            <img src='{{url('/')}}/confirm/img/confirm/button.gif' alt='' />
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------>
<script src="{{url('/')}}/exam2/js/jquery-1.11.3.js"></script>
<script src="{{url('/')}}/admintheme/bootstrap/js/bootstrap.min.js"></script>
<script type='text/javascript' src='{{url('/')}}/confirm/js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='{{url('/')}}/confirm/js/confirm.js'></script>
<script>
    function exit(){v
        window.confirm ("Are you sure to exit?");
    }
    function testyes(){
        window.location.href="<?php echo route('exam::exam_logout');?>";
    }
</script>
@stack('scripts')
<!--Required js -->
<script src="{{url('/')}}/exam2/js/bootstrap-dropdown-on-hover.js"></script>
</body>
</html>
