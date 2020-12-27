@if($user->status == 1)
<span class="badge badge-pill bg-success">Active</span>
@else
<span class="badge badge-pill bg-danger">InActive</span>
@endif