<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0"><?= lang('Auth.resetYourPassword') ?></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= view('App\Views\Auth\_message_block') ?>
                            <p><?= lang('Auth.enterCodeEmailPassword') ?></p>
                            <form action="<?= url_to('reset-password') ?>" method="post">
                                <div class="input-group input-group-outline mb-3">
                                    <label for="token" class="form-label"><?= lang('Auth.token') ?></label>
                                    <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" <?= old('token', $token) ? "value='" . old('token', $token ?? '') . "'" : '' ?>>
                                    <div class="invalid-feedback">
                                        <?= session('errors.token') ?>
                                    </div>
                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <label for="email" class="form-label"><?= lang('Auth.email') ?></label>
                                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" <?= old('email') ? 'value="' . old("email") . '"' : '' ?>>
                                    <div class="invalid-feedback">
                                        <?= session('errors.email') ?>
                                    </div>
                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <label for="password" class="form-label"><?= lang('Auth.newPassword') ?></label>
                                    <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password">
                                    <div class="invalid-feedback">
                                        <?= session('errors.password') ?>
                                    </div>
                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <label for="pass_confirm" class="form-label"><?= lang('Auth.newPasswordRepeat') ?></label>
                                    <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm">
                                    <div class="invalid-feedback">
                                        <?= session('errors.pass_confirm') ?>
                                    </div>
                                </div>

                                <button type="submit" class="btn bg-gradient-dark mt-3 btn-block"><?= lang('Auth.resetPassword') ?></button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection() ?>