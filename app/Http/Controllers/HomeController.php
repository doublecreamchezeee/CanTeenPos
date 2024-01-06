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

        // Doanh thu gần nhất
        $revenue = BaoCao::where('GiaiDoanBaoCao', 'bc_ngay')
        ->orderBy('created_at', 'desc') // Assuming there's a 'created_at' column for timestamp
        ->first();
        
        return view('home', compact('bestProducts', 'totalSold','revenue'));
    }
}
