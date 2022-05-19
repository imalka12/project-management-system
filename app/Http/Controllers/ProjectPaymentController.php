<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectPaymentController extends Controller
{
    public function showProjectPayments()
    {
        $payments = Payment::all();
        $projects = Project::with('payments')->get();

        return view('project-payment', compact('payments', 'projects'));
    }
}
