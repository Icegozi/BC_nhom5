<?php
include 'header.php';
if(isset($_GET['pg'])){
    $pg = $_GET['pg'];

    switch($pg){
        case 'order':
            include 'order.php';
            break;
        case 'userEdit':
            include 'userEdit.php';
            break;
        case 'pitchSearch':
            include 'pitchSearch.php';
            break;
        default:
            include 'home.php';
            break;
        }
    }else{
        include 'home.php';
    }  

include 'footer.php';