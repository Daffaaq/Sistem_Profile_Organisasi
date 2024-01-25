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
                <h4>File Update</h4>
            </div>
            <form action="{{ url('/superadmin/File/update/' . $file->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Use PUT method for update -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="upload-box">
                            <div class="mb-3">
                                <label for="file" class="form-label">Current File:</label>
                                <p>{{ $file->name }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="new_file" class="form-label">Choose New File:</label>
                                <input type="file" name="new_file" id="new-file-input" class="form-control"
                                    accept=".pdf, .doc, .docx">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">File Name:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $file->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="category_files_id" class="form-label">Category:</label>
                                <select name="category_files_id" id="category_files_id" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $file->category_files_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name_category_files }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Preview Container -->
                            <div id="file-preview-container"></div>

                            <!-- Button for Preview -->
                            <button type="button" class="btn btn-secondary mt-2" onclick="previewFile()">Preview File</button>
                            <!-- Button to Go Back -->
                            <button type="button" class="btn btn-warning mt-2" onclick="goBack()" style="display:none;">Go Back</button>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <a href="{{ url('/superadmin/File') }}" class="btn btn-secondary custom-button-back mx-auto mr-2">Back</a>
                        <button type="submit" class="btn btn-primary custom-button mx-auto ml-2">Update File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Simpan informasi tentang file yang dipilih
        let selectedFile = null;

        // Simpan referensi ke iframe
        let iframe = null;

        // Function to handle preview button click event
        function previewFile() {
            const fileInput = document.getElementById('new-file-input');
            const previewContainer = document.getElementById('file-preview-container');
            const goBackButton = document.querySelector('.btn-warning');
            const previewButton = document.querySelector('.btn-secondary'); // Tombol "Preview File"

            // Clear previous preview
            previewContainer.innerHTML = '';

            // Check if a file is selected
            if (fileInput.files.length > 0) {
                selectedFile = fileInput.files[0];

                // Check the file type
                if (selectedFile.type.includes('pdf')) {
                    // Create an iframe
                    iframe = document.createElement('iframe');
                    iframe.width = '100%';
                    iframe.height = '600px';
                    iframe.src = URL.createObjectURL(selectedFile);

                    // Append the iframe to the preview container
                    previewContainer.appendChild(iframe);

                    // Show the Go Back button
                    goBackButton.style.display = 'inline-block';

                    // Hide the Preview File button
                    previewButton.style.display = 'none';
                } else {
                    // Display a message for non-PDF files
                    previewContainer.innerHTML = `<p>No preview available for this file type.</p>`;
                }
            }
        }

        // Function to handle Go Back button click event
        function goBack() {
            // Perform actions to go back to the initial state
            // For example, reset form fields or clear the preview container

            // Hapus iframe jika ada
            if (iframe) {
                iframe.parentNode.removeChild(iframe);
            }

            // Clear the selected file
            selectedFile = null;

            // Hide the Go Back button
            document.querySelector('.btn-warning').style.display = 'none';

            // Show the Preview File button
            document.querySelector('.btn-secondary').style.display = 'inline-block';
        }
    </script>
@endsection
