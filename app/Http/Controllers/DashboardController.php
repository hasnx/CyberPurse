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
        $wallets = Wallet::with([
            'transactions' => function ($query) {
                $query->latest()->take(5);
            },
            'tokens'
        ])->get();

        $totalBalance = $wallets->sum('eth_balance');

        $recentTransactions = Transaction::with('wallet')
            ->latest()
            ->take(5)
            ->get();

        // Debug information
        \Log::info('Wallets:', ['count' => $wallets->count(), 'wallets' => $wallets->toArray()]);
        \Log::info('Recent Transactions:', ['count' => $recentTransactions->count()]);

        return Inertia::render('Dashboard', [
            'wallets' => $wallets,
            'totalBalance' => $totalBalance,
            'recentTransactions' => $recentTransactions,
        ]);
    }
}
