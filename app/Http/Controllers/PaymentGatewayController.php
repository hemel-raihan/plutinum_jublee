<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;

class PaymentGatewayController extends Controller
{
    
    public function initiatePayment(Request $request)
    {
        $register_info = DB::table('member_registrations')->where("id",$request->register_id)->first();

        $info = array( 
            'currency' => "BDT",
            'amount' => $register_info->total_fee, 
            'order_id' => (string) $register_info->id, 
            'discsount_amount' =>0 , 
            'disc_percent' =>0 , 
            'client_ip' => "127.0.0.1", 
            'customer_name' => $register_info->name, 
            'customer_phone' => (string) $register_info->phone, 
            'email' => $register_info->email, 
            'customer_address' => $register_info->present_address, 
            'customer_city' => "Dhaka", 
            'customer_state' => "", 
            'customer_postcode' => "", 
            'customer_country' => "BD",
        );

        $shurjopay_service = new ShurjopayController();
        return $shurjopay_service->checkout($info);
    }


    public function verifyPayment(Request $request)
    {
        $order_id = $request->order_id;
        $shurjopay_service = new ShurjopayController();
        $data = $shurjopay_service->verify($order_id);

        $payment_return = json_decode($data);
        $length = count($payment_return);
        $payment_data = $payment_return[($length-1)];

        if($payment_data->sp_code == 1000){
            $voucherUpdated = DB::table('member_registrations')
                                ->where('id', $payment_data->customer_order_id)
                                ->update([
                                          'payment_status' => 1,
                                        ]);
        }
        
        return view('frontend_theme.corporate.success_page',compact('payment_data'));
    }


}
