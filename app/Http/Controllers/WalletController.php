<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\EthereumService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class WalletController extends Controller
{
    protected $ethereumService;

    public function __construct(EthereumService $ethereumService)
    {
        $this->ethereumService = $ethereumService;
    }

    public function index()
    {
        $wallets = Wallet::with(['tokens', 'transactions' => function ($query) {
            $query->latest()->take(5);
        }])->get();

        return Inertia::render('Wallets/Index', [
            'wallets' => $wallets,
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
                'message' => session('message'),
            ],
        ]);
    }

    public function show(Wallet $wallet)
    {
        $wallet->load(['tokens', 'transactions' => function ($query) {
            $query->latest()->take(10);
        }]);

        return Inertia::render('Wallets/Show', [
            'wallet' => $wallet
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|size:42|unique:wallets,address',
            'name' => 'nullable|string|max:255',
        ]);

        // Get initial ETH balance
        $ethBalance = $this->ethereumService->getWalletBalance($validated['address']);

        $wallet = Wallet::create([
            'address' => $validated['address'],
            'name' => $validated['name'],
            'eth_balance' => $ethBalance,
            'last_checked_at' => now(),
        ]);

        return redirect()->route('wallets.show', $wallet)
            ->with('success', 'Wallet added successfully');
    }

    public function refresh(Wallet $wallet)
    {
        // Update ETH balance
        $ethBalance = $this->ethereumService->getWalletBalance($wallet->address);
        $wallet->update([
            'eth_balance' => $ethBalance,
            'last_checked_at' => now(),
        ]);

        // Update token balances
        foreach ($wallet->tokens as $token) {
            $tokenBalance = $this->ethereumService->getTokenBalance(
                $wallet->address,
                $token->contract_address
            );

            $wallet->tokens()->updateExistingPivot($token->id, [
                'balance' => $tokenBalance,
                'last_checked_at' => now(),
            ]);
        }

        // Fetch latest transactions
        $transactions = $this->ethereumService->getTransactions($wallet->address);
        if ($transactions['status'] === '1') {
            foreach ($transactions['result'] as $tx) {
                Transaction::updateOrCreate(
                    ['hash' => $tx['hash']],
                    [
                        'wallet_id' => $wallet->id,
                        'from_address' => $tx['from'],
                        'to_address' => $tx['to'],
                        'value' => $tx['value'] / pow(10, 18),
                        'block_number' => $tx['blockNumber'],
                        'transaction_date' => date('Y-m-d H:i:s', $tx['timeStamp']),
                        'status' => $tx['isError'] === '0' ? 'success' : 'failed',
                        'raw_data' => $tx,
                    ]
                );
            }
        }

        return back()->with('success', 'Wallet data refreshed successfully');
    }

    public function edit(Wallet $wallet)
    {
        return Inertia::render('Wallets/Edit', [
            'wallet' => $wallet
        ]);
    }

    public function update(Request $request, Wallet $wallet)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => [
                'required',
                'string',
                'max:42',
                'regex:/^0x[a-fA-F0-9]{40}$/',
                Rule::unique('wallets')->ignore($wallet->id)
            ],
        ]);

        $wallet->update($validated);

        return redirect()->route('wallets.index')
            ->with('success', 'Wallet reconfigured successfully');
    }
}
