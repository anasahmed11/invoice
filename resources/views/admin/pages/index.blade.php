@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div >
        <div>

            <div class="row">
                <div class="col-md-3 ">
                    <div class="small-box bg-green ">
                        <div class="inner ">
                            <h2>Customers</h2> <br><h3>{{$customers}}</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="small-box bg-red" >
                        <div class="inner" >
                            <h2 style="color: white">Invoices</h2> <br><h3 style="color: white">{{$invoices}}</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="small-box bg-blue" >
                        <div class="inner" >
                            <h2 style="color: white">Users</h2> <br><h3 style="color: white">{{$users}}</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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


        })
    </script>
@endsection
