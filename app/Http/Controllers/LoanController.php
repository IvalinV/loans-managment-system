<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Http\Requests\LoanRequest;
use App\Http\Resources\LoanResource;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'loans' => LoanResource::collection(Loan::latest()->get()),
        ]);
    }

    public function create() {
        return Inertia::render('Loan/Create');
    }

    public function store(LoanRequest $request){
        $validated = $request->validated();

        $loan = new Loan();

        $loan->uuid = Str::uuid();
        $loan->total_amount = $validated['total_amount'];
        $loan->remaining_amount = $validated['total_amount'];
        $loan->deadline = $validated['deadline'];
        $loan->holder_id =auth()->id();
        $loan->monthly_installment = $loan->total_amount / $loan->deadline;
        $loan->save();

        return redirect()->back()->with('success', 'Loan created successfuly!');
    }

    public function createPayment() {
        return Inertia::render('Loan/Payment/Create', [
            'loans' => LoanResource::collection(Loan::latest()->get()),
        ]);
    }

    public function storePayment(Request $request) {
        $loan = Loan::find($request->loan_id);
        
        $loan->payments()->create([
            'amount' => $request->amount
        ]);

        if($loan->remaining_amount == 0){
            return redirect()->back()->with('status', 'No remaining amount to pay.');
        }
        if($request->amount > $loan->remaining_amount){
            $return_amount = $request->amount - $loan->remaining_amount;
            $loan->remaining_amount = 0;
            $loan->save();

            return redirect()->back()->with('status', "Your payment exceeds the remainng amount, only $return_amount BGN was taken.");
        }else{
            $loan->remaining_amount = $loan->remaining_amount - intval($request->amount);
        }
        
        $loan->save();

        return redirect()->back()->with('status', 'Your payment was successful.');
    }
}
