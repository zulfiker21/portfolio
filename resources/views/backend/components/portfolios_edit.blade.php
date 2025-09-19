 @extends('backend.layouts.admin')
 @section('title', 'Portfolios - Edit')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Edit</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">Edit</li>
             </ol>
             <form action="{{ route('admin.portfolios.update', $portfolios->id) }}" method="POST"
                 enctype="multipart/form-data">
                 @csrf
                 {{ method_field('PUT') }}
                 <div class="row">
                     <div class="form-group mt-3">
                         <label for="big_image" class="form-label">Big Image</label>

                         <img id="preview_big" src="{{ asset($portfolios->big_image) }}" alt="Big Image" class="mt-2"
                             width="200">
                         <input type="file" name="big_image" id="big_image" class="form-control mt-2"
                             onchange="previewImage(event, 'preview_big')">
                     </div>
                     <div class="form-group mt-3">
                         <label for="small_image" class="form-label">Small Image</label>

                         <img id="preview_small" src="{{ asset($portfolios->small_image) }}" alt="Small Image"
                             class="mt-2" width="200">
                         <input type="file" name="small_image" id="small_image" class="form-control mt-2"
                             onchange="previewImage(event, 'preview_small')">
                     </div>
                     <div class="form-group mt-3">
                         <div class="mb-3">
                             <label for="title">
                                 <h4>Title</h4>
                             </label>
                             <input type="text" class="form-control" id="title" name="title"
                                 value="{{ $portfolios->title }}">
                         </div>
                         <div class="mb-5">
                             <label for="sub_title">
                                 <h4>Sub Title</h4>
                             </label>
                             <input type="text" class="form-control" id="sub_title" name="sub_title"
                                 value="{{ $portfolios->sub_title }}">
                         </div>
                     </div>
                     <div class="form-group mt-3">
                         <h3>Description</h3>
                         <textarea class="form-control" name="description" rows="5">{{ $portfolios->description }}</textarea>
                     </div>
                     <div class="form-group mt-3">
                         <label for="client">
                             <h4>Client</h4>
                         </label>
                         <input type="text" class="form-control" id="client" name="client"
                             value="{{ $portfolios->client }}">
                     </div>
                        <div class="form-group mt-3">
                         <label for="category">
                             <h4>Category</h4>
                         </label>
                         <input type="text" class="form-control" id="category" name="category"
                             value="{{ $portfolios->category }}">
                     </div>
                 </div>
                 <input type="submit" name="submit" class="btn btn-primary mt-5">
         </div>
         </form>
     </main>
     <script>
         function previewImage(event, previewId) {
             const reader = new FileReader();
             reader.onload = function() {
                 const output = document.getElementById(previewId);
                 output.src = reader.result;
             };
             reader.readAsDataURL(event.target.files[0]);
         }
     </script>
 @endsection
