<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">

        <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    {{ __('Trang chủ') }}
                </p>
            </a>
        </li>

        @if (auth()->user()->role == 'admin')
            <!-- Hiển thị tất cả menu cho Admin -->
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Nhân viên') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                        {{ __('Món ăn') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('receipts.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-receipt"></i>
                    <p>
                        {{ __('Hóa đơn') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('BaoCao.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                        {{ __('Báo cáo') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('PhieuNhap.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        {{ __('Phiếu nhập') }}
                    </p>
                </a>
            </li>
        @elseif (auth()->user()->role == 'nhanvien')
            <!-- Hiển thị Menu và Món ăn cho Nhân viên -->
            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                        {{ __('Món ăn') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('receipts.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-receipt"></i>
                    <p>
                        {{ __('Hóa đơn') }}
                    </p>
                </a>
            </li>
        @elseif (auth()->user()->role == 'thungan')
            <!-- Hiển thị Báo cáo và Hóa đơn cho Thu Ngân -->
            <li class="nav-item">
                <a href="{{ route('receipts.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-receipt"></i>
                    <p>
                        {{ __('Hóa đơn') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('BaoCao.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        {{ __('Báo cáo') }}
                    </p>
                </a>
            </li>
        @endif

        <!-- Các mục menu chung -->
        <li class="nav-item">
            <a href="{{ route('about') }}" class="nav-link">
                <i class="nav-icon far fa-address-card"></i>
                <p>
                    {{ __('Về chúng tôi') }}
                </p>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle nav-icon"></i>
                <p>
                    Menu
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Menu nhỏ</p>
                    </a>
                </li>
            </ul>
        </li> --}}

        <!-- Đăng xuất -->
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    {{ __('Đăng xuất') }}
                </p>
                <form action="{{route('logout')}}" method="POST" id="logout-form">@csrf</form>
            </a>
        </

</div>
<!-- /.sidebar -->