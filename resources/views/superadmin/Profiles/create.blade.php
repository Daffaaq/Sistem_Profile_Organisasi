@extends('superadmin.layouts.index')
@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Profile</div>

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

                        <form method="POST" action="{{ url('/superadmin/Profile/store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                    <!-- Bagian kiri form -->
                                    <div class="card">
                                        <div class="card-header">Create New Profile</div>

                                        <div class="card-body">
                                            <!-- Form input untuk informasi profil -->
                                            <!-- Nickname -->
                                            <div class="form-group">
                                                <label for="nickname_profiles">Nickname<span
                                                        style="color: red;">*</span>:</label>
                                                <input type="text" name="nickname_profiles" id="nickname_profiles"
                                                    class="form-control" required>
                                            </div>
                                            <!-- Name -->
                                            <div class="form-group">
                                                <label for="name_profiles">Name<span style="color: red;">*</span>:</label>
                                                <input type="text" name="name_profiles" id="name_profiles"
                                                    class="form-control" required>
                                            </div>
                                            <!-- Address -->
                                            <div class="form-group">
                                                <label for="address_profiles">Address<span
                                                        style="color: red;">*</span>:</label>
                                                <input type="text" name="address_profiles" id="address_profiles"
                                                    class="form-control" required>
                                            </div>
                                            <!-- Phone -->
                                            <div class="form-group">
                                                <label for="phone_profiles">Phone<span style="color: red;">*</span>:</label>
                                                <input type="text" name="phone_profiles" id="phone_profiles"
                                                    class="form-control" required>
                                            </div>
                                            <!-- Email -->
                                            <div class="form-group">
                                                <label for="email_profiles">Email<span style="color: red;">*</span>:</label>
                                                <input type="email" name="email_profiles" id="email_profiles"
                                                    class="form-control" required>
                                            </div>
                                            <!-- Description -->
                                            <div class="form-group">
                                                <label for="description_profiles">Description:</label>
                                                <textarea name="description_profiles" id="description_profiles" class="form-control"></textarea>
                                            </div>
                                            <!-- Logo -->
                                            <div class="form-group">
                                                <label for="logo_profiles">Logo<span style="color: red;">*</span>:</label>
                                                <input type="file" name="logo_profiles" id="logo_profiles"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-5">
                                    <!-- Bagian kanan form -->
                                    <div class="card">
                                        <div class="card-header">Social Media URLs</div>

                                        <div class="card-body">
                                            <!-- Form input untuk URL media sosial -->
                                            <!-- Twitter URL -->
                                            <div class="form-group">
                                                <label for="twitter_url">Twitter URL:</label>
                                                <input type="url" name="twitter_url" id="twitter_url"
                                                    class="form-control">
                                            </div>

                                            <!-- Facebook URL -->
                                            <div class="form-group">
                                                <label for="facebook_url">Facebook URL:</label>
                                                <input type="url" name="facebook_url" id="facebook_url"
                                                    class="form-control">
                                            </div>

                                            <!-- Instagram URL -->
                                            <div class="form-group">
                                                <label for="instagram_url">Instagram URL:</label>
                                                <input type="url" name="instagram_url" id="instagram_url"
                                                    class="form-control">
                                            </div>

                                            <!-- LinkedIn URL -->
                                            <div class="form-group">
                                                <label for="linkedin_url">LinkedIn URL:</label>
                                                <input type="url" name="linkedin_url" id="linkedin_url"
                                                    class="form-control">
                                            </div>

                                            <!-- Line URL -->
                                            <div class="form-group">
                                                <label for="line_url">Line URL:</label>
                                                <input type="url" name="line_url" id="line_url" class="form-control">
                                            </div>

                                            <!-- TikTok URL -->
                                            <div class="form-group">
                                                <label for="tiktok_url">TikTok URL:</label>
                                                <input type="url" name="tiktok_url" id="tiktok_url"
                                                    class="form-control">
                                            </div>

                                            <!-- YouTube URL -->
                                            <div class="form-group">
                                                <label for="youtube_url">YouTube URL:</label>
                                                <input type="url" name="youtube_url" id="youtube_url"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <a href="{{ url('superadmin/Profile') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Create Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
