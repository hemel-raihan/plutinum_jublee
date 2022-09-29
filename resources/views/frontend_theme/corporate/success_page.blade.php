@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')


    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
            <div class="card" style="margin:10%;">
                <div class="card-header">
                
                    <p style="font-size:25px;font-weight:bolder">
                        Payment Status : <b style="color:rgb(12, 116, 148);font-weight:bold">{{$payment_data->bank_status}}</b>
                    </p>
                    
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3"></div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @if ($payment_data->sp_code == 1000)
                                    <p style="font-size:20px;font-weight:bolder">Your payment process has been succeeded.</p>
                                @else
                                    <p style="font-size:20px;font-weight:bolder">Your payment process has been failed.</p>
                                @endif
                            </div>
                    </div>
                        <div class="col-md-3"></div>
                </div>
                    
            </div>
        </div>
    </div>


@endsection()

@section('scripts')

@endsection
