<?php

namespace App\Http\Controllers;

use App\Models\Models\PhieuNhap;
use Illuminate\Http\Request;

class PhieuNhapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $phieuNhap = PhieuNhap::latest()->paginate(1);
        // return view('PhieuNhap.index')->with($phieuNhap);
        return view('PhieuNhap.index')->with('phieuNhaps', $phieuNhap);
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
    public function show(PhieuNhap $phieuNhap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhieuNhap $phieuNhap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PhieuNhap $phieuNhap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhieuNhap $phieuNhap)
    {
        //
    }
}
