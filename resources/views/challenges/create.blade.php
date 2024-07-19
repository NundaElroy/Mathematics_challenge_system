@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <!-- Place this somewhere in your HTML where you want the success message to appear -->
                <div id="successMessage" class="alert alert-success" style="display: none;">
                    Challenge created successfuly
                </div>
                <div class="card-header bg-primary text-white" style="border-bottom: 2px solid #ffffff;">
                    <h1 class="card-title" style="font-size: 1.5rem; font-weight: bold;">Add New Challenge</h1>
                </div>
                <div class="card-body">
                    <form id="challengeForm" action="{{ route('challenges.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="challengeid" style="font-weight: bold;">Challenge ID</label>
                            <input type="number" class="form-control" id="challengeid" name="challengeid" required>
                        </div>
                        <div class="form-group">
                            <label for="opening_date" style="font-weight: bold;">Opening Date</label>
                            <input type="date" class="form-control" id="opening_date" name="opening_date" required>
                        </div>
                        <div class="form-group">
                            <label for="closing_date" style="font-weight: bold;">Closing Date</label>
                            <input type="date" class="form-control" id="closing_date" name="closing_date" required>
                        </div>
                        <div class="form-group">
                            <label for="challenge_name" style="font-weight: bold;">Challenge Name</label>
                            <input type="text" class="form-control" id="challenge_name" name="challenge_name" required>
                        </div>
                        <div class="form-group">
                            <label for="duration" style="font-weight: bold;">Duration</label>
                            <input type="number" class="form-control" id="duration" name="duration" required>
                            <small class="form-text text-muted" style="font-size: 0.9rem; color: #6c757d;">Note the duration is in minutes</small>
                        </div>
                        <div class="form-group">
                            <label for="number_of_questions" style="font-weight: bold;">Number of Questions</label>
                            <input type="number" class="form-control" id="number_of_questions" name="number_of_questions" required min="1">
                            <small class="form-text text-muted" style="font-size: 0.9rem; color: #6c757d;">Enter the total number of questions for the challenge.</small>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 20px; padding: 10px 20px;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div id="successMessageAnswer" class="alert alert-success" style="display: none;">
                    Files uploaded succesfuly.
                </div>
                <div class="card-header bg-primary text-white" style="border-bottom: 2px solid #ffffff;">
                    <h1 class="card-title" style="font-size: 1.5rem; font-weight: bold;">Upload Questions and Answers</h1>
                </div>
                <div class="card-body">
                    <form id="questionsForm" action="{{ route('questions.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="questions" style="font-weight: bold;">Questions</label>
                            <input type="file" id="questions" name="import_question_file" class="form-control" />
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <form id="answersForm" action="{{ route('answers.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="answers" style="font-weight: bold;">Answers</label>
                            <input type="file" id="answers" name="import_answer_file" class="form-control" />
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('challengeForm').addEventListener('submit', function (e) {
        e.preventDefault();
        submitForm(this, `{{ route('challenges.store') }}`, 'challengeForm');
    });

    document.getElementById('questionsForm').addEventListener('submit', function (e) {
        e.preventDefault();
        submitForm(this, `{{ route('questions.upload') }}`, 'questionsForm');
    });

    document.getElementById('answersForm').addEventListener('submit', function (e) {
        e.preventDefault();
        submitForm(this, `{{ route('answers.upload') }}`, 'answersForm');
    });
});

function submitForm(form, url, formType) {
    let formData = new FormData(form);
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(response => {
        console.log('Response received:', response);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    }).then(data => {
        console.log('Data received:', data);
        if (data.success) {
            // Show success message based on form type
            showSuccessMessage(formType);
            // Optionally reset the form after successful submission
            form.reset();
        } else {
            alert('An error occurred.');
        }
    }).catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting the form.');
    });
}

function showSuccessMessage(formType) {
    let messageElement;

    switch(formType) {
        case 'challengeForm':
            messageElement = document.getElementById('successMessage');
            break;
        case 'questionsForm':
            messageElement = document.getElementById('successMessageAnswer');
            break;
        case 'answersForm':
            messageElement = document.getElementById('successMessageAnswer');
            break;
        default:
            return;
    }

    // Show the success message for the specific form
    if (messageElement) {
        messageElement.style.display = 'block';
        // Hide the success message after 5 seconds
        setTimeout(() => {
            messageElement.style.display = 'none';
        }, 5000);
    }
}

</script>


@endsection
