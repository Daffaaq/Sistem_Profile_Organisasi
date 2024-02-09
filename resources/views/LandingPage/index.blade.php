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
    {{-- <section class="projects-section bg-light" id="article">
        <div class="container px-4 px-lg-5">
            <div class="row">
                @foreach ($article as $art)
                    <div class="col-lg-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('storage/' . $art->image_path_article) }}" class="card-img-top"
                                alt="{{ $art->title }}" width="300" height="200" />
                            <div class="card-body">
                                <h5 class="card-title">{{ $art->title }}</h5>
                                <p class="card-text">
                                    @if (strlen($art->Descriptions) > 100)
                                        {{ substr($art->Descriptions, 0, 100) }}... <a href="#"
                                            onclick="showFullDescription({{ $loop->iteration }})">see more</a>
                                    @else
                                        {{ $art->Descriptions }}
                                    @endif
                                </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">{{ $art->categoryArticle->name_category_article }}</li>
                            </ul>
                            <div class="card-footer">
                                <!-- Menampilkan tanggal pembuatan artikel dengan pemisah dalam badge Bootstrap -->
                                <span class="badge bg-secondary">{{ $art->created_date }}</span>
                                <span class="badge bg-secondary">{{ $art->created_time }}</span>
                                <span class="badge bg-secondary">{{ $art->user->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="text-center" style="margin-top: 0px;">
            <a href="{{ url('landingpage/article') }}" class="btn btn-primary"
                style="width: 300px; height: 35px; padding: 0;">
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                    Berita Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </a>
        </div>
    </section> --}}
    <section class="projects-section bg-light" id="article">
        <div class="container px-4 px-lg-5">
            <div class="row">
                @foreach ($article as $art)
                    <div class="col-lg-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('storage/' . $art->image_path_article) }}" class="card-img-top"
                                alt="{{ $art->title }}" width="350" height="240" />
                        </div> <br>
                        <div class="card-title" style="max-width: 350px;">
                            <h3 style="font-size: 20px; word-wrap: break-word;">{{ $art->title }}</h3>
                        </div>
                        {{-- <div class="card" style="width: 18rem;">
                            <div style="display: flex; flex-wrap: wrap;">
                                <img src="{{ asset('storage/' . $art->image_path_article) }}" class="card-img-top"
                                    alt="{{ $art->title }}" width="350" height="250" />
                            </div>
                            <div class="card-title" style="max-width: 350px;">
                                <h3 style="font-size: 20px; word-wrap: break-word;">{{ $art->title }}</h3>
                            </div>
                        </div> --}}


                        <div class="card-text">
                            <p>
                                <a href="#" onclick="showFullDescription({{ $loop->iteration }})">Baca
                                    Selengkapnya</a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="text-center" style="margin-top: 0px;">
            <a href="{{ url('landingpage/article') }}" class="btn btn-primary"
                style="width: 300px; height: 35px; padding: 0;">
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                    Berita Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </a>
        </div>
    </section>






    {{-- <section class="projects-section bg-light" id="galeri">
        <div class="container px-4 px-lg-5">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($galeries as $key => $galery)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $galery->image_path_galeries) }}" class="d-block w-100"
                                alt="{{ $galery->title }}" />
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $galery->title }}</h5>
                                <p>{{ $galery->categoryGalery->name }}</p>
                                <!-- You can add more details from the Galery model as needed -->
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section> --}}

    <section class="projects-section bg-light" id="galeri">
        <div class="container px-4 px-lg-5">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($galeries as $key => $galery)
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}"
                            class="{{ $key === 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($galeries as $key => $galery)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $galery->image_path_galeries) }}" class="d-block w-100"
                                alt="{{ $galery->title }}" />
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $galery->title }}</h5>
                                <p>{{ $galery->categoryGalery->name_category_galerie }}</p>
                                <!-- You can add more details from the Galery model as needed -->
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>


    {{-- <section class="projects-section bg-light" id="aspiration">
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
    </section> --}}
    {{-- <section class="projects-section bg-light" id="aspiration">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h2 class="text-center mb-0">Create New Aspiration</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/Aspiration') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title"
                                        name="tittle_aspirations" placeholder="Enter aspiration title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description_aspirations" rows="3"
                                        placeholder="Enter aspiration description" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" id="category" name="category_aspirations_id"
                                        required>
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
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="projects-section bg-light" id="aspiration">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h2 class="text-center mb-0">Create New Aspiration</h2>
                        </div>
                        <div class="card-header bg-primary text-white">
                            <h6 class="text-center mb-0">Mau tahu tentang form aspirasi ini <span
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="fas fa-question-circle"></i></span></h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/Aspiration') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="category" class="form-label">kategori Aspirasi</label>
                                    <select class="form-select" id="category" name="category_aspirations_id"
                                        required>
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
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Aspirasi</label>
                                    <input type="text" class="form-control" id="title"
                                        name="tittle_aspirations" placeholder="ex: Fasilitas" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Aspirasi</label>
                                    <textarea class="form-control" id="description" name="description_aspirations" rows="3"
                                        placeholder="ex: kamar mandi rusak" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi dari modal -->
                    <h3 class="slogan text-center"><strong>INFO FORM ASPIRASI</strong></h3>
                    <p>Form ini bersifat anonymous, jadi tidak ada data yang kelihatan.</p>
                    <p>Aspirasi adalah harapan, cita-cita, atau keinginan yang kuat untuk mencapai sesuatu yang
                        diinginkan, baik itu untuk diri sendiri maupun untuk orang lain.</p>
                    <p>Tata Cara Pengisian Form Aspirasi:</p>
                    <ul>
                        <li>Isi Kategory Aspirasi yang tersedia</li>
                        <li>Isi Judul terlebih dahulu</li>
                        <li>isi deskripsi keluhan</li>
                        <li>lakukan Submit</li>
                        <li>Tunggu Jawaban ketika ada perubahan apa yang kalian keluhkan </li>
                    </ul>
                    <p>Dengan menggunakan formulir ini, Anda memiliki kesempatan untuk menyuarakan ide-ide dan perasaan
                        Anda tanpa harus memberikan identitas Anda.</p>
                    <p>Jangan ragu untuk berbagi aspirasi Anda dengan kami! Isilah formulir di atas dan berikan suara
                        Anda untuk perubahan yang Anda inginkan.</p>
                    <h3 class="slogan text-center"><strong>Aspirasi bawahan, Hiburan Para Petinggi!</strong></h3>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



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
                @foreach ($profile as $p)
                    <a class="mx-2" href="{{ $p->twitter_url }}"><i class="fab fa-twitter"></i></a>
                @endforeach
                @foreach ($profile as $p)
                    <a class="mx-2" href="{{ $p->facebook_url }}"><i class="fab fa-facebook-f"></i></a>
                @endforeach
                @foreach ($profile as $p)
                    <a class="mx-2" href="{{ $p->instagram_url }}"><i class="fab fa-instagram"></i></a>
                @endforeach
                @foreach ($profile as $p)
                    <a class="mx-2" href="{{ $p->linkedin_url }}"><i class="fab fa-linkedin"></i></a>
                @endforeach
                @foreach ($profile as $p)
                    <a class="mx-2" href="{{ $p->line_url }}"><i class="fab fa-line"></i></a>
                @endforeach
                @foreach ($profile as $p)
                    <a class="mx-2" href="{{ $p->tiktok_url }}"><i class="fab fa-tiktok"></i></a>
                @endforeach
                @foreach ($profile as $p)
                    <a class="mx-2" href="{{ $p->youtube_url }}"><i class="fab fa-youtube"></i></a>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">Copyright &copy; Daffa Aqila Rahmatullah 2024</div>
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
