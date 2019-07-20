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
    <!-- Page styles -->
    <link type='text/css' href='{{url('/')}}/confirm/css/demo.css' rel='stylesheet' media='screen' />
    <!-- Confirm CSS files -->
    <link type='text/css' href='{{url('/')}}/confirm/css/confirm.css' rel='stylesheet' media='screen' />
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
<section id="header-area1">
    <div class="container">
        <div class="col-md-3 col-xs-6">
            <ul>
                <li>
                    <img src="https://banner2.kisspng.com/20180630/ltq/kisspng-computer-icons-user-avatar-clip-art-skincare-cartoon-5b371025a6d8a7.5354815915303352696834.jpg" class="img-responsive img-circle"/>
                </li>
                <li> <p> {{$name}}</p></li>
            </ul>

        </div>
        <div class="col-md-3 col-xs-6">
            <p class="text-center"><i class="fa fa-calendar"></i> {{$date}}</p>
        </div>
        <a class="col-md-3 col-xs-6" href="#">
            <p class="text-right" onclick="exit()">EXIT <i class="fa fa-angle-right"></i></p>
        </a>

    </div>
</section>

@yield('exam-content')

<!------------------------------------------------------------------- Submit Confirm ------------------------------------>

<div id='container'>
    <div id='content'>
        <!-- modal content -->
        <div id='confirm'>
            <div class='header'><span>Confirm</span></div>
            <div class='message'></div>
            <div class='buttons'>
                <div class='no simplemodal-close'>No</div><div class='yes' onclick="testyes()" >Yes</div>
            </div>
        </div>
        <!-- preload the images -->
        <div style='display:none'>
            <img src='{{url('/')}}/confirm/img/confirm/header.gif' alt='' />
            <img src='{{url('/')}}/confirm/img/confirm/button.gif' alt='' />
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------>
<!--Required js -->
<script src="{{url('/')}}/admintheme/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="{{url('/')}}/admintheme/bootstrap/js/bootstrap.min.js"></script>
<script type='text/javascript' src='{{url('/')}}/confirm/js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='{{url('/')}}/confirm/js/confirm.js'></script>

<script>
    function exit(){
        window.confirm ("Are you sure to exit?");
    }
    function testyes(){
        window.location.href="<?php echo route('exam::exam_logout');?>";
    }
</script>
@stack('scripts')
<!--Required js -->
</body>
</html>
