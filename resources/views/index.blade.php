<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarpras IT</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <style>
        .vl {
            border-left: 6px solid #475f7b;
            height: 100%;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar">
        </div>

        <div id="main">
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <section class="section">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header text-end">
                                    <div class="col-sm-12">
                                        <img src="{{ asset('assets/images/sarpras_logo.png') }}"
                                            style="width: 60%; height: auto" alt="" srcset="">

                                    </div>
                                </div>
                                <form class="form form-vertical m-2 mt-3" method="POST" action="{{ url('authLogin') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-icon">NIK</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" name="username"
                                                            placeholder="NIK" id="first-name-icon">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-id-icon">Password</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control" name="password"
                                                            placeholder="Password" id="password-id-icon">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


        </div>
    </div>
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>