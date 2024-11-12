<?php
//  try{
$db = new PDO("mysql:host=localhost;dbname=ikandra;charset=utf8", "root", "");

$entretien_candidat = $db->prepare("SELECT * FROM entretien WHERE id_profil=? ORDER BY id_entretien DESC");
$notif = $db->prepare("SELECT count(*) as nombre FROM entretien WHERE id_profil=? AND statue=0");

$sup_perso = $db->prepare("DELETE FROM personnels WHERE id_personnel= ? ");



$paye_s = $db->prepare("INSERT INTO payement_salaire(date_payement,mois,anee,id_personnel,id_entreprise) VALUE(?,?,?,?,?)");

function affich(){
    if(isset($_GET["anee"])){
        echo "&anee=".$_GET["anee"];
    }
}

function update_pay($db,$status,$get){
    if(isset($_GET[$get])){
    $update_p = $db->prepare("UPDATE payement_abonnement SET status = ? WHERE id_payement_abonnement=?");
    $update_p->execute(array($status,$_GET["id"]));        
    }

}

if(isset($_GET["activer-contrat"])){
    if(isset($_GET["status"])){
        $date = date_create(date("Y-m-d H:i:s"));
        $date_fin = date_add($date, date_interval_create_from_date_string('1 month'));
        $fin = date_format($date_fin,"Y-m-d H:i:s");
        $d=date_format($date,"Y-m-d H:i:s");
        // echo "<script>alert('".date_format($date_fin,"Y-m d H:i:s")."')</script>";
        $update_pr = $db->prepare("UPDATE payement_abonnement SET status = '1' ,debut_contrat=?,fin_contrat=? WHERE id_payement_abonnement=?");
        $update_pr->execute(array(date("Y-m-d H:i:s"),$fin,$_GET["id"]));
    }else{
update_pay($db,"1","activer-contrat");        
    }
}

update_pay($db,"2","desactiver-contrat");

$pem = $db->prepare("SELECT *,payement_abonnement.status as status FROM payement_abonnement  INNER JOIN utilisateur on utilisateur.id_utilisateur=payement_abonnement.id_utilisateur");
$pem->execute();
$p_a = $pem->fetchAll(PDO::FETCH_ASSOC);

$payement_salaire = $db->prepare("SELECT COUNT(*), anee FROM payement_salaire WHERE id_entreprise = ? GROUP BY anee");
$payement_salair = $db->prepare("SELECT COUNT(*), anee FROM payement_salaire WHERE id_entreprise = ? GROUP BY anee");

$contrate = $db->prepare("SELECT * FROM prix_abonnement WHERE id_prix_abonnement =1 ");
$contrate->execute();
$contrat1 = $contrate->fetch(PDO::FETCH_ASSOC);

$contras = $db->prepare("SELECT * FROM prix_abonnement WHERE id_prix_abonnement = 2");
$contras->execute();
$contrat2 = $contras->fetch(PDO::FETCH_ASSOC);

$duree_essai = $db->prepare("SELECT * FROM essai ORDER by id DESC LIMIT 1");
$duree_essai->execute();
$essai = $duree_essai->fetch(PDO::FETCH_ASSOC);

function selected($reference, $option)
{
    if ($reference == $option) {
        echo "selected";
    }
}

function remove_storage($remove){
    echo "<script>localStorage.removeItem('$remove')</script>";
}

function description($description){
    $tags = preg_replace('/<[^>]+>/', ' ', $description);
    $sans = strip_tags($tags);
    $space = preg_replace('/\s+/'," ",$sans);
    $separe = trim($space);                                                    
    return $separe;
    }

function delete($gets, $db, $table, $column, $redirige)
{
    if (isset($_GET[$gets])) {
        $delete = $db->prepare("DELETE FROM $table WHERE $column = ?");
        $delete->execute(array($_GET["id"]));
        $suc = "Supprimé avec success";
        $page = "";
        echo "<script>window.location.href='$redirige'</script>";
    }
}

delete("supprimer-pub",$db,"offres","id","?");
delete("supprimer-personnel",$db,"personnels","id_personnel","?");
delete("supprimer-diplome",$db,"diplomes","id","?");
delete("tout-supprimer",$db,"conge","id_entreprise","?");
delete("supprimer-conge",$db,"conge","id_conge","?");
delete("supprimer-experience",$db,"experiences","id","#");
delete("supprimer-competence",$db,"competences","id","#");

///////ADMINNNNN///

$G_pub = $db->prepare("SELECT * FROM offres INNER JOIN entreprise on entreprise.id_entreprise = offres.id_entreprise INNER JOIN utilisateur on utilisateur.id_utilisateur = entreprise.id_utilisateur ORDER BY id DESC");
$G_pub->execute();
$Gr_pub = $G_pub->fetchAll(PDO::FETCH_ASSOC);

$revenue = $db->prepare("SELECT  SUM(payement_abonnement.prix) as revenue FROM payement_abonnement INNER JOIN utilisateur on payement_abonnement.id_utilisateur=utilisateur.id_utilisateur INNER JOIN prix_abonnement on prix_abonnement.id_prix_abonnement = utilisateur.id_contrat WHERE payement_abonnement.status <> 0 AND reference_transaction <> 'essai contrat'");
$revenue->execute();
$revenues = $revenue->fetch(PDO::FETCH_ASSOC);

$rev = $db->prepare("SELECT *,payement_abonnement.status as status, payement_abonnement.prix as prix FROM payement_abonnement INNER JOIN utilisateur on payement_abonnement.id_utilisateur=utilisateur.id_utilisateur INNER JOIN prix_abonnement on prix_abonnement.id_prix_abonnement = utilisateur.id_contrat WHERE payement_abonnement.status <> '0' ");
$rev->execute();
$reve = $rev->fetchAll(PDO::FETCH_ASSOC);

$prix_payement = $db->prepare("SELECT * FROM prix_abonnement WHERE id_prix_abonnement=?");

$selct = $db->prepare("SELECT * FROM utilisateur");
$selct->execute();

$paye = $db->prepare("INSERT INTO payement_abonnement(reference_transaction,debut_contrat,fin_contrat,status,id_utilisateur) VALUE(?,?,?,?,?)");
$pay_a = $db->prepare("INSERT INTO payement_abonnement(reference_transaction,prix,id_utilisateur) VALUE(?,?,?)");

$verif_abonn = $db->prepare("SELECT * FROM payement_abonnement WHERE id_utilisateur =? and status = '1' ");
$attente_abonn = $db->prepare("SELECT * FROM payement_abonnement WHERE id_utilisateur =? and status = '0' ORDER BY id_payement_abonnement DESC LIMIT 5");
////////ADMINN////////

////////CANCIAID//////
$insert_entretien = $db->prepare("INSERT INTO entretien(date_entretien,heure,lieu,email,telephone,id_profil,id_offre) VALUE(?,?,?,?,?,?,?)");
$verif_entretien = $db->prepare("SELECT * FROM entretien WHERE id_profil=? AND id_offre=?");

$dep_sup = $db->prepare("DELETE FROM departement WHERE id_departement=?");



$verif_candider = $db->prepare("SELECT * FROM candidat_entreprise WHERE id_profil = ? AND id_offres = ? AND (status = '0' or status = '1')");
$show_candidat = $db->prepare("SELECT * ,candidat_entreprise.status as status_candidature  FROM candidat_entreprise INNER JOIN offres on candidat_entreprise.id_offres = offres.id INNER JOIN utilisateur on utilisateur.id_utilisateur = candidat_entreprise.id_profil WHERE id_profil=?");
$diplome_candidat = $db->prepare("SELECT * FROM diplomes WHERE id_profil=?");
$action_candidat = $db->prepare("UPDATE candidat_entreprise SET status = ? WHERE id_candidat_entreprise=?");
$suppr_candidatur = $db->prepare("DELETE FROM candidat_entreprise WHERE id_candidat_entreprise=?");

if (isset($_GET["accepter-candidat"]) AND !isset($_POST["modif_pub"])) {
    $show_candidat->execute(array( $_GET["accepter-candidat"]));
    if($show_candidat->rowcount()==0){
    $action_candidat->execute(array("1", $_GET["accepter-candidat"]));
    $suc = "candidature acceptée"; 
    }

    $page = "eto ltyahh";
}

$competence_candidat = $db->prepare("SELECT * FROM competences WHERE id_profil=?");
$experience_candidat = $db->prepare("SELECT * FROM experiences WHERE id_profil=?");
///////////////////////////

function verifier($db, $reference, $noms)
{
    $verification = $db->prepare("SELECT * FROM `$reference` WHERE $reference.nom like '%$noms%'");
    $verification->execute();

    if ($verification->rowcount() == 0) {
        $add = $db->prepare("INSERT INTO $reference (nom) VALUES ('$noms')");
        $add->execute();
    }
}

$categories = $db->prepare("SELECT * FROM categories");
$categories->execute();
$categorie = $categories->fetchAll(PDO::FETCH_ASSOC);

$contrat = $db->prepare("SELECT * FROM contrat");
$contrat->execute();

if (!isset($_GET["categorie"])) {
    $list_offres = $db->prepare("SELECT * FROM offres where id_entreprise = ? order by id desc");

    $publications = $db->prepare("SELECT * FROM offres WHERE statue = '0' order by id desc");
    $publications->execute();
    $list_pub = $publications->fetchAll(PDO::FETCH_ASSOC);

    $echantillon = $db->prepare("SELECT * FROM offres WHERE statue = '0' order by id desc ");
    $echantillon->execute();
    $pub_ech = $echantillon->fetchAll(PDO::FETCH_ASSOC);

} else {

    $list_offres = $db->prepare("SELECT * FROM offres where id_entreprise = ? order by id desc ");
    $ref = $_GET["categorie"];
    $publications = $db->prepare("SELECT * FROM offres WHERE categorie = ? or description like '%$ref%' order by id desc ");
    $publications->execute(array($_GET["categorie"]));
    $list_pub = $publications->fetchAll(PDO::FETCH_ASSOC);

    $echantillon = $db->prepare("SELECT * FROM offres WHERE categorie =  ? or description like '%$ref%' order by id desc LIMIT 10");
    $echantillon->execute(array($_GET["categorie"]));

    if ($echantillon->rowcount() == 0) {
        $aucune = "Aucune";
    }
    $pub_ech = $echantillon->fetchAll(PDO::FETCH_ASSOC);

}

$change_theme = $db->prepare("UPDATE utilisateur SET theme = ? WHERE id_utilisateur = ? ");

$utilisateur = $db->prepare("SELECT * FROM utilisateur WHERE email=?");

$in = $db->prepare("SELECT * FROM utilisateur INNER JOIN prix_abonnement on prix_abonnement.id_prix_abonnement = utilisateur.id_contrat WHERE id_utilisateur= ? ");
$in2 = $db->prepare("SELECT * FROM utilisateur WHERE id_utilisateur= ? ");

$drp = $db->prepare("SELECT * FROM departement where id_departement=?");

$nom_entreprise = $db->prepare("SELECT * FROM entreprise WHERE id_utilisateur = ? and nom_entreprise = ?");

$select_departement = $db->prepare("SELECT * FROM departement WHERE id_entreprise=? and nom_departement = ? ");

$ajout_entreprise = $db->prepare("INSERT INTO entreprise (nom_entreprise, id_utilisateur, adresse_entreprise, pays) VALUE(?,?,?,?)");

$ajout_departement = $db->prepare("INSERT INTO departement (nom_departement, id_entreprise) VALUE (?,?)");

$inscr = $db->prepare("INSERT INTO utilisateur(nom_utilisateur,prenom,email,mdp,types,id_contrat) VALUE(?,?,?,?,?,?)");

$ajout_poste = $db->prepare("INSERT into poste(id_departement,nom_poste,id_entreprise) VALUE(?,?,?)");

$verif_post = $db->prepare("SELECT * FROM poste where id_departement = ? and nom_poste=?");

$select_post = $db->prepare("SELECT * FROM poste where id_poste = ?");

$candidat_offre = $db->prepare("SELECT * FROM candidat_entreprise INNER JOIN utilisateur on utilisateur.id_utilisateur = candidat_entreprise.id_profil WHERE id_offres = ? ");

$candid_entr = $db->prepare("SELECT *,candidat_entreprise.status as status FROM candidat_entreprise INNER JOIN utilisateur on utilisateur.id_utilisateur = candidat_entreprise.id_profil WHERE id_entreprise = ? ");

$Total = $db->prepare("SELECT * FROM personnels WHERE id_entreprise = ?");

$poste_personnel = $db->prepare("SELECT * FROM personnels where id_poste = ? ");

//     $_SESSION["Entreprise"] = array////////////////////////
if (isset($_GET["poste"])) {
    $personnels = $db->prepare("SELECT *  FROM personnels INNER JOIN departement on departement.id_departement = personnels.id_departement INNER JOIN poste on poste.id_poste = personnels.id_poste WHERE personnels.id_poste = ? and personnels.id_entreprise = ? ");
} elseif (isset($_GET["id_departement"])) {
    $personnels = $db->prepare("SELECT * FROM personnels INNER JOIN departement on departement.id_departement = personnels.id_departement INNER JOIN poste on poste.id_poste = personnels.id_poste WHERE personnels.id_departement=?");
} elseif(isset($_GET["salaire"])){
    $liste_personnels = $db->prepare("SELECT * FROM personnels INNER JOIN poste on poste.id_poste = personnels.id_poste  WHERE personnels.id_personnel NOT IN (SELECT id_personnel FROM payement_salaire WHERE mois=? AND anee=?)  AND personnels.id_entreprise=?;");
    $personnels = $db->prepare("SELECT * FROM personnels INNER JOIN poste on poste.id_poste = personnels.id_poste  WHERE personnels.id_personnel NOT IN (SELECT id_personnel FROM payement_salaire WHERE mois=? AND anee=?)  AND personnels.id_entreprise=?;");
}else{
    $liste_personnels = $db->prepare("SELECT * FROM personnels WHERE id_utilisateur = ? and id_entreprise = ? ");
    $personnels = $db->prepare("SELECT * FROM personnels INNER JOIN departement on departement.id_departement = personnels.id_departement INNER JOIN poste on poste.id_poste = personnels.id_poste WHERE personnels.id_entreprise=?");
}

$verif_perso = $db->prepare("SELECT * FROM personnels WHERE nom_personnel = ? and id_poste = ?");

$ajout_personnel = $db->prepare("INSERT INTO personnels (remarque,adresse,image, nom_personnel, telephone, email, contrat, salaire, id_departement, id_poste, id_entreprise, date_debut) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
$update_personnel = $db->prepare("UPDATE personnels SET remarque=?,adresse=?,image=?, nom_personnel=?, telephone=?, email=?, contrat=?, salaire=?, id_departement=?, id_poste=?, id_entreprise=?, date_debut=? WHERE id_personnel=?");

$select_pays = $db->prepare("SELECT * FROM pays where nom =?");

$insert_pays = $db->prepare("INSERT INTO pays (nom) Value (?)");

$list_entreprise = $db->prepare("SELECT * FROM entreprise WHERE id_utilisateur = ? ");

$list_pays = $db->prepare("SELECT * FROM pays");
$list_pays->execute();
$l_pays = $list_pays->fetchAll(PDO::FETCH_ASSOC);

$tp_contr = $db->prepare("SELECT * FROM contrat ");
$tp_contr->execute();
$typ_contrat = $tp_contr->fetchAll(PDO::FETCH_ASSOC);

$notifications = $db->prepare("SELECT * FROM notification WHERE id_entreprise =?");

$dp_perso = $db->prepare("SELECT * FROM personnels WHERE id_departement =?");
$info_pers = $db->prepare("SELECT * FROM personnels INNER JOIN departement on departement.id_departement = personnels.id_departement INNER JOIN poste on poste.id_poste = personnels.id_poste WHERE id_personnel = ? ");

$list_departement = $db->prepare("SELECT * FROM departement where id_entreprise=?");

if (isset($_GET["id_departement"])) {
    $sel_post = $db->prepare("SELECT * FROM poste INNER JOIN departement on departement.id_departement = poste.id_departement WHERE departement.id_departement = ?");
    $sel_post->execute(array($_GET["id_departement"]));
    $poster = $sel_post->fetchAll(PDO::FETCH_ASSOC);
} elseif (isset($_SESSION["entreprise"]) and !isset($_GET["id_departement"])) {
    $sel_post = $db->prepare("SELECT * FROM poste INNER JOIN departement on departement.id_departement = poste.id_departement WHERE departement.id_entreprise = ?");
    $sel_post->execute(array($_SESSION["entreprise"]["id"]));
    $poster = $sel_post->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_SESSION["entreprise"])) {
    $nbr_pay = $db->prepare("SELECT * FROM payement_salaire WHERE mois=? and ");
}

$list_post = $db->prepare("SELECT * FROM poste WHERE id_departement = ?");

///UPDATE
$update_user = $db->prepare("UPDATE utilisateur set nom_utilisateur=?,prenom=' ',email=?,images=?,telephone=? where id_utilisateur=?");



$update_email = $db->prepare("UPDATE utilisateur set email=? where id=?");
$change_usr = $db->prepare("UPDATE utilisateur set images = ? where id_utilisateur=?");

$chng_perso = $db->prepare("UPDATE personnels set image = ? where id=?");

$update_post = $db->prepare("UPDATE poste set nom_poste=?,id_departement=? WHERE poste.id_poste=?");
$upt_post = $db->prepare("UPDATE poste set max=?,min=? WHERE id_poste=?");
$update_pub = $db->prepare("UPDATE offres SET images=?, poste= ?, description= ?, categorie= ?,villes= ?,contrat= ? WHERE id=?");
$change_mdp = $db->prepare("UPDATE utilisateur SET mdp = ? WHERE id_utilisateur=?");
////SUPRR
$suppr_post = $db->prepare("DELETE FROM POSTE WHERE id_poste=?");
$modif = $db->prepare("UPDATE utilisateur SET status=? WHERE id_utilisateur=?");
$modif_offre = $db->prepare("UPDATE offres SET statue=? WHERE id=?");
$modif_pay_abon = $db->prepare("UPDATE payement_abonnement SET status = ? WHERE id_payement_abonnement = ? ");
$suppr_candidatur = $db->prepare("DELETE FROM candidat_entreprise WHERE id_candidat_entreprise=?");

if (isset($_GET["annuler"])) {
    $suppr_candidatur->execute(array($_GET["id_candidature"]));
    $err = "candidature annulé";
}

$ajout_conge = $db->prepare("INSERT INTO conge(date_debut,date_fin,raison,id_personnel,id_entreprise) VALUE(?,?,?,?,?)");
$verif_conge = $db->prepare("SELECT * FROM conge WHERE id_personnel=? and date_debut=?");
$list_conge = $db->prepare("SELECT * FROM conge INNER JOIN personnels on personnels.id_personnel = conge.id_personnel INNER JOIN poste on poste.id_poste = personnels.id_poste  WHERE conge.id_entreprise=?");

///ACTION
// $add_archive = $db->prepare("INSERT INTO archive")

// }catch(PDOException){

//     echo "<script>window.location.href='404'</script>";

// }
