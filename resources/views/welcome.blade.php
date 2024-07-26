@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'Welcome'])

<head>
    <!-- Including Owl Carousel CSS for the image slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <style>
        .section-image {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }
        .carousel-inner {
            height: 100vh;
        }
        .carousel-item img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }
        .logo {
            width: 70px;
            height: 70px;
            position: absolute;
            top: 70px;
            left: 25px;
            z-index: 3;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        .content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            color: white;
            padding: 0 10%;
        }
        footer {
            color: white;
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            z-index: 2;
        }
        h1, h4, p {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }
        h1 {
            font-size: 3.5em;
            font-weight: bold;
        }
        h4 {
            font-size: 1.5em;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2em;
        }
    </style>
</head>

<body>
    @section('content')
    <div class="full-page section-image" data-image="{{asset('light-bootstrap/img/math-problem.jpg')}}">
  
    <div class="content">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <h1 class="text-white text-center">{{ __('Welcome to the National Mathematics Challenge') }}</h1>
                    <h4 class="text-white text-center"><i>{{ __(' "Unlock the Potential of Mathematics,One Challenge Gradually in Succession" ') }}</i></h4>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('light-bootstrap/img/Side3.jpg') }}" class="d-block w-100" alt="Slide 4">
            </div>
        </div>
    </div>
    <div class="overlay"></div>
    <img src="{{ asset('light-bootstrap/img/logo1.png') }}" alt="logo" class="logo">
    <div class="content">
        <h1>{{ __('Welcome to the National Mathematics Challenge') }}</h1>
        <h4>
            <i>{{ __('"Unlock the Potential of Mathematics, One Challenge at a Time"') }}</i>
        </h4>
        <p>
            {{ __('Join us in this exciting journey to enhance your math skills and compete with the best minds across the nation.
             Solve intriguing problems, rise up the ranks, and unlock your true potential!') }}
        </p>
    </div>
    <footer>
        <p>&copy;{{ date('Y') }} {{ __('Mathematics National Challenge Platform') }}</p>
        <a href="http://www.creative-tim.com" style="color: white;">{{ __('Mathematics National Challenge Platform') }}</a>
    </footer>
    @endsection

    @push('js')
    <!-- Including jQuery and Bootstrap JS for the carousel functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 3000,
                pause: "hover"
            });
        });
    </script>
    @endpush
</body>
