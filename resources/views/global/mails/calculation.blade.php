<h2>Neue Kalkulationsanfrage</h2>

<p><strong>Name:</strong> {{ $data['vorname'] }} {{ $data['nachname'] }}</p>
<p><strong>E-Mail:</strong> {{ $data['email'] }}</p>
<p><strong>Telefon:</strong> {{ $data['telefon'] }}</p>

<h3>Leistungen:</h3>
<ul>
    @foreach($data['services'] as $s)
        <li>
            {!! nl2br(e($s['summary'])) !!}<br>
            <em>Formel:</em> {{ $s['formel'] }}<br>
            <strong>Kosten:</strong> {{ $s['cost'] }} €
        </li>
    @endforeach
</ul>

<h3>Gesamtkosten: {{ $data['gesamt'] }} €</h3>
