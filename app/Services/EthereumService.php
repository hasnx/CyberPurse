<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Token;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class EthereumService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.etherscan.key');
        $this->baseUrl = 'https://api.etherscan.io/api';
    }

    public function getWalletBalance(string $address): float
    {
        $response = Http::get($this->baseUrl, [
            'module' => 'account',
            'action' => 'balance',
            'address' => $address,
            'tag' => 'latest',
            'apikey' => $this->apiKey,
        ]);

        $data = $response->json();

        if ($data['status'] === '1') {
            // Convert from Wei to ETH (18 decimals)
            return $data['result'] / pow(10, 18);
        }

        return 0;
    }

    public function getTokenBalance(string $walletAddress, string $tokenAddress): float
    {
        $response = Http::get($this->baseUrl, [
            'module' => 'account',
            'action' => 'tokenbalance',
            'contractaddress' => $tokenAddress,
            'address' => $walletAddress,
            'tag' => 'latest',
            'apikey' => $this->apiKey,
        ]);

        $data = $response->json();

        if ($data['status'] === '1') {
            $token = Token::where('contract_address', $tokenAddress)->first();
            return $data['result'] / pow(10, $token->decimals);
        }

        return 0;
    }

    public function getTransactions(string $address, int $page = 1, int $offset = 10)
    {
        $response = Http::get($this->baseUrl, [
            'module' => 'account',
            'action' => 'txlist',
            'address' => $address,
            'startblock' => 0,
            'endblock' => 99999999,
            'page' => $page,
            'offset' => $offset,
            'sort' => 'desc',
            'apikey' => $this->apiKey,
        ]);

        return $response->json();
    }
}
