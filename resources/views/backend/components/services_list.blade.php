 @extends('backend.layouts.admin')
 @section('title', 'Services - List')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Services</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">List of Services</li>
             </ol>
              <form method="GET" action="{{ route('admin.services.list') }}" class="mb-3">
                 <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search users..."
                     style="width: 500px; padding: 10px; border: 1px solid #ccc;">
                 <button style="padding: 10px 20px; color: #464343ff; border: none; cursor: pointer;"
                     type="submit">Search</button>
             </form>
             {{-- Success & Error Message --}}
             @if (session('success'))
                 <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                     {{ session('success') }}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @endif
             @if (session('error'))
                 <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                     {{ session('error') }}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @endif
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th scope="col">#</th>
                         <th scope="col">Title</th>
                         <th scope="col">Description</th>
                         <th scope="col">Icon</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse ($services as $service)
                         <tr>
                             <th scope="row">{{ $service->id }}</th>
                             <td>{{ $service->title }}</td>
                             <td>{{ Str::limit(strip_tags($service->description), 40) }}</td>
                              <td>{{ $service->icon }}</td>
                             <td>
                                 <div class="d-flex gap-2">
                                     <a href="{{ route('admin.services.edit', $service->id) }}"
                                         class="btn btn-sm btn-primary">Edit</a>
                                     <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-sm btn-danger"
                                             onclick="return confirm('Are you sure?')">Delete</button>
                                     </form>
                                 </div>
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="8" class="text-center">No services found.</td>
                         </tr>
                     @endforelse

                 </tbody>
             </table>
     </main>
 @endsection
