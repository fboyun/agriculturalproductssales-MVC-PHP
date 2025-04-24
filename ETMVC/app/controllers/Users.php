<?php
class Users extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function login() {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];

            // Validate Email
            if(empty($data['email'])) {
                $data['email_err'] = 'Lütfen email adresinizi girin';
            }

            // Validate Password
            if(empty($data['password'])) {
                $data['password_err'] = 'Lütfen şifrenizi girin';
            }

            // Check for user/email
            if($this->userModel->getUserByEmail($data['email'])) {
                // User found
            } else {
                // User not found
                $data['email_err'] = 'Kullanıcı bulunamadı';
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $user = $this->userModel->getUserByEmail($data['email']);

                if($user && password_verify($data['password'], $user->password)) {
                    // Create Session
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['user_email'] = $user->email;
                    $_SESSION['user_name'] = $user->name;
                    $_SESSION['user_role'] = $user->role ?? 'user';
                    $_SESSION['user_status'] = $user->status ?? 'active';

                    if($user->status == 'inactive') {
                        unset($_SESSION['user_id']);
                        unset($_SESSION['user_email']);
                        unset($_SESSION['user_name']);
                        unset($_SESSION['user_role']);
                        unset($_SESSION['user_status']);
                        
                        flash('login_message', 'Hesabınız pasif durumda. Lütfen yönetici ile iletişime geçin.', 'alert alert-danger');
                        redirect('users/login');
                    }
                    if($user->role == 'admin') {
                        $this->view('admin/index', $data);

                    } else {
                        redirect('pages/index'); // 'admin/dashboard' yönlendirmesi yapılabilir
                    }

                } else {
                    $data['password_err'] = 'Şifre yanlış';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }

        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function register() {
        // POST isteği kontrolü
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form verilerini al
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Ad kontrolü
            if(empty($data['name'])) {
                $data['name_err'] = 'Lütfen adınızı girin';
            }

            // Email kontrolü
            if(empty($data['email'])) {
                $data['email_err'] = 'Lütfen email adresinizi girin';
            } elseif($this->userModel->getUserByEmail($data['email'])) {
                $data['email_err'] = 'Bu email adresi zaten kayıtlı';
            }

            // Şifre kontrolü
            if(empty($data['password'])) {
                $data['password_err'] = 'Lütfen şifrenizi girin';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Şifre en az 6 karakter olmalıdır';
            }

            // Şifre tekrar kontrolü
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Lütfen şifrenizi tekrar girin';
            } elseif($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Şifreler eşleşmiyor';
            }

            // Hata yoksa kayıt yap
            if(empty($data['name_err']) && empty($data['email_err']) && 
               empty($data['password_err']) && empty($data['confirm_password_err'])) {
                
                // Şifreyi hashle
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Kayıt işlemi
                if($this->userModel->register($data)) {
                    flash('register_success', 'Kayıt başarılı, giriş yapabilirsiniz');
                    redirect('users/login');
                } else {
                    die('Bir hata oluştu');
                }
            } else {
                // Hata varsa formu göster
                $this->view('users/register', $data);
            }
        } else {
            // İlk sayfa yüklemesi
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            $this->view('users/register', $data);
        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }
} 