@extends('layouts.admin')

@section('content')

    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-6">
            Daftar Withdraw Seller
        </h1>

        @if ($withdrawals->isEmpty())
            <div class="bg-gray-50 border rounded p-6 text-center text-gray-500">
                Tidak ada request withdraw.
            </div>
        @else
            <div class="bg-white border rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Seller</th>
                            <th class="p-3 text-center">Jumlah</th>
                            <th class="p-3 text-center">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($withdrawals as $withdraw)
                            <tr class="border-t">
                                <td class="p-3">
                                    {{ $withdraw->seller->name }}
                                </td>

                                <td class="p-3 text-center">
                                    Rp {{ number_format($withdraw->amount, 0, ',', '.') }}
                                </td>

                                <td class="p-3 text-center">
                                    {{ ucfirst($withdraw->status) }}
                                </td>

                                <td class="p-3 text-center">

                                    @if ($withdraw->status == 'pending')
                                        <form method="POST" action="{{ route('admin.withdraw.approve', $withdraw->id) }}">
                                            @csrf
                                            <button class="px-3 py-1 bg-green-600 text-white rounded text-xs">
                                                Approve
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>

@endsection
