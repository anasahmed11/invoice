<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceEmail;
use App\Models\Customer;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;
use Response;
use Validator;
use Illuminate\Http\Request;
use View;

class InvoiceController extends Controller
{
    public function __construct(InvoiceRepository $InvoiceRepository)
    {
        $this->middleware('auth');
        $this->InvoiceRepository= $InvoiceRepository;
    }

    public function index()
    {
        if(Auth::user()->type==1){
            $invoices=$this->InvoiceRepository->search(request())->paginate(10);
            $invoices->appends(request()->all());
            $total_invoices=$this->InvoiceRepository->search(request())->sum('total');
            $count_invoices=$this->InvoiceRepository->search(request())->count();
            return view('admin.pages.invoice.index')
                ->with('invoices',$invoices)->with('total_invoices',$total_invoices)
                ->with('count_invoices',$count_invoices)
            ;
        }else{
            return View('admin.pages.404');
        }

    }

    public function create()
    {
        if(Auth::user()->type==1){
            $customers=Customer::select('name','id','phone')->get();
            return view('admin.pages.invoice.customer-invoice')->with('customers',$customers);
        }else{
            return View('admin.pages.404');
        }

    }

    public function create_new()
    {
        if(Auth::user()->type==1){
            return view('admin.pages.invoice.new-invoice');
        }else{
            return View('admin.pages.404');
        }

    }

    public function customer_invoice(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
            'customer_id' => 'required|exists:customers,id',
            'total'=>'required|',
            'due_date'=>'required'

            ],
            [
                'customer_id.required' =>'you should choose customer',
                'total.required' =>'you should enter total',
                'due_date.required' =>'you should enter due date',

            ]
        );
        if ($validator->fails()) {
            return response()->json(
                array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray())
                , 400);
        }else{
            $invoice=new Invoice();
            $invoice->due_date=$request->input('due_date');
            $invoice->total=$request->input('total');
            $invoice->user_id=Auth::user()->id;
            $invoice->customer_id=$request->input('customer_id');
            $invoice->save();

            //send the mail
            $customer=Customer::find($request->input('customer_id'));
            $details = [
                'name' => $customer->name,
                'due_date' => $request->input('due_date'),
                'total' => $request->input('total')
            ];
            Mail::to($customer->email)->send(new InvoiceEmail($details));
            return response()->json($invoice);

        }
    }

    public function new_invoice(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'total'=>'required|',
                'due_date'=>'required',
                'name' => 'required|',
                'phone' => [ 'regex:/^01(?!3|4)[0-5]{1}[0-9]{8}$/','required'],
                'address' => 'required|',
                'email'=>'required'

            ],
            [
                'customer_id.required' =>'you should choose customer',
                'total.required' =>'you should enter total',
                'due_date.required' =>'you should enter due date',
                'name.required' =>'you should enter name',
                'phone.required' =>'you should enter phone',
                'phone.regex' =>'Not Egyptian Number',
                'address.required' =>'you should enter address',
                'email.required' =>'you should enter email',

            ]
        );
        if ($validator->fails()) {
            return response()->json(
                array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray())
                , 400);
        }else{
            //create customer
            $customer=new Customer();
            $customer->name = $request->input('name');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->email = $request->input('email');
            $customer->save();
            //append invoice to the customer
            $invoice=new Invoice();
            $invoice->due_date=$request->input('due_date');
            $invoice->total=$request->input('total');
            $invoice->user_id=Auth::user()->id;
            $invoice->customer_id=$customer->id;
            $invoice->save();

            //send the mail
            $details = [
                'name' => $request->input('name'),
                'due_date' => $request->input('due_date'),
                'total' => $request->input('total')
            ];
            Mail::to($request->input('email'))->send(new InvoiceEmail($details));

            return response()->json($invoice);

        }
    }

    public function export_invoice_pdf($id)
    {
        $mytime = Carbon::now();
        $invoice=Invoice::where('id',$id)->first();
        $pdf = PDF::loadView('admin.pages.invoice.pdf', ['invoice' => $invoice]);
        return $pdf->download('Invoice' . $mytime->toDateTimeString() . '.pdf');
    }

}
