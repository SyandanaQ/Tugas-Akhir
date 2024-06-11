<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Controllers\Dashboard;
use OpenAdmin\Admin\Layout\Column;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Layout\Row;
use App\Models\ManajemenPenjualan;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        // Ambil data penjualan dari database (tanggal dan total)
        $salesData = ManajemenPenjualan::select('tanggal', 'total')
            ->orderBy('tanggal')
            ->get();

        // Ambil label (tanggal) dan data (total) untuk grafik
        $labels = $salesData->pluck('tanggal')->map(function($date) {
            return Carbon::parse($date)->format('F'); // Mengubah format menjadi nama bulan
        })->toArray();

        $data = $salesData->pluck('total')->toArray();

        return $content
            ->css_file(Admin::asset("open-admin/css/pages/dashboard.css"))
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) use ($labels, $data) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });

                // Menambahkan view grafik
                $row->column(12, function (Column $column) use ($labels, $data) {
                    $column->append(view('admin.charts.bar', compact('labels', 'data')));
                });
            });
    }
}
