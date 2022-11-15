@extends('layouts.app')

@section('page_title', 'Welcome')

@section('content')
<div class="py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <h1 class="display-4 fw-bold text-black pt-5">Start Improving<br>Your Health<br>In Multiple Areas</h1>
                <p class="col-md-8 fs-6 text-black mt-5 mb-5" style="font-weight: 100">Our philosophy is to treat your health as a holistic package and enable you to have improved health outcomes in a number of different areas.</p>
                <a href="{{ route('register') }}" class="btn btn-violet mt-3 mb-5 px-5 py-3">Get Started Today <i class="fa-light fa-arrow-right"></i></a>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{ asset('images/home_top.png') }}" class="img-fluid rounded-3">
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-black text-center mb-5" style="font-weight: 600">Stay Organized & Connected</h2>

    <div class="row mb-5">
        <div class="col-12 col-md-4 text-center mb-5">
            <span class="fa-stack fa-2x">
                <i class="fa-solid fa-circle fa-stack-2x text-light"></i>
                <i class="fa-light fa-user-group fa-stack-1x text-purple fs-4"></i>
            </span>
            <h5 class="mt-4">Your own PT</h5>
            <p style="font-weight: 100">You'll have a coach who'll be with you every step of the way</p>
        </div>
        <div class="col-12 col-md-4 text-center mb-5">
            <span class="fa-stack fa-2x">
                <i class="fa-solid fa-circle fa-stack-2x text-light"></i>
                <i class="fa-light fa-clipboard-list-check fa-stack-1x text-purple fs-4"></i>
            </span>
            <h5 class="mt-4">Personalised Training Plan</h5>
            <p style="font-weight: 100">A Training Plan specifically for you and what you're wanting to achieve</p>
        </div>
        <div class="col-12 col-md-4 text-center mb-5">
            <span class="fa-stack fa-2x">
                <i class="fa-solid fa-circle fa-stack-2x text-light"></i>
                <i class="fa-light fa-chart-column fa-stack-1x text-purple fs-4"></i>
            </span>
            <h5 class="mt-4">Reporting</h5>
            <p style="font-weight: 100">Weekly/Monthly reporting to help you keep track of where you're up to</p>
        </div>
        <div class="col-12 col-md-4 text-center mb-5">
            <span class="fa-stack fa-2x">
                <i class="fa-solid fa-circle fa-stack-2x text-light"></i>
                <i class="fa-light fa-hand-fist fa-stack-1x text-purple fs-4"></i>
            </span>
            <h5 class="mt-4">Education & Motivation</h5>
            <p style="font-weight: 100">Education, accountability and motivation to help you achieve personal goals</p>
        </div>
        <div class="col-12 col-md-4 text-center mb-5">
            <span class="fa-stack fa-2x">
                <i class="fa-solid fa-circle fa-stack-2x text-light"></i>
                <i class="fa-light fa-road-barrier fa-stack-1x text-purple fs-4"></i>
            </span>
            <h5 class="mt-4">Limited Spaces</h5>
            <p style="font-weight: 100">To ensure you have the appropriate levels of support from your coach</p>
        </div>
        <div class="col-12 col-md-4 text-center mb-5">
            <span class="fa-stack fa-2x">
                <i class="fa-solid fa-circle fa-stack-2x text-light"></i>
                <i class="fa-light fa-hands-holding-heart fa-stack-1x text-purple fs-4"></i>
            </span>
            <h5 class="mt-4">Support & Guidance</h5>
            <p style="font-weight: 100">Whenever you need it, your coach will be on hand to provide support & guidance</p>
        </div>
    </div>

    <div class="row align-items-center mb-5">
        <div class="col-12 col-md-6 mb-5">
            <img src="{{ asset('images/home_bottom.png') }}" class="img-fluid rounded-3">
        </div>
        <div class="col-12 offset-md-2 col-md-4 mb-5">
            <h3 class="mb-4" style="font-weight: 600">Track your Health</h3>
            <p>
                <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                <span style="font-weight: 100">Steps taken</span>
            </p>
            <p>
                <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                <span style="font-weight: 100">Calories consumed</span>
            </p>
            <p>
                <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                <span style="font-weight: 100">How long you sleep</span>
            </p>
            <p>
                <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                <span style="font-weight: 100">Your motivation</span>
            </p>
            <p>
                <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                <span style="font-weight: 100">Your mood</span>
            </p>
            <p>
                <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                <span style="font-weight: 100">and more!</span>
            </p>

            <a href="{{ route('about') }}" class="btn btn-violet px-5 py-3 mt-3">Learn More <i class="fa-light fa-arrow-right"></i></a>
        </div>
    </div>

    <h2 class="text-black text-center mb-5 mt-5" style="font-weight: 600">Transparent Pricing for You</h2>

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-md-3 mb-5">
            <div class="card text-center">
                <div class="card-header py-3">
                    Pay Per Session
                </div>
                <div class="card-body">
                    <h1 class="mb-4">£30</h1>
                    <p>
                        <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                        <span style="font-weight: 100">Your own PT</span>
                    </p>
                    <p>
                        <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                        <span style="font-weight: 100">Personalised Training Plan</span>
                    </p>
                    <p>
                        <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                        <span style="font-weight: 100">Access to Reporting</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-5">
            <div class="card text-center">
                <div class="card-header py-3">
                    12 Week Block
                </div>
                <div class="card-body">
                    <h1 class="mb-4">£620</h1>
                    <p>
                        <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                        <span style="font-weight: 100">Your own PT</span>
                    </p>
                    <p>
                        <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                        <span style="font-weight: 100">Personalised Training Plan</span>
                    </p>
                    <p>
                        <i class="fa-light fa-circle-check text-purple fa-fw"></i>
                        <span style="font-weight: 100">Access to Reporting</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col">
            <div class="bg-black-chocolate p-5 text-center rounded-3">
                <h2 class="text-ghost-white pt-5 pb-3">
                    Ready to Get Started?
                </h2>
                <p class="text-muted pb-3" style="font-weight: 100">
                    We'd love to have you! Register today and we'll get you started with an Initial Assessment.
                </p>
                <a href="{{ route('register') }}" class="btn btn-violet mt-3 mb-5 px-5 py-3">Get Started <i class="fa-light fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

</div>
@endsection()
