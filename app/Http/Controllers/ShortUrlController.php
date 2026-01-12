<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use App\Helpers\Base62;

class ShortUrlController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        $shortCode = Base62::encode(time() . rand(100, 999));

        $shortUrl = ShortUrl::create([
            'user_id' => auth()->id(),
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
            'clicks' => 0,
        ]);

        return back()->with('short_url', url($shortUrl->short_code));
    }

    public function redirect(string $shortCode)
    {
        $shortUrl = ShortUrl::where('short_code', $shortCode)->firstOrFail();
        $shortUrl->increment('clicks');

        return redirect()->away($shortUrl->original_url);
    }
}
