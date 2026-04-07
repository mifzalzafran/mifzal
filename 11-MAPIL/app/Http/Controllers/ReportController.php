<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Exports\EventsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $categories = EventCategory::all();

        $query = Event::with(['category', 'room', 'requester'])
            ->where('status', 'approved');

        if ($request->month && $request->year) {
            $query->whereMonth('start_datetime', $request->month)
                  ->whereYear('start_datetime', $request->year);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $events = $query->orderBy('start_datetime')->get();

        // Rekap per kategori
        $rekap = EventCategory::withCount([
            'events as total' => function ($q) use ($request) {
                $q->where('status', 'approved');
                if ($request->month && $request->year) {
                    $q->whereMonth('start_datetime', $request->month)
                      ->whereYear('start_datetime', $request->year);
                }
            }
        ])->get();

        return view('laporan.index', compact('events', 'categories', 'rekap'));
    }

    public function exportPdf(Request $request)
    {
        $query = Event::with(['category', 'room', 'requester'])
            ->where('status', 'approved');

        if ($request->month && $request->year) {
            $query->whereMonth('start_datetime', $request->month)
                  ->whereYear('start_datetime', $request->year);
        }

        $events   = $query->orderBy('start_datetime')->get();
        $periode  = ($request->month && $request->year)
            ? \Carbon\Carbon::createFromDate($request->year, $request->month, 1)->format('F Y')
            : 'Semua Periode';

        $pdf = Pdf::loadView('laporan.pdf', compact('events', 'periode'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download("laporan-event-smkn1-{$periode}.pdf");
    }

    public function exportExcel(Request $request)
    {
        $periode = ($request->month && $request->year)
            ? \Carbon\Carbon::createFromDate($request->year, $request->month, 1)->format('F_Y')
            : 'semua_periode';

        return Excel::download(
            new EventsExport($request->month, $request->year, $request->category_id),
            "laporan-event-smkn1-{$periode}.xlsx"
        );
    }
}