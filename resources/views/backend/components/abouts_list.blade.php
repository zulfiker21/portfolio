 @extends('backend.layouts.admin')
 @section('title', 'Abouts - List')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Abouts</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">List of Abouts</li>
             </ol>
             <form method="GET" action="{{ route('admin.abouts.list') }}" class="mb-3">
                 <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search users..."
                     style="width: 500px; padding: 10px; border: 1px solid #ccc;">
                 <button style="padding: 10px 20px; color: #464343ff; border: none; cursor: pointer;"
                     type="submit">Search</button>
             </form>
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
                         <th scope="col">Image</th>
                         <th scope="col">Description</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse ($abouts as $about)
                         <tr>
                             <th scope="row">{{ $about->id }}</th>
                             <td>{{ $about->title }}</td>
                             <td>{{ $about->sub_title }}</td>
                             <td>
                                 @if ($about->image)
                                     <img src="{{ asset($about->image) }}" alt="About Image" width="80">
                                 @else
                                     N/A
                                 @endif
                             </td>
                             <td>{{ Str::limit(strip_tags($about->description), 60) }}</td>
                             <td>
                                 <div class="d-flex gap-2">
                                     <a href="{{ route('admin.abouts.edit', $about->id) }}"
                                         class="btn btn-sm btn-primary">Edit</a>
                                     <form action="{{ route('admin.abouts.destroy', $about->id) }}" method="POST"
                                         onsubmit="return confirm('Are you sure you want to delete this about?');">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                     </form>
                                 </div>
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="6" class="text-center">No about records found.</td>
                         </tr>
                     @endforelse

                 </tbody>
             </table>
     </main>
 @endsection
