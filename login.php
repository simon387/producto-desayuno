<?php include "head.php"; ?>

<body class="bg-gradient-primary">

<div class="container">
	<div class="row justify-content-center">
		<div class="col-xl-10 col-lg-12 col-md-9">
			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<div class="row">
						<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">¡Bienvenido de nuevo!</h1>
								</div>
								<form class="user" method="POST" id="login-form">
									<?php if( $_SERVER['REQUEST_METHOD'] == 'POST' ) { ?>Invalid password<?php } ?>
									<div class="form-group">
										<input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" required>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password" required>
									</div>
									<div class="form-group">
										<div class="custom-control custom-checkbox small">
											<input type="checkbox" class="custom-control-input" id="customCheck" onclick="remembermeClick()">
											<label class="custom-control-label" for="customCheck">Remember Me</label>
										</div>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
									<br><br><br>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="js/login/login.js"></script>
</body>
</html>
