<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<main class="main-content  mt-0">
	<div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
		<span class="mask bg-gradient-dark opacity-6"></span>
		<div class="container my-auto">
			<div class="row">
				<div class="col-lg-4 col-md-8 col-12 mx-auto">
					<div class="card z-index-0 fadeIn3 fadeInBottom">
						<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
							<div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
								<div class="text-center">
									<img src="/assets/logo.png" class="navbar-brand-img" style="width: 100px;" alt="main_logo">
								</div>
								<h4 class="text-white font-weight-bolder text-center mt-2 mb-0"><?= lang('Auth.loginTitle') ?></h4>
								<div class="row mt-0">
									<div class="col-12 text-center px-1">
										<a class="btn btn-link px-5" href="javascript:;">
											<i class="fa fa-github text-white">Sistem Informasi<br>Pendaftaran Magang</i>
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<?= view('App\Views\Auth\_message_block') ?>
							<form role="form" method="post" action="<?= url_to('login') ?>">
								<?= csrf_field() ?>
								<?php if ($config->validFields === ['email']) : ?>
									<div class="input-group input-group-outline my-3">
										<label class="form-label"><?= lang('Auth.email') ?></label>
										<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login">
										<div class="invalid-feedback">
											<?= session('errors.login') ?>
										</div>
									</div>
								<?php else : ?>
									<div class="input-group input-group-outline my-3">
										<label class="form-label"><?= lang('Auth.emailOrUsername') ?></label>
										<input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login">
										<div class="invalid-feedback">
											<?= session('errors.login') ?>
										</div>
									</div>
								<?php endif; ?>

								<div class="input-group input-group-outline mb-3">
									<label class="form-label"><?= lang('Auth.password') ?></label>
									<input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>">
									<div class="invalid-feedback">
										<?= session('errors.password') ?>
									</div>
								</div>

								<?php if ($config->allowRemembering) : ?>
									<div class="form-check form-switch d-flex align-items-center mb-3">
										<input class="form-check-input" type="checkbox" id="rememberMe" <?php if (old('remember')) : ?> checked <?php endif ?>>
										<label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
									</div>
								<?php endif; ?>

								<div class="text-center">
									<button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2"><?= lang('Auth.loginAction') ?></button>
								</div>
							</form>
							<hr class="horizontal dark mt-4 mb-3">
							<?php if ($config->allowRegistration) : ?>
								<p class="text-sm text-center mb-2 p-0"><a class="text-dark text-gradient font-weight-bold" href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
							<?php endif; ?>
							<?php if ($config->activeResetter) : ?>
								<p class="text-sm text-center mb-2 p-0"><a class="text-dark text-gradient font-weight-bold" href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?= $this->endSection() ?>