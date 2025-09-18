        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row">
                    @foreach ($teams as $team)
                        <div class="col-lg-4">
                            <div class="team-member">
                                <img class="mx-auto rounded-circle" src="{{ asset($team->image) }}"
                                    alt="{{ $team->title }}" />
                                <h4>{{ $team->title }}</h4>
                                <p class="text-muted">{{ $team->sub_title }}</p>

                                @if ($team->twitter)
                                    <a class="btn btn-dark btn-social mx-2" href="{{ $team->twitter }}"
                                        target="_blank"><i class="fab fa-twitter"></i></a>
                                @endif

                                @if ($team->facebook)
                                    <a class="btn btn-dark btn-social mx-2" href="{{ $team->facebook }}"
                                        target="_blank"><i class="fab fa-facebook-f"></i></a>
                                @endif

                                @if ($team->linkedin)
                                    <a class="btn btn-dark btn-social mx-2" href="{{ $team->linkedin }}"
                                        target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque,
                            laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Clients-->
        <div class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto"
                                src="assets/img/logos/microsoft.svg" alt="..." aria-label="Microsoft Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto"
                                src="assets/img/logos/google.svg" alt="..." aria-label="Google Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto"
                                src="assets/img/logos/facebook.svg" alt="..." aria-label="Facebook Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto"
                                src="assets/img/logos/ibm.svg" alt="..." aria-label="IBM Logo" /></a>
                    </div>
                </div>
            </div>
        </div>
