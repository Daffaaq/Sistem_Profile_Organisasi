@extends('superadmin.layouts.index')

@section('container')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('failed'))
            <div class="alert alert-danger mt-3">
                {{ session('failed') }}
            </div>
        @endif

        <div class="upload-container">
            <div class="upload-title">
                <h4>File Upload</h4>
            </div>
            <form action="{{ url('/superadmin/File/store') }}" method="post" enctype="multipart/form-data" id="file-upload"
                class="dropzone">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="upload-box">
                            <div class="mb-3">
                                <label for="file" class="form-label visually-hidden">Choose File:</label>
                                <div class="dropzone" id="file-dropzone">
                                    <input type="file" name="file" id="file-input"
                                        class="form-control visually-hidden" accept=".pdf, .doc, .docx"
                                        style="display:none;" required>
                                    <div class="dz-message" data-dz-message>
                                        <div class="icon" onclick="document.getElementById('file-input').click()">
                                            <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                        </div>
                                        <p>Click or drag & drop to upload</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-box">
                            <div class="mb-3">
                                <label for="name" class="form-label">File Name:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="category_files_id" class="form-label">Category:</label>
                                <select name="category_files_id" id="category_files_id" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name_category_files }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload File</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        Dropzone.options.fileUpload = {
            maxFilesize: 1000,
            acceptedFiles: ".pdf, .doc, .docx"
            // previewTemplate: '',
        };
    </script>
@endsection
