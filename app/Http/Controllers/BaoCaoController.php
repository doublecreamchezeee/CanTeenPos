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
        $baoCao = BaoCao::latest()->paginate(1);
        // return view('PhieuNhap.index')->with($phieuNhap);
        return view('BaoCao.index')->with('baoCaos', $baoCao);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BaoCao $baoCao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BaoCao $baoCao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BaoCao $baoCao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BaoCao $baoCao)
    {
        //
    }
}
