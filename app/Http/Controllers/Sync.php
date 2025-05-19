<?php

namespace App\Http\Controllers;

use App\Models\Satker;
use App\Models\SirupPenyedia;
use App\Models\SirupSwakelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Sync extends Controller
{
    public function syncpenyedia(Request $request)
    {
        $kd_klpd = "D349";
        $tahun = $request->tahun ?? now()->year;
        $url = env('API_SIRUP_PENYEDIA') . $tahun . ':' . $kd_klpd;
        $response = Http::get($url);
        $data = $response->json();

        $batchSize = 100;

        DB::transaction(function () use ($data, $batchSize) {
            foreach (array_chunk($data, $batchSize) as $batch) {
                foreach ($batch as $item) {
                    $filtered = collect($item)->only((new \App\Models\SirupPenyedia())->getFillable())->toArray();
                    \App\Models\SirupPenyedia::updateOrCreate(
                        ['kd_rup' => $item['kd_rup']],
                        $filtered
                    );
                }
            }
        });

        return redirect()->back()->with('success', 'Sinkronisasi Penyedia berhasil!');
    }


    public function syncswakelola(Request $request)
    {
        $kd_klpd = "D349";
        $tahun = $request->tahun ?? now()->year;
        $url = env('API_SIRUP_SWAKELOLA') . $tahun . ':' . $kd_klpd;
        $response = Http::get($url);
        $data = $response->json();

        $batchSize = 100;

        DB::transaction(function () use ($data, $batchSize) {
            foreach (array_chunk($data, $batchSize) as $batch) {
                foreach ($batch as $item) {
                    $filtered = collect($item)->only((new \App\Models\SirupSwakelola())->getFillable())->toArray();
                    \App\Models\SirupSwakelola::updateOrCreate(
                        ['kd_rup' => $item['kd_rup']],
                        $filtered
                    );
                }
            }
        });

        return redirect()->back()->with('success', 'Sinkronisasi Swakelola berhasil!');
    }

    public function syncsatker(Request $request)
    {
        $kd_klpd = "D349";
        $tahun = $request->tahun ?? now()->year;
        $url = env('API_SIRUP_MASTER_SATKER') . $kd_klpd . ':' . $tahun;
        $response = Http::get($url);
        $data = $response->json();

        $batchSize = 100;

        DB::transaction(function () use ($data, $batchSize) {
            foreach (array_chunk($data, $batchSize) as $batch) {
                foreach ($batch as $item) {
                    $filtered = collect($item)->only((new \App\Models\Satker())->getFillable())->toArray();
                    \App\Models\Satker::updateOrCreate(
                        ['kd_rup' => $item['kd_rup']],
                        $filtered
                    );
                }
            }
        });

        return redirect()->back()->with('success', 'Sinkronisasi Satker Berhasil!');
    }
}
