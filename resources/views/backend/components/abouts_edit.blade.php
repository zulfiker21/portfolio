 @extends('backend.layouts.admin')
 @section('title', 'Abouts - Edit')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Abouts</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">Create</li>
             </ol>
             <form action="{{ route('admin.abouts.update', $abouts->id) }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 {{ method_field('PUT') }}
                 <div class="row">
                     <div class="form-group col-md-6 mt-3">
                         <div class="mb-2">
                             <h3>Big Image</h3>
                             <img style="height: 30vh; display: block" src="{{ url($abouts->image) }}"
                                 class="img-thumbnail">
                             <input class="mt-3" type="file" id="image" name="image"
                                 value="{{ $abouts->image }}">
                         </div>
                     </div>
                     <div class="form-group col-md-4 mt-3">
                         <div class="mb-3">
                             <label for="title">
                                 <h4>Title</h4>
                             </label>
                             <input type="text" class="form-control" id="title" name="title"
                                 value="{{ $abouts->title }}">
                         </div>
                         <div class="mb-3">
                             <label for="sub_title">
                                 <h4>Sub Title</h4>
                             </label>
                             <input type="text" class="form-control" id="sub_title" name="sub_title"
                                 value="{{ $abouts->sub_title }}">
                         </div>
                         <div class="mb-3">
                             <label for="title">
                                 <h4>Description</h4>
                             </label>
                             <input type="text" class="form-control" id="description" name="description"
                                 value="{{ $abouts->description }}">
                         </div>
                     </div>
                 </div>
                 <input type="submit" name="submit" class="btn btn-primary mt-2">
         </div>
         </form>
     </main>
 @endsection
