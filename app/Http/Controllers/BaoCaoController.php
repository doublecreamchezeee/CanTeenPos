<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Models\BaoCao;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BaoCaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baoCaos = BaoCao::latest()->paginate(10);
        return view('BaoCao.index', compact('baoCaos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('BaoCao.create');
    }

    private function updateTongDoanhThuNgay(BaoCao $baoCao){
        $ngayLap = $baoCao->ThoiGianLap;

        // Group by và sum theo ngày
        $tongDoanhThuNgay = DB::table('receipts')
        ->whereRaw('DATE(created_at) = DATE(?)', [$ngayLap])
        ->sum('total_cost');
    
        // Cập nhật cột trong bảng báo cáo
        $baoCao->update([
            'TongDoanhThu' => $tongDoanhThuNgay,
        ]);
    }

    private function updateTongDoanhThuThang(BaoCao $baoCao)
    {
        $ngayLap = Carbon::parse($baoCao->ThoiGianLap);

        // Group by và sum theo tháng
        $tongDoanhThuThang = DB::table('receipts')
            ->whereYear('created_at', $ngayLap->year)
            ->whereMonth('created_at', $ngayLap->month)
            ->sum('total_cost');

        // Cập nhật cột trong bảng báo cáo
        $baoCao->update([
            'TongDoanhThu' => $tongDoanhThuThang,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'MaBaoCao' => 'required|numeric',
            'MaNV' => 'required|numeric',
            'ThoiGianLap' => 'nullable|date',
            'GiaiDoanBaoCao' => 'required',
            'TongDoanhThu' => 'nullable|int',
        ]);
        // dd($request);
        // $baocao = BaoCao::create($request->all());

        $baocao = new BaoCao;
        $baocao->MaNV = $validatedData['MaNV'];
        $baocao->MaBaoCao = $validatedData['MaBaoCao'];
        $baocao->ThoiGianLap = $validatedData['ThoiGianLap'];
        $baocao->GiaiDoanBaoCao = $validatedData['GiaiDoanBaoCao'];
        $baocao->TongDoanhThu = 0;

        $baocao->save();

        if ($baocao->GiaiDoanBaoCao == 'bc_ngay'){
            $this->updateTongDoanhThuNgay($baocao);
        }

        if ($request->GiaiDoanBaoCao == 'bc_thang'){
            $this->updateTongDoanhThuThang($baocao);
        }



        return redirect()->route('BaoCao.index')->with('success', 'Báo cáo đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BaoCao $baoCao)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BaoCao $baoCao)
    {
        return view('BaoCao.edit', compact('baoCao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BaoCao $baoCao)
    {
        $request->validate([
            'MaBaoCao' => 'required|numeric',
            'MaNV' => 'required|numeric',
            'ThoiGianLap' => 'nullable|date',
            'GiaiDoanBaoCao' => 'required|string',
            'TongDoanhThu' => 'required|int',
        ]);

        // $baoCao->update($request->all());


        return redirect()->route('BaoCao.index')->with('success', 'Báo cáo đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BaoCao $baoCao)
    {
        $baoCao->delete();

        return redirect()->route('BaoCao.index')->with('success', 'Báo cáo đã được xóa thành công.');
    }
}
