@extends('layouts.loginlayout')
@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="{{route('store_exam_register')}}" method="post">
            {{ csrf_field()}}
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>{{Session::get('error')}}</strong>
                </div>
            @endif
            @if(Session::has('logout'))
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>{{Session::get('logout')}}</strong>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <div class="form-group has-feedback">
                <input type="text" name="name" class="form-control" placeholder="Name">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
                </div><!-- /.col -->
            </div>
        </form>
    </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection
