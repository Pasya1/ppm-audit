<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{ route('admin') }}" class="simple-text">
            <div class="logo-image-small">
                <img src="{{ asset('AdminStyle') }}/img/Stempel Prasetiya Mandiri-01.png">
            </div>
            <!-- <p>CT</p> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ Request::routeIs('admin') ? 'active' : '' }}">
                <a href="{{ route('admin') }}"
                    style="{{ Request::routeIs('admin') ? 'color: #001A6E !important;' : '' }}">
                    <i class="nc-icon nc-bank"
                        style="{{ Request::routeIs('admin') ? 'color: #001A6E !important;' : '' }}"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Group: Laporan -->
            <li class="nav-title pt-5 mx-3" style="opacity: 0.5;"><strong> > Kebutuhan Audit </strong></li>
            <li class="{{ Request::routeIs('document') ? 'active' : '' }}">
                <a href="{{ route('document') }}"
                    style="{{ Request::routeIs('document') ? 'color: #001A6E !important;' : '' }}">
                    <i class="fas fa-book"
                        style="{{ Request::routeIs('document') ? 'color: #001A6E !important;' : '' }}"></i>
                    <p>Document</p>
                </a>
            </li>
            <li class="{{ Request::routeIs('finalaudit') ? 'active' : '' }}">
                <a href="{{ route('finalaudit') }}"
                    style="{{ Request::routeIs('finalaudit') ? 'color: #001A6E !important;' : '' }}">
                    <i class="fa-solid fa-chart-bar"
                        style="{{ Request::routeIs('finalaudit') ? 'color: #001A6E !important;' : '' }}"></i>
                    <p>Laporan Hasil Audit</p>
                </a>
            </li>
            <li class="{{ Request::routeIs('tindaklanjut') ? 'active' : '' }}">
                <a href="{{ route('tindaklanjut') }}"
                    style="{{ Request::routeIs('tindaklanjut') ? 'color: #001A6E !important;' : '' }}">
                    <i class="fa-solid fa-bars-staggered"
                        style="{{ Request::routeIs('tindaklanjut') ? 'color: #001A6E !important;' : '' }}"></i>
                    <p>Tindakan Perbaikan</p>
                </a>
            </li>


            <li class="nav-title pt-5 mx-3" style="opacity: 0.5;"><strong> > Rencana Tindak Lanjut </strong></li>
            <li class="{{ Request::routeIs('hasilRTL.index') ? 'active' : '' }}">
                <a href="{{ route('hasilRTL.index') }}"
                    style="{{ Request::routeIs('hasilRTL.index') ? 'color: #001A6E !important;' : '' }}">
                    <i class="fa-solid fa-book-open"
                        style="{{ Request::routeIs('hasilRTL.index') ? 'color: #001A6E !important;' : '' }}"></i>
                    <p>Rencana Tindak Lanjut</p>
                </a>
            </li>

            @if ($user->role === 'Admin')
                <!-- Group: Master Data -->
                <li class="nav-title pt-5 mx-3" style="opacity: 0.5;"><strong> > Master Data </strong></li>
                <li class="{{ Request::routeIs('programstudi') ? 'active' : '' }}">
                    <a href="{{ route('programstudi') }}"
                        style="{{ Request::routeIs('programstudi') ? 'color: #001A6E !important;' : '' }}">
                        <i class="fa-brands fa-leanpub"
                            style="{{ Request::routeIs('programstudi') ? 'color: #001A6E !important;' : '' }}"></i>
                        <p>Program Studi / Unit</p>
                    </a>
                </li>
                <li class="{{ Request::routeIs('daftarpengguna') ? 'active' : '' }}">
                    <a href="{{ route('daftarpengguna') }}"
                        style="{{ Request::routeIs('daftarpengguna') ? 'color: #001A6E !important;' : '' }}">
                        <i class="nc-icon nc-single-02"
                            style="{{ Request::routeIs('daftarpengguna') ? 'color: #001A6E !important;' : '' }}"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li class="{{ Request::routeIs('site') ? 'active' : '' }}">
                    <a href="{{ route('site') }}"
                        style="{{ Request::routeIs('site') ? 'color: #001A6E !important;' : '' }}">
                        <i class="fa-solid fa-gear"
                            style="{{ Request::routeIs('site') ? 'color: #001A6E !important;' : '' }}"></i>
                        <p>Pengaturan Situs</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
