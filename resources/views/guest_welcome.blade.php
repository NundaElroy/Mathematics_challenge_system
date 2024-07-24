@extends('layouts.app', ['activePage' => 'guest.welcome', 'title' => 'guestpage', 'activeButton' => 'laravel'])
<head>  
</head>
<body>

    @section('content')
    <div class="full-page section-image" data-image="{{asset('light-bootstrap/img/Students2.jpg')}}">
    
    <div class="content">
    <div class="logo" style="display:flex; align-items:center;position:absolute;top:-50px;left: 10px;">
    <img src="{{asset('light-bootstrap/img/logo1.png')}}" alt="logo" class="logo" style="height: 60px; width:60px;">
    </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <h1 class="text-white text-center">{{ __('Welcome to the National Mathematics Challenge') }}</h1>
                    <h4 class="text-white text-center"><i>{{ __(' "Unlock the Potential of Mathematics,One Challenge Gradually in Succession" ') }}</i></h4>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('analytics') }}" class="btn btn-primary">{{ __('System Analytics') }}</a>
                
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

        
    });
</script>
@endpush
