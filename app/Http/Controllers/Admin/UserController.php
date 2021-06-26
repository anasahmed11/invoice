<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserType;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Hash;
use Response;
use Validator;
use Illuminate\Http\Request;
use View;
use Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $rules =
        [
            'phone' => [ 'regex:/^01(?!3|4)[0-5]{1}[0-9]{8}$/','required'],
            'type' => 'required|',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    protected $messages =
        [
            'name.required' =>'you should enter name',
            'phone.required' =>'you should enter phone',
            'phone.regex' =>'Not Egyptian Number',
            'type.required' =>'you should enter type',
        ];

    public function __construct(UserRepository $UserRepository)
    {
        $this->middleware('auth');
        $this->UserRepository= $UserRepository;
    }
    public function index()
    {
        if(Auth::user()->type==1 ){
            $users=$this->UserRepository->search(request())->paginate(10);
            $users->appends(request()->all());
            $types=UserType::pluck('name','id');
            $count=$this->UserRepository->search(request())->count();
            return View::make('admin.users.users', ['users' => $users ,'count' => $count,'types'=>$types]);
        }else{
            return View('admin.pages.404');
        }

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules,$this->messages);
        if ($validator->fails()) {
            return response()->json(
                array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray())
                , 400);
        }else{

            $user=new User();
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->type = $request->input('type');
            $user->email = $request->input('email');
            $user->password =Hash::make($request->input('password'));
            $user->save();
            $user->load('user_type');
            return response()->json($user);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'phone' => [ 'regex:/^01(?!3|4)[0-5]{1}[0-9]{8}$/','required'],
                'type' => 'required|',
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($id),
                ],
            ],
            $this->messages
        );
        if ($validator->fails()) {
            return response()->json(
                array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray())
                , 400);
        }else{
            $user=User::find($id);
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->type = $request->input('type');
            $user->email = $request->input('email');
            $user->save();
            $user->load('user_type');
            return response()->json($user);
        }
    }


    public function destroy($id)
    {
        if(Auth::user()->type==1){
            $user = user::find($id);
            $user->delete();
        }else{
            $user=['message'=>'you should have admin permission first'];
        }

        return response()->json($user);
    }
}
