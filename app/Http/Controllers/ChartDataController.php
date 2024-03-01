<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChartDataController extends Controller
{
    public function getIuranData(Request $request)
    {
        $timeframe = $request->query('timeframe');
        $lastDateTime = Angsuran::max('tgl_angsuran');
        $endDate = Carbon::parse($lastDateTime);
        // Retrieve data based on the selected timeframe
        switch ($timeframe) {
            case '1y':
                // Use the last datetime as the end date
                // $startDate = Carbon::now()->subYear();
                // $endDate = Carbon::now();
                $startDate = $endDate->copy()->subYear();
                $data = Angsuran::selectRaw('MONTH(tgl_angsuran) as month, SUM(iuran) as total_iuran')
                                ->whereBetween('tgl_angsuran', [$startDate, $endDate])
                                ->groupByRaw('MONTH(tgl_angsuran)')
                                ->get();
                $data['name'] = '1 Tahun';
                $dataArray = $data->toArray();
                break;
            case '3m':
                // $startDate = Carbon::now()->subMonths(3);
                // $endDate = Carbon::now();
                $startDate = $endDate->copy()->subMonths(3);
                $data = Angsuran::selectRaw('MONTH(tgl_angsuran) as month, SUM(iuran) as total_iuran')
                                ->whereBetween('tgl_angsuran', [$startDate, $endDate])
                                ->groupByRaw('MONTH(tgl_angsuran)')
                                ->get();
                $data['name'] = '3 Bulan';
                $dataArray = $data->toArray();
                break;
            case '6m':
                // $startDate = Carbon::now()->subMonths(6);
                // $endDate = Carbon::now();
                $startDate = $endDate->copy()->subMonths(6);
                $data = Angsuran::selectRaw('MONTH(tgl_angsuran) as month, SUM(iuran) as total_iuran')
                                ->whereBetween('tgl_angsuran', [$startDate, $endDate])
                                ->groupByRaw('MONTH(tgl_angsuran)')
                                ->get();
                $data['name'] = '6 Bulan';
                $dataArray = $data->toArray();
                break;
            default:
                // $startDate = Carbon::now()->subMonths(3);
                // $endDate = Carbon::now();
                $startDate = $endDate->copy()->subMonths(3);
                $data = Angsuran::selectRaw('MONTH(tgl_angsuran) as month, SUM(iuran) as total_iuran')
                                ->whereBetween('tgl_angsuran', [$startDate, $endDate])
                                ->groupByRaw('MONTH(tgl_angsuran)')
                                ->get();
                $data['name'] = '3 Bulan';
                $dataArray = $data->toArray();
                break;
        }

        return response()->json($dataArray);
    }
    public function getIuranDataRange(Request $request)
    {
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');

        // Default values if start date and end date are not provided
        if (!$startDate || !$endDate) {
            $endDate = Carbon::now();
            $startDate = Carbon::now()->subMonths(3);
        } else {
            // Convert start and end date strings to Carbon instances
            $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
            $endDate = Carbon::createFromFormat('Y-m-d', $endDate);
        }

        $data = Angsuran::selectRaw('MONTH(tgl_angsuran) as month, SUM(iuran) as total_iuran')
                        ->whereBetween('tgl_angsuran', [$startDate, $endDate])
                        ->groupByRaw('MONTH(tgl_angsuran)')
                        ->get();

        $dataArray = $data->toArray();

        return response()->json($dataArray);
    }
}
