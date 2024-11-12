<?php

if (isset($_SESSION["utilisateur"])):

    if(isset($_GET["ref"])){
        $in2->execute(array($_GET["id"]));
        $user = $in2->fetch(PDO::FETCH_ASSOC);
    }else{
         $in->execute(array($_SESSION["utilisateur"]["id"]));
        $user = $in->fetch(PDO::FETCH_ASSOC);   
    }

    include_once "partials/sidebar.php";

    ?>



<body style="background-color: <?=@$black?>">
    


	<main id="main" class="main" >
	<!-- <div class="pagetitle " style="position: sticky; top: 70px">
	    <h1>

	    </h1>
	    <nav>
	        <ol class="breadcrumb card shadow bg-light">
	            <li class="breadcrumb-item"><a href="">Profil</a></li>
	            <li class="breadcrumb-item active">Informations</li>
	        </ol>
	    </nav>
	</div> -->
	<!-- End Page Title -->

	<section class="section profile">
	    <div class="row">
	        <div class="col-xl-4 " >
	            <div class="fixée bg-dark text-secondary col-lg-3  p-2">
	            <div class="" > 
	                <div class="card-body pt-4 d-flex flex-column align-items-center" >
	                <div class="photo">
	                    <div id="chng_prev" style="display: none">
	                        <i class="fa fa-user-circle fa-6x icone" aria-hidden="true"></i>
	                        <img src="" id="pdp" class="rounded-circle" alt="cc">
	                    </div>
	                    <div id="exist" >
	                        <?php if(file_exists("../../assets/images/".$user["images"])): ?>
	                                <img src="../../assets/images/<?=$user["images"]?>" class='img-thumbnail' id="pdps" alt="">
	                                <?php else: ?>
                                    <img src="../../assets/images/<?=$user["images"]?>"  alt="">
                                    <i class="fa fa-user-circle fa-8x" aria-hidden="true"></i>
                        <?php endif;?>
                    </div>
                </div>
                <center>
                    <h2 class="mt-2 text-light"><?=@$user["nom_utilisateur"]." ".$user["prenom"]?></h2>
                    <h3><?php if (!empty($user["profil"])) {echo $user["profil"];}?></h3>
                </center>    
                    <div class="">

                    </div>
                </div>
            </div>
            <div class="contacts text-start p-5 " >
                        <!-- <label for=""><h3>Contacts</h3></label><br> -->
                        <label for="Phone"><b><i class="fa fa-phone" aria-hidden="true"></i> Telephone</b> <br>
                        - <?=$user["telephone"]?></label><br>
                        <label for=""><b><i class="fa fa-envelope" aria-hidden="true"></i> Email</b><br> 
                        - <?=$user["email"]?></label><br>
                        <label for=""><b><i class="fa fa-address-card" aria-hidden="true"></i> Adresse</b><br>
                        - <?=$user["adresse"]?></label>
            </div>
            <div class="row"></div>
        </div>
        </div>

        <div class="col-xl-8">

            <div class="ca container">
                <div class="card-body ">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered p-2">
<?php if(isset($_GET["ref"])):?>
                        <li class="nav-item">
                            <button class="nav-link  <?php if ((!isset($page)) and isset($_GET["ref"])) {echo "active";}?>" data-bs-toggle="tab" data-bs-target="#profile-overview">Resumé</button>
                        </li>
<?php else:?>
                        <li class="nav-item">
                            <button class="nav-link text-<?=$primaire?> <?php if (!isset($_GET["ref"]) and !isset($page)) {echo "active";}?>" data-bs-toggle="tab" data-bs-target="#profile-edit"><i class="fas fa-user-edit text-<?=@$black?> "></i></button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link <?php if (isset($page)) {echo "active";}?>  text-<?=@$secondaire?>" data-bs-toggle="tab" data-bs-target="#profile-change-password"><i class="fas fa-user-shield "></i> Securité</button>
                        </li>
<?php endif;?>                        
                    </ul>
                    <div class="tab-content pt-2" style="min-height: 400px">

                        <div class="tab-pane fade <?php if (!isset($page) and isset($_GET["ref"])) {echo "show active ";}?>profile-overview" id="profile-overview">

                            <h5 class="card-title text-<?=@$secondaire?>">Detail du profil</h5>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-<?=@$tertiaire?>">
                                        <?php if (!empty($user["about"])) {echo $user["about"];}?>
                                    </p>
                                </div>
                            </div>
<?php if (isset($_GET["ref"])):
    $diplome_candidat->execute(array($_GET["id"]));
    $list_dip = $diplome_candidat->fetchAll(PDO::FETCH_ASSOC);
    $competence_candidat->execute(array($_GET["id"]));
    $list_compet = $competence_candidat->fetchAll(PDO::FETCH_ASSOC);
    $experience_candidat->execute(array($_GET["id"]));
    $list_exp = $experience_candidat->fetchAll(PDO::FETCH_ASSOC);
    ?>
	                            <div class="row">
	                                <div class="col-lg-3 col-md-4 label text-<?=@$tertiaire?>">Profil</div>
	                                <div class="col-lg-9 col-md-8 text-<?=@$secondaire?>">
                                        <?php if (!empty($user["profil"])) {echo $user["profil"];} else {echo "Compétence général du candidat";}?></div>
	                            </div>

	                            <div class="row">
	                                <div class="col-lg-3 col-md-4 label text-<?=@$tertiaire?>">Diplomes</div>
	                                <div class="col-lg-9 col-md-8 text-<?=@$secondaire?>">
	                                    <ul>
                                        <?php if(    $diplome_candidat->rowcount()==0):?>
                                            <li>Ce candidat n'a defini aucun diplome</li>
                                        <?php endif;?>
	                                        <?php foreach ($list_dip as $diplom): ?>
	                                        <li><b><?=$diplom["ref"]?>: </b>
	                                               <br> <?=$diplom["titre"]?>
	                                        </li>
	                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label text-<?=@$tertiaire?>">Exepriences</div>
                                <div class="col-lg-9 col-md-8 text-<?=@$secondaire?>">
                                    <ul>
                                    <?php if($experience_candidat->rowcount()==0):?>
                                        <li>Ce candidat n'a defini aucune diplome</li>
                                    <?php endif;foreach ($list_exp as $l_exp): ?>
                                    <li>
                                        <b><?=$l_exp["ref"]?>: </b>
                                        <p><?=$l_exp["titre"]?> </p>
                                    </li>
                                    <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label text-<?=@$tertiaire?>">Compétences</div>
                                <div class="col-lg-9 col-md-8 text-<?=@$secondaire?>">
                                    <ul>
                                        <?php if($competence_candidat->rowcount()==0):?>
                                            <li>Aucun compétence defini</li>
                                        <?php endif;foreach ($list_compet as $list_comp): ?>
                            <h4 class="small font-weight-bold"><?=$list_comp["titre"]?>: <span class="float-right"><?=$list_comp["ref"]?>%</span></h4>
                            <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if($list_comp["ref"] == 100){echo " bg-succss";}else if ($list_comp["ref"] >= 50) {echo " bg-warning";} if ($list_comp["ref"] <= 30) {echo " bg-danger";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$list_comp["ref"]?>%;"><span class="sr-only">20%</span></div>
                            </div>
                                        <?php endforeach;?>

                                    </ul>
                                </div>
                            </div>
<?php endif;?>
                        </div>

                        <div class="tab-pane <?php if(!isset($_GET["ref"]) and !isset($page)){echo "show active";}?> fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form method="post" action="" enctype="multipart/form-data">

                                    <input type="hidden" name="" id="dd">

                                <div class="row mb-3 mt-5">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label text-<?=@$secondaire?>">Images</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="pt-2">
                                            <input type="hidden" name="re_faire" value="<?=$user["images"]?>">
                                            <input type="file" name="sary" class="d-none" id="sarye">
                                            <label for="sarye"><butt type="button" class="btn btn-primary"><i class="bi bi-camera"></i></button></label>
                                            <label for=""><button name="suppr_pdp" id="suppr" class="btn btn-danger"><i class="bi bi-trash"></i></button></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label text-<?=@$secondaire?>">Nom et prenom</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?=@$user["nom_utilisateur"]." ".$user["prenom"]?>">
                                    </div>
                                </div>


                               

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label text-<?=@$secondaire?>">Téléphone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="telephone" type="text" class="form-control" id="Phone" value="<?=@$user["telephone"]?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label text-<?=@$secondaire?>">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email" value="<?=@$user["email"]?>">
                                    <input type="hidden" name="email_e" value="<?=@$user["email"]?>">
                                    </div>
                                </div>

                             
                                <div class="text-center">
                                    <button type="submit" name="modif_cv" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                            <!-- End Profile Edit Form -->

                        </div>

                        <div class="tab-pane fade pt-3 " id="profile-settings">

                            <!-- Settings Form -->
                            <!-- End settings Form -->

                        </div>

                        <div class="tab-pane fade pt-3 <?php if (isset($page)) {echo "show active";}?>" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form method="post" action="">
                                <input type="hidden" value="<?=$user["id_utilisateur"]?>" name="id_utilisateur">
                                <div class="row mb-3 mt-5">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label text-<?=@$secondaire?>">Mot de passe </label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="mdp" value="<?=@$mdp?>" type="password" class="form-control <?=@$colo?>" id="currentPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label text-<?=@$secondaire?>">Nouveau mot de passe</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="mdp1" type="password" class="form-control <?=@$page?>" id="newPassword" value="<?=@$mdp1?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label text-<?=@$secondaire?>">Confirmer mot de passe</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="mdp2" type="password" class="form-control <?=@$page?>" id="renewPassword" value="<?=@$mdp2?>">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" value="<?=$user["mdp"]?>" class="btn btn-primary" name="change_mdp">Changer le mot de passe</button>
                                </div>
                            </form>
                            <!-- End Change Password Form -->

                        </div>

                    </div>
                    <!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>

</main>
</body>
<script>

</script>
<style>
                    .fixée{
                    position: fixed;
                    background-color: rgba(0,2,156,0.4);
                    min-height: 600px;
                    }

                    @media(min-width:1597px){
                        .fixée{
                            min-width: 40px;
                        }
                    }

                    @media(max-width:1305px){
                        .fixée{
                    position: unset;
                            width: 100%;
                        }

                    }
                    .photo{
                        object-fit: cover;
                        overflow: hidden;
                    }

                    #pdps{
                        width: 125px;
                        height: 125px;
                        object-fit: cover;
                    }

                    #pdp{
                        width: 125px;
                        height: 125px;
                        display: none;
                        object-fit: cover;
                    }
</style>


<script>

function plus(ref,name,refer){
    var place = document.querySelector("."+ref);
    var new_element = document.createElement("div");
    new_element.classList = "input-group mt-2";
    new_element.innerHTML = "<div class='input-group-prepend'><input type='number' min='0' name='"+refer+"[]' class='input-group-text btn btn-outline-dark' placeholder='' id='my-addon' style='width: 100px'></div><input class='form-control' type='text' name='"+name+"[]' placeholder='' aria-label='Recipient's text' aria-describedby='my-addon'>";
    place.appendChild(new_element);
}

// function pus(btn_pus,place){
//     var btn_plus = document.querySelectorAll("."+btn_plus);
//     var place = document.querySelector("."+place);
//     for(i=0;i<departement.length;i++){
//             departement[i].onclick = function(e){
//             var new_dep = document.createElement("div");
//             new_dep.classList = "input-group p-2";
//             new_dep.innerHTML = "<input class='form-control departement valeurs' type='text' name='departement[]' placeholder='' aria-label='' aria-describedby='my-addon'>";
//             place.appendChild(new_dep);
//             }
//     };
// }

                            var afficher = document.querySelector("#pdp");
                            var exist = document.querySelector("#exist");
                            var img_src = document.getElementById("sarye");
                            var chng_prev = document.getElementById("chng_prev");
                            var icones = document.querySelector(".icone");
                            var tbn_s = document.getElementById("suppr");
                            var enregistre = localStorage.getItem("importé");

                            if(enregistre){
                                afficher.style.display = "unset";
                                icones.style.display = "none";
                                chng_prev.style.display = "block";
                                exist.style.display = "none";
                                const sources = new Image();
                                sources.src = enregistre;
                                afficher.src= sources.src;
                                tbn_s.onclick=function(e){
                                chng_prev.style.display = "none";
                                exist.style.display = "block";
                                localStorage.removeItem("importé");
                                e.preventDefault();
                                }
                            }

                                img_src.onchange = function(){
                                const sary = img_src.files[0];
                                icones.style.display = "none";
                                afficher.style.display = "unset";
                                chng_prev.style.display = "block";
                                exist.style.display = "none";
                                const affichage = new FileReader();
                                    affichage.onload = function(e){
                                    afficher.src = e.target.result;
                                    localStorage.setItem("importé", e.target.result);

                                }

                            affichage.readAsDataURL(sary);
                                }

</script>

<?php
include "partials/foot.php";
else:
    redirige("connexion");
endif;?>

<style>

</style>