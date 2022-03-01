<div>
    <header wire:ignore id="header" class="d-flex align-items-center ">
        <div class="container-fluid container-xxl d-flex align-items-center">

            <div id="logo" class="me-auto">
                <!-- Uncomment below if you prefer to use a text logo -->
                <!-- <h1><a href="index.html">The<span>Event</span></a></h1>-->
            </div>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#speakers">Team</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
            <a class="buy-tickets scrollto" href="{{ route('register') }}">Sign Up</a>
            <a class="buy-tickets scrollto" href="{{ route('login') }}">Login</a>

        </div>
    </header>
    <!-- End Header -->

    <!--Body-->
    <section wire:ignore id="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <h1 class="mb-4 pb-0">Sistem <span>Informasi </span>Alumni</h1>
        </div>
    </section>


    <main id="main">


        <section wire:ignore id="about">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>About SisinfoAlumni</h2>
                        <p>SMK Multistudi High School is a vocational education institution that was founded in 2007
                            with a focus on innovation, achievement and noble character. Through innovation, MHS
                            Vocational High School implements and mixes a vocational
                            education system that best suits the needs of today's world of work, requiring students
                            to
                            be proactive and become pioneers for development. SMK MHS also focuses on the learning
                            process on the mental and spiritual formation
                            of its students so that they have noble character and behavior. With a vision to become
                            a
                            modern school with a global perspective and personality supported by Human Resources and
                            complete infrastructure, MHS is ready to give
                            birth to a generation that is reliable and capable of facing a better future.
                        </p>
                    </div>
                    <div class="col-lg-3">
                        <h3>Where</h3>
                        <p>Gedong Gapuro JL. Kuda Laut Kav.121 Batuampar Batam 2945</p>
                    </div>
                    <div class="col-lg-3">
                        <h3>When</h3>
                        <p>Monday to Wednesday<br>10-12 December</p>
                    </div>
                </div>
            </div>
        </section>

        <section wire:ignore id="speakers">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Team</h2>
                </div>

                <div class="row">

                    @foreach ($teams as $team)
                        <div class="col-lg-4 col-md-6">
                            <div class="speaker" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset('storage/teams/' . $team->photo) }}" alt="{{ $team->photo }}"
                                    class="img-fluid">
                                <div class="details">
                                    <h3><a href="speaker-details.html">{{ $team->name }}</a></h3>
                                    <p>{{ $team->desc }}</p>
                                    <div class="social">
                                        @if ($team->link_twitter)
                                            <a href="{{ $team->link_twitter }}" target="_blank"><i
                                                    class="bi bi-twitter"></i></a>
                                        @endif
                                        @if ($team->link_fb)
                                            <a href="{{ $team->link_fb }}" target="_blank"><i
                                                    class="bi bi-facebook"></i></a>
                                        @endif
                                        @if ($team->link_ig)
                                            <a href="{{ $team->link_ig }}" target="_blank"><i
                                                    class="bi bi-instagram"></i></a>
                                        @endif
                                        @if ($team->link_in)
                                            <a href="{{ $team->link_in }}" target="_blank"><i
                                                    class="bi bi-linkedin"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </section>
        <!-- Team -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="section-bg">

            <div wire:ignore.self class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Contact Us</h2>

                </div>
                <div class="alert alert-light shadow text-warning" wire:offline>
                    <i class="bi bi-exclamation-circle-fill"></i> You are offline. Sending Contact may not work.
                </div>
                <div class="row contact-info">

                    <div class="col-md-4">
                        <div class="contact-address">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <address>Gedong Gapuro JL. Kuda Laut Kav.121 Batuampar Batam 2945</address>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="bi bi-phone"></i>
                            <h3>Phone Number</h3>
                            <p><a href="tel:0778 - 422859">0778 - 422859</a></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:info@multistudi.sch.id">info@multistudi.sch.id</a></p>
                        </div>
                    </div>

                </div>
                <div class="alert alert-light shadow text-primary w-50" wire:loading wire:target='sendContact'>
                    <div class="spinner-border text-primary" role="status"></div>
                    <span>Sending...</span>
                </div>
                <div wire:loading.remove wire:target='sendContact' class="form">
                    <form wire:submit.prevent='sendContact' class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Your Name" required {!! wireModel('name') !!}
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="Your Email" required {!! wireModel('email') !!}
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                name="subject" id="subject" placeholder="Subject" required {!! wireModel('subject') !!}
                                value="{{ old('subject') }}">
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message"
                                rows="5" placeholder="Message" required
                                {!! wireModel('message') !!}> {{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center mt-3"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>
        </section>


    </main>

    <!--End Body-->
</div>
</div>
