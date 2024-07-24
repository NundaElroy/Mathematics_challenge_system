@extends('layouts.app', ['activePage' => 'analytics', 'title' => 'Analytics'])
<html lang="en">
<head>
    <link rel="stylesheet" href="{{asset('css/bootstrap.mini,css')}}"> 
</head>
<body STYLE="background-color:azure">
    
@section('content')
<div class="container">
    <!--<div class="row">
        <div class="col-md-12">-->
            <h1>Analytics</h1>

            
      <!--  </div>
    </div>-->
    <h2>Most Correctly Answered Questions</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Question ID</th>
                <th>Question Text</th> 
                <th>Most Correctly Answered</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
            
            <tr>
                <td>{{ $question->questionid }}</td>
               <td>{{ $question->question_text ?? 'N/A'  }}</td>
                <td>{{ $question->total_correct}}</td>
            </tr>
           @endforeach
        </tbody>
    </table>
</div>
@endsection
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>