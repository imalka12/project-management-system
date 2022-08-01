<?php
namespace App\Services;

use App\Http\Requests\CreatePaymentRequest;
use App\Models\Payment;
use App\Repositories\PaymentRepository;

class PaymentService
{
    public $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * create new payment
     * 
     * @param createPaymentRequest $request
     * @return Payment
     */
    public function create(CreatePaymentRequest $request): Payment
    {
        $data = $request->validated();

        return $this->paymentRepository->create($data);
    }

    /**
     * delete payment record
     * 
     * @param Payment $payment
     * 
     */
    public function delete(Payment $payment)
    {
        return $this->paymentRepository->delete($payment->id);
    }

    public function update(Payment $payment, CreatePaymentRequest $request)
    {
        $data = $request->validated();
        return $this->paymentRepository->update($payment, $data);
    }

    public function getPaymentsByProject($id, $from_date, $to_date)
    {
        return $this->paymentRepository->getPaymentsByProject($id, $from_date, $to_date);
    }
}