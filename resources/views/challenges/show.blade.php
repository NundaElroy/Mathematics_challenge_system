@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-primary text-white" style="border-bottom: 2px solid #ffffff;">
                    <h1 class="card-title" style="font-size: 1.5rem; font-weight: bold;">Challenge Details</h1>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Challenge Name:</dt>
                        <dd class="col-sm-8">{{ $challenge->challenge_name }}</dd>

                        <dt class="col-sm-4">Opening Date:</dt>
                        <dd class="col-sm-8">{{ $challenge->opening_date }}</dd>

                        <dt class="col-sm-4">Closing Date:</dt>
                        <dd class="col-sm-8">{{ $challenge->closing_date }}</dd>

                        <dt class="col-sm-4">Duration:</dt>
                        <dd class="col-sm-8">{{ $challenge->duration }}</dd>

                        <dt class="col-sm-4">Number of Questions:</dt>
                        <dd class="col-sm-8">{{ $challenge->number_of_questions }}</dd>
                    </dl>
                    <div class="text-center mt-4">
                        <a href="{{ route('challenges.edit', $challenge->id) }}" class="btn btn-warning btn-lg" style="border-radius: 20px; padding: 10px 20px;">Edit Challenge</a>

                        <form action="{{ route('challenges.destroy', $challenge->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg" style="border-radius: 20px; padding: 10px 20px;">Delete Challenge</button>
                        </form>

                        <a href="{{ route('challenges.index') }}" class="btn btn-secondary btn-lg" style="border-radius: 20px; padding: 10px 20px;">Back to Challenges</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this challenge? This action cannot be undone.');
    }
</script>
@endsection
@endsection
