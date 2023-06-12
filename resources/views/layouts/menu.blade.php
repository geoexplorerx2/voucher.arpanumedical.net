<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header align-items-center">
            <a class="navbar-brand" href="{{ route('home'); }}">
                <img class="navbar-brand-img" src="{{ asset('assets/img/logo.png') }}" alt="">
            </a>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-files-o text-primary"></i>
                            <span class="nav-link-text">Voucher</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a href="{{ route('voucher'); }}">
                                    <span>Create Voucher</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('voucher.show'); }}">
                                    <span>Vouchers List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-files-o text-primary"></i>
                            <span class="nav-link-text">Proforma Invoice</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a href="{{ route('vocher.proforma') }}">
                                    <span>Create Proforma Invoice</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('proforma.List') }}">
                                    <span>Pro-forma invoice List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @can('show users')
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-user text-primary"></i>
                            <span class="nav-link-text">Users</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            @can('show users')
                            <li>
                                <a href="{{ route('user.index'); }}">
                                    <span>All Users</span>
                                </a>
                            </li>
                            @endcan
                            @can('show roles')
                            <li>
                                <a href="{{ route('role.index'); }}">
                                    <span>Roles</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('show agent')
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;">
                            <i class="fa fa-tasks text-primary"></i>
                            <span class="nav-link-text">Definitions</span>
                            <i class="fa fa-caret-right sub-icon"></i>
                        </a>
                        <ul class="nav-item_sub">
                            <li>
                                <a href="{{ route('hospital.index'); }}">
                                    <span>Hospitals</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('hotel.index'); }}">
                                    <span>Hotels</span>
                                </a>
                            </li>
                            @can('show sales person')
                            <li>
                                <a href="{{ route('salesperson.index'); }}">
                                    <span>Sales Agents</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                        @endcan
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
