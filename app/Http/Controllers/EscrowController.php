<?php

namespace App\Http\Controllers;

use App\Models\Escrow;
use Illuminate\Http\Request;

use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

class EscrowController extends Controller
{
    public function createEscrow(Request $request)
{
    $buyer = $request->user();
    $sellerId = $request->seller_id;
    $amount = $request->amount;

    DB::transaction(function () use ($buyer, $sellerId, $amount) {

        //Kurangi saldo buyer
        $buyer->wallet->decrement('balance', $amount);

        WalletTransaction::create([
            'wallet_id' => $buyer->wallet->id,
            'type' => 'debit',
            'amount' => $amount,
            'description' => 'Pembayaran masuk escrow'
        ]);

        //Buat escrow (HOLD)
        Escrow::create([
            'buyer_id' => $buyer->id,
            'seller_id' => $sellerId,
            'amount' => $amount,
            'status' => 'pending'
        ]);
    });

    return response()->json(['message' => 'Dana berhasil ditahan di escrow']);
}


    public function approveEscrow($id, $request)
    {
        $admin = $request->user();
        $escrow = Escrow::findOrFail($id);

        if ($escrow->status !== 'pending') {
            abort(400, 'Escrow sudah diproses');
        }

        DB::transaction(function () use ($escrow, $admin) 
        {
            $sellerWallet = $escrow->seller->wallet;
            
            // Tambah saldo seller
            $sellerWallet->increment('balance',$escrow->amount);
            WalletTransaction::create([
                'wallet_id' => $sellerWallet->id,
                'seller_id' => 'debit',
                'amount' => $escrow->amount,
                'description' => 'Dana escrow di lepas ke seller'

            ]);

            // Update Escrow
            $escrow->update([
                'status' => 'approved',
                'admin_id' => $admin->id,
            ]);
        });
        return response()->json(['message' => 'Escrow approved']);
    }

    public function rejectEscrow($id,$request)
    {
        $admin = $request->user();
        $escrow = Escrow::findOrFail($id);

        DB::transaction(function () use ($escrow, $admin)
        {
            $buyerWallet = $escrow->buyer->wallet;

            // Refund ke buyer
            $buyerWallet->increment('balance', $escrow->amount);

            WalletTransaction::create([
                'wallet_id' => $buyerWallet->id,
                'type' => 'credit',
                'amount' => $escrow->amount,
                'desciprion' => 'Refund dari escrow'
            ]);

            // Update escrow
            $escrow->update([
                'status' => 'rejected',
                'admin_id' => $admin->id
            ]);
        });

        return response()->json(['message' => 'Escrow rejected & Refund']);
    }
}
