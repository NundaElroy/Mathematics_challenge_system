@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-primary text-white" style="border-bottom: 2px solid #ffffff;">
                    <h4 class="card-title" style="font-size: 1.5rem; font-weight: bold;">Challenges</h4>
                    <a href="{{ route('challenges.create') }}" class="btn btn-success" style="float: right; border-radius: 20px; padding: 10px 20px;">Add Challenge</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert" style="border-radius: 8px;">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <thead class="bg-dark text-white" style="font-size: 1.1rem;">
                                <tr>
                                    <th>Challenge ID</th>
                                    <th>Opening Date</th>
                                    <th>Closing Date</th>
                                    <th>Challenge Name</th>
                                    <th>Duration</th>
                                    <th>Number of Questions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($challenges as $challenge)
                                    <tr>
                                        <td>{{ $challenge->challengeid }}</td>
                                        <td>{{ $challenge->opening_date }}</td>
                                        <td>{{ $challenge->closing_date }}</td>
                                        <td>{{ $challenge->challenge_name }}</td>
                                        <td>{{ $challenge->duration }}</td>
                                        <td>{{ $challenge->number_of_questions }}</td>
                                        <td>
                                            <a href="{{ route('challenges.show', $challenge->challengeid) }}" class="btn btn-info btn-sm" style="background-color: #17a2b8; border-color: #17a2b8; color: #ffffff;">View</a>
                                            <a href="{{ route('challenges.edit', $challenge->challengeid) }}" class="btn btn-warning btn-sm" style="background-color: #fd7e14; border-color: #fd7e14; color: #ffffff;">Edit</a>
                                            <form action="{{ route('challenges.destroy', $challenge->challengeid) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete();">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" style="background-color: #dc3545; border-color: #dc3545; color: #ffffff;">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
