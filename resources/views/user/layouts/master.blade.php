<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">


    <!-- Favicon -->

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <link href="{{ asset('user/img/favicon.ico') }}" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="{{ asset('user/https://fonts.gstatic.com') }}">
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap') }}"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css') }}"
        rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->

    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                    href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"> AllShop.com</h6>

                </a>

            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('user#home') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('user#cart') }}" class="nav-item nav-link">My Cart</a>

                            @if (!session('sentSuccess'))
                                <a href="" data-bs-toggle="modal" class="nav-item nav-link"
                                    data-bs-target="#staticBackdrop">
                                    Contact
                                </a>
                            @endif
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <div class="btn-group mr-lg-5">
                                <button class="btn btn-secondary dropdown-toggle rounded" type="button" id="triggerId"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-start" aria-labelledby="triggerId">
                                    <a class="dropdown-item my-2" href="{{ route('user#profileChange') }}"><i
                                            class="mx-1 fa-regular fa-user"></i>Account</a>
                                    @if (isset($carts))
                                        <a class="dropdown-item my-2" href="{{ route('user#cart') }}">
                                            <button type="button" class="btn btn-primary position-relative">
                                                <i class=" mx-1 fa-solid fa-cart-shopping"></i> carts
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    {{ count($carts) }}
                                                    <span class="visually-hidden">unread messages</span>
                                                </span>
                                            </button>
                                        </a>
                                    @endif
                                    <a class="dropdown-item my-2" href="{{ route('user#pwChangePage') }}"><i
                                            class="mx-1 fa-solid fa-user-lock"></i>Password</a>
                                    <div class="dropdown-divider"></div>


                                    <div class="d-flex justify-content-center p-3">
                                        <button class="btn btn-outline-danger w-100 btn-sm rouned"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">logout</button>
                                    </div>
                                    <!-- Modal -->

                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-danger ">
                    Are you sure do you want to logout?.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary rounded">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!--  Model section -- >
        <!-- Modal -->
    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">We are here .Let Us know What you What to
                        say
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user#contentForm') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded" autocomplete="off" name="name"
                                id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" autocomplete="off" name="email" class="form-control rounded"
                                id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control rounded" name="message" placeholder="Leave a comment here" id="floatingTextarea2"
                                style="height: 100px"></textarea>
                            <label for="floatingTextarea2">What you want to say to us .</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger rounded" data-bs-dismiss="modal"><i
                                class="fa-solid fa-xmark mx-1"></i></button>
                        <button type="submit" class="btn btn-outline-dark rounded">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Breadcrumb Start -->

    <!-- Breadcrumb End -->

    @yield('content')
    <!-- Shop Start -->

    <!-- Shop End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed
                    dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href=""><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('user/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('user/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('user/js/main.js') }}"></script>
    {{-- jqueryCDN --}}

</body>
@yield('scriptSource')

</html>
{{-- <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
    <div class="navbar-nav mr-auto py-0">
        <a href="{{route('user#home')}}" class="nav-item nav-link active">Home</a>
        <a href="{{route('user#cart')}}" class="nav-item nav-link">Cart</a>
        <a href="contact.html" class="nav-item nav-link">Contact</a>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf

            <div class="dropdown mr-lg-5">
                <button class="btn btn-secondary rounded dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-regular fa-user mx-1"></i>{{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu rounded">
                    @if (isset($carts))
                    <li><a class="dropdown-item my-2" href="{{ route('user#cart') }}"><i
                        class="fa-solid fa-cart-shopping"></i><span
                        class="ml-2">{{count($carts)}}</span></a></li>
                    @endif

                    <li><a class="dropdown-item my-2" href="{{ route('user#profileChange') }}"><i class="fa fa-user mx-1"
                                aria-hidden="true"></i><span class="ml-2">Account</span></a></li>
                    <li><a class="dropdown-item my-2" href="{{ route('user#pwChangePage') }}"><i
                                class="fa fa-key mx-1" aria-hidden="true"></i><span class="">
                                Password</span></a></li>
                    <li><a class="dropdown-item my-2" href="#">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-dark btn-sm btn-block">
                                    <i class="fa-solid fa-arrow-right-from-bracket mx-1"></i>logout
                                </button>
                            </form>
                        </a></li>
                </ul>
            </div>


    </form>
</div> --}}
