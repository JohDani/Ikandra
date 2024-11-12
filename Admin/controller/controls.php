<?php


function rediriger($link){
    echo "<script>window.location.href='".$link."'</script>";
}

if(isset($_POST["gerr_Amin"])){
    $i = 0;
    $modif_prix = $db->prepare("UPDATE prix_abonnement SET prix=? WHERE id_prix_abonnement=?");

for($i=0; $i<count($_POST["id_contrat"]);$i++){
    $modif_prix->execute(array($_POST["prix"][$i],$_POST["id_contrat"][$i]));
    rediriger("accueil");
}
}



if(isset($_POST["connexion"])){
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];

    if(!empty($email and $mdp)){

        $utilisateur->execute([$email]);

        if($utilisateur->rowcount() == 1){

            $user = $utilisateur -> fetch(PDO::FETCH_ASSOC);

                if($mdp == $user["mdp"]){

                    $_SESSION["utilisateur"]=array("id"=>$user['id'], "type"=>$user["type"], "nom"=>$user["nom"]);
                    
                    header("location: ../Entreprise");

                }else{
                    $alert = array("couleur" => "text-danger", "message" => "Le mot de passe est incorrect");
                }


        }else{
            $alert = array("couleur" => "text-danger", "message" => "Aucun compte correspondant");

        }

    }else{
        $alert = array ("couleur"=>"text-danger", "message"=>"Entrez les informations de connexion");
    }
}

    if(isset($_SESSION['etape1'])){
        $contrat = $_SESSION['etape1']['contrat'];
        $prenom = $_SESSION['etape1']['prenom'];
        $nom = $_SESSION['etape1']['nom'];
    }
    


    if(isset($_POST['inscription'])){
    if(!isset($_GET["etape"])){

        $contrat = $_POST["contrat"];
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST["nom"]);
        $verification = "/^[a-zA-Z ]*$/";

        if($contrat == 0){
            $ctr_color = "border-danger";
        }

        if(empty($prenom) or !preg_match($verification, $prenom)){
            $prenom_c = "border-danger";
        }
        
        if(!preg_match($verification, $nom)){
            $nom_color = "border-danger";
        }
    if($contrat !== 0 and !empty($prenom) and preg_match($verification, $nom) and preg_match($verification, $prenom)){

        $_SESSION["etape1"] = array("contrat" => $contrat, "prenom" => $prenom, "nom" => $nom);
        rediriges("inscription?etape=2");
    }

    }
    
    if(isset($_GET["etape"])){
        $email = $_POST["email"];
        $mdp = htmlspecialchars(($_POST["mdp"]));
        $mdp2 = htmlspecialchars(($_POST["mdp2"]));


    
        if(!filter_var($email,FILTER_VALIDATE_EMAIL) or empty($email)){
            $err_email = "border-danger";
            $err = "Veuillez entrer un email valide";
        }

        if(strlen($mdp <= 6)){
            $err_mdp = "border-danger";
            $err = "Veuillez choisir mot de passe au moins 6 caractères";
        }

        if($mdp !== $mdp2){
            $err_mdp = "border-danger text-danger";
            $err = "Les mot de passes ne sont pas les mêmes";
        }

$utilisateur -> execute([$email]);

if($utilisateur -> rowcount() == 0){
    if(!isset($err_email) and !isset($err_mdp)){

    
        $inscr->execute(array($nom,$prenom,$email,$mdp,$contrat));

        $utilisateur -> execute([$email]);
        $u = $utilisateur->fetch(PDO::FETCH_ASSOC);
        $_SESSION["utilisateur"]=array("id"=>$u['id'], "type"=>$u["type"], "nom"=>$u["nom"]);
        
        unset($_SESSION["etape1"]);
           
            header("location:../Entreprise/configurer");
    }
}else{
    $err = "Email déjà utilisé par autre compte";
    $err_email = 'border-danger';
}
    
    }

}




