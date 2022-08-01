<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Enums\PaymentType;
use App\Http\Requests\CreatePaymentRequest;
use App\Models\Payment;
use App\Models\Project;
use App\Services\PaymentService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public $payments;
    public $projects;

    public function __construct(PaymentService $paymentService, ProjectService $projectService)
    {
        $this->payments = $paymentService;
        $this->projects = $projectService;
    }

    /**
     * show create payment page to add payments
     * 
     * @return void
     */
    public function showCreatePayments()
    {
        $payment_types = PaymentType::asSelectArray();

        $payment_methods = PaymentMethod::asSelectArray();

        $projects = Project::all();
        $payments = Payment::all();
        return view('payments', compact('projects', 'payments', 'payment_types', 'payment_methods'));
    }

    /**
     * process create payment request
     * 
     * @param CreatePaymentRequest $request
     */
    public function addPayment(CreatePaymentRequest $request)
    {
        $this->payments->create($request);

        return redirect()->route('create-payment');
    }

    /**
     * process delete payment request
     * 
     * @param Payment $payment
     */
    public function deletePayment(Payment $payment)
    {
        $this->payments->delete($payment);
        return redirect()->route('create-payment')->with('success', 'Payment record deleted successfully.');
    }

    /**
     * show edit payment page to edit payment details
     * 
     * @param Payment $payment 
     * @param Project $project
     * @return void
     */
    public function editPayment(Payment $payment, Project $projects)
    {
        $payment_types = PaymentType::asSelectArray();
        $payment_methods = PaymentMethod::asSelectArray();

        $projects = Project::all();
        return view('payments-edit', compact('payment', 'projects', 'payment_types', 'payment_methods'));
    }

    /**
     * process update payment request
     * 
     * @param CreatePaymentRequest $request
     * @param Payment $payment
     */
    public function updatePayment(CreatePaymentRequest $request, Payment $payment)
    {
        $this->payments->update($payment, $request);

        return redirect()->route('create-payment');
    }

    /**
     * show payment report page to display payment details
     * 
     * @param Project $projects
     * @param Payment $payment
     * @return void
     */
    public function paymentsReport(Project $projects, Payment $payments)
    {
        $projects = Project::all();
        return view('payments-reports', compact('projects', 'payments'));
    }

    /**
     * to generate payment report
     * 
     * @param Request $request
     */
    public function paymentReportGenerate(Request $request)
    {
        // get payments for project, between start date and end date
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $project_id = $request->get('project');

        $project = $this->projects->getProjectById($project_id);

        $payments = $this->payments->getPaymentsByProject($project_id, $from_date, $to_date);

        return view('payment-by-period', compact('payments', 'project'));
    }

    public function getPaymentsByProject($project_id)
    {
        $payments = Payment::whereProjectId($project_id)->get();
        return $payments;
    }

    public function showPaymentsPage()
    {
        $payment_types = PaymentType::asSelectArray();

        $payment_methods = PaymentMethod::asSelectArray();

        return view('payments_js', compact('payment_types', 'payment_methods'));
    }

    public function createNewPayment(CreatePaymentRequest $request)
    {
        $data = $request->validated();
        $payment = Payment::create($data);

        return $payment;
    }

    public function getAllPayments()
    {
        $payments = Payment::all();

        return $payments;
    }

    public function deleteSelectedPayment(Payment $payment)
    {
        $payment->delete();
    }

    public function getPaymentRecord(Payment $payment)
    {
        return $payment;
    }

    public function updateSelectedPayment(CreatePaymentRequest $request, Payment $payment)
    {
        $payment->update([
            'project_id' => $request->get('project_id'),
            'amount' => $request->get('amount'),
            'type' => $request->get('type'),
            'payment_method' => $request->get('payment_method'),
            'received_date' => $request->get('received_date'),
            'remarks' => $request->get('remarks'),   
        ]);
        return $payment;
    }

    public function getPaymentDetailsView()
    {
        $allPayments = Payment::all();
        return view('get-payments-details', compact('allPayments'));
    }

    public function getPayemtnsByDate(Request $request)
    {
        // $request = $request->validate([
        //     'date' => 'required|exists:payments,received_date',
        // ]);

        $payments = Payment::whereDate('received_date', $request['received_date'])->get();

        return view('get-payments-details', compact('payments'));
    }

    public function viewPayementDetails(Payment $payment)
    {
        $payments = Payment::whereDate('received_date', $payment['received_date'])->get();

        return view('get-payments-details', compact('payment', 'payments'));
    }
}
