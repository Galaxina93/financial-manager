<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Anfragebestätigung – Felix Machts</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header {
            width: 100%;
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-bottom: 2px solid #ddd;
        }

        .header img {
            height: 60px;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #9b3870;
        }

        .content {
            padding: 30px 40px;
        }

        h2 {
            color: #9b3870;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            vertical-align: top;
        }

        th {
            background-color: #f1f1f1;
        }

        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #9b3870;
            color: #f1f1f1;
            font-size: 10px;
            text-align: center;
            padding: 10px 20px;
        }

        .footer img {
            height: 20px;
            vertical-align: middle;
            margin-right: 8px;
        }

        .footer a {
            color: #f1f1f1;
            text-decoration: none;
            margin: 0 5px;
        }

        .footer p {
            margin: 4px 0;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <img src="{{ public_path('images/fmi/cropped-logo-felix.png') }}" alt="Felix Machts Logo">
    <h1>Felix Machts – Anfragebestätigung</h1>
</div>

<!-- Content -->
<div class="content">
    <p><strong>Name:</strong> {{ $data['vorname'] }} {{ $data['nachname'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Telefon:</strong> {{ $data['telefon'] ?? '–' }}</p>

    <h2>Gewählte Leistungen</h2>
    <table>
        <thead>
        <tr>
            <th>Leistung</th>
            <th>Details</th>
            <th style="text-align:right;">Kosten (€)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['services'] as $svc)
            <tr>
                <td>{{ $svc['name'] }}</td>
                <td>{!! nl2br(e($svc['summary'])) !!}</td>
                <td style="text-align:right;">{{ $svc['cost'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p class="total">Gesamtkosten: {{ $data['gesamt'] }} €</p>
</div>

<!-- Footer -->
<div class="footer">
    <p>
        <img src="{{ public_path('images/fmi/Logo_mtv.png') }}" alt="MTV Logo">
        Offizieller Partner des MTV Braunschweig
    </p>
    <p>
        Felix Machts · Heinrichstraße 12, 31224 Peine ·
        <a href="mailto:info@felix-machts.com">info@felix-machts.com</a> ·
        <a href="https://felix-machts.com">felix-machts.com</a>
    </p>
    <p>&copy; 2025 Felix Machts. Alle Rechte vorbehalten.</p>
</div>

</body>
</html>
