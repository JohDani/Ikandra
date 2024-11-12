<?php 

session_start();

if(isset($_GET["url"])){
    $url = $_GET["url"];

}


function redirige($lien){
  echo "<script>window.location.href=$lien</script>";
}


function rediriges($lien){
  header("location: $lien");
}

function requis($urls){

  include_once "../../Model/db.php";
  include_once '../../controllers/control.php';

  include_once "../controller/controls.php";
  
  
     include_once "../../partials/head.php";
  // if(strtolower($url) !== "configurer"){
     include_once "../View/partials/navbar.php";   
  // }


          if(file_exists("../View/".$urls.".php")){
            include_once("../View/".$urls.".php");
          }elseif($urls == ""){
            
            include_once("../View/accueil.php");
          }else{
            include_once "../../partials/404.php";
          }
    
    include_once "../../partials/footer.php";



  }; 

    





  
  function active($urls){
    if($urls == strtolower($_GET['url'])){
      echo "actives";
    }
  }

  


  



if(isset($_GET["salaire"])){
    $salaire=$_GET["salaire"];

}

if(!isset($_GET["etape"])){

  if(empty($nom_e)){
     $btn_titre = "Etape suivant"; 
  }

}





?>











