<?php

namespace App\Http\Controllers\Seller;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{
    public function store(Request $request)
    {
        $seller = $request->user();
        $amount = $request->amount;

        if ($amount <= 0) {
            return back()->with('error', 'Jumlah tidak valid');
        }

        if ($amount > $seller->wallet->balance) {
            return back()->with('error', 'Saldo tidak cukup');
        }

        Withdrawal::create([
            'seller_id' => $seller->id,
            'amount' => $amount,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Pengajuan withdraw berhasil');
    }
}
