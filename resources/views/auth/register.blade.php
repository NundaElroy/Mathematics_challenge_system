@extends('layouts.app', ['activePage' => 'register', 'title' => 'register'])

@section('content')
    <div class="full-page register-page section-image" data-color="azure" data-image="{{ asset('light-bootstrap/img/bg-image.jpg') }}">
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="card card-login" style="background-color:rgba(255,255,255,0.5) ;" >
                                <div class="content">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Custom password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" placeholder="Password Confirmation" class="form-control" required>
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <div class="form-check">
                                        <input class="form-check-input" name="agree" id="agree" type="checkbox" required name="terms" style="display:inline-block">
                                        <!--added code above here -->
                                            <label class="form-check-label ml-2" for="agree">
                                                <b>{{ __('Agree With Terms And Conditions') }}</b>
                                            </label>    
                                             </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-fill btn-neutral btn-wd">{{ __('Create Free Account') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if($errors->any())
                            <div class="col">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .form-check-input {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }
        .form-check-label {
            color: black; /* Ensure text is visible */
        }
        .form-check {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-check-sign {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: white;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        .form-check-label b {
            color: black; /* Ensure bold text is visible */
        }
       
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
@endpush
