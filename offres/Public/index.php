<?php 


include '../../controllers/control.php'; 
requis($url);         

if($url !== "accueil"){
    unset($_SESSION["err"]);
    unset($_SESSION["postule"]);


}


if($url != "profil"){
?>
<script>
    

    // if(confirm("Votre profil n'est pas encore enregitré")){
    //      localStorage.removeItem('importé');
    // }else{
    //     window.location.href="profil";
    // }

</script>    
<?php }?>








