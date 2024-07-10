@extends('layouts.app')

@section('content')
    <h1>{{ $question->title }}</h1>
    <p>{{ $question->body }}</p>

    <h2>Answers</h2>
    <ul>
        @foreach ($question->answers as $answer)
            <li>{{ $answer->body }}</li>
        @endforeach
    </ul>

    <h3>Your Answer</h3>
    <form action="{{ route('answers.store', $question) }}" method="POST">
        @csrf
        <textarea name="body"></textarea>
        <button type="submit">Submit</button>
    </form>
@endsection
