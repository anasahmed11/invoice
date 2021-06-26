<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\User;
use View ;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers=Customer::count();
        $users=User::count();
        $invoices=Invoice::count();

        return view('admin.pages.index')
            ->with('customers',$customers)
            ->with('users',$users)
            ->with('invoices',$invoices)
        ;

    }
}
