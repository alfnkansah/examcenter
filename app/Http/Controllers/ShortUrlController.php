<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    public function store(Request $request)
    {
        $originalUrl = $request->input('url');
        $code = substr(md5($originalUrl . microtime()), 0, 6);

        $shortUrl = ShortUrl::create([
            'code' => $code,
            'original_url' => $originalUrl,
        ]);

        return response()->json(['short_url' => url($code)]);
    }
}
