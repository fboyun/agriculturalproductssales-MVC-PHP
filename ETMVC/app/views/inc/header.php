<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const URLROOT = '<?php echo URLROOT; ?>';
    </script>
    <script src="<?php echo URLROOT; ?>/js/cart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            padding: 1rem 0;
            background-color: #fff !important;
            width: 100%;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            color: #6F4F37  !important;
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover {
            color: #6F4F37  !important;
        }

        .btn-success {
            background-color: #6F4F37 ;
            border-color: #6F4F37 ;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #6F4F37 ;
            border-color: #6F4F37 ;
            transform: translateY(-2px);
        }

        .card {
            border: none;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .card-body {
            padding: 1.25rem;
        }

        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
        }

        .list-group-item {
            border: none;
            padding: 0.75rem 1.25rem;
            background: transparent;
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background: #f8f9fa;
            color: #6F4F37 ;
        }

        .list-group-item.active {
            background-color: #6F4F37 ;
            border-color: #6F4F37 ;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #6F4F37 ;
        }

        .dropdown-item.text-danger:hover {
            background-color: #dc3545;
            color: white !important;
        }

        .cart-count {
            position: absolute;
            top: 0;
            right: 0;
            transform: translate(50%, -50%);
        }

        /* Banner Styles */
        .banner {
            position: relative;
            overflow: hidden;
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            margin-right: calc(-50vw + 50%);
            margin-top: -20px;
        }

        .banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .banner img {
            width: 100%;
            height: 600px;
            object-fit: cover;
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }

        .banner:hover img {
            transform: scale(1);
        }

        .banner-content {
            z-index: 2;
            width: 100%;
            padding: 0 15px;
        }

        .banner-content h1 {
            font-size: 4rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .banner-content p {
            font-size: 1.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .banner-content .btn {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .banner-content .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            .banner-content h1 {
                font-size: 2.5rem;
            }
            .banner-content p {
                font-size: 1.2rem;
            }
            .banner-content .btn {
                font-size: 1rem;
            }
        }

        main {
            flex: 1;
            width: 100%;
            padding: 20px 0;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .row {
            margin-right: -15px;
            margin-left: -15px;
        }

        .col, .col-md-4, .col-lg-3 {
            padding-right: 15px;
            padding-left: 15px;
        }

        footer {
            margin-top: auto;
        }

        /* Section Styles */
        .section-header {
            position: relative;
            margin-bottom: 3rem;
        }

        .section-divider {
            width: 60px;
            height: 3px;
            background-color: #6F4F37 ;
            margin: 1rem auto;
        }

        /* Product Card Styles */
        .product-card {
            border: none;
            transition: all 0.3s ease;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .card-img-wrapper {
            position: relative;
            padding-top: 75%; /* 4:3 Aspect Ratio */
            overflow: hidden;
        }

        .card-img-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .card-img-wrapper img {
            transform: scale(1.1);
        }

        /* Category Card Styles */
        .category-card {
            border: none;
            transition: all 0.3s ease;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Feature Card Styles */
        .feature-card {
            background: white;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            background: #6F4F37 ;
            color: white;
        }

        .feature-card:hover .feature-icon i {
            color: white !important;
        }
    </style>
</head>
<body>
    <?php require APPROOT . '/views/inc/navbar.php'; ?>
    <main>
        <div class="container">
</body>
</html> 