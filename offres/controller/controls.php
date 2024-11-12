<?php

function rediriger($lien){
    echo "<script>window.location.href='$lien'</script>";
}


if(isset($_POST["off_notif"])){
    $of = $db->prepare("UPDATE entretien SET statue = '1' WHERE id_profil=?");
    $of->execute(array($_SESSION["utilisateur"]["id"]));
}

if(isset($_POST["deconnexion"])){
    session_destroy();

    header("location: accueil");
}

if(isset($_POST["connexion"])){
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];

    if(!empty($email and $mdp)){

        $utilisateur->execute([$email]);

        if($utilisateur->rowcount() === 1){

            $us = $utilisateur -> fetch(PDO::FETCH_ASSOC);


                if(md5($mdp) === $us["mdp"]){
                    if($_SESSION["utilisateur"]["types"]==1){
                        rediriger("../admin");
                    }else{
                        $_SESSION["utilisateur"]=array("id"=>$us['id_utilisateur'], "type"=>$us["types"], "nom"=>$us["nom_utilisateur"], "prenom"=>$us['prenom'], "contrat"=>$us["id_contrat"]);
                    }

                  
               
                    if($_SESSION["utilisateur"]["type"] == 3){
                        if($us["status"] == "0"){
                        if(isset($_SESSION["postule"])){
                            $verif_candider->execute(array($_SESSION["utilisateur"]["id"],$_SESSION["postule"]["id_offre"]));
                            if($verif_candider->rowcount() == 0){
                            $candider->execute(array($_SESSION["utilisateur"]["id"], $_SESSION["postule"]["id_entreprise"], $_SESSION["postule"]["id_offre"])); 
                            $suc = "Candidature envoyé";
                            }else{
                                $_SESSION["postule"] = array("message"=>"Vous avez postulé à cette offre");
                                rediriger("accueil");
                            }
                        }else{
                    header("location: candidature");  
                        }      }else{
                            header("location: candidature");  
                }   
                    
                        
                    }elseif($_SESSION["utilisateur"]['type'] == 1){
                        header('location: ../admin');
                    }elseif($_SESSION['utilisateur']['type'] == 2){

                        $list_entreprise->execute(array($_SESSION["utilisateur"]["id"]));
             
                        $nombre = $list_entreprise ->rowcount();

                        if($nombre == 0){
                            rediriges('../entreprise/configurer');
                        }elseif($nombre == 1){
                                       $entreprise = $list_entreprise->fetch(PDO::FETCH_ASSOC);
                            $_SESSION["entreprise"] = array("id" => $entreprise["id_entreprise"], "nom" =>$entreprise["nom_entreprise"]);
                            rediriges("../entreprise/accueil");
                        }else{
                            rediriges("./entreprise/session");
                        }

                        echo $nombre;
                         
                    }else{
                        $err = "Une erreur inconnue est survenue, veuillez reessayer";
                    }
                   

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
        $verification = "/^[\p{L}]+$/u";

        if($contrat == 0){
            $ctr_color = "border-danger";
        }

        if(empty($prenom)){
            $prenom_c = "border-danger";
        }
        
        if(!preg_match($verification, $nom)){
            $nom_color = "border-danger";
        }
    if($contrat !== 0 and !empty($prenom) and preg_match($verification, $nom) and preg_match($verification, $prenom)){

        $_SESSION["etape1"] = array("contrat" => $contrat, "prenom" => $prenom, "nom" => $nom, "mdp" => md5($mdp));
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
 

        $inscr->execute(array($nom,$prenom,$email,md5($mdp),"2",$contrat));


        $utilisateur -> execute([$email]);
        $u = $utilisateur->fetch(PDO::FETCH_ASSOC); 

         $_SESSION["utilisateur"]=array("id"=>$u['id_utilisateur'], "type"=>"2","prenom" => $u["prenom"], "nom"=>$u["nom_utilisateur"], "contrat" => $u["id_contrat"]);   
         $date = date_create(date("Y-m-d H:i:s"));
        $add = date_add($date, date_interval_create_from_date_string('7 days'));
        

         $paye->execute(array('essai contrat', date("Y-m-d H:i:s"), date_format($add, 'Y-m-d H:i:s'),'1',$_SESSION["utilisateur"]["id"]));
        header("location:../Entreprise/configurer");
    }
}else{
    $err = "Email déjà utilisé par autre compte";
    $err_email = 'border-danger';
}
    
    }

}

if(isset($_POST["inscription_candidat"])){
    $nom_candidat = $_POST["nom_candiat"];
    $email_candidat = $_POST["email_candidat"];
    $mdp_c = $_POST["mdp_1"];
    $mdp_2 = $_POST["mdp_2"];

   



    if((empty($mdp_c) and empty($mdp_2)) or ($mdp_c !== $mdp_2)){
        $err_mdp = "border border-danger";
        $err = "Les deux mot de passes doivent correspondre";
    }

    if(empty($email_candidat) or !filter_var($email_candidat, FILTER_VALIDATE_EMAIL)){
        $err_email = "border border-danger";
        $err = "Veuillez entrer un email bien valide";
    }

    if(empty($nom_candidat)){
        $nom_err = "border border-danger";
        $err = "Le nom ne doit pas être vide";
    }

    if(empty($nom_candidat) and empty($email_candidat) and empty($mdp_c)){
        $rr = "Veuillez completer correctement les informations";
       }


    if(!isset($err) and !isset($rr)){

        $utilisateur->execute(array($email_candidat));
if($utilisateur -> rowcount() == 0){
$inscr->execute(array($nom_candidat,"", $email_candidat, md5($mdp_c), "3",0));
$utilisateur->execute($email_candiat);
$us = $utilisateur->fetch(PDO::FETCH_ASSOC);
$_SESSION["utilisateur"]=array("id"=>$us['id_utilisateur'], "type"=>$us["types"], "nom"=>$us["nom_utilisateur"], "prenom"=>$us['prenom'], "contrat"=>$us["id_contrat"]);
header("location: candidature");
}else{
    $err = "Cet email est déjà utilisé par un autre compte";
}

     
    }
}




if(isset($_POST["postuler"])){
    if(!isset($_SESSION["utilisateur"]) or ($_SESSION["utilisateur"]["type"] !== 3)){
    $_SESSION["postule"] = array("id_offre" => $_POST["postuler"], "id_entreprise"=>$_POST["id_entreprise"]);
    $err_cnx = "Veuillez connecter d'abord";
    rediriger("connexion");        
    }else{
        $verif_candider->execute(array($_SESSION["utilisateur"]["id"],$_POST["postuler"]));
        if($verif_candider->rowcount() == 0){
        $candider->execute(array($_SESSION["utilisateur"]["id"], $_POST["id_entreprise"], $_POST["postuler"])); 
        $suc = "Candidature envoyé";
        }else{
            $err = "Vous avez déjà postulé à cette offre";
        }
    }

}

if(isset($_POST["postuler2"])){
      $id_offre = $_POST["postuler2"];
    $id_entreprise = $_POST["id_entreprise".$id_offre];
  
    $id_utilisateur=$_SESSION["utilisateur"]["id"];
    if(!isset($_SESSION["utilisateur"]) or ($_SESSION["utilisateur"]["type"] !== 3)){
        $_SESSION["postule"] = array("id_offre" => $_POST["postuler2"], "id_entreprise"=>$_POST["id_entreprise2"]);
        $err_cnx = "Veuillez connecter d'abord";
        rediriger("connexion");
    }else{
        $verif_candider->execute(array($_SESSION["utilisateur"]["id"],$id_offre));
        if($verif_candider->rowcount() == 0){
        $candiders = $db->prepare("INSERT INTO candidat_entreprise(id_profil, id_offres, id_entreprise) VALUE ($id_utilisateur,$id_offre,$id_entreprise)");
        $candiders->execute();
        $suc = "Candidature envoyé";
        }else{
            $err = "Vous avez déjà postulé à cette offre";
        }

    }
}


///////////SESSSIONNNNNNNNNNNNNNNNNNNN//////////////
if(isset($_SESSION["utilisateur"])){
    $id_utilisateur = $_SESSION["utilisateur"]["id"];
    $show_candidat->execute(array($id_utilisateur));
    $list_cd = $show_candidat->fetchAll(PDO::FETCH_ASSOC);


    if(isset($_POST["change_mdp"])){
    $mdp1 = $_POST["mdp1"];
    $mdp2 = $_POST["mdp2"];
    $mdp = $_POST["mdp"];
    $mdp_user = $_POST["change_mdp"];



    if(strlen($mdp1) < 6){
        $err = "Votre nouveau mot de passe doit être plus sure";
        $page="border-danger";
    }

    if($mdp == $mdp1){
        $err = "Aucune changement";
    }

    if($mdp1 != $mdp2){
        $err = "Les 2 mots de passe doivent être le même";
        $page="border-danger";

    }
    if(md5($mdp) != $mdp_user){
    $err = "Votre mot de passe est incorrect";
    $page="r";
    $colo = "border-danger";
    } 

    if(!isset($err)){
    $change_mdp->execute(array(md5($mdp1),$_POST["id_utilisateur"]));
    $suc = "modifié avec succès";
    }else{
        $color = "danger";
    }
       
        // $change_mdp->execute(array());
    }




    function update($db,$table){
        if(isset( $_POST["id_".$table])){
        $id_ref = $_POST["id_".$table];
        $champ_ref=$_POST["upt_ref_".$table];
        $champ_titre=$_POST["upt_".$table];
        $i=0;
        foreach($id_ref as $reffs){
        $i++;
        $update_reference = $db->prepare("UPDATE $table SET ref=?,titre=? WHERE id=?");
        $update_reference->execute(array($champ_ref[$i-1],$champ_titre[$i-1],$reffs));        
        }
        }
    }

    function insert($db,$table,$param1,$param2,$id_profil){
        $verif = $db->prepare("SELECT * FROM $table WHERE ref=? and titre=? and id_profil=?");
        $verif->execute([$param1,$param2,$id_profil]);
        if($verif->rowcount() == 0){
        $insert_value = $db->prepare("INSERT INTO $table(ref,titre,id_profil) VALUES(?,?,?)");
        $insert_value->execute([$param1,$param2,$id_profil]);            
        }


    }

    $diplome_candidat->execute(array($_SESSION["utilisateur"]["id"]));
    $list_dip = $diplome_candidat->fetchAll(PDO::FETCH_ASSOC);
    $competence_candidat->execute(array($_SESSION["utilisateur"]["id"]));
    $list_compet = $competence_candidat->fetchAll(PDO::FETCH_ASSOC);
    $experience_candidat->execute(array($_SESSION["utilisateur"]["id"]));
    $list_exp = $experience_candidat->fetchAll(PDO::FETCH_ASSOC);

if(isset($_SESSION["utilisateur"]) and $_SESSION["utilisateur"]["type"] == 3){
 if($competence_candidat->rowcount() == 0 and $diplome_candidat->rowcount()==0){
        $err = "<a href='profil' class='text-dark text-decoration-none'>Vous devez ajouter au moins un compétence et/ou expérience et/ou Diplomes</a>
        ";
        $err_pr="disabled";
        $disabled = "disabled";

    }    
}
   


    if(isset($_POST["modif_cv"])){
        $id_utilisateur = $_SESSION["utilisateur"]["id"];
        $email = $_POST["email"];
        $email_e = $_POST["email_e"];
        $nom = $_POST["nom"];
        $telephone = $_POST["telephone"];
        $profil = $_POST["profil"];
        $adresse = $_POST["adresse"];
        $about = $_POST["about"];

        if(empty($nom)){
            $errs = "Veuillez saisir votre nom";
        }

        if(empty($email) and empty($telephone)){
            $errs = "Vous devez entrer au moins un contact";
        }

        if(empty($profil)){
            $errs = "Veuillez entrer votre profil";
        }

        if (isset($_FILES["imager"]) and !empty($_FILES["imager"]["name"])) {
            $imager = array("nom" => md5($_FILES["imager"]["name"]), "tmp" => $_FILES["imager"]["tmp_name"]);
            if (move_uploaded_file($imager["tmp"], "../../assets/images/".$imager["nom"])) {
                   $_SESSION["imager"] = array("nom" => $_FILES["imager"]["name"], "tmp" => $_FILES["imager"]["tmp_name"]);
            }
        } elseif (isset($_SESSION["imager"])) {
            $imager = array("nom" => md5($_SESSION["imager"]["nom"]));
        }else{
            $imager = array("nom" => $_POST["exist"]);
        } 


        $utilisateur->execute(array($email));
        if($utilisateur->rowcount() and $email != $email_e){
            $errs = "Une erreur se reproduite, veuillez utiliser un autre email";
        }

        if(!isset($errs)){
            rediriger("profil");
            $update_candidat = $db->prepare("UPDATE utilisateur set nom_utilisateur=?,email=?,images=?,telephone=?,profil=?,adresse=?,about=? WHERE id_utilisateur=?");
            $update_candidat->execute(array($nom,$email,$imager["nom"],$telephone,$profil,$adresse,$about,$id_utilisateur));
        }


        $diplomes = $_POST["diplomes"];
        $anee_diplomes = $_POST["anee_diplome"];
        $exp = $_POST["exp"];
        $ref_exp = $_POST["ref_exp"];
        $competence = $_POST["competence"];
        $ref_compet = $_POST["ref_compet"];
    
        $counter=0;

        

        update($db,'diplomes');
        update($db,'experiences');
        update($db,'competence');


        //diplomes//
        foreach($diplomes as $d){
        $counter++;
        if(!empty($d)){
            insert($db,'diplomes',$anee_diplomes[$counter-1],$d,$id_utilisateur);
        }
        }

        //competences
        $counters=0;
        foreach($competence as $cp){
        $counters++;
        if(!empty($cp) ){
            insert($db,'competences',$ref_compet[$counters-1],$cp,$id_utilisateur);
        }
        }

        $compteurs=0;
        foreach($exp as $exps){
        $compteurs++;
        if(!empty($exps) ){
            insert($db,'experiences',$ref_exp[$compteurs-1],$exps,$id_utilisateur);
        }
        }

        if(!isset($err)){
                    $suc="Modifié avec success";
        }else{
            $info = "";
        }

    }

}

if(isset($_POST["suppr_pdp"])){
    $change_usr->execute(array("images",$_SESSION["utilisateur"]["id"]));
}