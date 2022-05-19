<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Enums\PaymentType;
use App\Http\Requests\CreatePaymentRequest;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showCreatePayments()
    {
        $payment_types = PaymentType::asSelectArray();
        
        $payment_methods = PaymentMethod::asSelectArray();

        $projects = Project::all();
        $payments = Payment::all();
        return view('payments', compact('projects', 'payments', 'payment_types' , 'payment_methods'));
    }

    public function addPayment(CreatePaymentRequest $request)
    {
        $data = $request->validated();
        Payment::create($data);

        return redirect()->route('create-payment');
    }

    public function deletePayment(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('create-payment')->with('success', 'Payment record deleted successfully.');
    }

    public function editPayment(Payment $payment, Project $projects)
    {
        $payment_types = PaymentType::asSelectArray();
        $payment_methods = PaymentMethod::asSelectArray();

        $projects = Project::all();
        return view('payments-edit' , compact('payment', 'projects', 'payment_types', 'payment_methods'));
    }

    public function updatePayment(CreatePaymentRequest $request, Payment $payment)
    {
        $payment = Payment::whereId($payment->id)->first();
        $payment->update([
            'project_id' => $request->get('project_id'),
            'received_date' => $request->get('received_date'),
            'type' => $request->get('type'),
            'payment_method' => $request->get('payment_method'),
            'amount' => $request->get('amount'),
            'remarks' => $request->get('remarks'),
        ]);

        return redirect()->route('create-payment');
    }

    
}
