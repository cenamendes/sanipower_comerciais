<div class="sidebar-right-container">

    <!-- BOF TABS -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#tab-1" data-toggle="tab" class="nav-link active">Informações</a>
        </li>
    </ul>
    <!-- EOF TABS -->

    <!-- BOF TAB PANES -->
    <div class="tab-content">

        <!-- BOF TAB-PANE #1 -->
        <div id="tab-1" class="tab-pane show active">
            <div class="pane-header">
                <h3><i class="ti-user"></i> Informações</h3>
                <i class="fa fa-circle text-success"></i> <span class="profile-user">{{ Auth::user()->name }}</span>
                <span class="float-right"><a href="javascript:void(0)" id="logout" class="text-carolina">Logout</a></span>
                <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logoutForm">
                    @csrf
                </form>
                <br>
                <span><a href="{{route('profile.edit')}}" class="text-carolina">Editar utilizador</a></span>

            </div>
            <div class="pane-body">
                <div class="card bg-transparent mb-3">
                    <ul class="list-group list-group-flush">

                                              
                        <li class="list-group-item">
                            <h5 class="mb-3">
                                Mensagens
                                <span class="badge badge-pill badge-info pull-right">4</span>
                            </h5>
                            <div class="message-group d-flex flex-row mb-3">
                                <a href="#"><img src="{{asset('assets/img/profile/profile-01.jpg')}}" class="rounded"
                                        alt="image"></a>
                                <div class="message-item">
                                    <small class="text-carolina">Today 3:30 pm</small><br>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </div>
                            </div>
                            <div class="message-group d-flex flex-row mb-3">
                                <a href="#"><img src="{{asset('assets/img/profile/profile-03.jpg')}}" class="rounded"
                                        alt="image"></a>
                                <div class="message-item">
                                    <small class="text-carolina">Today 12:45 pm</small><br>
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                    ut aliquip aute irure dolor in.
                                </div>
                            </div>
                            <div class="message-group d-flex flex-row mb-3">
                                <a href="#"><img src="{{asset('assets/img/profile/profile-02.jpg')}}" class="rounded"
                                        alt="image"></a>
                                <div class="message-item">
                                    <small class="text-carolina">Yesterday 5:20 pm</small><br>
                                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                    dolore eu fugiat nulla pariatur.
                                </div>
                            </div>
                            <div class="message-group d-flex flex-row">
                                <a href="#"><img src="{{asset('assets/img/profile/profile-05.jpg')}}" class="rounded"
                                        alt="image"></a>
                                <div class="message-item">
                                    <small class="text-carolina">Tuesday 2:20 pm</small><br>
                                    Sunt in culpa qui officia deserunt mollit anim est laborum voluptate.
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <h5>Upcoming Events</h5>
                            <p class="card-text">for Monday - February 25, 2019</p>
                            <div class="profile-calendar">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Schedule</th>
                                            <th scope="col">Events</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>All-day</td>
                                            <td><i class="fa fa-circle text-info"></i> Project concept</td>
                                        </tr>
                                        <tr>
                                            <td>10:00 am</td>
                                            <td><i class="fa fa-circle text-info"></i> Staff meeting</td>
                                        </tr>
                                        <tr>
                                            <td>2:50 pm</td>
                                            <td><i class="fa fa-circle text-warning"></i> Send out report
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4:30 pm</td>
                                            <td><i class="fa fa-circle text-danger"></i> Appointment with
                                                Tang</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- EOF TAB-PANE #1 -->

    </div>
    <!-- EOF TAB PANES -->

</div>