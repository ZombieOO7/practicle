@extends('layout.app')
@section('content')
<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">{{__('formname.sign_in')}}</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px">
                </div>
            </div>

            <div style="padding-top:30px" class="panel-body">

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    {{ Form::open(['id'=> 'loginform', 'class'=>'form-horizontal', 'route' =>'login.post' ]) }}
                    <div style="margin-bottom: 10px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        {!! Form::text('email', null, ['id'=> 'login-username','class'=> 'form-control', 
                            'placeholder'=> __('formname.email')]) !!}
                    </div>
                    <span class="emailError">
                        @if ($errors->has('email'))
                        <p style="color:red;">{{ $errors->first('email') }}</p>
                        @endif
                    </span>
                    <div style="margin-bottom: 10px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        {!! Form::password('password',['id'=> 'login-password','class'=> 'form-control', 
                        'placeholder'=> __('formname.password')]) !!}
                    </div>
                    <span class="pswError">
                        @if ($errors->has('password'))
                        <p style="color:red;">{{ $errors->first('password') }}</p>
                        @endif
                    </span>
                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <button id="btn-login" type="submit" class="btn btn-success">{{__('formname.login')}} </a>
                        </div>
                    </div>
                    {{Form::close()}}

                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                {{__('formname.didnt_acnt')}}
                                <a href="{{route('signup')}}" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                    {{__('formname.signup_here')}}
                                </a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection