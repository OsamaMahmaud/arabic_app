<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaypalPaymentService extends BasePaymentService implements PaymentGatewayInterface
{
    protected $client_id;
    protected $client_secret;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //test base_url
        $this->base_url = env("PAYPAL_BASE_URL");
        $this->client_id = env("PAYPAL_CLIENT_ID");
        $this->client_secret = env("PAYPAL_CLIENT_SECRET");
        $this->header=[
            "Accept" => "application/json",
            'Content-Type'=>"application/json",
            'Authorization'=> "Basic " . base64_encode("$this->client_id:$this->client_secret"),
        ];
    }
    
    public function sendPayment(Request $request): array
    {
        $data=$this->formatData($request);
        $response = $this->buildRequest("POST", "/v2/checkout/orders", $data);
        //handel payment response data and return it

        if ($response->getData(true)['success']) {
            $transactionId = $response->getData(true)['data']['id']; // الحصول على transaction_id
    
            return [
                'success' => true,
                'url' => $response->getData(true)['data']['links'][1]['href'],
                'transaction_id' => $transactionId, // إرجاع transaction_id
            ];
        }
        return ['success' => false,'url'=>route('payment.failed')];

    }

    public function callBack(Request $request):bool
    {

         $token=$request->get('token');
        //  dd($token);

         $response=$this->buildRequest('POST',"/v2/checkout/orders/$token/capture");
        Storage::put('paypal.json',json_encode([
            'callback_response'=>$request->all(),
            'capture_response'=>$response
        ]));
        if($response->getData(true)['success']&& $response->getData(true)['data']['status']==='COMPLETED' ){

            return true;
        }
        return false;
    }

    public function formatData($request): array
    {
        return [
            "intent" => "CAPTURE",
            "purchase_units"=>[
                [
                    "amount" => $request->input("amount"),
                ]
            ],
            "payment_source" => [
                "paypal" => [
                    "experience_context" => [
                        "return_url" => $request->getSchemeAndHttpHost().'/api/payment/callback',
                        "cancel_url" => route("payment.failed"),
                    ]
                ]
            ]
        ];
    }

}
