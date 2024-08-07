@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'dashboard', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])



@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-dark" style="border-radius: 0;">
                <div class="card-header" style="font-size: 1.2rem; font-weight: bold;">
                <i class="fa fa-users" aria-hidden="true"></i>
                    <i class="bi bi-people" style="font-size: 2rem; margin-right: 10px;"></i>Participants
                    
                </div>
                <div class="card-body">
                    <h3 style="font-size: 2.5rem;">{{ $participantsCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-dark" style="border-radius: 0;">
                <div class="card-header" style="font-size: 1.2rem; font-weight: bold;">
                <i class="fa fa-trophy" aria-hidden="true"></i>
                    <i class="bi bi-trophy" style="font-size: 2rem; margin-right: 10px;"></i>Challenges
                  </div>
                <div class="card-body">
                    <h3 style="font-size: 2.5rem;">{{ $challengesCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-dark" style="border-radius: 0;">
                <div class="card-header" style="font-size: 1.2rem; font-weight: bold;">
                <i class="fa fa-list-ul" aria-hidden="true"></i>
                    <i class="bi bi-question-circle" style="font-size: 2rem; margin-right: 10px;"></i>Questions
                </div>
                <div class="card-body">
                    <h3 style="font-size: 2.5rem;">{{ $questionsCount }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-dark" style="border-radius: 0;">
                <div class="card-header" style="font-size: 1.2rem; font-weight: bold;">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <i class="bi bi-building" style="font-size: 2rem; margin-right: 10px;"></i>Schools
                </div>
                <div class="card-body">
                    <h3 style="font-size: 2.5rem;">{{ $schoolsCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-dark" style="border-radius: 0;">
                <div class="card-header" style="font-size: 1.2rem; font-weight: bold;">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="bi bi-clipboard-check" style="font-size: 2rem; margin-right: 10px;"></i>Attempts
                </div>
                <div class="card-body">
                    <h3 style="font-size: 2.5rem;">{{ $attemptsCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-dark" style="border-radius: 0;">
                <div class="card-header" style="font-size: 1.2rem; font-weight: bold;">
                <i class="fa fa-bell-slash-o" aria-hidden="true"></i>
                    <i class="bi bi-x-circle" style="font-size: 2rem; margin-right: 10px;"></i>Rejected
                </div>
                <div class="card-body">
                    <h3 style="font-size: 2.5rem;">{{ $rejectedCount }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- @section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card ">
                       
                       
                        
                            
                            <div class="full-page section-image"  data-image="{{asset('C:\code\sebabe\public\light-bootstrap\img\Screenshot (14).png')}}">
                            
                        </div>
                    </div>
                </div>
               
                        
                
                </div>
          
          </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('2024 mathematics competition') }}</h4>
                            <p class="card-category">{{ __('School rankings') }}</p>
                        </div>
                        <div class="card-body ">
                            <div id="chartActivity" class="ct-chart"></div>
                        </div>
                        <div class="card-footer ">
                            <div class="legend">
                                <i class="fa fa-circle text-info"></i> {{ __('Kibuli PS') }}
                                <i class="fa fa-circle text-danger"></i> {{ __('Moroto PS') }}

                            </div>
                            <hr>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card  card-tasks">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Protocols') }}</h4>
                            <p class="card-category">{{ __('As guides to the examination') }}</p>
                        </div>
                        <div class="card-body ">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ __('All students are expected to register?"') }}</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="" checked>
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ __('Schools shall provide three representatives?') }}</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="" checked>
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ __('Marks shall be awarded accordingly') }}
                                            </td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" checked>
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ __('Examination materials are free of use') }}</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ __('Awards ') }}</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="" disabled>
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ __('All questions are standard') }}</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="now-ui-icons loader_refresh spin"></i> {{ __('Updated by group i, 3 minutes ago') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

            demo.showNotification();

        });
    </script>
@endpush -->