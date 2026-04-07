<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Event SMKN 1 Purwokerto</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; }
        h2 { text-align: center; margin-bottom: 5px; }
        p.subtitle { text-align: center; color: #666; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #2E86AB; color: white; padding: 6px 8px; text-align: left; }
        td { padding: 5px 8px; border-bottom: 1px solid #eee; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 20px; font-size: 10px; color: #888; text-align: right; }
    </style>
</head>
<body>
    <h2>LAPORAN EVENT SMKN 1 PURWOKERTO</h2>
    <p class="subtitle">Periode: {{ $periode }} | Total: {{ $events->count() }} Event</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Judul Event</th>
                <th>Kategori</th>
                <th>Ruangan</th>
                <th>Pengaju</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $i => $event)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->category->name ?? '-' }}</td>
                <td>{{ $event->room->name ?? '-' }}</td>
                <td>{{ $event->requester->name }}</td>
                <td>{{ $event->start_datetime->format('d/m/Y H:i') }}</td>
                <td>{{ $event->end_datetime->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh: {{ auth()->user()->name }} | {{ now()->format('d/m/Y H:i') }} WIB
    </div>
</body>
</html>