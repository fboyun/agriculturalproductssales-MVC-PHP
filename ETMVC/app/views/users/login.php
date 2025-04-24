<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">
                        <i class="fas fa-user-circle fa-2x text-success mb-3"></i><br>
                        Giriş Yap
                    </h2>

                    <?php flash('register_success'); ?>

                    <form action="<?php echo URLROOT; ?>/users/login" method="post">
                        <div class="mb-4">
                            <label for="email" class="form-label">Email Adresi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input type="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" 
                                       id="email" name="email" value="<?php echo $data['email']; ?>"
                                       placeholder="ornek@email.com">
                                <div class="invalid-feedback">
                                    <?php echo $data['email_err']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Şifre</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" 
                                       id="password" name="password"
                                       placeholder="••••••">
                                <div class="invalid-feedback">
                                    <?php echo $data['password_err']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label text-muted" for="remember">
                                    Beni hatırla
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mb-4">
                            <i class="fas fa-sign-in-alt me-2"></i>Giriş Yap
                        </button>

                        <div class="text-center">
                            <p class="text-muted">Hesabınız yok mu? 
                                <a href="<?php echo URLROOT; ?>/users/register" class="text-success">
                                    Kayıt Olun
                                </a>
                            </p>
                            <a href="<?php echo URLROOT; ?>/users/forgot" class="text-muted">
                                <i class="fas fa-lock me-1"></i>Şifremi Unuttum
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sosyal Medya ile Giriş -->
            <div class="text-center mt-4">
                <p class="text-muted mb-4">Sosyal medya ile giriş yapın</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="btn btn-outline-primary">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-outline-danger">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="btn btn-outline-dark">
                        <i class="fab fa-apple"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 