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
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0"><?= lang('Auth.register') ?></h4>
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
                            <form role="form" action="<?= url_to('register') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="input-group input-group-outline mb-0">
                                    <label class="form-label" for="email"><?= lang('Auth.email') ?></label>
                                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" <?= old('email') ? 'value="' . old("email") . '"' : '' ?>>
                                </div>
                                <small id="emailHelp" class="form-text text-muted d-none"><?= lang('Auth.weNeverShare') ?></small>

                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label" for="username"><?= lang('Auth.username') ?></label>
                                    <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" <?= old('username') ? 'value="' . old("username") . '"' : '' ?>>
                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label" for="password"><?= lang('Auth.password') ?></label>
                                    <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" autocomplete="off">
                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label" for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                                    <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" autocomplete="off">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2"><?= lang('Auth.register') ?></button>
                                </div>
                            </form>
                            <hr class="horizontal dark m-0 mb-2">
                            <div class="text-center">
                                <div class="text-sm mb-0 pb-0"><?= lang('Auth.alreadyRegistered') ?></div>
                                <a class="text-sm text-dark text-gradient font-weight-bold" href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection() ?>