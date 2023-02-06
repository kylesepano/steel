<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        C ONE STEEL SALES AND PRODUCTION
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <section class="vh-100" style="background-color: #86bd6f;">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('img/c-one-logo2.png') }}" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1"
                    style=" background-image: url('{{ asset('img/c-one-logo.png') }}'); background-size: cover; background-repeat: no-repeat;
                background-position: center; 
                position: relative; height:400px; ">
                    @if (\Session::has('status'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{!! \Session::get('status') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <h4 class="text bold">C ONE STEEL</h4>
                    <form method="post" action="{{ route('log') }}">
                        @csrf
                        <div class="form-outline mb-4">
                            <input name="username" type="text" id="form3Example3"
                                class="form-control form-control-lg" placeholder="Username" required />
                            <label class="form-label" for="form3Example3">Username</label>
                        </div>
                        <div class="form-outline mb-3">
                            <input name="password" type="password" id="form3Example4"
                                class="form-control form-control-lg" placeholder="Enter password" required />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn text-white  btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;background-color: #414042;">Login</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
