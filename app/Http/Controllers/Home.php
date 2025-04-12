<?php

namespace App\Http\Controllers;

use App\Models\SirupPenyedia;
use App\Models\SirupSwakelola;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenyediaExport;


class Home extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function penyedia(Request $request)
    {
        // Mengambil data tahun anggaran yang unik
        $tahun_options = SirupPenyedia::select('tahun_anggaran')->distinct()->get();

        // Mengambil data OPD yang unik
        $opd_options = SirupPenyedia::select('nama_satker')->distinct()->get();

        $query = SirupPenyedia::query();

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->where('tahun_anggaran', $request->tahun);
        }

        // Filter berdasarkan OPD / Satker
        if ($request->filled('opd')) {
            $query->where('nama_satker', 'like', '%' . $request->opd . '%');
        }

        // Filter berdasarkan nama paket atau kode RUP
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_paket', 'like', '%' . $request->search . '%')
                    ->orWhere('kd_rup', 'like', '%' . $request->search . '%');
            });
        }

        // Mengambil data dengan pagination
        $data = [
            'siruppenyedia' => $query->paginate(10)->withQueryString(),
            'tahun_options' => $tahun_options,  // Mengirimkan data tahun
            'opd_options' => $opd_options,      // Mengirimkan data OPD
        ];

        return view('penyedia', $data);
    }

    public function swakelola(Request $request)
    {
        $query = SirupSwakelola::query();
        
        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->where('tahun_anggaran', $request->tahun);
        }

        // Filter berdasarkan OPD / Satker
        if ($request->filled('opd')) {
            $query->where('nama_satker', 'like', '%' . $request->opd . '%');
        }

        // Search berdasarkan nama paket atau kode RUP
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_paket', 'like', '%' . $request->search . '%')
                    ->orWhere('kd_rup', 'like', '%' . $request->search . '%');
            });
        }

        $data = [
            'sirupswakelola' => $query->paginate(10),
        ];

        return view('swakelola', $data);
    }

    public function penyediaExport(Request $request)
    {
        return Excel::download(new PenyediaExport($request), 'data-penyedia.xlsx');
    }
    
    
}
