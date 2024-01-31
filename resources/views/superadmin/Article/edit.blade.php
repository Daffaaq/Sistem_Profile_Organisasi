@extends('superadmin.layouts.index')
@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Article</div>

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

                        <form method="POST" action="{{ url('/superadmin/Article/update/' . $article->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Title -->
                            <div class="form-group">
                                <label for="category_articles_id">Category:</label>
                                <select name="category_articles_id" id="category_articles_id" class="form-control" required>
                                    @foreach ($categoryArticle as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $article->category_articles_id ? 'selected' : '' }}>
                                            {{ $category->name_category_article }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $article->title }}" required>
                            </div>
                            <!-- Description -->
                            <div class="form-group">
                                <label for="Descriptions">Description:</label>
                                <textarea name="Descriptions" id="Descriptions" class="form-control" style="height: 150px; resize: vertical;" required>{{ $article->Descriptions }}</textarea>
                            </div>

                            <!-- Image Path -->
                            <div class="form-group">
                                <label for="image_path_article">Image:</label>
                                <input type="file" name="image_path_article" id="image_path_article"
                                    class="form-control-file">
                            </div>
                            <!-- Category -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <a href="{{ url('/superadmin/Article') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Update Article</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
