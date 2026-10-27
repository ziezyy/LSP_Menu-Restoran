@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<div class="hero-elegant text-center text-white rounded-4 p-5 mb-5">
    <p class="text-uppercase small mb-2" style="letter-spacing: 3px; color: var(--resto-gold-light);">Selamat Datang di</p>
    <h1 class="display-4 mb-2" style="color: var(--resto-gold-light);">Restoran Burger FJ</h1>
    <p class="lead mb-4">Nikmati Pengalaman Bersantap yang Istimewa</p>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            @guest
            <a href="{{ route('login') }}" class="btn btn-lg"
                style="background: var(--resto-gold-light); color: var(--resto-dark);">
                Lihat Menu
            </a>
            @else
            @if(auth()->user()->role == 'admin')
            <a href="{{ route('admin.menu.index') }}" class="btn btn-lg"
                style="background: var(--resto-gold-light); color: var(--resto-dark);">
                Lihat Menu
            </a>
            @elseif(auth()->user()->status == 'accepted')
            <a href="{{ route('pelanggan.menu.index') }}" class="btn btn-lg"
                style="background: var(--resto-gold-light); color: var(--resto-dark);">
                Lihat Menu
            </a>
            @else
            <a href="{{ route('pelanggan.status-akun') }}" class="btn btn-lg"
                style="background: var(--resto-gold-light); color: var(--resto-dark);">
                Lihat Menu
            </a>
            @endif
            @endguest
        </div>
    </div>
</div>

@php
if (auth()->guest()) {
$linkMenu = route('login');
} elseif (auth()->user()->role === 'admin') {
$linkMenu = route('admin.menu.index');
} elseif (auth()->user()->status === 'accepted') {
$linkMenu = route('pelanggan.menu.index');
} else {
$linkMenu = route('pelanggan.status-akun');
}
@endphp

<div class="text-center mb-4">
    <p class="text-uppercase small mb-1" style="letter-spacing: 2px; color: var(--resto-gold);">Menu Pilihan</p>
    <h2>Hidangan Spesial Kami</h2>
</div>

<div class="row justify-content-center mb-4">
    <div class="col-md-6">
        <form action="{{ route('home') }}" method="GET">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari menu favorit Anda..."
                    value="{{ request('search') }}">

                <button class="btn"
                    type="submit"
                    style="background: var(--resto-gold-light); color: var(--resto-dark);">
                    <i class="fas fa-search"></i> Cari
                </button>

                @if(request('search'))
                <a href="{{ route('home') }}"
                    class="btn btn-outline-secondary">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="row g-4 mb-5">
    @forelse ($menuUnggulan as $item)
    <div class="col-md-4">
        <div class="card shadow-sm h-100 text-center border-0" style="background: var(--resto-dark); color: #f7f2ea;">
            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/placeholder-menu.jpg') }}"
                class="card-img-top" style="height: 220px; object-fit: cover; border-bottom: 2px solid var(--resto-gold);"
                alt="{{ $item->nama_menu }}">
            <div class="card-body">
                <h5 class="card-title" style="color: var(--resto-gold-light);">{{ $item->nama_menu }}</h5>
                <p class="small text-white-50">{{ Str::limit($item->deskripsi, 60) }}</p>
                <p class="fw-bold fs-5 mb-3" style="color: var(--resto-gold-light);">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                <a href="{{ $linkMenu }}" class="btn btn-sm" style="background: var(--resto-gold-light); color: var(--resto-dark);">Pesan Sekarang</a>
            </div>
        </div>
    </div>
    @empty
    <p class="text-center text-muted">Menu belum tersedia saat ini.</p>
    @endforelse
</div>

<div class="row align-items-center bg-white rounded-4 shadow-sm p-4 mb-5">
    <div class="col-md-6">
        <p class="text-uppercase small mb-1" style="color: var(--resto-gold);">Cerita Kami</p>
        <h3 class="mb-3">Cita Rasa Autentik, Disajikan dengan Elegan</h3>
        <p class="text-muted">Kami menghadirkan pengalaman bersantap terbaik dengan bahan-bahan pilihan dan resep yang diracik penuh cinta oleh para chef berpengalaman kami.</p>
    </div>
    <div class="col-md-6 text-center">
        <img src="{{ asset('images/hero-bg.jpg') }}" class="img-fluid rounded-4" alt="Suasana Restoran" style="max-height: 350px; object-fit: cover;">
    </div>
</div>
@endsection