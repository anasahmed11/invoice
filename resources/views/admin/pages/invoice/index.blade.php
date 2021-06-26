@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div >
        <div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1><b> Invoices</b></h1><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 ">

                </div>
                <div class="col-md-3 ">
                    <button class="btn btn-success btn-block" >Invoices Number <br>{{$count_invoices}}</button><br>
                </div>
                <div class="col-md-3 ">
                    <button class="btn btn-danger btn-block" >Total Invoices Value <br>{{$total_invoices}}</button><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-primary btn-block " ><a href="{{route('new-invoice')}}" style="color: white"><i class="fas fa-cart-plus"></i> Add new</a></button><br><br>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-warning btn-block " ><a href="{{route('customer-invoice')}}" style="color: white"><i class="fas fa-cart-plus"></i> invoice for existing customers</a></button><br><br>
                </div>
            </div>
            <form >
                <div class="row">

                    <div class="col-md-2">
                        <input type="text" name="customer" class="form-control" placeholder="customer">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="customer_phone" class="form-control" placeholder="phone">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="invoice_id" class="form-control" placeholder="invoice number">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark" type="submit" ><i class="fas fa-search"></i> search </button>
                        <button class="btn btn-danger " ><a href="{{route('invoice-index')}}" style="color: white"><i class="far fa-arrow-alt-circle-left"></i> back</a></button><br><br>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2">

                        <span>From : </span>  <input type="date" name="from_date" class="form-control" id="from_date"><br>
                    </div>
                    <div class="col-md-2">
                        <span>To :</span>  <input type="date" name="to_date" class="form-control" id="to_date"><br>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="table-holder table-responsive">
                    <table class="article-table table table-striped  ">
                        <thead class="thead-light">
                        <tr>
                            <th>id</th>
                            <th>customer</th>
                            <th>phone</th>
                            <th>total</th>
                            <th>due date</th>
                            <th>print</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $row)
                            <tr class="invoice-{{$row->id}}">
                                <th scope="row">{{$row->id}}</th>
                                <td>{{$row->customer?$row->customer->name : ''}}</td>
                                <td>{{$row->customer?$row->customer->phone : ''}}</td>
                                <td>{{$row->total}}</td>
                                <td>{{$row->due_date}}</td>
                                <td>
                                    <button class="pdf btn btn-danger" data-id="{{ $row->id }}" ><i class="far fa-file-pdf"></i> Print</button>
                                </td>
                            </tr>
                        @endforeach
                        {{ $invoices->links() }}
                        </tbody>
                    </table>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>

    <script>
        $( document ).ready(function() {
            $(document).on("click", ".pdf", function(e) {
                var id=$(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    Content: "text/csv",
                    url: 'export-invoice-details/'+id,
                    beforeSend: function(){
                        Swal.fire({
                            title: 'Please Wait ..!',
                            text: ' Transaction Under processing Now .... ',
                            type: 'warning',
                            showConfirmButton: false
                        });
                    },
                    success: function(data) {
                        window.location.href = 'export-invoice-details/'+id ;
                        Swal.fire(
                            'done',
                            '',
                            'success'
                        );
                    },
                    statusCode: {
                        500: function() {
                            Swal.fire({
                                type: 'error',
                                title: 'sorry',
                                text: 'error try again ',
                            });
                        }
                    }
                });
                e.preventDefault();
            });
        })
    </script>
@endsection
