<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Tangkap input filter tunggal (Global Filter)
            $reqBulan = $request->input('bulan');
            $reqTahun = $request->input('tahun');

            // ==========================================
            // 1. BASE QUERY UNTUK KARTU STATUS & TABEL
            // ==========================================
            $countQuery = Pemesanan::query();
            $query = Pemesanan::with(['user', 'paket', 'jadwal']);

            // Jika filter di-apply, filter tabel dan kartu
            if ($reqBulan) {
                $query->whereMonth('tanggal_pesan', $reqBulan);
                $countQuery->whereMonth('tanggal_pesan', $reqBulan);
            }
            if ($reqTahun) {
                $query->whereYear('tanggal_pesan', $reqTahun);
                $countQuery->whereYear('tanggal_pesan', $reqTahun);
            }

            // Tampil semua secara default, paginate 10
            $pemesanan = $query->latest('tanggal_pesan')->paginate(10)->withQueryString();

            // ==========================================
            // 2. HITUNG JUMLAH STATUS (SUMMARY CARDS)
            // ==========================================
            $countPending = (clone $countQuery)->where('status_pemesanan', 'pending')->count();
            $countDiproses = (clone $countQuery)->where('status_pemesanan', 'diproses')->count();
            $countSelesai = (clone $countQuery)->where('status_pemesanan', 'selesai')->count();
            $countDibatalkan = (clone $countQuery)->where('status_pemesanan', 'dibatalkan')->count();

            // ==========================================
            // 3. LOGIKA GANTT CHART (DURASI PROJECT)
            // ==========================================
            // Gantt Chart wajib butuh bulan/tahun spesifik. Jika filter kosong, gunakan bulan ini.
            $ganttBulan = $reqBulan ?: date('m');
            $ganttTahun = $reqTahun ?: date('Y');

            $startOfMonth = Carbon::createFromDate($ganttTahun, $ganttBulan, 1)->startOfDay();
            $daysInMonth = $startOfMonth->daysInMonth;
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            // Cari project yang sedang aktif (jadwalnya bersinggungan dengan bulan chart)
            $activeProjects = Pemesanan::with(['user', 'paket', 'jadwal'])
                ->whereHas('jadwal', function ($q) use ($startOfMonth, $endOfMonth) {
                    $q->whereDate('tanggal_mulai', '<=', $endOfMonth)
                        ->whereDate('tanggal_selesai', '>=', $startOfMonth);
                })
                ->whereIn('status_pemesanan', ['diproses', 'selesai'])
                ->get();

            $ganttLabels = [];
            $ganttData = [];
            $ganttTooltips = [];

            foreach ($activeProjects as $project) {
                $ganttLabels[] = ($project->user->name ?? 'User') . ' (' . ($project->paket->nama_paket ?? 'Paket') . ')';

                $start = Carbon::parse($project->jadwal->tanggal_mulai);
                $end = Carbon::parse($project->jadwal->tanggal_selesai);

                $startDay = $start->lessThan($startOfMonth) ? 1 : (int) $start->format('d');
                $endDay = $end->greaterThan($endOfMonth) ? $daysInMonth : (int)$end->format('d');

                if ($startDay === $endDay) {
                    $endDay += 0.8;
                }

                $ganttData[] = [$startDay, $endDay];
                $ganttTooltips[] = $start->format('d M Y') . ' s/d ' . $end->format('d M Y');
            }

            return view('dashboard', compact(
                'pemesanan',
                'countPending',
                'countDiproses',
                'countSelesai',
                'countDibatalkan',
                'daysInMonth',
                'ganttLabels',
                'ganttData',
                'ganttTooltips',
                'ganttBulan',
                'ganttTahun'
            ));
        }

        // ==========================================
        // 4. LOGIKA PELANGGAN
        // ==========================================
        $pesananTerakhir = Pemesanan::with(['paket', 'jadwal'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        return view('pelanggan.dashboard', compact('pesananTerakhir'));
    }
}
