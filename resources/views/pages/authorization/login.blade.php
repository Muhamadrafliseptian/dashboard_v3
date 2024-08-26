<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="PT Xtreme Network Sistem">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>
        .: {{ config('app.name') }} - Login :.
    </title>
    <link rel="icon" type="image/png" href="{{ dynamic_asset('/template/images/LOGO-TAB-TNOS.png') }}" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ dynamic_asset('/login-template/css/my-login.css') }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{ dynamic_asset('/template/images/LOGO-TAB-TNOS.png') }}" alt="logo">
					</div>
					<div class="card fat">
                        @if (session("success"))
                        <div class="alert alert-success">
                            <strong class="text-uppercase">
                                Berhasil,
                            </strong>
                            {!! session('success') !!}
                        </div>
                        @elseif(session("error"))
                        <div class="alert alert-danger">
                            <strong class="text-uppercase">
                                Gagal,
                            </strong>
                            {!! session('error') !!}
                        </div>
                        @endif
						<div class="card-body">
							<div class="card-title text-center text-uppercase">
                                <strong style="font-size: 24px">
                                    Login
                                </strong>
                                <br>
                                <small style="font-size: 14px">
                                    Silahkan Login Terlebih Dahulu
                                </small>
                            </div>
							<form method="POST" class="my-login-validation" action="{{ route('pages.login.post-login') }}">
                                @csrf
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="text" class="form-control" name="username" placeholder="Masukkan Username" value="{{ old('username') }}">
								</div>

								<div class="form-group">
									<label for="password">Password
										<a target="_blank" href="{{ url('/pages/lupa-password') }}" class="float-right">
											Lupa Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" data-eye placeholder="Masukkan Password">
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-sm text-uppercase" style="width: 100%">
										<strong>
                                            <i class="fa fa-sign-in"></i> Login
                                        </strong>
									</button>
								</div>
							</form>
						</div>
					</div>
					{{-- <div class="footer">
						Copyright &copy; 2024 &mdash; PT Xtreme Network Sistem
					</div> --}}
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="{{ url('/login-template/js/my-login.js') }}"></script>
</body>
</html>
