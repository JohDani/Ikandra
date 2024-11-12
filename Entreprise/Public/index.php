<?php


include '../../controllers/control.php';
if(isset($_SESSION['utilisateur']) and $_SESSION["utilisateur"]["type"] == 2){
requis($url);



}else{
header("location: ../offres");
}
    


