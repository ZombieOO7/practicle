<a href="javascript:;" class="edit" data-url="{{route('user.edit',['uuid'=>@$user->uuid])}}"><span class="fa fa-pen" data-toggle="modal" data-target="#createModal"></span></a>
<a href="javascript:;" class="delete" data-url="{{route('user.delete',['uuid'=>@$user->uuid])}}"><span class="fa fa-trash" data-toggle="modal" data-target="#exampleModal"></span></a>
<a href="javascript:;" class="active_inactive" data-url="{{route('user.active-inactive',['uuid'=>@$user->uuid])}}">
    <label class="switch">
        <input type="checkbox" data-url="{{route('user.active-inactive',['uuid'=>@$user->uuid])}}" class='active_inactive' @if($user->status==1) checked @endif>
        <span class="slider round"></span>
    </label>
</a>