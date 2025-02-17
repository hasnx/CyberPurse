<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $wallets = Wallet::with(['transactions' => function ($query) {
            $query->latest()->take(5);
        }])->get();

        $totalBalance = $wallets->sum('eth_balance');

        $recentTransactions = Transaction::with('wallet')
            ->latest()
            ->take(10)
            ->get();

        return Inertia::render('Dashboard', [
            'wallets' => $wallets,
            'totalBalance' => $totalBalance,
            'recentTransactions' => $recentTransactions,
        ]);
    }
}
