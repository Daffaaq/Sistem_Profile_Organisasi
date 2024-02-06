@extends('superadmin.layouts.index')
@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>

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

                        <form method="POST" action="{{ url('/superadmin/Profile/update/' . $profile->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Name -->
                            <div class="form-group">
                                <label for="nickname_profiles">Nickname:</label>
                                <input type="text" name="nickname_profiles" id="nickname_profiles" class="form-control"
                                    value="{{ $profile->nickname_profiles }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name_profiles">Name:</label>
                                <input type="text" name="name_profiles" id="name_profiles" class="form-control"
                                    value="{{ $profile->name_profiles }}" required>
                            </div>
                            <!-- Address -->
                            <div class="form-group">
                                <label for="address_profiles">Address:</label>
                                <input type="text" name="address_profiles" id="address_profiles" class="form-control"
                                    value="{{ $profile->address_profiles }}" required>
                            </div>
                            <!-- Phone -->
                            <div class="form-group">
                                <label for="phone_profiles">Phone:</label>
                                <input type="text" name="phone_profiles" id="phone_profiles" class="form-control"
                                    value="{{ $profile->phone_profiles }}" required>
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email_profiles">Email:</label>
                                <input type="email" name="email_profiles" id="email_profiles" class="form-control"
                                    value="{{ $profile->email_profiles }}" required>
                            </div>
                            <!-- Description -->
                            <div class="form-group">
                                <label for="description_profiles">Description:</label>
                                <textarea name="description_profiles" id="description_profiles" class="form-control">{{ $profile->description_profiles }}</textarea>
                            </div>
                            <!-- Logo -->
                            <div class="form-group">
                                <label for="logo_profiles">Logo:</label>
                                <input type="file" name="logo_profiles" id="logo_profiles" class="form-control">
                            </div>

                            <!-- Submit Button -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <a href="{{ url('superadmin/Profile') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
