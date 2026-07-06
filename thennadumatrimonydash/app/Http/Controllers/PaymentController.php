<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Package;
use App\Models\UserPackage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id'
        ]);

        $package = Package::findOrFail($request->package_id);
        
        $orderData = [
            'receipt'         => 'rcptid_' . time(),
            'amount'          => $package->package_price * 100, // in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        try {
            $razorpayOrder = $this->api->order->create($orderData);
            
            return response()->json([
                'order_id' => $razorpayOrder['id'],
                'amount' => $orderData['amount'],
                'package_id' => $package->id,
                'package_name' => $package->package_name
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        $signatureStatus = $this->verifySignature(
            $request->razorpay_signature,
            $request->razorpay_payment_id,
            $request->razorpay_order_id
        );

        if ($signatureStatus) {
            // Payment successful
            $user = Auth::user();
            $package = Package::findOrFail($request->package_id);

            // Cancel previous active packages
            UserPackage::where('user_varan_id', $user->varan_id)
                ->where('status', 1)
                ->update(['status' => 0]);

            $videos = $package->no_of_videos ? 1 : 0;
            $images = (int) $package->no_of_images;
            $enableChat = strtolower($package->specification_3) === 'yes' ? 'yes' : 'no';
            $enableAdvancedSearch = strtolower($package->specification_5) === 'yes' ? 'yes' : 'no';
            $enableCall = strtolower($package->specification_6) === 'yes' ? 'yes' : 'no';

            UserPackage::create([
                'user_varan_id' => $user->varan_id,
                'package_name' => $package->package_name,
                'package_price' => $package->package_price,
                'no_of_video' => $videos,
                'no_of_video_upload' => 0,
                'no_of_image' => $images,
                'no_of_image_upload' => 0,
                'no_of_horo' => 1,
                'no_of_horo_upload' => 0,
                'no_of_phno' => $package->noofmblno ?? 0,
                'no_of_phno_viewed' => 0,
                'enable_chat' => $enableChat,
                'enable_call' => $enableCall,
                'enable_horoschope' => 'yes',
                'enable_advancesearch' => $enableAdvancedSearch,
                'validity_date' => Carbon::now()->addDays($package->validity),
                'payment_status' => 'Paid',
                'payment_id' => $request->razorpay_payment_id,
                'status' => 1
            ]);

            session()->flash('success', 'Successfully subscribed to ' . $package->package_name . '!');
            return response()->json(['success' => true, 'redirect_url' => route('dashboard')]);
        } else {
            return response()->json(['success' => false, 'message' => 'Payment verification failed!']);
        }
    }

    private function verifySignature($signature, $paymentId, $orderId)
    {
        try {
            $attributes = array(
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            );
            $this->api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch(\Exception $e) {
            Log::error('Signature Verification Error: ' . $e->getMessage());
            return false;
        }
    }
}
