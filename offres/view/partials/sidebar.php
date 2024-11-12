<aside id="sidebar" class="sidebar ">

<ul class="sidebar-nav" id="sidebar-nav">
<?php

if(isset($_SESSION["utilisateur"]) and $_SESSION["utilisateur"]["type"] == 3):
$in -> execute(array($_SESSION["utilisateur"]["id"]));
$user = $in->fetch(PDO::FETCH_ASSOC);
endif;?>

<?php if(isset($_SESSION["candidat"])): ?>


<?php endif;?>
<li class="nav-item">
        <a class="nav-link " href="accueil">
            <i class="bi bi-grid"></i>
            <span>Accueil</span>
        </a>
    </li>
     
    <!-- End Dashboard Nav -->
<?php if($url == "candidat" or $url == "profil" or (isset($_SESSION["utilisateur"])and $_SESSION["utilisateur"]["type"] == 3)):
  $_SESSION["candidat"] = 3;
  $notif->execute(array($_SESSION["utilisateur"]["id"]));
  $n = $notif->fetch(PDO::FETCH_ASSOC);
  ?>

<li class="nav-item">
        <a class="nav-link text-primary" href=""  data-bs-toggle="modal" data-bs-target="#modalId">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <span>Notification
                <?php if($n["nombre"]>0):?>
                <span
                class="badge bg-danger"
                ><?=$n["nombre"]?></span
            >
            <?php endif;?>
            </span>
                
        </a>
    </li>  
   
    <li class="nav-item">
        <a class="nav-link " href="profil">
            <i class="fa fa-user"></i>
            <span>Votre CV / profil</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="candidature">
            <i class="fas fa-user-tag    "></i>
            <span>Candidature</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="accueil?categorie=<?=@$user["profil"]?>">
            <i class="bi bi-grid"></i>
            <span>Suggestion d'offres</span>
        </a>
    </li>
<li class="nav-item fixed-bottom " style="left: 10px">

</li>
<?php endif;


if(!isset($candidat)):
?>


<?php endif;?>

<li class="nav-heading">Categories</li>
<?php foreach($categorie as $categories):?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="?categorie=<?=$categories["nom"]?>">
            <span><?=$categories["nom"]?></span>
        </a>
    </li>
<?php endforeach;
?>
</ul>

</aside>