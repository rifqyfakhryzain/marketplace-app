<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // LIST CHAT (buyer & seller)
    public function index()
    {
        $userId = Auth::id();

        $chats = Chat::where('buyer_id', $userId)
            ->orWhere('seller_id', $userId)
            ->with('barang')
            ->get();

        return view('chat.index', compact('chats'));
    }

    // START CHAT DARI HALAMAN BARANG (PRE-ORDER)
    public function start(Barang $barang)
    {
        $buyerId  = Auth::id();
        $sellerId = $barang->user_id;

        // cegah penjual chat ke barang sendiri
        abort_if($buyerId === $sellerId, 403);

        // opsional: hanya barang tersedia
        abort_if($barang->status !== 'tersedia', 403);

        $chat = Chat::firstOrCreate([
            'buyer_id'  => $buyerId,
            'seller_id' => $sellerId,
            'barang_id' => $barang->id,
        ]);

        return redirect()->route('chats.show', $chat);
    }

    // TAMPILKAN CHAT
    public function show(Chat $chat)
    {
        $this->authorizeChat($chat);

        return view('chat.show', [
            'chat'     => $chat,
            'messages' => $chat->messages()->with('sender')->get(),
        ]);
    }

    // KIRIM PESAN
    public function store(Request $request, Chat $chat)
    {
        $this->authorizeChat($chat);

        $request->validate([
            'message' => 'required|string',
        ]);

        $chat->messages()->create([
            'sender_id' => Auth::id(),
            'message'   => $request->message,
        ]);

        return back();
    }

    // AUTHORIZATION CHAT
    private function authorizeChat(Chat $chat): void
    {
        $userId = Auth::id();

        abort_if(
            $userId !== $chat->buyer_id &&
            $userId !== $chat->seller_id,
            403
        );
    }
}
