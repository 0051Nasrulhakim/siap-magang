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
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0"><?= lang('Auth.forgotPassword') ?></h4>
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
                            <p><?= lang('Auth.enterEmailForInstructions') ?></p>
                            <form action="<?= url_to('forgot') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="input-group input-group-outline">
                                    <label for="email" class="form-label"><?= lang('Auth.emailAddress') ?></label>
                                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp">
                                    <div class="invalid-feedback">
                                        <?= session('errors.email') ?>
                                    </div>
                                </div>

                                <button type="submit" class="btn bg-gradient-dark my-4 mb-2"><?= lang('Auth.sendInstructions') ?></button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection() ?>