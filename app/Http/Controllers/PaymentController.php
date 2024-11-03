<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function handleWebhook(Request $request)
    {
        return $this->paymentService->handleWebhook($request);
    }

    public function getAllTransactions()
    {
        return $this->paymentService->getAllTransactions();
    }

    public function cron(){
        return $this->paymentService->cron();
    }


}
