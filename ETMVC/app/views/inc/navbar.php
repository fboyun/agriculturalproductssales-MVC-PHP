<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>">
            <i class="fas fa-leaf me-2"></i><?php echo SITENAME; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == URLROOT || $_SERVER['REQUEST_URI'] == URLROOT . '/') ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>">
                        <i class="fas fa-home me-1"></i> Ana Sayfa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], URLROOT . '/products') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/products">
                        <i class="fas fa-store me-1"></i> Ürünler
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item me-3 position-relative">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/cart">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-danger cart-count">0</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> <?php echo $_SESSION['user_name']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/profile">
                                    <i class="fas fa-user me-2"></i> Profilim
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/users/logout">
                                    <i class="fas fa-sign-out-alt me-2"></i> Çıkış
                                </a>
                                <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/orderitems/index">
                                    <i class="fas fa-sign-out-alt me-2"></i> Admin Panel
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/users/login') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/users/login">
                            <i class="fas fa-sign-in-alt me-1"></i> Giriş
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], '/users/register') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/users/register">
                            <i class="fas fa-user-plus me-1"></i> Kayıt
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div style="margin-top: 76px;"></div> 