 @extends('backend.layouts.admin')
 @section('title', 'Abouts - Create')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Abouts</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">Create</li>
             </ol>
             <form action="{{ route('admin.abouts.store') }}" method="POST" enctype="multipart/form-data">
                 @csrf
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


                 <div class="row">
                     <div class="form-group col-md-4 mt-3">
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
                             <label for="sub_title">
                                 <h4>Sub Title</h4>
                             </label>
                             <input type="text" class="form-control" id="sub_title" name="sub_title"
                                 value="{{ old('sub_title') }}">
                             @error('sub_title')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                         <div class="mb-3">
                             <label for="title">
                                 <h4>Description</h4>
                             </label>
                             <input type="text" class="form-control" id="description" name="description"
                                 value="{{ old('description') }}">
                             @error('description')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                         <div class="mb-3">
                             <h3>Big Image</h3>
                             <img id="about_image_preview" style="display: block" src="" class="img-fluid">
                             <input class="form-control" type="file" id="image" name="image">
                             @error('image')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                         <input type="submit" name="submit" class="btn btn-primary mt-3">
                     </div>
                 </div>
         </div>
         </form>
     </main>
     <script>
         document.getElementById('image').addEventListener('change', function(event) {
             let preview = document.getElementById('about_image_preview');
             let file = event.target.files[0];

             if (file) {
                 preview.src = URL.createObjectURL(file);
                 preview.style.display = 'block';
             }
         });
     </script>
 @endsection
