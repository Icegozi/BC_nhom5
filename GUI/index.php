<?php
        include 'header.php';

        // Lấy giá trị của biến $pg từ URL, nếu không có thì mặc định là 'home'
        if(isset($_GET["pg"])){
            $pg = $_GET["pg"];

        // Xử lý điều hướng dựa trên giá trị của biến $pg
        switch ($pg) {
            case 'contact':
                include 'contact.php';
                break;
            case 'about':
                include 'about.php';
                break;
            case 'detail-page':
                include 'detail-page.php';
                break;
            case 'listing-page':
                include 'listing-page.php';
                break;
            default:
                include 'home.php';
                break;
        }
        }
        else{
             include 'home.php';
        }
    include 'footer.php';
