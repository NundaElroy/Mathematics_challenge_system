@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'welcome'])
<head>
    
  
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
            
            <div class="container" data-color="white" style="padding:1em;position:absolute;bottom:0;">
            <footer style="color: white;">
            <p>&copy;{{date('Y')}}</p>
            </footer>
            <a href="http://www.creative-tim.com" style="color: white;">{{__('Mathematics National Challenge Platform')}}</a>
            </div>
           

        </div>
        
    </div>
    

    </div>
    
    
</body>
@endsection

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