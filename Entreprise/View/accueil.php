

 <?php

include_once "partials/sidebar.php";
?>
<?php

if (isset($_GET["desactiver_payement"])) {
    if ($verif_abonn->rowcount() > 0) {
        $modif_pay_abon->execute(array('2', $_GET["desactiver_payement"]));
        rediriger("accueil");
    } else {
        rediriger("accueil");
    }
}

if (isset($_SESSION["entreprise"])) {
    $info_entreprise = $list_entreprise->fetch(PDO::FETCH_ASSOC);
   
}
if ($_SESSION["utilisateur"]["contrat"] == 1 or isset($_SESSION["recrutement"])): ?>

    <main id="main" class="main shadow" style="background-color: <?=@$black?>">

<div class="pagetitle">
    <h2 class="text-<?=@$secondaire?> ml-2">Accueil</h2>
    <nav>
        <ol class="breadcrumb">

        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">
                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6 ">
                    <div class="card info-card sales-card bg-<?=@$primaire?> text-<?=@$secondaire?>">

                        <div class="filter">
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Option</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Ajout</a></li>
                                <li><a class="dropdown-item" href="#">Archives</a></li>
                            </ul>
                        </div>

                        <div class="card-body bg-<?=@$primaire?>" onclick="redirige('recrutement?action=publier')">
                            <h5 class="card-title">Publier</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-journal"></i>
                                </div>

                                <div class="ps-3 ">
                                    <h6></h6>
                                    <span class="text-mute small pt-2 ps-1 ">Recrutement</span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card bg-<?=@$primaire?> text-<?=@$secondaire?>">
                        <div class="card-body bg-<?=@$primaire?>" onclick="redirige('recrutement?publication&ref_pub=dernier')">
                            <h5 class="card-title">Dernier publication</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="text-<?=@$secondaire?>"><?php 
                                     $pub = $db->prepare("SELECT * FROM offres lastinsertId WHERE id_entreprise = ? ORDER by id DESC");
                                     $pub->execute(array($_SESSION["entreprise"]["id"]));
                                     $offre = $pub->fetch(PDO::FETCH_ASSOC);
                                     if($pub->rowcount()>0){
                                     $candidats = $db->prepare("SELECT *,candidat_entreprise.status as status FROM candidat_entreprise INNER JOIN utilisateur on utilisateur.id_utilisateur = candidat_entreprise.id_profil WHERE id_offres = ?");
                                     $candidats->execute(array($offre["id"]));
                                     echo $candidats->rowcount();    
                                     }else{
                                        echo "0";
                                     }
                                    
                                    ?></h6>
                                    <span class="text-mute small pt-2 ps-1">Candidat(s)</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-md-6">

                    <div class="card info-card customers-card bg-<?=@$primaire?> text-<?=@$secondaire?>">
                        <div class="card-body bg-<?=@$primaire?> text-<?=@$secondaire?>" onclick="redirige('recrutement')">
                            <h5 class="card-title">Archives offres</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-archive"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="text-<?=@$secondaire?>"><?=@$list_offres->rowcount()?></h6>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- End Customers Card -->


                                        <!-- Customers Card -->
                <div class="col-xxl-4 col-md-6">

<div class="card info-card customers-card bg-<?=@$primaire?> text-<?=@$secondaire?>">
        <div class="card-body" onclick="redirige('recrutement?page=candidats')">
        <h5 class="card-title">Historique candidats</span></h5>

        <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
            </div>
            <div class="ps-3">
                <h6 class="text-<?=@$secondaire?>"><?=@$candid_entr->rowcount()?></h6>
            </div>
        </div>

</div>
</div>

</div>
<!-- End Customers Card -->




            </div>
        </div>
        <!-- End Left side columns -->







        <!-- Right side columns -->
        <div class="col-lg-4 ">

            <!-- Recent Activity -->
            <div class="card bg-gradient-primary">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Option</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Modifier</a></li>
                    </ul>
                </div>
<h2 class="card-title text-center"><b>Votre Entreprise</b></h2>
                <div class="card-body bg-dark p-4 text-light">


                    <div class="activity p-4">

                        <div class="activity-item d-flex">
                            <div class="activite-label text-light">Nom </div>
                            <i class='bi bi-circle-fill text-dark activity-badge align-self-start'></i>
                            <div class="activity-content">
                               <?=$info_entreprise["nom_entreprise"]?>
                            </div>
                        </div>
                        <!-- End activity item-->

                        <div class="activity-item d-flex">
                            <div class="activite-label text-light">Adresse</div>
                            <i class='bi bi-circle-fill text-primary activity-badge align-self-start'></i>
                            <div class="activity-content">
                              <?=$info_entreprise["adresse_entreprise"]?>
                            </div>
                        </div>
                        <!-- End activity item-->

                        <div class="activity-item d-flex">
                            <div class="activite-label text-light">Ville</div>
                            <i class='bi bi-circle-fill text-primary activity-badge  align-self-start'></i>
                            <div class="activity-content">
                            <?=$info_entreprise["pays"]?>
                            </div>
                        </div>
                        <!-- End activity item-->
                        <div class="activity-item d-flex">
                            <div class="activite-label text-light">Contrat</div>
                            <i class='bi bi-circle-fill text-primary activity-badge  align-self-start'></i>
                            <div class="activity-content">
                                <?php
$date = date_create('2019-01-01 12:31:25');
date_add($date, date_interval_create_from_date_string('5 second'));
$reste = date_format($date, 'r');
?>
                            <b><p id="demo"></p></b>
                            </div>
                        </div>
                        <!-- End activity item-->



                    </div>

                </div>
            </div>
            <!-- End Recent Activity -->

        </div>
        <!-- End Right side columns -->

        <div class="pagetitle">
    <h1 class="text-<?=@$secondaire?>">Acces rapide</h1>
    <nav>
        <ol class="breadcrumb">

        </ol>
    </nav>
</div>

           <!-- Recent Sales -->
           <div class="col">
                    <div class="card recent-sales overflow-auto">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="recrutement?action=publier">Publier</a></li>
                                <li><a class="dropdown-item" href="recrutement?page=candidats">Tous les candidats</a></li>
                                <li><a class="dropdown-item" href="recrutement">Toutes les offres</a></li>
                            </ul>
                        </div>

                        <div class="card-body bg-<?=@$primaire?> text-<?=@$secondaire?>">
                            <h5 class="card-title">Candidatures et recrutements</h5>
<div class="table-responsive m-0">
<table class="table table-borderless table-striped table-<?=@$primaire?> datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Candidat</th>
                                                <th scope="col">Profil</th>
                                                <th scope="col">id offre</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_candid as $l_c): ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php $date = date_create($l_c["date_candidature"]);
echo date_format($date, "Y-m-d");
?>
                                                </th>
                                                <td>
                                                    <?=$l_c["nom_utilisateur"]?>
                                                </td>
                                                <td>
                                                    - <?=$l_c["profil"]?>
                                                </td>
                                                <td onclick="window.location.href='recrutement?publication&ref_pub=<?=$l_c['id_offres']?>'">
                                                    <?=$l_c["id_offres"]?>
                                                </td>
                                                <td>
                                                    <?php if ($l_c["status"] == 0): ?>
                                                        <span class="badge bg-warning">En attente</span>
                                                    <?php elseif ($l_c["status"] == 1): ?>
                                                    <span class="badge bg-success">Apprové</span>
                                                    <?php else: ?>
                                                    <span class="badge bg-success">Approved</span>
                                                    <?php endif;?>
                                                </td>
                                            </tr>

                                            <?php endforeach;?>

                                        </tbody>
                                    </table>
</div>
                        </div>

                    </div>
                </div>
                <!-- End Recent Sales -->
    </div>
</section>

</main>
<!-- End #main -->



<?php

elseif ($user["id_contrat"] == 2): ?>
 <main id="main" class="main" style="background-color: <?=@$black?>">

        <div class="pagetitle">
            <h2 class=" text-<?=@$secondaire?> ml-2">Accueil</h2>
            <nav>
                <ol class="breadcrumb">

                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card bg-<?=@$primaire?> text-<?=@$secondaire?>">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Option</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Ajout</a></li>
                                        <li><a class="dropdown-item" href="#">Archives</a></li>
                                    </ul>
                                </div>

                                <div class="card-body" onclick="redirige('personnels?action')">
                                    <h5 class="card-title">Personnels</h5>

                                    <div class="d-flex align-items-center ">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3 ">
                                            <h6 class="text-<?=@$secondaire?>"><?=@$personnels->rowcount()?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card bg-<?=@$primaire?> text-<?=@$secondaire?>">
                                <div class="card-body" onclick="redirige('payements')">
                                    <h5 class="card-title">Payement Salaire <span>| Ce mois-ci</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
                                        <div class="ps-3 ">
                                            <h6 class="text-<?=@$tertiaire?>"> 
                                            <?php 
            $perso = $db->prepare("SELECT id_personnel FROM payement_salaire WHERE mois=? AND anee=? AND id_entreprise=?;");
            $perso->execute(array(date("m"),date("Y"),$_SESSION["entreprise"]["id"]));
                                            if($personnels->rowcount() > 0){
                                        echo  number_format($perso->rowcount()*100/$personnels->rowcount());        
                                            }else{
                                                echo "0";
                                            }
                                           
                                            ?>
                                            %</b></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-md-6">

                            <div class="card info-card customers-card bg-<?=@$primaire?> text-<?=@$secondaire?>">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body" onclick="redirige('congés')">
                                    <h5 class="card-title">Congés</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa fa-user-times" aria-hidden="true"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 class="text-<?=@$tertiaire?>"></h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- End Customers Card -->


                                                <!-- Customers Card -->
                                                <div class="col-xxl-4 col-md-6">

<div class="card info-card customers-card bg-<?=@$primaire?> text-<?=@$secondaire?>">

    <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
                <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
    </div>

    <div class="card-body" onclick="redirige('departement')">
        <h5 class="card-title">Departement et poste</span></h5>

        <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
            </div>
            <div class="ps-3">
                <h6 class="text-<?=@$tertiaire?>">
                <?php
echo $list_departement->rowcount();
?>
                </h6>
                <span class="text-<?=@$secondaire?> small pt-1 fw-bold"><?=$sel_post->rowcount()?></span> <span class="text-muted small pt-2 ps-1">Poste</span>

            </div>
        </div>

    </div>
</div>

</div>
<!-- End Customers Card -->




                    </div>
                </div>
                <!-- End Left side columns -->







                <!-- Right side columns -->
                <div class="col-lg-4 ">

                    <!-- Recent Activity -->
                    <div class="card bg-gradient-primary">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Option</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Modifier</a></li>
                            </ul>
                        </div>
    <h2 class="card-title text-center mb-3"><b>Votre Entreprise</b></h2>
                        <div class="card-body bg-dark p-5 text-light">


                            <div class="activity">

                                <div class="activity-item d-flex">
                                    <div class="activite-label text-light">Nom </div>
                                    <i class='bi bi-circle-fill text-dark activity-badge align-self-start'></i>
                                    <div class="activity-content">
                                <?=$info_entreprise["nom_entreprise"]?>
                                    </div>
                                </div>
                                <!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label text-light">Adresse</div>
                                    <i class='bi bi-circle-fill text-primary activity-badge align-self-start'></i>
                                    <div class="activity-content">
                                   <?=$info_entreprise["adresse_entreprise"]?>
                                    </div>
                                </div>
                                <!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label text-light">Ville</div>
                                    <i class='bi bi-circle-fill text-primary activity-badge  align-self-start'></i>
                                    <div class="activity-content">
                                    <?=$info_entreprise["pays"]?>
                                    </div>
                                </div>
                                <!-- End activity item-->
                        <div class="activity-item d-flex">
                            <div class="activite-label text-light">Contrat</div>
                            <i class='bi bi-circle-fill text-primary activity-badge  align-self-start'></i>
                            <div class="activity-content">
                            <p id="demo"></p>
                            </div>
                        </div>
                                <!-- End activity item-->

                            </div>

                        </div>
                    </div>
                    <!-- End Recent Activity -->

                </div>
                <!-- End Right side columns -->




                   <!-- Recent Sales -->
                        <!-- End Recent Sales -->



                   <!-- Recent Sales -->


        <div class="pagetitle">

<h1 class="text-<?=@$secondaire?>">Acces rapide</h1>
<nav>
    <ol class="breadcrumb">

    </ol>
</nav>
</div>
                <div class="col">
                            <div class="card recent-sales overflow-auto bg-<?=@$primaire?> text-<?=@$secondaire?>">
                            <?php if($list_departement->rowcount()>0):?>
                                <div class="filter">
                                    <a class="icon "  href="departement?action=ajout&type=poste" >
                                        <i class="fa fa-plus-circle text-primary" aria-hidden="true"></i>
                                        <span class="text-primary ">Ajout poste</span>
                                    </a>
                                </div>
                            <?php endif;?>
                                <div class="card-body">
                                    <h5 class="card-title">Postes</span></h5>
                                    <?php if ($sel_post->rowcount() > 0): ?>
                                    <table class="table table-<?=@$primaire?> table-striped table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-secondary">Poste</th>
                                                <th scope="col" class="text-secondary">Departement</th>
                                                <th scope="col" class="text-secondary">Personnel</th>
                                                <th scope="col" class="text-secondary">Status</th>
                                                <th scope="col" class="text-secondary"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
foreach ($poster as $postes):
    $poste_personnel->execute(array($postes["id_poste"]));
    ?>
	                                            <tr>
	                                                <th><?=$postes["nom_poste"]?></th>
	                                                <td ><?=$postes["nom_departement"]?></td>
	                                                <td><?=$poste_personnel->rowcount();?></td>
	                                                <td>
	                                                <?php if ($poste_personnel->rowcount() == 0): ?>
	                                                <span class="badge bg-danger">Vide</span>
	                                                <?php elseif ($poste_personnel->rowcount() < $postes["min"]): ?>
                                                        <span  class="badge bg-warning">insuffisant</span>
                                                    <?php elseif ($poste_personnel->rowcount() > $postes["max"] and !empty($postes['max'])): ?>
                                                    <span class="badge bg-warning">excès</span>
                                                    <?php else: ?>
                                                    <span class="badge bg-success">ok</span>
                                                    <?php endif;?>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <center>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Vous devez configurer d'abord les postes et departements</h5>
                                                <a href="departement?action=ajout&type=departement" class="btn btn-dark card-text">Configurer</a>
                                            </div>
                                        </div>
                                    </center>
                                <?php endif;?>
                                </div>

                            </div>
                </div>
                        <!-- End Recent Sales -->

                    </div>
        </section>

    </main>
    <!-- End #main -->
<?php else: ?>

<h3 class="bg-danger">
    Une erreur s'est reproduite
</h3>

<?php endif;?>

<style>
    a{
  color: white
    }
</style>
<?php

include_once "partials/foot.php";
?>

<!-- Display the countdown timer in an element -->







