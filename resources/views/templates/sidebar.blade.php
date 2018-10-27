<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                    <span></span>
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-folder"></i>
                    <span class="title">Master</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ url('/master/kategori') }}" class="markbar nav-link">
                            <i class="icon-link"></i> Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/master/merk') }}" class="markbar nav-link">
                            <i class="icon-link"></i> Merk</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/master/satuan-barang') }}" class="markbar nav-link">
                            <i class="icon-link"></i> Satuan Barang</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/master/barang') }}" class="markbar nav-link"> <!--beras-->
                            <i class="icon-link"></i> Barang</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ url('/konsumen') }}" class="nav-link">
                    <i class="icon-folder"></i>
                    <span class="title"> Konsumen</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/suplier') }}" class="nav-link">
                    <i class="icon-folder"></i>
                    <span class="title"> Suplier</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/setting-harga-barang') }}" class="nav-link">
                    <i class="icon-folder"></i>
                    <span class="title">Setting Harga Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/penjualan') }}" class="nav-link">
                    <i class="icon-folder"></i>
                    <span class="title">Penjualan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/pengadaan')}}" class="nav-link nav-toggle">
                    <i class="icon-folder"></i>
                    <span class="title">Pengadaan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/pengeluaran')}}" class="nav-link nav-toggle">
                    <i class="icon-folder"></i>
                    <span class="title">Pengeluaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/laporan')}}" class="nav-link nav-toggle">
                    <i class="icon-folder"></i>
                    <span class="title">Laporan</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
