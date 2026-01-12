<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShortUrl;

class DashboardController extends Controller
{
    public function index()
    {
        $uid = Auth::id();

        $urls = ShortUrl::where('user_id', $uid)->latest()->paginate(20);

        return view('dashboard', compact('urls'));
    }
}
