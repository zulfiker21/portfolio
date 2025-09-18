        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row text-center">
                    @if ($services->isNotEmpty())
                        @foreach ($services as $service)
                            <div class="col-md-4">
                                <span class="fa-stack fa-4x">
                                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                    <i class="{{ $service->icon }} fa-stack-1x fa-inverse"></i>
                                </span>
                                <h4 class="my-3">{{ $service->title }}</h4>
                                <p class="text-muted">{{ $service->description }}</p>
                            </div>
                        @endforeach
                    @else
                        <div>
                            <p>No services found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
