<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Exception;

class WalletService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // Tambah Saldo
    public function credit(Wallet $wallet, float $amount, string $description = null, int $referenceId = null): void
    {
        DB::transaction(function () use ($wallet, $amount, $description, $referenceId) {
            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'credit',
                'amount' => $amount,
                'description' => $description,
                'reference_id' => $referenceId,
            ]);
            $wallet->increment('balance', $amount);
        });
    } 

    // Kurang Saldo
    public function debit(Wallet $wallet, float $amount, string $description = null, int $referenceId = null): void
    {
        if ($wallet->balance < $amount) {
            throw new Exception('Saldo Tidak Cukup');
        }

        DB::transaction(function() use ($wallet, $amount, $description, $referenceId) {
            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'debit',
                'amount' => $amount,
                'description' => $description,
                'reference_id' => $referenceId,
            ]);
            $wallet->decrement('balance', $amount);
        });
    }

    // Escrow
    public function hold(Wallet $wallet, float $amount, string $description = null, int $referenceId = null): void
    {
        if ($wallet->balance < $amount) {
        throw new Exception('Saldo tidak cukup untuk escrow');
        }
        DB::transaction(function () use ($wallet, $amount, $description, $referenceId) 
        {
            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'hold',
                'amount' => $amount,
                'description' => $description,
                'reference_id' => $referenceId,
            ]);
            // Saldo Buyer berkurang saat di hold
            $wallet->decrement('balance', $amount);
        });
    }

    // Escrow Cair
    public function release(Wallet $sellerWallet, float $amount, string $description = null, int $referenceId = null):void
    {
        DB::transaction(function () use ($sellerWallet, $amount, $description, $referenceId) 
        {
            WalletTransaction::create([
                'wallet_id' => $sellerWallet->id,
                'type' => 'release',
                'amount' => $amount,
                'description' => $description,
                'reference_id' => $referenceId,
            ]);

            $sellerWallet->increment('balance', $amount);
        });
    }

    }
