<?php

namespace App\Http\Controllers;
use App\Models\Models\DetailReceipt; // Import model DetailReceipt
use App\Models\Models\BaoCao; // Import model DetailReceipt
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Sử dụng model DetailReceipt và DB facade
        $bestProducts = DetailReceipt::join('products', 'products.id', '=', 'detail_receipts.product_id')
        ->select('products.id as product_id', 'products.price','products.name', DB::raw('SUM(detail_receipts.quantity) as total_quantity'))
        ->groupBy('products.id', 'products.price','products.name')
        ->orderByDesc('total_quantity')
        ->take(5)
        ->get();

        // Tính tổng số lượng đã bán (totalSold)
        $totalSold = DetailReceipt::sum('quantity');

        // // Doanh thu tháng này
        // $revenueThisMonth = BaoCao::where('type', 'bc_thang')
        //     ->whereMonth('created_at', Carbon::now()->month)
        //     ->value('TongDoanhThu');

        // // Doanh thu tháng trước
        // $revenueLastMonth = BaoCao::where('type', 'bc_thang')
        //     ->whereMonth('created_at', Carbon::now()->subMonth()->month)
        //     ->value('TongDoanhThu');

        // // Doanh thu hôm nay
        // $revenueToday = BaoCao::where('type', 'bc_ngay')
        //     ->whereDate('created_at', Carbon::today())
        //     ->value('TongDoanhThu');

        // // Doanh thu hôm qua
        // $revenueYesterday = BaoCao::where('type', 'bc_ngay')
        //     ->whereDate('created_at', Carbon::yesterday())
        //     ->value('TongDoanhThu');

        return view('home', compact('bestProducts', 'totalSold'));
    }
}
