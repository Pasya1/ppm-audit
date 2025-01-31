<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" type="image/png" href="{{ asset('AdminStyle') }}/img/pmg.png">
    <title>
        Audit PPM
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 0;
            border: none;
        }

        .card1 {
            width: 50%;
            padding: 40px 30px 10px 30px;
        }

        .card2 {
            width: 50%;
            background-image: linear-gradient(to right, #001A6E, #FF204E);
        }

        #logo {
            width: 100%;
            height: 100%;
        }

        .btn-color {
            border-radius: 50px;
            color: #fff;
            background-image: linear-gradient(to right, #001A6E, #FF204E);
            padding: 15px;
            cursor: pointer;
            border: none !important;
            margin-top: 40px;
        }

        .btn-color:hover {
            opacity: 0.8;
        }

        .btn-white {
            border-radius: 50px;
            color: #001A6E;
            background-color: #fff;
            padding: 8px 40px;
            cursor: pointer;
            border: 2px solid #D500F9 !important;
        }

        .btn-white:hover {
            color: #fff;
            background-image: linear-gradient(to right, #FFD54F, #D500F9);
        }

        @media screen and (max-width: 992px) {
            .card1 {
                width: 100%;
                padding: 40px 30px 10px 30px;
            }

            .card2 {
                width: 100%;
            }
        }
    </style>
</head>

<div class="container px-4 py-5 mx-auto">
    <div class="card card0 shadow-lg">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-10 my-5">
                        <div class="row justify-content-center px-3 mb-3">
                            <img id="logo" src="{{ asset('AdminStyle') }}/img/Stempel Prasetiya Mandiri-01.png">
                        </div>

                        <h6 class="msg-info pb-2">Please login to your account</h6>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login.process') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label text-muted">Username</label>
                                <input type="text" id="username_login" name="username_login" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="form-control-label text-muted">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>

                            <div class="row justify-content-center my-3 px-3">
                                <button type="submit" class="btn-block btn-color">Login</button>
                            </div>
                        </form>

                        <div class="row justify-content-center my-2">
                            <a href="#" data-toggle="modal" data-target="#helpModal"><small
                                    class="text-muted">Butuh Bantuan?</small></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5 right">
                    <h3 class="text-white">Selamat Datang di Sistem Audit Kampus Politeknik Prasetiya Mandiri</h3>
                    <small class="text-white">Sistem ini dipergunakan pada saat Audit internal seperti Program Studi
                        atau Unit. Yang dimana di dalamnya User bisa menambahkan dokumen, menilai dokumen, membuat
                        daftar tilik serta pembuatan laporan hasil audit dan laporan tindak lanjut.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Butuh Bantuan -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="helpModalLabel">Need Help?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Jika membutuhkan bantuan atau memiliki kendala, silakan hubungi admin melalui whatsapp
                <b>+62-896-5214-3101</b>.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a href="https://api.whatsapp.com/send?phone=6289652143101&text=Halo%20Admin,%20saya%20membutuhkan%20bantuan."
                    target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
