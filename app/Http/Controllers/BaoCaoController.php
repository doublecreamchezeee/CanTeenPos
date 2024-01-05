<?php

namespace App\Http\Controllers;

use App\Models\Models\BaoCao;
use Illuminate\Http\Request;

class BaoCaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baoCaos = BaoCao::latest()->paginate(1);
        return view('BaoCao.index', compact('baoCaos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('BaoCao.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'MaNV' => 'required|numeric',
            'ThoiGianLap' => 'nullable|date',
            'GiaiDoanBaoCao' => 'required|string',
            'TongDoanhThu' => 'required|numeric',
        ]);

        BaoCao::create($request->all());

        return redirect()->route('baoCao.index')->with('success', 'Báo cáo đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $baoCao = BaoCao::findOrFail($id);
        return view('baoCao.show', compact('baoCao'));
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
            'MaNV' => 'required|numeric',
            'ThoiGianLap' => 'nullable|date',
            'GiaiDoanBaoCao' => 'required|string',
        ]);

        $baoCao->update($request->all());

        return redirect()->route('baoCao.index')->with('success', 'Báo cáo đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BaoCao $baoCao)
    {
        $baoCao->delete();

        return redirect()->route('baoCao.index')->with('success', 'Báo cáo đã được xóa thành công.');
    }
}
