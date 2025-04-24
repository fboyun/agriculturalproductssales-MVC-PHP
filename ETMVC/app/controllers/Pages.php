<?php
class Pages extends Controller {
    public function __construct() {
    }

    public function index() {
        $data = [
            'title' => 'Ana Sayfa',
            'description' => 'Taze ve doğal tarım ürünleri'
        ];
        
        $this->view('pages/index', $data);
    }

    public function about() {
        $data = [
            'title' => 'Hakkımızda',
            'description' => 'Taze ve doğal tarım ürünlerini sizlerle buluşturuyoruz.'
        ];
        
        $this->view('pages/about', $data);
    }

    public function contact() {
        $data = [
            'title' => 'İletişim',
            'description' => 'Bizimle iletişime geçin'
        ];
        
        $this->view('pages/contact', $data);
    }
} 