<?php
include 'header_admin.php';
if(isset($_GET['pg'])){
    $pg = $_GET['pg'];

    switch($pg){
        case 'userEdit':
            include 'userEdit.php';
            break;
        case 'pitchManage':
            include 'pitchManage.php';
            break;
        default:
            include 'home.php';
            break;
        }
    }else{
        include 'home.php';
    }  

include 'footer.php';