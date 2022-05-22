<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    //

    private $gateway;
    public function  __construct(){
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request, Post $post){

        try{
            $response=$this->gateway->purchase(array(
                'amount'=>$request->amount,
                'currency'=>env('PAYPAL_CURRENCY'),
                'returnUrl'=>url('success/'.$post->id),
                'cancelUrl'=>url('error'),
            ))->send();
            if($response->isRedirect()){
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }
        }catch(\Throwable $th){
            return  $th->getMessage();
        }
    }
    public function success(Request $request, $id){
        if($request->input('paymentId') && $request->input('PayerID')){
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'=>$request->input('PayerID'),
                'transactionReference'=> $request->input('paymentId')
            ));

            $response= $transaction->send();
            if($response->isSuccessful()){
                $arr=$response->getData();

                $payment= new Payment();
                $payment->user_id=Auth::id();
                $payment->post_id= $id;
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount =$arr['transactions'][0]['amount']['total'];
                $payment->currency=env('PAYPAL_CURRENCY');
                $payment->payment_status=$arr['state'];
                $payment->save();

                return redirect()->route('post',$id);
//                return "Payment is Successfull. Your transaction Id is:".$arr['id'];
            }
            else{
                return $response->getMessage();
            }
        }
        else{
            return 'Payment declined';
        }
    }


    public function error(){
        return 'User declined the payment';
    }

}
