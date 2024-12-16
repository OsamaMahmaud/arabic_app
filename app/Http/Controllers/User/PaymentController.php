<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\PaymentGatewayInterface;

class PaymentController extends Controller
{
    protected PaymentGatewayInterface $paymentGateway;

    public function __construct(PaymentGatewayInterface $paymentGateway)
    {

        $this->paymentGateway = $paymentGateway;
    }


    public function paymentProcess(Request $request)
    {
            // التحقق من البيانات المدخلة
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,id',
            'amount' => 'required|array',
            'amount.currency_code' => 'required|string|in:USD,EUR', // السماح بالعملات المحددة فقط
            'amount.value' => 'required|numeric|min:0', // القيمة يجب أن تكون رقمية وإيجابية
        ]);

        // الحصول على الباقة ومبلغها
        $package = Package::findOrFail($request->package_id);

        // التحقق من أن المبلغ المرسل يساوي مبلغ الباقة
        if ($request->amount != $package->price) {
            return response()->json(['error' => 'Invalid amount.'], 400);
        }


        $paymentData =  $this->paymentGateway->sendPayment($request);


        if ($paymentData['success']) {
            // إنشاء سجل جديد للدفع مع حالة "قيد الانتظار"
            Payment::create([
                'user_id' => $request->user_id,
                'package_id' => $request->package_id,
                'payment_status' => 'pending',
                'transaction_id' => $paymentData['transaction_id'], // تخزين transaction_id
            ]);

            return response()->json(['url' => $paymentData['url']]);
        }

       return response()->json(['error' => 'Payment initiation failed'], 500);
    }



    public function callBack(Request $request): \Illuminate\Http\RedirectResponse
    {
        $isPaymentSuccess = $this->paymentGateway->callBack($request);

        if ($isPaymentSuccess) {
            // تحديث حالة الدفع إلى "مكتمل"
            $payment = Payment::where('transaction_id', $request->get('token'))->first();
            // dd($payment);
            $payment->update(['payment_status' => 'completed']);
            // dd($payment);
      
            $package = Package::find($payment->package_id);
            //  dd($package);
            // تفعيل المستويات
            $packageLevels =$package->levels()->pluck('levels.id');
            // dd($packageLevels);
            $user = User::find($payment->user_id);
            $user->levels()->syncWithoutDetaching($packageLevels);
            //  dd($user);

            
            return redirect()->route('payment.success');
        }
    
        return redirect()->route('payment.failed');
    }



    public function success()
    {

        return view('payment-success');
    }
    public function failed()
    {

        return view('payment-failed');
    }

}

