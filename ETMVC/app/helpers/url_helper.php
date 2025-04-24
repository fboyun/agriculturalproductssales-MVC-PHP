<?php
// Sayfa yönlendirme
function redirect($page) {
    header('location: ' . URLROOT . '/' . $page);
} 