<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Employee');
    }

    // List all customers
    public function customers()
    {
        $customers = User::where('role', 'Customer')->get();
        return view('employees.customers', compact('customers'));
    }

    // Add credit to a customer
    public function addCredit(Request $request, User $user)
    {
        $request->validate([
            'credit' => 'required|numeric|min:0',
        ]);

        if ($user->role !== 'Customer') {
            return redirect()->back()->with('error', 'Can only add credit to customers.');
        }

        $user->credit += $request->credit;
        $user->save();

        return redirect()->route('employees.customers')->with('success', 'Credit added successfully.');
    }
}