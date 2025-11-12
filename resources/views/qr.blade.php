<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Scan to open Welcome</title>
    <style>
        body{font-family:sans-serif;display:flex;flex-direction:column;align-items:center;justify-content:center;height:100vh;margin:0}
        .card{padding:20px;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,0.08);text-align:center}
        .small{font-size:0.9rem;color:#666;margin-top:10px}
        .open-btn{margin-top:14px;padding:10px 18px;border-radius:8px;border:none;cursor:pointer}
    </style>
</head>
<body>
    <div class="card">
        <h2>Scan this QR to open the welcome page</h2>

        {{-- Server-side QR generation using Simple QrCode --}}
        <div style="margin:18px 0;">
            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->generate($targetUrl) !!}
        </div>

        <div class="small">Or open here on this device:</div>
        <a href="{{ $targetUrl }}"><button class="open-btn">Open Welcome Page</button></a>
        <div class="small" style="margin-top:12px">{{ $targetUrl }}</div>
    </div>
</body>
</html>
