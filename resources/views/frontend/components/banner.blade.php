        <!-- Masthead-->
        <header class="masthead" style="background-image: url('{{ url($main->bc_img) }}')">
            <div class="container">
                <div class="masthead-subheading">{{ $main->title }}</div>
                <div class="masthead-heading text-uppercase">{{ $main->sub_title }}</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="{{ url($main->resume) }}">Download Resume</a>
            </div>
        </header>
