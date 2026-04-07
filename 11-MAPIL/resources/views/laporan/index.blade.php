@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">📊 Laporan & Statistik Event</h1>

    <!-- Filter -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                <select name="month" class="border rounded px-3 py-2 text-sm">
                    <option value="">Semua</option>
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create(null, $m)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <select name="year" class="border rounded px-3 py-2 text-sm">
                    @for($y = now()->year; $y >= now()->year - 3; $y--)
                        <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" class="border rounded px-3 py-2 text-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                Filter
            </button>
            <a href="{{ route('report.pdf', request()->all()) }}"
               class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">
                ⬇ Export PDF
            </a>
            <a href="{{ route('report.excel', request()->all()) }}"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                ⬇ Export Excel
            </a>
        </form>
    </div>

    <!-- Rekap per Kategori -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <h2 class="font-semibold mb-3">Rekap per Kategori</h2>
        <div class="flex flex-wrap gap-3">
            @foreach($rekap as $cat)
            <div class="border rounded px-4 py-2 text-center text-sm">
                <div class="font-bold text-lg">{{ $cat->total }}</div>
                <div class="text-gray-500">{{ $cat->name }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Tabel Event -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Judul Event</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Ruangan</th>
                    <th class="px-4 py-3 text-left">Waktu</th>
                    <th class="px-4 py-3 text-left">Pengaju</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($events as $i => $event)
                <tr>
                    <td class="px-4 py-3">{{ $i + 1 }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('events.show', $event) }}"
                           class="text-blue-600 hover:underline">
                            {{ $event->title }}
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded text-white"
                              style="background-color: {{ $event->category->color ?? '#95A5A6' }}">
                            {{ $event->category->name ?? '-' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">{{ $event->room->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $event->start_datetime->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3">{{ $event->requester->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                        Tidak ada data event untuk filter ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection