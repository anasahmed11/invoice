<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Validation\Rule;
use Response;
use Validator;
use Illuminate\Http\Request;
use View;
use Auth;

class CustomerController extends Controller
{

    protected $rules =
        [
            'name' => 'required|',
            'phone' => [ 'regex:/^01(?!3|4)[0-5]{1}[0-9]{8}$/','required'],
            'address' => 'required|',
            'email'=>'required'
        ];
    protected $messages =
        [
            'name.required' =>'you should enter name',
            'phone.required' =>'you should enter phone',
            'phone.regex' =>'Not Egyptian Number',
            'address.required' =>'you should enter address',
            'email.required' =>'you should enter email',
        ];

    private $CustomerRepository;

    public function __construct(CustomerRepository $CustomerRepository)
    {
        $this->middleware('auth');
        $this->CustomerRepository= $CustomerRepository;
    }
    public function index()
    {
        if(Auth::user()->type==1 ){
            $customers=$this->CustomerRepository->search(request())->paginate(10);
            $customers->appends(request()->all());
            $count=$this->CustomerRepository->search(request())->count();
            return View::make('admin.users.customers', ['customers' => $customers,'count' => $count  ]);
        }else{
            return View('admin.pages.404');
        }

    }


    public function create()
    {
        //
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

            $customer=new Customer();
            $customer->name = $request->input('name');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->email = $request->input('email');
            $customer->save();
            return response()->json($customer);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'phone' => [ 'regex:/^01(?!3|4)[0-5]{1}[0-9]{8}$/','required'],
                'address' => 'required|',
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    Rule::unique('customers')->ignore($id),
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
            $customer=Customer::find($id);
            $customer->name = $request->input('name');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->email = $request->input('email');
            $customer->save();
            return response()->json($customer);
        }
    }

}
