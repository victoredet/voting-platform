@extends('layouts.home.home')

@section('homeLayout')

<section class="contact">

    <div class="container py-4" data-aos="fade-up">

        <header class="section-header">
            <p>Welcome back</p>
        </header>

        <div class="row gy-4">
            <div class="col-lg-6 mx-auto">
                <form action="{{url('login')}}" method="post" class="php-email-form">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>

                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>

                            <button type="submit">Sign In</button>
                        </div>

                    </div>
                </form>

            </div>

        </div>

    </div>

</section>

@endsection
