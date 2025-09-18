              <!-- Masthead-->
              <header class="masthead" style="background-image: url('{{ asset($main?->bc_img ?? null) }}')">????
                  <div class="container">
                      <div class="masthead-subheading">{{ $main?->title }}</div>
                      <div class="masthead-heading text-uppercase">{{ $main?->sub_title }}</div>
                      <a class="btn btn-primary btn-xl text-uppercase" href="{{ asset($main?->resume) }}">Download
                          Resume</a>
                  </div>
              </header>
