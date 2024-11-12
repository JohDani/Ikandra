<?php

$danger = "text-danger border-danger";
$success = "text-success border-success";
$verification = "/^[\p{L}]+$/u";

if (isset($_SESSION["utilisateur"])) {

    $in->execute(array($_SESSION["utilisateur"]["id"]));
    $user = $in->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST["change_mdp"])) {
        $mdp1 = $_POST["mdp1"];
        $mdp2 = $_POST["mdp2"];
        $mdp = $_POST["mdp"];
        $mdp_user = $_POST["change_mdp"];

        if (strlen($mdp1) < 6) {
            $err = "Votre nouveau mot de passe doit être plus sure";
            $page = "border-danger";
        }

        if ($mdp == $mdp1) {
            $err = "Aucune changement";
        }

        if ($mdp1 != $mdp2) {
            $err = "Les 2 mots de passe doivent être le même";
            $page = "border-danger";

        }
        if (md5($mdp) != $mdp_user) {
            $err = "Votre mot de passe est incorrect";
            $page = "r";
            $colo = "border-danger";
        }

        if (!isset($err)) {
            $change_mdp->execute(array(md5($mdp1), $_POST["id_utilisateur"]));
            $suc = "modifié avec succès";
        } else {
            $color = "danger";
        }

        // $change_mdp->execute(array());
    }

    if (isset($_POST["payer_salaire"])) {
        $id_s = $_POST["payer_salaire"];
        $date_payement = $_POST["date_payement" . $id_s];
        if (!empty($date_payement)) {
            if (isset($_GET["anee"]) and !empty($anee)) {
                $paye_s->execute(array($date_payement, $_GET["mois"], $_GET["anee"], $id_s, $_SESSION["entreprise"]["id"]));

            } else {
                $paye_s->execute(array($date_payement, $_GET["mois"], date("Y"), $id_s, $_SESSION["entreprise"]["id"]));
            }
        } else {
            $err = "Vous devez marquer la date de payement";
        }
    }

    if (isset($_POST["dark"])) {
        $change_theme->execute(array("1", $_SESSION["utilisateur"]["id"]));
    }

    if (isset($_POST["light"])) {
        $change_theme->execute(array("0", $_SESSION["utilisateur"]["id"]));
    }

    if (isset($_POST["change"])) {
        if ($user["theme"] == "0") {
            $change_theme->execute(array("1", $_SESSION["utilisateur"]["id"]));
        } else {
            $change_theme->execute(array("0", $_SESSION["utilisateur"]["id"]));
        }
    }
}

function img_profil($nom_image)
{
    if (file_exists("../../images/" . $nom_image)) {
        $src = "<img class='m-0 p-0' src='../images/$nom_image>";
        //   echo "<img src='../images/md5($nom_image)' class=' img-profile'>";
        echo "<img src='../images/$nom_image' class='img-profile'>";
    } else {
        echo "<i class='fa fa-2x text-dark fa-user-circle' aria-hidden='true'></i>";
    }

}

if (isset($_GET["action"])) {
    $action = $_GET["action"];
}

function rediriger($link)
{
    echo "<script>window.location.href='$link';</script>";
}

///utilisation utilisateur
if (isset($_SESSION["utilisateur"])) {
    $id_utilisateur = $_SESSION["utilisateur"]["id"];

    $verif_abonn->execute(array($_SESSION["utilisateur"]["id"]));
    $abonn = $verif_abonn->fetch(PDO::FETCH_ASSOC);

    if ($verif_abonn->rowcount() == 0) {
        // $modif->execute(array('1',$_SESSION["utilisateur"]["id"]));
        $desactive_account = "";
    } else {
        // if($user["status"] == 1){
        // $modif->execute(array('0',$_SESSION["utilisateur"]["id"]));
        // }
    }
    $attente_abonn->execute(array($_SESSION["utilisateur"]["id"]));
    if ($attente_abonn->rowcount() > 0) {
        $attente = $attente_abonn->fetchAll(PDO::FETCH_ASSOC);
        $err_att = "";
    }

    $list_entreprise = $db->prepare("SELECT * FROM entreprise WHERE id_utilisateur = ? ");
    $list_entreprise->execute([$id_utilisateur]);

}

///utilisation entreprise

if (isset($_POST["deconnexion"])) {
    session_destroy();
    rediriges("../offres");
}

if (isset($_SESSION["entreprise"])) {

    $id_entreprise = $_SESSION["entreprise"]["id"];

    $payement_salaire->execute([$id_entreprise]);
    $payement_salair->execute([$id_entreprise]);
    $p_ann = $payement_salaire->fetchAll(PDO::FETCH_ASSOC);

    $list_conge->execute([$id_entreprise]);

    $candid_entr->execute([$id_entreprise]);
    $list_candid = $candid_entr->fetchAll(PDO::FETCH_ASSOC);

///////AJOUT PERSONNEL//////////////////////////////////////////////////
    if (isset($_POST["ajout_personnel"])) {

        $nom = $_POST["nom"];
        $adresse = $_POST["adresse"];
        $telephone = $_POST["telephone"];
        $email = $_POST["email"];
        $remarque = $_POST["remarque"];

        if (isset($_FILES["sary"]) and !empty($_FILES["sary"]["name"])) {
            $image = array("nom" => $_FILES["sary"]["name"], "tmp" => $_FILES["sary"]["tmp_name"], "type" => $_FILES["sary"]["type"]);
            $_SESSION["image"] = array("nom" => $_FILES["sary"]["name"], "tmp" => $_FILES["sary"]["tmp_name"]);

            if (move_uploaded_file($image["tmp"], "../../assets/images/" . md5($image["nom"]))) {

            } else {
                $err = "Impossible d'importer l'image";
            }
        } elseif (isset($_SESSION["image"])) {
            $image = array("nom" => $_SESSION["image"]["nom"]);
        } elseif (isset($_POST["re_faire"])) {
            $ajanona = "ajanony ltyaahhh";
        } else {
            $image = array("nom" => "image");
        }

        $salaire = $_POST["salaire"];
        $id_depart = $_POST["id_depart"];
        $contrat = $_POST["contrat"];
        $date = $_POST["date"];

        if (!empty($email) and !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = "Veuillez entrer un email bien valide";
            $em_cl = "border-danger";
        }

        if (empty($email) and empty($telephone)) {
            $err = "Le personnel doit en avoir un de ces contacts";
            $ttc = "border-danger";
        }

        if (empty($adresse)) {
            $err = "L'adresse ne doit pas etre vide";
        }

        if (empty($salaire)) {
            $err = "completer correctement les informations";
        }

        if (isset($_POST["id_post"]) and !empty($_POST["id_post"]) and $_POST["id_post"] !== 0) {
            $id_poste = $_POST["id_post"];
        } elseif (!empty($_POST["new_post"])) {
            $new_post = $_POST["new_post"];
            $verif_post->execute(array($id_depart, $new_post));
            if ($verif_post->rowcount() == 0) {
                $ajout_poste->execute(array($id_depart, $new_post, $id_entreprise));
                $verif_post->execute(array($id_depart, $new_post));
                $info_post = $verif_post->fetch(PDO::FETCH_ASSOC);
                $id_poste = $info_post["id_poste"];
            }
        } else {
            $err = "Des informations sont manques,actualisez le navigateur et veuillez reessayer";
        }

        if (!isset($err)) {

            $verif_perso->execute(array($nom, $id_poste));
            if ($verif_perso->rowcount() == 0) {

                if (!isset($_GET["action"])) {
                    $ajout_personnel->execute(array($remarque, $adresse, md5($image["nom"]), $nom, $telephone, $email, $contrat, $salaire, $id_depart, $id_poste, $id_entreprise, $date));
                    $suc = "Ajouté avec success";
                    $color = "bg-success";
                } else {
                    if (isset($ajanona)) {
                        $image = array("nom" => $_POST["re_faire"]);
                        $update_personnel->execute(array($remarque, $adresse, $image["nom"], $nom, $telephone, $email, $contrat, $salaire, $id_depart, $id_poste, $id_entreprise, $date, $_GET["id"]));
                        $suc = "Modifié avec success";
                    } else {
                        $update_personnel->execute(array($remarque, $adresse, md5($image["nom"]), $nom, $telephone, $email, $contrat, $salaire, $id_depart, $id_poste, $id_entreprise, $date, $_GET["id"]));
                        $suc = "Modifié avec success";
                    }

                }

                unset($_SESSION["image"]);
            }
        }

        if (isset($err)) {
            $color = "danger";
        }

        if ($verif_perso->rowcount() > 0 and (!isset($_GET["id"]))) {
            $err = "ce personnel est déjà dans ce poste";
        }

        if (!isset($err)) {

        }

        if (!isset($err)) {

        }

    }
//////////////////////////////////////////////////////////////////////////
    if (isset($_POST["session_recrutement"])) {
        if (isset($_SESSION["recrutement"])) {
            unset($_SESSION["recrutement"]);
            rediriger("accueil");
        } else {
            $_SESSION["recrutement"] = array("id_entreprise" => $id_entreprise, "id_utilisateur" => $_SESSION["utilisateur"]["id"]);
            rediriger("accueil");
        }

    }

    if (isset($_GET["departement"])) {
        $list_post->execute(array($_GET["departement"]));
        $pst = $list_post->fetchAll(PDO::FETCH_ASSOC);
    }

    $list_offres->execute([$id_entreprise]);
    $offre_list = $list_offres->fetchAll(PDO::FETCH_ASSOC);

    $notifications->execute(array($id_entreprise));
    $notif = $notifications->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET["salaire"])) {
        $personnels = $db->prepare("SELECT * FROM personnels INNER JOIN poste on poste.id_poste = personnels.id_poste  WHERE personnels.id_personnel NOT IN (SELECT id_personnel FROM payement_salaire WHERE mois=? AND anee=?)  AND personnels.id_entreprise=?;");
        if (isset($_GET["anee"])) {
            $personnels->execute(array($_GET["mois"], $_GET["anee"], $id_entreprise));
        } else {
            $personnels->execute(array($_GET["mois"], date("Y"), $id_entreprise));
        }

    } else {
        if (isset($_GET["poste"])) {
            $personnels->execute(array($_GET["poste"], $id_entreprise));
        } elseif (isset($_GET["id_departement"])) {
            $personnels->execute(array($_GET["id_departement"]));
        } else {
            $personnels->execute(array($id_entreprise));
        }
    }

    $perso = $personnels->fetchAll(PDO::FETCH_ASSOC);

    $list_departement->execute([$id_entreprise]);
    $departs = $list_departement->fetchAll(PDO::FETCH_ASSOC);

}

if (isset($_POST["terminer"])) {

    @$departement = @$_POST["departement"];

    if (isset($departement)) {
        foreach ($departement as $departements) {

            // if(isset($_GET["type"]) and $_GET["type"] == "poste"){}

            $select_departement->execute([$id_entreprise, $departements]);

            if (!empty($departements)) {

                $id_entreprise = $_SESSION["entreprise"]["id"];

                if (isset($_GET["type"]) and $_GET["type"] == "poste") {

                    if (isset($_GET["id_departement"])) {
                        $verif_post->execute(array($_GET["id_departement"], $departements));

                        if ($verif_post->rowcount() == 0) {
                            $ajout_poste->execute(array($_GET["id_departement"], $departements, $id_entreprise));
                            $confirm = 'Ajoutée avec success';
                            $color = $success;
                            rediriger("departement");
                        } else {
                            $err = "Les postes éxistes ne seront pas doublés";
                            rediriger("departement");
                        }
                    } else {
                        $err = "Veuillez selectionner le departement";
                    }
                } else {

                    if ($select_departement->rowcount() == 0) {
                        $ajout_departement->execute([$departements, $id_entreprise]);
                        $confirm = 'Ajoutée avec success';
                        $color = $success;
                        rediriger("departement");
                    } else {
                        $err = "Les departements déjà existé ne seront pas doublés";
                    }
                }

            } else {

            }

        }
    }
}

if (isset($_GET["etape"]) and $_GET["etape"] == 3) {
    $btn_titre = "Vous êtes prets!";
} else {
    $btn_titre = "Continue";
}

if (isset($_POST["etape"])) {

    if (isset($_GET["etape"])) {
        $etape = $_GET["etape"];
        if ($etape == 2) {

            rediriges("configurer?etape=3");

            // rediriges("accueil?etape=3");

        } elseif ($etape == 3) {

            rediriges("accueil");

        }

    } elseif (!isset($etape)) {

        $nom_e = htmlspecialchars($_POST["nom_e"]);
        $adress_e = htmlspecialchars($_POST["adresse_e"]);
        $pays = $_POST["pays"];

        if (!empty($nom_e) and ($adress_e)) {
            $nom_entreprise->execute([$id_utilisateur, $nom_e]);
            if ($nom_entreprise->rowcount() == 0) {

                $ajout_entreprise->execute(array($nom_e, $id_utilisateur, $adress_e, $pays));

                $nom_entreprise->execute([$id_utilisateur, $nom_e]);
                $nom_E = $nom_entreprise->fetchAll(PDO::FETCH_ASSOC);
                foreach ($nom_E as $n) {
                    $_SESSION["entreprise"] = array("id" => $n["id_entreprise"], "nom" => $n["nom_entreprise"]);
                    rediriges("configurer?etape=2");
                }
            } else {
                $err = "L'entreprise est déjà enregistré";
            }

        } else {
            $err = "Ces informations sont obligatoires Veuillez les completer";
        }

    }
}

if (isset($_POST['passer'])) {
    rediriges("accueil");
}

//MODIF POST

if (isset($_POST["ok"])) {
    $nom_poste = $_POST["nom_poste"];
    $id_poste = $_POST["id_poste"];
    $departement = $_POST["departement"];
    $min = $_POST["min"];
    $max = $_POST["max"];

    for ($i = 0; $i < count($nom_poste); $i++) {
        $verif_post->execute(array($departement[$i], $nom_poste[$i]));
        if ($verif_post->rowcount() == 0) {
            $update_post->execute(array($nom_poste[$i], $departement[$i], $id_poste[$i]));
            $confirm = "Enregistré avec success";
            $color = $success;

        }
        rediriger("departement");
        $upt_post->execute(array($max[$i], $min[$i], $id_poste[$i]));

    }

}

if (isset($_POST["multi-suppr"])) {
    $selection = $_POST["checkbox"];
    foreach ($selection as $selected) {
        $suppr_post->execute([$selected]);
        rediriger("departement");
    }
}
/////////PBLICATION

if (isset($_POST["publier"]) or isset($_POST["modif_pub"])) {

    $description = $_POST["description"];
    $contra = $_POST["contrat"];
    $titre = $_POST["titre"];
    $villes = $_POST["villes"];

    if (isset($_FILES["photor"]) and !empty($_FILES["photor"]["name"])) {
        $name = $_FILES["photor"]["name"];
        $image = array("nom" => md5($name), "tmp" => $_FILES["photor"]["tmp_name"]);
        $_SESSION["imagess"] = array("nom" => md5($_FILES["photor"]["name"]), "tmp" => $_FILES["photor"]["tmp_name"]);
        move_uploaded_file($image["tmp"], "../../assets/images/" . $image["nom"]);

    } elseif (isset($_SESSION["imagess"])) {
        $image = array("nom" => $_SESSION["imagess"]["nom"]);
    }

    if (isset($_POST['new_categorie']) and !empty($_POST["new_categorie"])) {
        $categori = $_POST["new_categorie"];
        verifier($db, "categories", $categori);

    } else {
        $categori = $_POST["categori"];
    }

    // $telephone = $_POST["telephone"];
    // $email = $_POST["email"];

    if (empty($categori)) {
        $err = "Veuillez selectionner la categorie";
        $mo = "";
    }

    if (empty($contra)) {

    } else {
        verifier($db, "contrat", $contra);
    }

    if (empty($description)) {
        $err = "La description ne doit pas être vide";
        $mo = "";
    }

    if (!isset($err)) {
        if (isset($_POST["publier"])) {
            $puber = $db->prepare("INSERT INTO offres (images,poste,description,villes,categorie, contrat,id_entreprise) VALUES (?,?,?,?,?,?,?)");
            $puber->execute(array($image["nom"], $titre, $description, $villes, $categori, $contra, $id_entreprise));
            $suc = "publié avec success";
            unset($_SESSION["imagess"]);
            remove_storage("importé");
            rediriger("recrutement?ref_pub=dernier&publication");
        } elseif (isset($_POST["modif_pub"])) {

            if (isset($_FILES["imager"]) and !empty($_FILES["imager"]["name"])) {
                $imager = array("nom" => md5($_FILES["imager"]["name"]), "tmp" => $_FILES["imager"]["tmp_name"]);
                if (move_uploaded_file($imager["tmp"], "../../assets/images/" . $imager["nom"])) {
                    $_SESSION["imager"] = array("nom" => $_FILES["imager"]["name"], "tmp" => $_FILES["imager"]["tmp_name"]);
                }
            } elseif (isset($_SESSION["imager"])) {
                $imager = array("nom" => md5($_SESSION["imager"]["nom"]));
            } else {
                $imager = array("nom" => $_POST["exist"]);
            }

            $id_pub = $_POST["modif_pub"];
            $update_pub->execute(array($imager["nom"], $titre, $description, $categori, $villes, $contra, $id_pub));
            $suc = "Modifié avec success";
            unset($_SESSION["imager"]);
            remove_storage("importé");
        }

    }
}

if (isset($_POST["suppr_pdp"])) {
    $change_usr->execute(array("images", $_SESSION["utilisateur"]["id"]));
}

if (isset($_GET["ref_pub"]) and isset($_GET["publication"])) {
    if ($_GET["ref_pub"] == "dernier") {
        $pub = $db->prepare("SELECT * FROM offres lastinsertId WHERE id_entreprise = ? ORDER by id DESC");
        $pub->execute(array($_SESSION["entreprise"]["id"]));
    } else {
        $pub = $db->prepare("SELECT * FROM offres WHERE id = ?");
        $pub->execute(array($_GET["ref_pub"]));
    }
    $info_pub = $pub->fetch(PDO::FETCH_ASSOC);
    $candidats = $db->prepare("SELECT *,candidat_entreprise.status as status FROM candidat_entreprise INNER JOIN utilisateur on utilisateur.id_utilisateur = candidat_entreprise.id_profil WHERE id_offres = ?");

    if ($pub->rowcount() > 0) {
        $candidats->execute(array($info_pub["id"]));
        $list_candidats = $candidats->fetchAll(PDO::FETCH_ASSOC);
    }

}

if (isset($_POST["ajout_conge"])) {
    $id = $_POST["id_personnel"];
    $debut = $_POST["debut"];
    $duree = $_POST["duree"];
    $unite = $_POST["unite"];
    $date = date_create($debut);
    $raison = $_POST["raison"];

    if ($unite == 1) {
        $date_fin = date_add($date, date_interval_create_from_date_string($duree . ' days'));
    } elseif ($unite == 2) {
        $date_fin = date_add($date, date_interval_create_from_date_string($duree . ' month'));
    }

    if ($id == 0) {
        $err = "Veuillez selectionner le personnel";
    } else {
        $verif_conge->execute(array($id, $debut));
        if ($verif_conge->rowcount() == 0) {
            $ajout_conge->execute(array($debut, date_format($date_fin, "Y-m-d"), $raison, $id, $_SESSION["entreprise"]["id"]));
            $err = "Ajouté avec success";
            $bg = "success";
            rediriger("congés");
        } else {
            $err = "L'information de congé est déjà present";
            $bg = "danger";
        }
    }

}

if (isset($_POST["modif_cv"])) {
    $email = $_POST["email"];
    $noms = $_POST["fullName"];
    $telephone = $_POST["telephone"];

    if (empty($email) or empty($telephone)) {
        $err = "";
    }

    if (isset($_FILES["sary"]) and !empty($_FILES["sary"]["name"])) {
        $image = array("nom" => md5($_FILES["sary"]["name"]), "tmp" => $_FILES["sary"]["tmp_name"], "type" => $_FILES["sary"]["type"]);
        $_SESSION["image"] = array("nom" => $_FILES["sary"]["name"], "tmp" => $_FILES["sary"]["tmp_name"]);
        if (move_uploaded_file($image["tmp"], "../../assets/images/" . $image["nom"])) {

        } else {
            $err = "Impossible d'importer l'image";
        }
    } elseif (isset($_SESSION["image"])) {
        $image = array("nom" => md5($_SESSION["image"]["nom"]));
    } elseif (isset($_POST["re_faire"])) {
        $ajanona = "ajanony ltyaahhh";
        $image = array("nom" => $_POST["re_faire"]);
    } else {
        $image = array("nom" => "image");
    }

    function update_user($update_user, $nom, $email, $image, $telephone, $id_utilisateur)
    {
        $update_user->execute(array($nom, $email, $image, $telephone, $id_utilisateur));
        unset($_SESSION["image"]);
    };

    $utilisateur->execute([$email]);
    if ($email == $_POST["email_e"]) {
        update_user($update_user, $noms, $email, $image["nom"], $telephone, $_SESSION["utilisateur"]["id"]);
    } elseif ($utilisateur->rowcount() == 0) {
        update_user($update_user, $noms, $email, $image["nom"], $telephone, $_SESSION["utilisateur"]["id"]);
    } else {
        $page = "";
        $err = "L'email que vous avez entré est déjà utilisé";
    }
}

if (isset($_GET["supprimer-candidat"])) {
    $suppr_candidatur->execute(array($_GET["supprimer-candidat"]));
    $suc = "candidature supprimé";
    $page = "";
    rediriger("#");

}

if (isset($_POST["envoi_entretien"])) {
    $date = $_POST['date'];
    $heure = $_POST["heure"];
    $lieu = $_POST["lieu"];
    $id_candidat = $_POST["id_candidat"];
    $id_offre = $_POST["id_offre"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];

    $verif_entretien->execute([$id_candidat, $id_offre]);
    if ($verif_entretien->rowcount() == 0) {
        $insert_entretien->execute([$date, $heure, $lieu, $email, $telephone, $id_candidat, $id_offre]);
        $suc = "Entretien envoyé avec success";
    } else {
        $err = "Vous avez déjà envoyé une entretien de cette offre pour ce candidat";
        $page = "";
    }

}

if (isset($_POST['suppr_dep'])) {
    $de = $_POST["dep_s"];
    foreach ($de as $depar) {
        $dep_sup->execute(array($depar));
    }
    $suc = "supprimé avc success";

}

if (isset($_POST["payer_contrat"])) {
    $ref = $_POST["reference_transaction"];
    $prix = $_POST["prix"];
    $pay_a->execute(array($ref, $prix, $_SESSION["utilisateur"]["id"]));

}
