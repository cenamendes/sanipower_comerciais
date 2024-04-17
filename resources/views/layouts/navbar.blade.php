<div class="header-bar">
    <div class="brand d-flex">
        <a href="{{route('dashboard')}}">
            <img src="{{asset('logo/sanipower_Azul.svg')}}" class="logo-sanipower-navbar" width="200">  
        </a> 
        
    </div>
    <div class="btn-toggle">
        <div class="nav-responsive">
            <div class="maincat">
            </div>
            <div class="item-respos">
                <a href="#" class="slide-sidebar-btn"><i class="ti-menu"></i></a>
            </div>

            <div class="item-respos">
                <a href="{{route('clientes')}}" class="{{ Str::contains(request()->route()->getName(), 'clientes') ? 'text-info' : '' }}">
                    <i class="ti-user"></i>

                </a>
            </div>
            <div class="item-respos2">
                <a href="{{route('visitas')}}" class="{{ Str::contains(request()->route()->getName(), 'visitas') ? 'text-info' : '' }}">
                    <i class="ti-calendar"></i>
                </a>
            </div>
            <div class="item-respos2">
                <a href="{{route('encomendas')}}" class="{{ Str::contains(request()->route()->getName(), 'encomendas') ? 'text-info' : '' }}">
                    <i class="ti-agenda"></i>
                </a>
            </div>
            <div class="item-respos2">
                <a href="{{route('propostas')}}" class="{{ Str::contains(request()->route()->getName(), 'propostas') ? 'text-info' : '' }}">
                    <i class="ti-wallet"></i>
                </a>
            </div>
        </div>
        <a href="#" class="slide-sidebar-btn" style="display:none;"><i class="ti-menu"></i></a>
    </div>
   

    <div class="navigation d-flex">
        <!-- BOF Header Nav -->
        <div class="navbar-menu d-flex">
            
            <div class="menu-item">
                <a href="#" class="btn" data-toggle="dropdown">
                    <i class="ti-bell"></i>
                    <span class="badge badge-pill badge-danger">3</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-alert">
                    <li class="dropdown-header text-center"><a href="#"><i class="ti-comment-alt"></i> View
                            All Alerts <i class="ti-angle-right"></i></a></li>
                    <li><a href="#"><i class="fa fa-user"></i> New user registered <span>Just now</span></a>
                    </li>
                    <li><a href="#"><i class="fa fa-calendar-plus-o"></i> New event created <span>5 min
                                ago</span></a></li>
                    <li><a href="#"><i class="fa fa-area-chart"></i> Report ready to download <span>1 day
                                ago</span></a></li>
                    <li><a href="#"><i class="fa fa-bank"></i> Bill payment reminder <span>1 day
                                ago</span></a></li>
                    <li><a href="#"><i class="fa fa-clock-o"></i> Staff meeting <span>3 days ago</span></a>
                    </li>
                </ul>
            </div>
            <!-- <div class="menu-item">
                <a href="#" class="btn" data-toggle="dropdown">
                    <i class="ti-email"></i>
                    <span class="badge badge-pill badge-success">7</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-message">
                    <li class="dropdown-header text-center"><a href="#"><i class="ti-comments"></i> View All
                            Messages <i class="ti-angle-right"></i></a></li>
                    <li>
                        <img src="assets/img/profile/profile-04.jpg">
                        <div class="message-row">
                            <small>24h ago</small>
                            <a href="#"><span class="message-user">Pear Appleton</span><br>
                                Staff meeting on Tuesday at 4PM, remember to set date</a>
                        </div>
                    </li>
                    <li>
                        <img src="assets/img/profile/profile-07.jpg">
                        <div class="message-row">
                            <small>2h ago</small>
                            <a href="#"><span class="message-user">siQuang Humbleman</span><br>
                                RE: Remember to generate PNL for October</a>
                        </div>
                    </li>
                    <li>
                        <img src="assets/img/profile/profile-06.jpg">
                        <div class="message-row">
                            <small>3d ago</small>
                            <a href="#"><span class="message-user">Lemony Tang</span><br>
                                Appointment with lawyer, better call Saul!</a>
                        </div>
                    </li>
                    <li>
                        <img src="assets/img/profile/profile-07.jpg">
                        <div class="message-row">
                            <small>4d ago</small>
                            <a href="#"><span class="message-user">siQuang Humbleman</span><br>
                                Theme designed by siQuang for siQthemes</a>
                        </div>
                    </li>
                </ul>
            </div> -->
            <div class="menu-item d-flex align-items-center">
                <div class="logo-img-container">
                    <a href="#" class="right-sidebar-toggle">
                    @if (Auth::user()->imagem == null || Auth::user()->imagem == '')
                        <div class="img-temporary-navbar">{{ ucfirst(substr(Auth::user()->name, 0, 1)) }}</div>
                    @else
                        <img class="img-navbar" src="{{ asset('storage/profile/' . Auth::user()->imagem) }}" alt=""/>
                    @endif
                    </a>
                </div>
            </div>
        </div>
        <!-- EOF Header Nav -->

    </div>
</div>