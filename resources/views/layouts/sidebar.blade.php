<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url(auth()->user()->foto ?? '') }}" class="img-circle img-profil" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>Aktif</a>
            </div>
        </div>
        
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Panel</span>
                </a>
            </li>

            @if (auth()->user()->level == 1)
            <li class="header">YÖNETİM</li>
            <li>
                <a href="{{ route('kategori.index') }}">
                    <i class="fa fa-cube"></i> <span>Kategori</span>
                </a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}">
                    <i class="fa fa-cubes"></i> <span>Ürün</span>
                </a>
            </li>
            <li>
                <a href="{{ route('member.index') }}">
                    <i class="fa fa-id-card"></i> <span>Üye</span>
                </a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}">
                    <i class="fa fa-truck"></i> <span>Tedarikçi</span>
                </a>
            </li>
            <li class="header">İŞLEM</li>
            <li>
                <a href="{{ route('pengeluaran.index') }}">
                    <i class="fa fa-money"></i> <span>Masraflar</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pembelian.index') }}">
                    <i class="fa fa-download"></i> <span>Alım</span>
                </a>
            </li>
            <li>
                <a href="{{ route('penjualan.index') }}">
                    <i class="fa fa-dollar"></i> <span>Satış Listesi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.baru') }}">
                    <i class="fa fa-cart-plus"></i> <span>Yeni İşlem</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.index') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Aktif İşlem</span>
                </a>
            </li>
            
            <li class="header">RAPOR</li>
            <li>
                <a href="{{ route('laporan.index') }}">
                    <i class="fa fa-file-pdf-o"></i> <span>Gelir</span>
                </a>
            </li>
            <li class="header">SİSTEM</li>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-users"></i> <span>Kullanıcı</span>
                </a>
            </li>
            <li>
                <a href="{{ route("setting.index") }}">
                    <i class="fa fa-cogs"></i> <span>Ayarlar</span>
                </a>
            </li>
            @else
            <li>
                <a href="{{ route('transaksi.baru') }}">
                    <i class="fa fa-cart-plus"></i> <span>Yeni İşlem</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.index') }}">
                    <i class="fa fa-cart-arrow-down"></i> <span>Aktif İşlem</span>
                </a>
            </li>
            @endif
        </ul>
    </section>
</aside>