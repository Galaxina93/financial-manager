<h2>Vielen Dank für Ihre Kalkulationsanfrage!</h2>

<p>Hallo {{ $data['vorname'] }} {{ $data['nachname'] }},</p>

<p>wir haben Ihre Anfrage erhalten und bearbeiten diese schnellstmöglich. Hier eine Zusammenfassung Ihrer Anfrage:</p>

<h3>Ihre Angaben:</h3>
<ul>
    <li><strong>Name:</strong> {{ $data['vorname'] }} {{ $data['nachname'] }}</li>
    <li><strong>E-Mail:</strong> {{ $data['email'] }}</li>
    <li><strong>Telefon:</strong> {{ $data['telefon'] ?? '–' }}</li>
</ul>

<h3>Gewählte Leistungen:</h3>
<ul>
    @foreach($data['services'] as $service)
        <li>
            <strong>{{ $service['name'] }}</strong><br>
            {!! nl2br(e($service['summary'])) !!}<br>
            <em>Formel:</em> {{ $service['formel'] }}<br>
            <strong>Kosten:</strong> {{ $service['cost'] }} €
        </li>
    @endforeach
</ul>

<h3>Gesamtkosten: {{ $data['gesamt'] }} €</h3>

<p>Für Rückfragen stehen wir Ihnen gerne jederzeit zur Verfügung.</p>

<p>Mit freundlichen Grüßen<br>Ihr Team von {{ config('app.name') }}</p>
