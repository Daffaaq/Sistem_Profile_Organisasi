@extends('admin.layouts.index')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Aspiration</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ url('/admin/Aspiration/update/'. $aspiration->id) }}">
                            @csrf
                            @method('PUT')
                            <!-- Title -->
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="tittle_aspirations" id="tittle_aspirations"
                                       class="form-control" value="{{ $aspiration->tittle_aspirations }}" required>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description_aspirations" id="description_aspirations"
                                          class="form-control" required>{{ $aspiration->description_aspirations }}</textarea>
                            </div>

                            <!-- Category -->
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category_aspirations_id" id="category_aspirations_id"
                                        class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                                {{ $aspiration->category_aspirations_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name_category_aspirations }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <a href="{{ url('/admin/Aspiration') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Update Aspiration</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
