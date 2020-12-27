@extends('layout.app')
@section('content')
<div class="container">
    <div id="signupbox" style="margin-top:50px"
        class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">{{__('formname.sign_up')}}</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="{{route('login')}}"
                        onclick="$('#signupbox').hide(); $('#loginbox').show()">{{__('formname.sign_in')}}</a></div>
            </div>
            <div class="panel-body">
                {{ Form::open(['id'=> 'signupform', 'class'=>'form-horizontal','route'=>'register']) }}
                    <div class="form-group">
                        <label for="fullname" class="col-md-3 control-label">{{__('formname.full_name')}}</label>
                        <div class="col-md-9">
                            {!! Form::text('full_name', null, ['id'=> 'login-username','class'=> 'form-control', 
                            'placeholder'=> __('formname.full_name')]) !!}
                            @if ($errors->has('full_name'))
                                <p style="color:red;">{{ $errors->first('full_name') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">{{__('formname.email')}}</label>
                        <div class="col-md-9">
                            {!! Form::text('email', null, ['class'=> 'form-control', 'placeholder'=> __('formname.email')]) !!}
                            @if ($errors->has('email'))
                                <p style="color:red;">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">{{__('formname.password')}}</label>
                        <div class="col-md-9">
                            {!! Form::password('password',['class'=> 'form-control', 'placeholder'=> __('formname.password')]) !!}
                            @if ($errors->has('password'))
                                <p style="color:red;">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>
                                &nbsp;{{ __('formname.sign_up')}} </button>
                        </div>
                    </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@endsection