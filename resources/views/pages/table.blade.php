@extends('layouts.app', ['activePage' => 'table', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION', 'navName' => 'Table List', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">List of paticipating schools</h4>
                            
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>RegNo</th>
                                    <th>Name</th>
                                    <th>District</th>
                                     </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td>u1</td>
                                        <td>kibuli ss</td>
                                        <td>kampala</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>u2</td>
                                        <td>kings college</td>
                                        <td>kampala</td>
                                        
                                        </tr>
                                    <tr>
                                        <td>u3</td>
                                        <td>makerere college</td>
                                        <td>kampala</td>
                                        
                                        
                                    </tr>
                                    <tr>
                                        <td>u4</td>
                                        <td>bombo ss</td>
                                        <td>wakiso</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>u5</td>
                                        <td>arau ss</td>
                                        <td>Arua</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>u6</td>
                                        <td>kabong</td>
                                        <td>moroto</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                                        


@endsection