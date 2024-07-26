<!DOCTYPE html>
<html>
<head>
    <title>Challenge Report:</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        h2 {
            color: #4CAF50;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .participant-details {
            margin-bottom: 20px;
        }
        .participant-details p {
            margin: 5px 0;
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
        img {
            max-width: 150px;
            height: auto;
            display: block;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>MATHEMATICS NATIONAL CHALLENGE</h1>
    <h1>Challenge Report</h1>
    <h1>{{ $data[0]->challengeId}}</h1>

    @if(isset($data[0]))
        <div class="participant-details">
            <h2>Participant Details</h2>
            @if(isset($data[0]->image))
                <p><strong>Image:</strong></p>
                <img src="data:image/jpeg;base64,{{ base64_encode($data[0]->image) }}" alt="Participant Image">
            @endif
            <p><strong>Username:</strong> {{ $data[0]->username }}</p>
            <p><strong>Full Name:</strong> {{ $data[0]->firstname }} {{ $data[0]->lastname }}</p>
            <p><strong>Email:</strong> {{ $data[0]->email }}</p>
            <p><strong>Date of Birth:</strong> {{ $data[0]->DOB }}</p>
            <p><strong>School Registration No:</strong> {{ $data[0]->school_registration_no }}</p>
        </div>
    @endif

    <h2>Attempt Details</h2>
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Selected Answer</th>
                <th>Correct Answer</th>
                <th>Score</th>
                <th>Time Taken</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->question_text }}</td>
                    <td>{{ $item->selected_answer }}</td>
                    <td>{{ $item->correct_answer }}</td>
                    <td>{{ $item->score }}</td>
                    <td>{{ $item->timetaken_per_question }}</td>
                    <td>{{ $item->marks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
