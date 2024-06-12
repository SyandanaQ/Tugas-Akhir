<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManajemenPenjualan;
use Carbon\Carbon;

class ARIMAController extends Controller
{
    public function forecast()
    {
        // Ambil data penjualan dari database
        $salesData = ManajemenPenjualan::select('tanggal', 'total')
            ->orderBy('tanggal')
            ->get()
            ->toArray();

        // Tulis data ke file JSON sementara
        $jsonFile = base_path('scripts/temp_data.json');
        file_put_contents($jsonFile, json_encode($salesData));

        // Lokasi absolut dari eksekusi Python
        $python = 'python'; // Menggunakan 'python' karena 'python3' tidak ditemukan
        $script = realpath(base_path('scripts/arima_forecast.py'));

        // Jalankan skrip Python untuk prediksi
        $command = "$python $script $jsonFile";
        $result = shell_exec($command);

        // Debugging untuk hasil skrip Python
        // dd($command, $result);

        // Parse hasil prediksi
        $prediction = json_decode($result, true);

        // Jika hasil prediksi tidak ter-parse dengan benar, gunakan result sebagai fallback
        if (json_last_error() !== JSON_ERROR_NONE) {
            $prediction = $result;
        }

        // Data untuk grafik
        $labels = collect($salesData)->pluck('tanggal')->map(function($date) {
            return Carbon::parse($date)->format('F'); // Mengubah format menjadi nama bulan
        })->toArray();

        $data = collect($salesData)->pluck('total')->toArray();

        // Tambahkan prediksi ke grafik
        $labels[] = Carbon::now()->addMonth()->format('F');
        $data[] = $prediction;

        // Kirimkan data ke view
        return view('admin.charts.sales-chart', compact('labels', 'data'));
    }
}






