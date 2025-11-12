<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrController extends Controller
{
    public function showQr()
    {
        // The URL the QR should point to (absolute)
        $targetUrl = route('welcome'); // e.g. https://example.com/welcome

        return view('qr', compact('targetUrl'));
    }

    public function welcome()
    {
        // your existing welcome logic or view
        return view('welcome'); // resources/views/welcome.blade.php
    }
}
