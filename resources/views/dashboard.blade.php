@extends('main')

@section('body')
    <style>
        #calendar {
            padding: 10px;
        }

        .scrollbox-md {
            overflow-y: auto;
         }

        .card-body {
        flex-grow: 1;
        }

        #filterOptions {
            position: absolute;
            background-color: white;
            z-index: 10;
            width: 100%;
            top: 8rem;
            box-shadow: 0px 8px 8px #e8e8e8;
        }


        .fc .fc-button-primary:not(:disabled).fc-button-active, .fc .fc-button-primary:not(:disabled):active {
            background-color: #0c7294!important;
            border-color: #0c7294!important;
            color: white!important;
            border: none;
        }

        .fc .fc-button-primary {
            background-color: #1791ba!important;
            border-color: #1791ba!important;
            color: white!important;
        }

        .fc .fc-button-primary:not(:disabled):active:focus {
            box-shadow: none;
        }

    </style>

            <!-- BOF Breadcrumb -->
            <div class="row navigationLinks">
                <div class="col">
                    <ol class="breadcrumb" style="padding-left: 25px;">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="ti-home"></i> Dashboard</a></li>
                    </ol>
                </div>
            </div>
            <!-- EOF Breadcrumb -->

 
            <div class="row" style="margin-left: 10px;">
                <!-- Employees Sales -->
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    @livewire('dashboard.calendar-dashboard')
                </div>

                <!-- My Tasks -->
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">

                    @livewire('dashboard.tarefas')
    
                </div>
            </div>

            <!-- Articles -->
            <?php
            use App\Models\DashboardPreference;
            use Illuminate\Support\Facades\Auth;
            
            $preferences = DashboardPreference::where('Id_user', Auth::id())->first();
            $show90dias = '';
            $showObjFat = '';
            $showTop500 = '';
            $showObjMargin = '';
            if ($preferences) {
                $show90dias = $preferences->days90 == 1 ? true : false;
                $showObjFat = $preferences->ObjFat == 1 ? true : false;
                $showTop500 = $preferences->Top500 == 1 ? true : false;
                $showObjMargin = $preferences->ObjMargin == 1 ? true : false;
            }
            
            ?>

            <div class="row" style="margin-left: 10px;">
                @if ($show90dias == true)
                <!-- Product Sales Chart -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body" id="product-sales-chart"></div>
                    </div>
                </div>
                @endif
                <!-- Expenses Chart -->
                @if ($showObjFat == true)
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body" id="expenses-chart1"></div>
                    </div>
                </div>
                
            </div>
                
            <div class="row" style="margin-left: 10px;">
              @endif
                <!-- Expenses Chart -->
                @if ($showTop500 == true)
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body" id="expenses-chart2"></div>
                    </div>
                </div>
                @endif
                <!-- Expenses Chart -->
                @if ($showObjMargin == true)
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body" id="expenses-chart3"></div>
                    </div>
                </div>
                @endif
            </div>
                
            
            <!-- EOF MAIN-BODY -->

            <style>
                .row {
                    display: flex;
                    flex-wrap: wrap;
                }
                .card {
                    flex: 1 1 auto;
                    min-height: 400px; /* ou o valor que você preferir */
                }
              </style>
              

@endsection

@push('scripts_footer')

    <script src="{{asset('assets/scripts/pages/dashboard1.js')}}"></script>
    <script src="{{asset('assets/scripts/pages/fm_control.js')}}"></script>
    <script src="{{asset('assets/scripts/pages/cp_datetime.js')}}"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        document.getElementById('toggleFilters').addEventListener('click', function() {
            var filterOptions = document.getElementById('filterOptions');
            if (filterOptions.style.display === 'none' || filterOptions.style.display === '') {
                filterOptions.style.display = 'block';
            } else {
                filterOptions.style.display = 'none';
            }
        });


    </script>
    
@endpush


