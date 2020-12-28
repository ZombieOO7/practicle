<?php

namespace App\Http\Controllers;

use View;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserFormRequest;
use Exception;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $view = 'user.';
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->view.'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->request->remove('_token');
            $date = explode('/',$request['joining_date']);
            $request['joining_date'] = $date[2] . '-' . $date[0] . '-' . $date[1];
            if($request->has('uuid') && $request->uuid != null){
                $this->user::whereUuid($request->uuid)->update($request->all());
                $msg = 'Record Updated Successfully';
            }else{
                $this->user::create($request->all());
                $msg = 'Record Created Successfully';
            }
            return response()->json(['status'=>'success','msg'=>$msg]);
        }catch(Exception $e){
            return response()->json(['status'=>'success','msg'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $userList = $this->user::where('id','!=',auth()->id())
                    ->get();
        return DataTables::of($userList)
                ->editColumn('joining_date', function ($user) {
                    return @$user->joining_date_text;
                })
                ->addColumn('action', function ($user) {
                    return View::make($this->view.'action', ['user'=>$user])->render();
                })
                ->editColumn('gender', function ($user) {
                    return @$user->gender_text;
                })
                ->editColumn('phone', function ($user) {
                    return @$user->phone_number;
                })
                ->addColumn('status', function ($user) {
                    return View::make($this->view.'status', ['user'=>$user])->render();
                })
                ->editColumn('updated_at', function ($user) {
                    return $user->proper_updated_at;
                })
                ->rawColumns(['joining_date','status','gender','action','phone','updated_at'])
                ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user::whereUuid($id)->first();
        $userArr = $user->toArray();
        $userArr['joining_date'] = $user->joining_date_text2;
        if($user){
            return response()->json(['status'=>'success','user'=>@$userArr]);
        }
        return response()->json(['status'=>'error']);
    }

    /**
     * update the specified user status from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        $user = $this->user::whereUuid($id)->first();
        $status = ($user->status == 1)?0:1;
        if($user){
            $user->update(['status'=>$status]);
            return response()->json(['status'=>'success','msg'=>'user status updated successfully']);
        }
        return response()->json(['status'=>'error','msg'=>'something went wrong']);
    }

    /**
     * Remove the specified usert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user::whereUuid($id)->first();
        if($user){
            $user->delete();
            return response()->json(['status'=>'success','msg'=>'user deleted successfully']);
        }
        return response()->json(['status'=>'error','msg'=>'something went wrong']);
    }

    /**
     * Validate user mail unique email.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateEmail(Request $request){
        if ($request->has('id') && $request->id != null) {
            $rules = [ 'email' => 'required|unique:users,email,' . $request->id.',uuid,deleted_at,NULL'];
        }else{
            $rules = [ 'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL'];
        }
        $validator = Validator::make($request->all(), $rules);
        $msg = true;
        if ($validator->fails()) {
            $msg = false;
        }
        return json_encode($msg);
    }

    /**
     * Validate user phone unique email.
     *
     * @return \Illuminate\Http\Response
     */
    public function validatePhone(Request $request){
        if ($request->has('id') && $request->id != null) {
            $rules = [ 'phone_number' => 'required|unique:users,phone_number,' . $request->id.',uuid,deleted_at,NULL'];
        }else{
            $rules = [ 'phone_number' => 'required|unique:users,phone_number,NULL,id,deleted_at,NULL'];
        }
        $validator = Validator::make($request->all(), $rules);
        $msg = true;
        if ($validator->fails()) {
            $msg = false;
        }
        return json_encode($msg);
    }
}
