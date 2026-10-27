@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<h3 class="mb-4">Pesanan Saya</h3>

@forelse ($pesanan as $item)
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h6 class="mb-1">Pesanan {{ $item->id }}</h6>
                <p class="small text-muted mb-2">{{ $item->created_at->translatedFormat('d M Y, H:i') }}</p>
            </div>
            <span class="badge bg-{{ $item->status === 'diterima' ? 'success' : ($item->status === 'ditolak' ? 'danger' : ($item->status === 'selesai' ? 'secondary' : 'warning')) }}">
                {{ ucfirst($item->status) }}
            </span>
        </div>

        <ul class="mb-2 ps-3 small">
            @foreach ($item->items as $detail)
            <li>{{ $detail->menu->nama_menu }} x{{ $detail->jumlah }} — Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</li>
            @endforeach
        </ul>

        <p class="fw-bold mb-2">Total: Rp {{ number_format($item->total_harga, 0, ',', '.') }}</p>

        @if ($item->status === 'ditolak' && $item->catatan)
        <p class="small text-danger mb-2">Alasan ditolak: {{ $item->catatan }}</p>
        @endif

        @if ($item->status === 'diterima' && ! $item->payment)
        <a href="{{ route('pelanggan.pembayaran.create', $item) }}" class="btn btn-sm btn-primary">Upload Bukti Bayar</a>
        @elseif ($item->payment)
        <span class="badge bg-{{ $item->payment->status === 'diterima' ? 'success' : ($item->payment->status === 'ditolak' ? 'danger' : 'warning') }}">
            Pembayaran: {{ ucfirst($item->payment->status) }}
        </span>
        @endif
    </div>
</div>
@empty
<p class="text-muted">Anda belum memiliki pesanan. <a href="{{ route('pelanggan.menu.index') }}">Pesan sekarang</a>.</p>
@endforelse

{{ $pesanan->links() }}
@endsection