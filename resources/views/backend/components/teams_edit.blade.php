 @extends('backend.layouts.admin')
 @section('title', 'Teams - Edit')
 @section('content')
     <main>
         <div class="container-fluid">
             <h1 class="mt-4">Edit</h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                 <li class="breadcrumb-item active">Edit</li>
             </ol>
             <form action="{{ route('admin.teams.update', $teams->id) }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 {{ method_field('PUT') }}
                 <div class="row">
                     <div class="form-group col-md-5 mt-3">
                         <div class="mb-3">
                             <h4>Title</h4>
                             <input type="text" class="form-control" id="title" name="title"
                                 value="{{ $teams->title }}">
                         </div>
                         <div class="mb-5">
                             <h4>Sub-Title</h4>
                             <input type="text" class="form-control" id="sub_title" name="sub_title"
                                 value="{{ $teams->sub_title }}">
                         </div>
                         <div class="mb-5">
                             <h3>Big Image</h3>
                             <img style="height: 20vh" src="{{ url($teams->image) }}" class="img-thumbnail">
                             <input class="mt-3" type="file" id="image" name="image">
                         </div>
                     </div>
                     <div class="form-group col-md-5 mt-3">
                         <div class="mb-3">
                             <h4>Twitter</h4>
                             <input type="text" class="form-control" id="icon" name="twitter"
                                 value="{{ $teams->twitter }}">
                         </div>
                         <div class="mb-5">
                             <h4>Facebook</h4>
                             <input type="text" class="form-control" id="facebook" name="facebook"
                                 value="{{ $teams->facebook }}">
                         </div>
                         <div class="mb-5">
                             <h4>Linkedin</h4>
                             <input type="text" class="form-control" id="linkedin" name="linkedin"
                                 value="{{ $teams->linkedin }}">
                         </div>
                     </div>
                 </div>
                 <input type="submit" name="submit" class="btn btn-primary mb-5">
         </div>
         </form>
     </main>
 @endsection
