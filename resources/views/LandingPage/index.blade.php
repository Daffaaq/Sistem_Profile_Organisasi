<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Grayscale - Start Bootstrap Theme</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('landingpage/css/styles.css') }}" rel="stylesheet" />
    {{-- <link href="css/styles.css" rel="stylesheet" /> --}}
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            {{-- <a class="navbar-brand" href="#page-top">Start Bootstrap</a> --}}
            @foreach ($profile as $p)
                <a class="navbar-brand" href="#page-top">{{ $p->nickname_profiles }}</a>
            @endforeach

            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#article">Article</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#aspiration">Aspiration</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                {{-- <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Grayscale</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">A free, responsive, one page Bootstrap theme created by
                        Start Bootstrap.</h2>
                    <a class="btn btn-primary" href="#about">Get Started</a>
                </div> --}}
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    {{-- profiles name_profiles --}}
                    @foreach ($profile as $p)
                        <h2 class="text-white mb-4">{{ $p->name_profiles }}</h2>
                    @endforeach
                    @foreach ($profile as $p)
                        <p class="text-white-50">
                            {{ $p->description_profiles }}
                        </p>
                    @endforeach
                    {{-- profiles description_profiles --}}

                </div>
            </div>
            {{-- <img class="img-fluid" src="assets/img/ipad.png" alt="..." /> --}}
        </div>
    </section>
    <!-- Projects-->
    {{-- articles --}}
    <section class="projects-section bg-light" id="article">
        <div class="container px-4 px-lg-5">
            @foreach ($article as $art)
                <!-- Featured Project Row-->
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-8 col-lg-7">
                        <img class="img-fluid mb-3 mb-lg-0" src="{{ asset('storage/' . $art->image_path_article) }}"
                            alt="{{ $art->title }}" width="300" height="200" />

                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h4>{{ $art->title }}</h4>
                            <p class="text-black-50 mb-0" id="articleDescription{{ $loop->iteration }}">
                                @if (strlen($art->Descriptions) > 100)
                                    {{ substr($art->Descriptions, 0, 100) }}... <a href="#"
                                        onclick="showFullDescription({{ $loop->iteration }})">see more</a>
                                @else
                                    {{ $art->Descriptions }}
                                @endif
                            </p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- galeries --}}
    <section class="projects-section bg-light" id="galeri">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="owl-carousel owl-theme">
                @foreach ($galeries as $galery)
                    <div class="item">
                        <img class="img-fluid mb-3 mb-lg-0"
                            src="{{ asset('storage/' . $galery->image_path_galeries) }}" alt="{{ $galery->title }}"
                            width="300" height="200" />
                        <div class="featured-text text-center text-lg-left">
                            <h4>{{ $galery->title }}</h4>
                            <p class="text-black-50 mb-0">{{ $galery->categoryGalery->name }}</p>
                            <!-- You can add more details from the Galery model as needed -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Signup-->
    {{-- aspiration --}}
    {{-- <section class="signup-section" id="aspiration">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-5">Subscribe to receive updates!</h2>
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- * * SB Forms Contact Form * *-->
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- This form is pre-integrated with SB Forms.-->
                    <!-- To make this form functional, sign up at-->
                    <!-- https://startbootstrap.com/solution/contact-forms-->
                    <!-- to get an API token!-->
                    <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Email address input-->
                        <div class="row input-group-newsletter">
                            <div class="col"><input class="form-control" id="emailAddress" type="email"
                                    placeholder="Enter email address..." aria-label="Enter email address..."
                                    data-sb-validations="required,email" /></div>
                            <div class="col-auto"><button class="btn btn-primary disabled" id="submitButton"
                                    type="submit">Notify Me!</button></div>
                        </div>
                        <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:required">An email is
                            required.</div>
                        <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:email">Email is not valid.
                        </div>
                        <!-- Submit success message-->
                        <!---->
                        <!-- This is what your users will see when the form-->
                        <!-- has successfully submitted-->
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3 mt-2 text-white">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a
                                    href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <!-- Submit error message-->
                        <!---->
                        <!-- This is what your users will see when there is-->
                        <!-- an error submitting the form-->
                        <div class="d-none" id="submitErrorMessage">
                            <div class="text-center text-danger mb-3 mt-2">Error sending message!</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="projects-section bg-light" id="aspiration">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-md-10 col-lg-8 mx-auto">
                    <h2 class="text-center mb-5">Create New Aspiration</h2>
                    <form action="{{ url('/Aspiration') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="tittle_aspirations"
                                placeholder="Enter aspiration title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description_aspirations" rows="3"
                                placeholder="Enter aspiration description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category_aspirations_id" required>
                                @if ($categories->isEmpty())
                                    <option value="" disabled>No categories available</option>
                                @else
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name_category_aspirations }}</option>
                                    @endforeach
                                @endif
                            </select>

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact-->
    <section class="contact-section bg-black">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        {{-- profiles address_profiles --}}
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Address</h4>
                            <hr class="my-4 mx-auto" />
                            @foreach ($profile as $p)
                                <div class="small text-black-50">{{ $p->address_profiles }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        {{-- profiles email_profiles --}}
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Email</h4>
                            <hr class="my-4 mx-auto" />
                            @foreach ($profile as $p)
                                <div class="small text-black-50"><a href="#!">{{ $p->email_profiles }}</a></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        {{-- profiles phone_profiles --}}
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Phone</h4>
                            <hr class="my-4 mx-auto" />
                            @foreach ($profile as $p)
                                <div class="small text-black-50">{{ $p->phone_profiles }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="social d-flex justify-content-center">
                <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">Copyright &copy; Your Website 2023</div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('landingpage/js/scripts.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    {{-- <script src="js/scripts.js"></script> --}}
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah formulir dari pengiriman default

                // Mengirim data formulir menggunakan fetch API
                fetch('{{ url('/Aspiration') }}', {
                        method: 'POST',
                        body: new FormData(form)
                    })
                    .then(response => response.json()) // Mengubah respon menjadi objek JSON
                    .then(data => {
                        if (data.success) {
                            // Menampilkan SweetAlert jika aspirasi berhasil dibuat
                            showSweetAlert('Success', data.success, 'success');
                            setTimeout(() => {
                                window.location.href = '{{ url('/') }}';
                            }, 2000);
                        } else if (data.error) {
                            // Menampilkan SweetAlert jika terjadi kesalahan saat membuat aspirasi
                            showSweetAlert('Error', data.error, 'error');
                        } else {
                            // Menampilkan SweetAlert jika terjadi kesalahan yang tidak diketahui
                            showSweetAlert('Error', 'Failed to create aspiration. Please try again.',
                                'error');
                        }
                    })
                    .catch(error => {
                        // Menampilkan SweetAlert jika terjadi kesalahan pada saat mengirim permintaan
                        showSweetAlert('Error', 'An error occurred. Please try again later.', 'error');
                    });
            });

            function showSweetAlert(title, text, icon) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const categorySelect = document.getElementById('category');
            const submitButton = document.querySelector('button[type="submit"]');

            // Mengatur status awal tombol submit
            submitButton.disabled = categorySelect.value === '';

            // Memantau perubahan pada pilihan kategori
            categorySelect.addEventListener('change', function() {
                submitButton.disabled = categorySelect.value === '';
            });

            // Menangani submit form
            form.addEventListener('submit', function(event) {
                if (submitButton.disabled) {
                    event.preventDefault(); // Mencegah pengiriman formulir jika tombol submit dinonaktifkan
                    // Tambahkan pesan atau tindakan lain di sini jika diperlukan
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false
                    }
                }
            });
        });
    </script>
</body>

</html>
