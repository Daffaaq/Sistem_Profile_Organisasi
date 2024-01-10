@extends('superadmin.layouts.index')
@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Category Article</div>

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

                        <form method="POST" action="{{ url('/superadmin/categoryArticle/store') }}">
                            @csrf
                                <!-- Name -->
                                <div class="form-group">
                                    <label for="name">Nama kategori Artikel: </label>
                                    <input type="text" name="name_category_article" id="name_category_article"
                                        class="form-control" required>
                                </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <a href="{{ url('/superadmin/categoryArticle') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Create Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
