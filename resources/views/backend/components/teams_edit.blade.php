@extends('backend.layouts.admin')
@section('title', 'Teams - Edit')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Teams</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>

        <form action="{{ route('admin.teams.update', $teams->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- Image Upload with Preview --}}
                <div class="form-group col-md-6 mt-3">
                    <div class="mb-2">
                        <label for="image" class="form-label">
                            <h4>Image</h4>
                        </label>
                        <input type="file" name="image" id="image" class="form-control"
                               onchange="previewImage(event, 'preview_image')">

                        <img id="preview_image"
                             src="{{ asset($teams->image) }}"
                             alt="Team Image"
                             class="img-thumbnail mt-2"
                             style="max-height: 200px;">
                    </div>
                </div>

                {{-- Text Fields --}}
                <div class="form-group col-md-6 mt-3">
                    <div class="mb-3">
                        <label for="title"><h4>Title</h4></label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="{{ $teams->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="sub_title"><h4>Sub Title</h4></label>
                        <input type="text" class="form-control" id="sub_title" name="sub_title"
                               value="{{ $teams->sub_title }}">
                    </div>
                    <div class="mb-3">
                        <label for="twitter"><h4>Twitter</h4></label>
                        <input type="text" class="form-control" id="twitter" name="twitter"
                               value="{{ $teams->twitter }}">
                    </div>
                    <div class="mb-3">
                        <label for="facebook"><h4>Facebook</h4></label>
                        <input type="text" class="form-control" id="facebook" name="facebook"
                               value="{{ $teams->facebook }}">
                    </div>
                    <div class="mb-3">
                        <label for="linkedin"><h4>LinkedIn</h4></label>
                        <input type="text" class="form-control" id="linkedin" name="linkedin"
                               value="{{ $teams->linkedin }}">
                    </div>
                </div>
            </div>

            <input type="submit" name="submit" class="btn btn-primary mt-2" value="Update">
        </form>
    </div>
</main>

{{-- Image Preview Script --}}
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
