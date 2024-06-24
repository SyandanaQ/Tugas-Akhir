<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ManajemenPenjualan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        $python = 'python';
        $script = realpath(base_path('scripts/arima_forecast.py'));

        // Escape jalur file dengan tanda kutip ganda
        $command = "$python \"$script\" \"$jsonFile\"";
        $result = shell_exec("$command 2>&1");

        // Debugging untuk hasil skrip Python
        Log::info('Command:', ['command' => $command]);
        Log::info('Result:', ['result' => $result]);

        // Parse hasil prediksi
        if ($result === null) {
            dd('Perintah tidak berhasil dijalankan.', $command, $result);
        } else {
            // Debugging untuk hasil skrip Python
            dd('Perintah berhasil dijalankan.', $command, $result);
        }

        $prediction = floatval($result);

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















