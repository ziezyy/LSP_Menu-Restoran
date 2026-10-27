<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::where('tersedia', true)->orderBy('kategori')->get();

        return view('pelanggan.menu.index', compact('menu'));
        
    }
    public function coba(Request $request)
    {
        $menu = Menu::where('tersedia', true)
            ->when($request->search, function ($query, $search) {
                $query->where('nama_menu', 'like', "%{$search}%");
            })
            ->orderBy('kategori')
            ->get();

        return view('pelanggan.menu.index', compact('menu'));
    }
}
