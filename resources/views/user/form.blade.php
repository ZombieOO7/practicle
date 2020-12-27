{{ Form::model($user, ['route' => ['user.update'], 'method' => 'POST','id'=>'editform','class'=>'form-horizontal','autocomplete' => "off"]) }}
<input type="hidden" name="uuid" id="{{@$user->uuid}}">
<div class="modal-body">
    <div class="form-group">
        <label for="fullname" class="col-md-3 control-label">{{__('formname.full_name')}}</label>
        <div class="col-md-9">
            {!! Form::text('full_name', @$user->full_name, ['class'=> 'form-control', 
            'placeholder'=> __('formname.full_name')]) !!}
            @if ($errors->has('full_name'))
                <p style="color:red;">{{ $errors->first('full_name') }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-md-3 control-label">{{__('formname.email')}}</label>
        <div class="col-md-9">
            {!! Form::text('email', @$user->email, ['class'=> 'form-control', 'placeholder'=> __('formname.email')]) !!}
            @if ($errors->has('email'))
                <p style="color:red;">{{ $errors->first('email') }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="phone_number" class="col-md-3 control-label">{{__('formname.phone_number')}}</label>
        <div class="col-md-9">
            {!! Form::text('phone_number', @$user->phone_number, ['class'=> 'form-control', 'placeholder'=> __('formname.phone_number')]) !!}
            @if ($errors->has('phone_number'))
                <p style="color:red;">{{ $errors->first('phone_number') }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="gender" class="col-md-3 control-label">{{__('formname.gender')}}</label>
        <div class="col-md-9">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1" @if($user->gender==1) ? checked @endif>
                <label class="form-check-label" for="exampleRadios1"> Male </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="0"  @if($user->gender==1) ? checked @endif>
                <label class="form-check-label" for="exampleRadios2"> Female</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="joining_date" class="col-md-3 control-label">{{__('formname.joining_date')}}</label>
        <div class="col-md-9">
            {!! Form::text('joining_date', @$user->joining_date, ['id'=>'joinDate','class'=> 'form-control', 'placeholder'=> __('formname.joining_date')]) !!}
            @if ($errors->has('joining_date'))
                <p style="color:red;">{{ $errors->first('joining_date') }}</p>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="department" class="col-md-3 control-label">{{__('formname.department')}}</label>
        <div class="col-md-9">
            {!! Form::text('department', @$user->department, ['class'=> 'form-control', 'placeholder'=> __('formname.department')]) !!}
            @if ($errors->has('department'))
                <p style="color:red;">{{ $errors->first('department') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary updateData">Save changes</button>
</div>
{{Form::close()}}
