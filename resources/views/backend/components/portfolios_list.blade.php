 @extends('backend.layouts.admin')
 @section('title', 'Portfolios - List')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Portfolios</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">List of Portfolios</li>
             </ol>
             @if (session('success'))
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                     {{ session('success') }}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @endif
             @if (session('error'))
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     {{ session('error') }}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @endif
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th scope="col">#</th>
                         <th scope="col">Title</th>
                         <th scope="col">Sub-Title</th>
                         <th scope="col">Big Image</th>
                         <th scope="col">Description</th>
                         <th scope="col">Category</th>
                         <th scope="col">Client</th>
                         <th scope="col">Small Image</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse ($portfolios as $portfolio)
                         <tr>
                             <th scope="row">{{ $portfolio->id }}</th>
                             <td>{{ $portfolio->title }}</td>
                             <td>{{ $portfolio->sub_title }}</td>
                             <td>
                                 @if ($portfolio->big_image)
                                     <img src="{{ asset($portfolio->big_image) }}" alt="Big Image" width="100">
                                 @else
                                     N/A
                                 @endif
                             </td>
                             <td>{{ Str::limit(strip_tags($portfolio->description), 40) }}</td>
                             <td>{{ $portfolio->category }}</td>
                             <td>{{ $portfolio->client }}</td>
                             <td>
                                 @if ($portfolio->small_image)
                                     <img src="{{ asset($portfolio->small_image) }}" alt="Small Image" width="100">
                                 @else
                                     N/A
                                 @endif
                             </td>
                             <td>
                                 <div class="d-flex gap-2">
                                     <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}"
                                         class="btn btn-sm btn-primary">Edit</a>
                                     <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST"
                                         onsubmit="return confirm('Are you sure you want to delete this portfolio?');">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                     </form>
                                 </div>
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="9" class="text-center">No portfolios found.</td>
                         </tr>
                     @endforelse

                 </tbody>
             </table>
     </main>
 @endsection
