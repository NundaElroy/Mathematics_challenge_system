@extends('layouts.app', ['activePage' => 'analytics', 'title' => 'Analytics'])
<!DOCTYPE html>
<html>
<head>
    <title>Challenge Winners</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
            color: #4CAF50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
            text-align: center;
        }
        td {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Most correctly answered questions per challenge</h1>

    @foreach($groupedByChallenge as $challengeId => $questions)
        <h2>Challenge ID: {{ $challengeId }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Question ID</th>
                    <th>Question Text</th>
                    <th>Total Correct</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->questionid }}</td>
                        <td>{{ $question->question_text }}</td>
                        <td>{{ $question->total_correct }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
