<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('assets/img/logo_kpu.png') }}" alt="DPS Pemilu Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">DPS Pemilu</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/app/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" data-toggle="tooltip" data-placement="right"
                    title="{{ Auth::user()->name }}">{{ substr(Auth::user()->name, 0, 20) }}..</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                @php
                    $uri = isset($nav) ? $nav : request()->route()->uri;
                @endphp


                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../../index.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ $uri == 'home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @hasanyrole('Administrator')
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link {{ $uri == 'user' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('relawans.index') }}" class="nav-link {{ $uri == 'relawans' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Relawan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penduduks.index') }}"
                            class="nav-link {{ $uri == 'penduduks' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tag"></i>
                            <p>
                                DPS
                            </p>
                        </a>
                    </li>
                @endhasanyrole

                <li class="nav-item">
                    <a href="{{ route('paslons.index') }}" class="nav-link {{ $uri == 'paslons' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Paslon
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('domisilis.index') }}"
                        class="nav-link {{ $uri == 'domisilis' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>
                            Domisili
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('surveys.index') }}" class="nav-link {{ $uri == 'surveys' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Survey
                        </p>
                    </a>
                </li>

                <!-- ========== Logout Nav ========== -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <!-- ========== End Logout Nav ========== -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
