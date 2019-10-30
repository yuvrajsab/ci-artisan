<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i&display=swap"
		rel="stylesheet">
	<style>
		body {
			font-family: 'Nunito', sans-serif;
		}
	</style>

	<title>Register</title>
</head>

<body class="bg-light">

	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
		<div class="container">
			<a class="navbar-brand" href="/">CodeIgniter</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
				aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar">
				<div class="navbar-nav ml-auto">
					<a class="nav-item nav-link" href="/auth/login">Login</a>
					<a class="nav-item nav-link active" href="/auth/register">Register</a>
				</div>
			</div>
		</div>
	</nav>

	<main class="container py-4">
		<div class="row justify-content-center">

			<div class="col-md-8">

				<div class="card">
					<div class="card-header">Register</div>
					<div class="card-body">

                        <form action="/auth/register" method="POST">
                            
                            <div class="form-group row">
								<label for="first_name" class="col-sm-4 col-form-label text-md-right">First Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control <?php echo form_error('first_name') ? 'is-invalid' : '' ?>" id="first_name" name="first_name"
										value="<?php echo set_value('first_name') ?>" autofocus>
									<?php if (form_error('first_name')): ?>
										<div class="invalid-feedback">
											<?php echo form_error('first_name') ?>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row">
								<label for="last_name" class="col-sm-4 col-form-label text-md-right">Last Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control <?php echo form_error('last_name') ? 'is-invalid' : '' ?>" id="last_name" name="last_name"
										value="<?php echo set_value('last_name') ?>" autofocus>
									<?php if (form_error('last_name')): ?>
										<div class="invalid-feedback">
											<?php echo form_error('last_name') ?>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row">
								<label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
								<div class="col-sm-6">
									<input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : '' ?>" id="email" name="email"
										value="<?php echo set_value('email') ?>" autocomplete="email">
									<?php if (form_error('email')): ?>
										<div class="invalid-feedback">
											<?php echo form_error('email') ?>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>
								<div class="col-sm-6">
									<input type="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" id="password" name="password">
									<?php if (form_error('password')): ?>
										<div class="invalid-feedback">
											<?php echo form_error('password') ?>
										</div>
									<?php endif; ?>
								</div>
                            </div>
                            
                            <div class="form-group row">
								<label for="confirm_password" class="col-sm-4 col-form-label text-md-right">Confirm Password</label>
								<div class="col-sm-6">
									<input type="password" class="form-control <?php echo form_error('confirm_password') ? 'is-invalid' : '' ?>" id="confirm_password" name="confirm_password">
									<?php if (form_error('confirm_password')): ?>
										<div class="invalid-feedback">
											<?php echo form_error('confirm_password') ?>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-sm-6 offset-md-4">
									<button type="submit" class="btn btn-primary">Register</button>
									<?php echo $this->session->flashdata('register_status'); ?>
								</div>
							</div>

						</form>

					</div>
				</div>

			</div>
		</div>
	</main>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
		</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
		</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
		</script>
</body>

</html>