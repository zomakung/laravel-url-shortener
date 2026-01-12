<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.overview', [
            'total_users' => User::count(),
            'total_urls'  => ShortUrl::count(),
            'total_clicks' => ShortUrl::sum('clicks'),
            'today_urls'  => ShortUrl::whereDate('created_at', now())->count(),
        ]);
    }

    public function urls()
    {
        $urls = ShortUrl::with('user')->latest()->paginate(20);

        return view('admin.urls', compact('urls'));
    }

    public function destroy_urls(ShortUrl $shortUrl)
    {
        $shortUrl->delete();

        return redirect()->route('admin.urls')->with('success', 'URL deleted successfully.');
    }

    public function users()
    {
        $users = User::withCount('shortUrls')->latest()->paginate(20);

        return view('admin.users', compact('users'));
    }
}
