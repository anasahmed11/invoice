@extends('layouts.pdf')


@section('content')
    <section id="invoice-title-number">

        <span id="title">No # {{$invoice->id}}</span>

    </section>

    <div class="clearfix"></div>

    <section id="client-info">
        <div>
            <span class="bold">Customer : {{$invoice->customer?$invoice->customer->name:''}}</span>
        </div>

        <div>
            <span>Phone : {{$invoice->customer?$invoice->customer->phone:''}}</span>
        </div>
        <br>

    </section>

    <div class="clearfix"></div>

    <section id="sums">

        <table cellpadding="0" cellspacing="0">

            <tr data-hide-on-quote="true" class="due-amount">
                <th>Due Date : </th>
                <td>{{$invoice->due_date}}</td>
            </tr>
            <tr class="amount-total">
                <!-- {amount_total_label} -->
                <td colspan="2">{{$invoice->total}}</td>
            </tr>
        </table>

        <div class="clearfix"></div>

    </section>

    <div class="clearfix"></div>

    <section id="invoice-info">
        <div>
            <span><b>Invoice Date :</b> </span> <span><b>{{$invoice->created_at}}</b></span>
        </div>

        <br />

        <div>
            <span>Currency : </span> <span>EGP</span>
        </div>
        <div>
            <span>Signature : </span> <span>-------------------------------</span>
        </div>
    </section>
    <hr>
@endsection

