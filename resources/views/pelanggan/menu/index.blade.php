@extends('layouts.app')

@section('title', 'Menu Restoran')

@section('content')
<h3 class="mb-4">Menu Restoran</h3>

@if ($menu->isEmpty())
<p class="text-muted">Belum ada menu tersedia saat ini.</p>
@else
<form action="{{ route('pelanggan.pesanan.store') }}" method="POST">
    @csrf
    <form action="{{ route('pelanggan.menu.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama menu...">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
    
    <div class="row g-3 mt-3">
        @foreach ($menu as $item)
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/300x180?text=No+Image' }}"
                    class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{ $item->nama_menu }}">
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title mb-1">{{ $item->nama_menu }}</h6>
                    <p class="small text-muted mb-1">{{ $item->kategori ?? '-' }}</p>
                    <p class="small mb-2">{{ Str::limit($item->deskripsi, 60) }}</p>
                    <p class="fw-bold mb-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>

                    <input type="hidden" name="menu_id[]" value="{{ $item->id }}">
                    <div class="mt-auto">
                        <label class="form-label small">Jumlah</label>
                        <input type="number" name="jumlah[]" min="0" value="0" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary mt-4">Pesan Sekarang</button>
</form>
@endif
@endsection