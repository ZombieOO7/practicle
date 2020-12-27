@extends('layout.app')
@section('content')
@section('css')
    <style>
        .hid_spn{
            display: none;
        }
        .mt-2{
            margin-top: 20px !important; 
        }
        .mb-2{
            margin-bottom: 20px !important; 
        }
    </style>
    <div class="row col-md-12">
        <div class="col-md-3">
            <h3>User : {{auth()->user()->full_name}}</h3>
        </div>
        <div class="col-md-2 mt-2">
            <a href="{{route('logout')}}" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <div class="col-md-12">
        <a href='javascript:;' class="btn btn-primary mb-2 creatRecord">Create</a>
        <table class="table table-bordered" id='userTable'>
            <thead>
                <th>{{__('formname.full_name')}}</th>
                <th>{{__('formname.email')}}</th>
                <th>{{__('formname.gender')}}</th>
                <th>{{__('formname.phone')}}</th>
                <th>{{__('formname.department')}}</th>
                <th>{{__('formname.joining_date')}}</th>
                <th>{{__('formname.status')}}</th>
                <th>{{__('formname.action')}}</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {{ Form::open(['id'=> 'createform', 'class'=>'form-horizontal','route'=>'user.store']) }}
                <div class="modal-body">
                    <input type="hidden" name="uuid" id="uuid">
                    <div class="form-group">
                        <label for="fullname" class="col-md-3 control-label">{{__('formname.full_name')}}</label>
                        <div class="col-md-9">
                            {!! Form::text('full_name', null, ['id'=>'full_name','class'=> 'form-control', 
                            'placeholder'=> __('formname.full_name')]) !!}
                            @if ($errors->has('full_name'))
                                <p style="color:red;">{{ $errors->first('full_name') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">{{__('formname.email')}}</label>
                        <div class="col-md-9">
                            {!! Form::text('email', null, ['id'=>'email','class'=> 'form-control', 'placeholder'=> __('formname.email')]) !!}
                            @if ($errors->has('email'))
                                <p style="color:red;">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="col-md-3 control-label">{{__('formname.phone_number')}}</label>
                        <div class="col-md-9">
                            {!! Form::text('phone_number', null, ['id'=>'phone_number','class'=> 'form-control', 'placeholder'=> __('formname.phone_number')]) !!}
                            @if ($errors->has('phone_number'))
                                <p style="color:red;">{{ $errors->first('phone_number') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-md-3 control-label">{{__('formname.gender')}}</label>
                        <div class="col-md-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1" checked>
                                <label class="form-check-label" for="exampleRadios1"> Male </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="0">
                                <label class="form-check-label" for="exampleRadios2"> Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="joining_date" class="col-md-3 control-label">{{__('formname.joining_date')}}</label>
                        <div class="col-md-9">
                            {!! Form::text('joining_date', null, ['id'=>'joinDate','class'=> 'form-control', 'placeholder'=> __('formname.joining_date'),'readonly'=>true]) !!}
                            @if ($errors->has('joining_date'))
                                <p style="color:red;">{{ $errors->first('joining_date') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department" class="col-md-3 control-label">{{__('formname.department')}}</label>
                        <div class="col-md-9">
                            {!! Form::text('department', null, ['id'=>'department','class'=> 'form-control', 'placeholder'=> __('formname.department')]) !!}
                            @if ($errors->has('department'))
                                <p style="color:red;">{{ $errors->first('department') }}</p>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="password" class="col-md-3 control-label">{{__('formname.password')}}</label>
                        <div class="col-md-9">
                            {!! Form::password('password',['class'=> 'form-control', 'placeholder'=> __('formname.password')]) !!}
                            @if ($errors->has('password'))
                                <p style="color:red;">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveChange">Save changes</button>
                </div>
            {{Form::close()}}
          </div>
        </div>
    </div>
    <!-- Modal -->
@stop
@section('js')
<script>
    var doms = 'trilp' ,button = [];
    var base_url = '{{url('/')}}';
    var url = "{{route('user.datatable')}}";
    var validateEmailURL = "{{route('validate.email')}}";
    var validatePhoneURL = "{{route('validate.phone')}}";
</script>
<script src="{{asset('js/user.js')}}"></script>
@endsection