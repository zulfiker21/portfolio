 @extends('backend.layouts.admin')
 @section('title', 'Dashboard - Admin')
 @section('content')
     @php
         $cards = [
             ['title' => 'Main', 'route' => 'admin.main', 'bg' => 'primary'],
             ['title' => 'Services', 'route' => 'admin.services.list', 'bg' => 'success'],
             ['title' => 'Portfolios', 'route' => 'admin.portfolios.list', 'bg' => 'warning'],
             ['title' => 'Abouts', 'route' => 'admin.abouts.list', 'bg' => 'secondary'],
             ['title' => 'Teams', 'route' => 'admin.teams.list', 'bg' => 'danger'],
             ['title' => 'Contacts', 'route' => 'admin.contacts.list', 'bg' => 'info'],
         ];
     @endphp
     <main>
         <div class="container-fluid px-4">
             <h1 class="mt-4">Dashboard</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">Dashboard</li>
             </ol>

             <div class="row">
                 @foreach ($cards as $card)
                     <div class="col-md-3 mb-4">
                         <div class="card text-white bg-{{ $card['bg'] }} h-100">
                             <div class="card-body">
                                 <div class="card-title fs-5">{{ $card['title'] }}</div>
                             </div>
                             <div class="card-footer d-flex align-items-center justify-content-center">
                                 <a class="text-white stretched-link text-decoration-none"
                                     href="{{ route($card['route']) }}">View Details</a>
                                 <i class="fas fa-arrow-circle-right fa-lg text-white-50 ms-2"></i>
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </main>

 @endsection
