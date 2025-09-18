 @extends('backend.layouts.admin')
 @section('title', 'Teams - Create')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Teams</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">Create</li>
             </ol>
             <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 {{ method_field('PUT') }}

                 <div class="row">
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
                     <div class="form-group col-md-5 mt-3">
                         <div class="mb-3">
                             <h4>Title</h4>
                             <input type="text" class="form-control" id="title" name="title"
                                 value="{{ old('title') }}">
                             @error('title')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                         <div class="mb-3">
                             <h4>Sub-Title</h4>
                             <input type="text" class="form-control" id="sub_title" name="sub_title"
                                 value="{{ old('sub_title') }}">
                             @error('sub_title')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                         <div class="mb-3">
                             <h3>Image</h3>

                             <img id="big_image_preview" style="display:block;"
                                 src="{{ old('image') ? asset('storage/' . old('image')) : '' }}" class="img-fluid mb-2">

                             <input class="form-control" type="file" id="image" name="image">

                             @error('image')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>

                     </div>
                     <div class="form-group col-md-5 mt-3">
                         <div class="mb-3">
                             <h4>Twitter</h4>
                             <input type="text" class="form-control" id="icon" name="twitter"
                                 value="{{ old('twitter') }}">
                             @error('twitter')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                         <div class="mb-4">
                             <h4>Facebook</h4>
                             <input type="text" class="form-control" id="facebook" name="facebook"
                                 value="{{ old('facebook') }}">
                             @error('facebook')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                         <div>
                             <h4>Linkedin</h4>
                             <input type="text" class="form-control" id="linkedin" name="linkedin"
                                 value="{{ old('linkedin') }}">
                             @error('linkedin')
                                 <div class="text-danger small mt-1">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>
                 </div>
                 <input type="submit" name="submit" class="btn btn-primary mt-3">
         </div>
         </form>
     </main>
     <script>
         document.getElementById('image').addEventListener('change', function(event) {
             let preview = document.getElementById('big_image_preview');
             let file = event.target.files[0];

             if (file) {
                 preview.src = URL.createObjectURL(file);
                 preview.style.display = 'block';
             }
         });
     </script>
 @endsection
