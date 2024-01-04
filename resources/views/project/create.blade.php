@extends('layouts.app') @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Project</h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Project</a></li>
                        <li class="breadcrumb-item active">Create Project</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Project</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('project.store') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name<span class="text-danger">*</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Enter name">

                                    @error('name')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- @push('child-scripts')
    <script>
        $(document).ready(function() {
            $("#pieces").select2({
                tags: true,
            });
            $(document).ready(function() {
                if ($("#pieces").hasClass("is-invalid")) {
                    $("#pieces").next(".select2-container").find(".select2-selection").css("border-color",
                        "red");
                }
            });

            function resetBorderColor() {
                $("#pieces").removeClass("is-invalid");
                $("#pieces").next(".select2-container").find(".select2-selection").css("border-color", "");
            }

            $("#pieces").on("change", function() {
                resetBorderColor();
            });
            $("#summernote").summernote({
                height: 300,
                focus: true,
            });
            if ($("#summernote").hasClass("is-invalid")) {
                $("#summernote").next(".note-editor").css("border-color", "red");
            }
            $("#blog_category,#blog_slug,#blog_tittle,#blog_description,#blog_image1,#blog_image2,#blog_authorname,#blog_date")
                .on("input", function() {
                    removeErrorMessages($(this));
                });

            $("#summernote").on("summernote.change", function(we, contents, $editable) {
                resetSummernoteBorder();
            });

            function resetSummernoteBorder() {
                $("#summernote").removeClass("is-invalid");
                $("#summernote").next(".note-editor").css("border-color", "");
            }
            $("#blog_tittle").on("input", function() {
                removeErrorMessages($(this));
                convertToSlug();
            });
            var blogtitle = $("#blog_tittle");
            var slugField = $("#blog_slug");

            function removeErrorMessages(inputField) {
                var parent = inputField.closest('.form-group');
                var errorElement = parent.find('.error');
                errorElement.remove();
                inputField.removeClass('is-invalid');
            }

            blogtitle.on('change', function() {
                convertToSlug();
                removeErrorMessages(slugField);
            });

            slugField.on('input', function() {
                removeErrorMessages(slugField);
            });
            function convertToSlug() {
                var category_name = $("#blog_tittle ").val();
                var str = category_name;

                str = str
                    .toLowerCase()
                    .replace(/[^a-z0-9\s]/g, "")
                    .replace(/\s+/g, "-");
                $("#blog_slug").val(str);
            }
        });
    </script>
@endpush --}}






{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
{{-- <div class="container-fluid"> --}}
<!-- Content Header (Page header) -->
{{-- <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Category</h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category</a></li>

                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section> --}}
<!-- Main content -->
{{-- <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Project</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('project.store') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name<span class="text-danger">*</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Enter name">

                                    @error('name')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> --}}
{{-- @endsection --}}
