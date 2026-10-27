<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $menuUnggulan = Menu::where('tersedia', true)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_menu', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->where(function ($query) {
                $query->where('unggulan', true);
            })
            ->take(3)
            ->get();

        // Jika tidak ada menu unggulan, ambil menu terbaru
        if ($menuUnggulan->isEmpty()) {
            $menuUnggulan = Menu::where('tersedia', true)
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('nama_menu', 'like', "%{$search}%")
                            ->orWhere('deskripsi', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->take(3)
                ->get();
        }

        return view('home', compact('menuUnggulan'));
    }
}
