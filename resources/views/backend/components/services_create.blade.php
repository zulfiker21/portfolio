 @extends('backend.layouts.admin')
 @section('title', 'Services - Create')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Services</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">Create</li>
             </ol>
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
             <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <div class="row">
                     <div class="form-group col-md-5 mt-3">
                         <div class="mb-3">
                             <label for="icon">
                                 <h4>Font Awesome Icon</h4>
                             </label>
                             <input type="text" class="form-control" id="icon" name="icon"
                                 value="{{ old('icon') }}">
                             @error('icon')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                         <div class="mb-3">
                             <label for="title">
                                 <h4>Title</h4>
                             </label>
                             <input type="text" class="form-control" id="title" name="title"
                                 value="{{ old('title') }}">
                             @error('title')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                         <div class="mb-3">
                             <label for="description">
                                 <h4>Description</h4>
                             </label>
                             <textarea type="text" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                             @error('description')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                 </div>
                 <input type="submit" name="submit" class="btn btn-primary mt-3">
         </div>
         </form>
     </main>
 @endsection
