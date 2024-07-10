@extends('layouts.app', ['activePage' => 'table', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION', 'navName' => 'Table List', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">list of school representatives</h4>
                            
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Rep Id</th>
                                    <th>schRegNo</th>
                                    <th>RepName</th>
                                    <th>RepEmail</th>
                                     </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td>R1</td>
                                        <td>u1</td>
                                        <td>john</td>
                                        <td>john@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>R2</td>
                                        <td>u2</td>
                                        <td>sam</td>
                                        <td>sam@gmail.com</td>
                                        
                                        </tr>
                                    <tr>
                                        <td>R3</td>
                                        <td>u3</td>
                                        <td>issac</td>
                                        <td>issac@gmail.com</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>R4</td>
                                        <td>u4</td>
                                        <td>julius</td>
                                        <td>julius@gmail.com</td>
                                        
                                    </tr>
                                    <tr>
                                         <td>R5</td>
                                        <td>u5</td>
                                        <td>peter</td>
                                        <td>peter@gmail.com</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>R6</td>
                                        <td>u6</td>
                                        <td>abdu</td>
                                        <td>abdu@gmail.com</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                                        


@endsection