<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">
                        <i class="fas fa-user-plus fa-2x text-success mb-3"></i><br>
                        Hesap Oluştur
                    </h2>

                    <form action="<?php echo URLROOT; ?>/users/register" method="post">
                        <!-- Ad Soyad -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Ad Soyad</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" 
                                       id="name" name="name" value="<?php echo $data['name']; ?>"
                                       placeholder="Adınız ve Soyadınız">
                                <div class="invalid-feedback">
                                    <?php echo $data['name_err']; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
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

                        <!-- Şifre -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Şifre</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" 
                                       id="password" name="password"
                                       placeholder="En az 6 karakter">
                                <div class="invalid-feedback">
                                    <?php echo $data['password_err']; ?>
                                </div>
                            </div>
                            <small class="text-muted">Şifreniz en az 6 karakter uzunluğunda olmalıdır.</small>
                        </div>

                        <!-- Şifre Tekrar -->
                        <div class="mb-4">
                            <label for="confirm_password" class="form-label">Şifre Tekrar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" 
                                       id="confirm_password" name="confirm_password"
                                       placeholder="Şifrenizi tekrar girin">
                                <div class="invalid-feedback">
                                    <?php echo $data['confirm_password_err']; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Kullanım Şartları -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                <label class="form-check-label text-muted" for="terms">
                                    <small>
                                        <a href="#" class="text-success">Kullanım şartlarını</a> ve 
                                        <a href="#" class="text-success">Gizlilik politikasını</a> kabul ediyorum.
                                    </small>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mb-4">
                            <i class="fas fa-user-plus me-2"></i>Hesap Oluştur
                        </button>

                        <div class="text-center">
                            <p class="text-muted">Zaten hesabınız var mı? 
                                <a href="<?php echo URLROOT; ?>/users/login" class="text-success">
                                    Giriş Yapın
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sosyal Medya ile Kayıt -->
            <div class="text-center mt-4">
                <p class="text-muted mb-4">Sosyal medya ile kayıt olun</p>
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