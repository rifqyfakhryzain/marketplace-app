<?php

namespace App\Http\Controllers\Admin;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{

    public function index()
    {
        $withdrawals = Withdrawal::with('seller')
            ->latest()
            ->get();

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function approve(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Sudah diproses');
        }

        DB::transaction(function () use ($withdrawal) {

            $wallet = $withdrawal->seller->wallet;

            $wallet->decrement('balance', $withdrawal->amount);

            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'debit',
                'amount' => $withdrawal->amount,
                'description' => 'Withdraw disetujui'
            ]);

            $withdrawal->update([
                'status' => 'approved',
                'admin_id' => Auth::id(),
            ]);
        });

        return back()->with('success', 'Withdraw approved');
    }
}
