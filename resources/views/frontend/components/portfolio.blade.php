        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Portfolio</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row">
                    @foreach ($portfolios as $portfolio)
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <!-- Portfolio item -->
                            <div class="portfolio-item">
                                <a class="portfolio-link" data-bs-toggle="modal"
                                    href="#portfolioModal{{ $portfolio->id }}">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="{{ asset($portfolio->small_image) }}" alt="..." />
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">{{ $portfolio->client }}</div>
                                    <div class="portfolio-caption-subheading text-muted">{{ $portfolio->category }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        @foreach ($portfolios as $portfolio)
            <div class="portfolio-modal modal fade" id="portfolioModal{{ $portfolio->id }}" tabindex="-1"
                role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="close-modal" data-bs-dismiss="modal">
                            <img src="{{ asset('assets/img/close-icon.svg') }}" alt="Close modal" />
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="modal-body">
                                        <!-- Project details-->
                                        <h2 class="text-uppercase">{{ $portfolio->title }}</h2>
                                        <p class="item-intro text-muted">{{ $portfolio->sub_title }}</p>
                                        <img class="img-fluid d-block mx-auto" src="{{ asset($portfolio->big_image) }}"
                                            alt="..." />
                                        <p>{{ $portfolio->description }}</p>
                                        <ul class="list-inline">
                                            <li>
                                                <strong>Client:</strong>
                                                {{ $portfolio->client }}
                                            </li>
                                            <li>
                                                <strong>Category:</strong>
                                                {{ $portfolio->category }}
                                            </li>
                                        </ul>
                                        <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal"
                                            type="button">
                                            <i class="fas fa-xmark me-1"></i>
                                            Close Project
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
