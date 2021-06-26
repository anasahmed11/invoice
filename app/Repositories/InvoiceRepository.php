<?php

namespace App\Repositories;

use App\Models\Invoice;
use Symfony\Component\HttpFoundation\Request;

class InvoiceRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $invoices= Invoice::orderByDesc("id")
            ->
            when($request->get('from_date'), function ($invoices) use ($request) {
                return $invoices->whereDate('due_date', '>=', $request->query->get('from_date'))
                    ->whereDate('due_date', '<=', $request->query->get('to_date'));
            })->when($request->get('customer'), function ($invoices) use ($request) {
                return $invoices->WhereHas('customer', function ($invoices) use ($request){
                    $invoices->where('name', 'like', '%' . $request->query->get('customer') . '%');
                });
            })->when($request->get('customer_phone'), function ($invoices) use ($request) {
                return $invoices->WhereHas('customer', function ($invoices) use ($request){
                    $invoices->where('phone', 'like', '%' . $request->query->get('customer_phone') . '%');
                });
            })->when($request->get('user'), function ($invoices) use ($request) {
                return $invoices->WhereHas('user', function ($invoices) use ($request){
                    $invoices->where('name', 'like', '%' . $request->query->get('user') . '%');
                });
            })->when($request->get('invoice_id'), function ($invoices) use ($request) {
                $invoices->where('id', '=', $request->query->get('invoice_id'));
            });
        return $invoices;
    }

}
