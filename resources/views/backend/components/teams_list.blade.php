 @extends('backend.layouts.admin')
 @section('title', 'Teams - List')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Teams</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">List of Teams</li>
             </ol>
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
                         <th scope="col">Sub-Title</th>
                         <th scope="col">Image</th>
                         <th scope="col">Facebook</th>
                         <th scope="col">Twitter</th>
                         <th scope="col">Linkedin</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse ($teams as $team)
                         <tr>
                             <th scope="row">{{ $team->id }}</th>
                             <td>{{ $team->title }}</td>
                             <td>{{ $team->sub_title }}</td>
                             <td>
                                 @if ($team->image)
                                     <img src="{{ asset($team->image) }}" alt="Team Image" width="50">
                                 @else
                                     N/A
                                 @endif
                             </td>
                             <td>{{ Str::limit($team->facebook ?? 'N/A', 10) }}</td>
                             <td>{{ Str::limit($team->twitter ?? 'N/A', 10) }}</td>
                             <td>{{ Str::limit($team->linkedin ?? 'N/A', 10) }}</td>
                             <td>
                                 <div class="d-flex gap-2">
                                     <a href="{{ route('admin.teams.edit', $team->id) }}"
                                         class="btn btn-sm btn-primary">Edit</a>
                                     <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST">
                                         @csrf
                                         @method('DELETE')
                                         <button class="btn btn-sm btn-danger"
                                             onclick="return confirm('Are you sure?')">Delete</button>
                                     </form>
                                 </div>
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="8" class="text-center">No teams found.</td>
                         </tr>
                     @endforelse


                 </tbody>
             </table>
     </main>
 @endsection
