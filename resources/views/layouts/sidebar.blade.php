<div class="sidebar-content sidebar-responsive">
    <!-- sidebar-menu  -->
    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="{{route('dashboard')}}" >
                    <img src="{{asset('logo/sanipower_Azul.svg')}}" class="logo-sanipower-sidbar">  
                </a>
            </li>
            
            <li class="header-menu">
                <span>Menu</span>
            </li>
            
            <li class="active">
                <a href="{{route('dashboard')}}" class="{{ request()->routeIs('dashboard') ? 'text-info' : '' }}">
                    <i class="ti-dashboard"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="maincat">
                <a href="#">
                    <i class="ti-layers-alt"></i>
                    <span class="menu-text">Multi-Levels Menu</span>
                </a>
                <div class="subcat">
                    <ul>
                        <li class="tier1">
                            <a href="javascript:;">Tier 1</a>
                            <div class="subcat">
                                <ul>
                                    <li><a href="javascript:;">Level 2</a></li>
                                    <li><a href="javascript:;">Level 2</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:;">Onion</a>
                        </li>
                        <li>
                            <a href="javascript:;">Router</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{route('clientes')}}" class="{{ Str::contains(request()->route()->getName(), 'clientes') ? 'text-info' : '' }}">
                    <i class="ti-user"></i>
                    Clientes
                </a>
            </li>
            <li>
                <a href="{{route('visitas')}}" class="{{ Str::contains(request()->route()->getName(), 'visitas') ? 'text-info' : '' }}">
                    <i class="ti-calendar"></i>
                    Visitas
                </a>
            </li>

            <li>
                <a href="{{route('encomendas')}}" class="{{ Str::contains(request()->route()->getName(), 'encomendas') ? 'text-info' : '' }}">
                    <i class="ti-agenda"></i>
                    Encomendas
                </a>
            </li>

            <li>
                <a href="{{route('propostas')}}" class="{{ Str::contains(request()->route()->getName(), 'propostas') ? 'text-info' : '' }}">
                    <i class="ti-wallet"></i>
                    Propostas
                </a>
            </li>
        </ul>
    </div>
    <!-- sidebar-menu  -->
</div>