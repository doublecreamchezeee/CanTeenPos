<?php

namespace App\Http\Controllers;

use App\Models\Models\PhieuNhap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Product;
class PhieuNhapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $phieuNhap = PhieuNhap::latest()->paginate(10);
        // return view('PhieuNhap.index')->with($phieuNhap);
        return view('PhieuNhap.index')->with('phieuNhaps', $phieuNhap);
    }

    /**
     * Show the form for creating a new resource. 
     */
    public function create()
    {
        return view('PhieuNhap.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'MaNV' => 'required',
            'MaSp' => 'required',
            'MaPhieu' => 'required',
            'Dongia' => 'required',
            'Ngaylap' => 'required',
            'SoLuong' => 'required'
            // Thêm các quy tắc xác thực khác tại đây
        ]);
    
        $phieuNhap = new PhieuNhap;
        $phieuNhap->MaNV = $validatedData['MaNV'];
        $phieuNhap->MaSp = $validatedData['MaSp'];
        $phieuNhap->MaPhieu = $validatedData['MaPhieu'];
        $phieuNhap->Dongia = $validatedData['Dongia'];
        $phieuNhap->Ngaylap = $validatedData['Ngaylap'];
        $phieuNhap->SoLuong = $validatedData['SoLuong'];


        // Gán giá trị cho các thuộc tính khác của $phieunhap tại đây
    
        $phieuNhap->save();


        $product = Product::find($validatedData['MaSp']);
        // Cập nhật số lượng sản phẩm
        $product->quantity += $validatedData['SoLuong'];

        // Lưu sản phẩm
        $product->save();
    
        return redirect()->route('PhieuNhap.index')->with('success', 'Phiếu Nhập đã được tạo thành công!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $phieuNhap = PhieuNhap::find($id);
        return view('PhieuNhap.show', compact('phieuNhap'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
            // Tìm phiếu nhập bằng ID
        $phieuNhap = PhieuNhap::find($id);

        // Kiểm tra xem phiếu nhập có tồn tại không
        if ($phieuNhap) {
            // Xóa phiếu nhập
            $phieuNhap->delete();

            // Chuyển hướng người dùng về trang danh sách với thông báo thành công
            return redirect()->route('PhieuNhap.index')->with('success', 'Phiếu nhập đã được xóa thành công.');
        } else {
            // Chuyển hướng người dùng về trang danh sách với thông báo lỗi
            return redirect()->route('PhieuNhap.index')->with('error', 'Không tìm thấy phiếu nhập.');
        }
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'MaNV' => 'required',
            'MaSp' => 'required',
            'MaPhieu' => 'required',
            'Dongia' => 'required',
            'Ngaylap' => 'required'
        ]);
    
        $phieuNhap = PhieuNhap::find($id);
        $phieuNhap->update($validatedData);
    
        return redirect()->route('PhieuNhap.index')->with('success', 'Phiếu Nhập đã được cập nhật thành công!');
    }
        /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $phieuNhap = PhieuNhap::find($id);
        return view('PhieuNhap.edit', compact('phieuNhap'));
    }

}
