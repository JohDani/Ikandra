<?php

if (isset($_SESSION["utilisateur"]) and $_SESSION["utilisateur"]["type"] == 3):
    $in2->execute(array($_SESSION["utilisateur"]["id"]));
    $users = $in2->fetch(PDO::FETCH_ASSOC);

    include_once "partials/sidebar.php";
    ?>

	<main id="main" class="main">
	<div class="pagetitle " style="position: sticky; top: 70px">
	    <h1>Votre CV</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">Profil</a></li>
	            <li class="breadcrumb-item active">Informations</li>
	        </ol>
	    </nav>
	</div>
	<!-- End Page Title -->

	<section class="section profile">
	    <div class="row">
	        <div class="col-xl-4" >
	            <div class="fixée bg-dark text-secondary card p-4">
	            <div class="" >
	                <div class="card-body  pt-4 d-flex flex-column align-items-center" >
	                <div class="photo">
	                    <div id="chng_prev" style="display: none">
	                        <i class="fa fa-user-circle fa-6x icone" aria-hidden="true"></i>
	                        <img src="" id="pdp" class="rounded-circle" alt="cc">
	                    </div>
	                    <div id="exist" >
	                        <?php if (file_exists("../../assets/images/" . $users["images"])): ?>
	                                <img src="../../assets/images/<?=$users["images"]?>" id="pdps" alt="">
	                                <?php else: ?>
                                    <img src="../../assets/images/<?=$users["images"]?>" alt="">
                                <i class="fa fa-user-circle fa-8x" aria-hidden="true"></i>
                        <?php endif;?>
                    </div>
                </div>
                    <h2 class="text-light mt-2"><?=@$users["nom_utilisateur"]?></h2>
                    <h4><?php if (!empty($users["profil"])) {echo $users["profil"];}?></h4>
                    <div class="">

                    </div>
                </div>
            </div>
            <div class="contacts text-start p-5 " >
                        <!-- <label for=""><h3>Contacts</h3></label><br> -->
                        <label for="Phone"><b><i class="fa fa-phone" aria-hidden="true"></i></b> <?=$users["telephone"]?></label><br>
                        <label for=""><i class="fa fa-envelope" aria-hidden="true"></i></b> <?=$users["email"]?></label><br>
                        <label for=""><b><i class="fa fa-address-card" aria-hidden="true"></i></b> <?=$users["adresse"]?></label>
            </div>
            <div class="row"></div>
        </div>
        </div>

        <div class="col-xl-8">

            <div class="car container">
                <div class="card-body ">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered p-2">

                        <li class="nav-item">
                            <button class="nav-link <?php if ((!isset($page) and !isset($info))) {echo "active";}?>" data-bs-toggle="tab" data-bs-target="#profile-overview">Resumé</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link <?php if (isset($info) and !isset($page)) {echo "active";}?>" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier le CV</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link  <?php if (isset($page)) {echo "active";}?>" data-bs-toggle="tab" data-bs-target="#profile-change-password">Securité et mot de passe</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade <?php if (!isset($page) and !isset($info)) {echo "show active ";}?>profile-overview" id="profile-overview">

                            <h5 class="card-title">Detail du profil</h5>

                            <div class="row">
                                <div class="col-12">
                                    <p>
                                        <?php if (!empty($users["about"])) {echo $users["about"];}?>
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Profil</div>
                                <div class="col-lg-9 col-md-8"><?php if (!empty($users["profil"])) {echo $users["profil"];} else {echo "votre comptetence general";}?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Diplomes</div>
                                <div class="col-lg-9 col-md-8">
                                    <ul>
                                        <?php foreach ($list_dip as $diplom): ?>
                                        <li><b><?=$diplom["ref"]?>: </b>
                                               <br> <?=$diplom["titre"]?>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Exepriences</div>
                                <div class="col-lg-9 col-md-8">
                                    <ul>
                                    <?php foreach ($list_exp as $l_exp): ?>
                                    <li>
                                        <b><?=$l_exp["ref"]?>: </b>
                                        <p><?=$l_exp["titre"]?> </p>
                                    </li>
                                    <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Compétences</div>
                                <div class="col-lg-9 col-md-8">
                                    <ul>
                                        <?php foreach ($list_compet as $list_comp): ?>
                                        <li>  <h4 class="small font-weight-bold"><?=$list_comp["titre"]?>: <span class="float-right"><?=$list_comp["ref"]?>%</span></h4>
                            <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if($list_comp["ref"] == 100){echo " bg-succss";}else if ($list_comp["ref"] >= 50) {echo " bg-warning";} if ($list_comp["ref"] <= 30) {echo " bg-danger";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$list_comp["ref"]?>%;"><span class="sr-only">20%</span></div>
                            </div></li>
                                        <?php endforeach;?>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade profile-edit pt-3 <?php if (isset($info)) {echo "show active ";}?>" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form method="post" action="" enctype="multipart/form-data">

                                    <input type="hidden" name="" id="dd">

                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Images</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="pt-2">
                                            <input type="file" name="imager" class="d-none" id="sarye">
                                            <input type="hidden" name="email_e" value="<?=$users["email"]?>">
                                            <input type="hidden" name="exist" value="<?=$users["images"]?>">
                                            <label for="sarye"><butt type="button" class="btn btn-primary"><i class="bi bi-camera"></i></button></label>
                                            <label for=""><button name="suppr_pdp" id="suppr" class="btn btn-danger"><i class="bi bi-trash"></i></button></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom et prenom</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="nom" type="text" class="form-control" id="fullName" value="<?=@$users["nom_utilisateur"]?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Profil</label>
                                    <div class="col-md-8 col-lg-9">
                                       <input name="profil" id="" class="form-control" cols="30" rows="4" value="<?=@$users["profil"]?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">A propos</label>
                                    <div class="col-md-8 col-lg-9">
                                       <textarea name="about" id="" placeholder="Decrivez-vous et resumer mots maximum" class="form-control" cols="30" rows="4"><?=@$users["about"]?></textarea>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="Job" onclick="plus('place1','diplomes','anee_diplome','<?=date('Y') - 50?>','<?=date('Y')?>')" class="col-md-4 col-lg-3 col-form-label">
                                        <span class="">Diplomes</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       <span class="text-primary"> Ajout </span> <i class="fa fa-plus-circle text-primary" aria-hidden="true"></i>
                                    </label>
                                    <div class="col-md-8 col-lg-9 place1">
                                <?php foreach ($list_dip as $diplom): ?>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <input type="number" max="<?=date('Y')?>" min="<?=date('Y')-50?>" class="input-group-text  btn btn-outline-dark" value="<?=$diplom["ref"]?>" name="upt_ref_diplomes[]" placeholder="année"  id="my-addon" style="width: 100px">
                                        </div>
                                        <input type="hidden" min="0" value="<?=$diplom["id"]?>" name="id_diplomes[]">
                                        <input class="form-control" name="upt_diplomes[]" placeholder="Titre du diplome" value="<?=$diplom["titre"]?>" aria-label="Recipient's text" aria-describedby="my-addon">
                                        <div class="input-group-prepend">
                                        <a class="input-group-text btn text-danger" href="?supprimer-diplome&id=<?=$diplom["id"]?>" placeholder="année"  id="my-addon" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                                <?php if (isset($diplomes) and !empty($diplomes)):
    $counter = 0;foreach ($diplomes as $d):

        $counter++?>
		                                    <div class="input-group mt-2">
		                                        <div class="input-group-prepend">
		                                            <input type="number" max="<?=date('Y')?>" min="<?=date('Y')-50?>" class="input-group-text  btn btn-outline-dark" value="<?=$anee_diplomes[$counter - 1]?>" name="anee_diplome[]" placeholder="année"  id="my-addon" style="width: 100px">
		                                        </div>
		                                        <input class="form-control" name="diplomes[]" placeholder="Titre du diplome" value="<?=$d?>" aria-label="Recipient's text" aria-describedby="my-addon">
		                                       </div>
		                                <?php endforeach;else: ?>
                                       <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <input class="input-group-text  btn btn-outline-dark" type="number" max="<?=date('Y')?>" min="<?=date('Y')-50?>" name="anee_diplome[]" placeholder="année" id="my-addon" style="width: 100px">
                                        </div>
                                        <input class="form-control" name="diplomes[]" placeholder="Titre du diplome" aria-label="Recipient's text" aria-describedby="my-addon">
                                       </div>
                                <?php endif;?>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" onclick="plus('place2','exp','ref_exp','<?=date('Y') - 50?>','<?=date('Y')?>')" class="col-md-4 col-lg-3 col-form-label">
                                        <span class="">Experiences</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="text-primary">Ajout</span> <i  class="fa fa-plus-circle text-primary" aria-hidden="true"></i>
                                    </label>
                                    <div class="col-md-8 col-lg-9 place2">
                                    <?php foreach ($list_exp as $expp): ?>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <input class="input-group-text  btn btn-outline-dark" type="number" max="<?=date('Y')?>" min="<?=date('Y') - 50?>" value="<?=$expp["ref"]?>" name="upt_ref_experiences[]" placeholder="année"  id="my-addon" style="width: 100px">
                                        </div>
                                        <input type="hidden" value="<?=$expp["id"]?>" name="id_experiences[]">
                                        <input class="form-control" name="upt_experiences[]" placeholder="Titre du diplome" value="<?=$expp["titre"]?>" aria-label="Recipient's text" aria-describedby="my-addon">
                                        <div class="input-group-prepend">
                                        <a class="input-group-text btn text-danger" href="?supprimer-experience&id=<?=$expp["id"]?>" name="suppr_ref" placeholder="année"  id="my-addon" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                    <?php if (isset($exp) and !empty($exp)):
    $i = 0;foreach ($exp as $exp): $i++;
        ?>
		                                       <div class="input-group  mt-2">
		                                        <div class="input-group-prepend">
		                                            <input type="number" value="<?=$ref_exp[$i - 1]?>" max="<?=date('Y')?>" min="<?=date('Y') - 50?>" name="ref_exp[]" class="input-group-text btn btn-outline-dark" placeholder="année" id="my-addon" style="width: 100px">
		                                        </div>
		                                        <input class="form-control" type="text" name="exp[]" value="<?=$exp?>" placeholder="experiences" aria-label="Recipient's text" aria-describedby="my-addon">
		                                       </div>
		                                    <?php endforeach;else: ?>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="number" name="ref_exp[]" max="<?=date('Y')?>" min="<?=date('Y') - 50?>" class="input-group-text btn btn-outline-dark" placeholder="année" id="my-addon" style="width: 100px">
                                        </div>
                                        <input class="form-control" type="text" name="exp[]" placeholder="experiences" aria-label="Recipient's text" aria-describedby="my-addon">
                                       </div>
                                    <?php endif;?>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="Job" onclick="plus('place3','competence','ref_compet','0','100')" class="col-md-4 col-lg-3 col-form-label">
                                        <span class="">Compétences</span>&nbsp;&nbsp;&nbsp;
                                        <span class="text-primary">Ajout </span><i class="fa fa-plus-circle text-primary" aria-hidden="true"></i>
                                    </label>
                                    <div class="col-md-8 col-lg-9 place3">
                                    <?php foreach ($list_compet as $compet): ?>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <input class="input-group-text  btn btn-outline-dark" value="<?=$compet["ref"]?>" max="100" min="0" name="upt_ref_experiences[]" placeholder="année"  id="my-addon" style="width: 100px">
                                        </div>
                                        <input type="hidden" value="<?=$compet["id"]?>" name="id_experiences[]">
                                        <input class="form-control" name="upt_experiences[]" placeholder="Titre du diplome" value="<?=$compet["titre"]?>" aria-label="Recipient's text" aria-describedby="my-addon">
                                        <div class="input-group-prepend">
                                        <a class="input-group-text btn text-danger" href="?supprimer-competence&id=<?=$compet["id"]?>" name="suppr_ref" placeholder="année"  id="my-addon" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                    <?php if (isset($competence)): $j = 0;foreach ($competence as $compet):
        $j++
        ?>	                                       <div class="input-group mt-2">
		                                        <div class="input-group-prepend">
		                                            <input type="number" value="<?=$ref_compet[$j - 1]?>" name="ref_compet[]" min="0" max="100" class="input-group-text btn btn-outline-dark" placeholder="%" id="my-addon" style="width: 100px">
		                                        </div>
		                                        <input class="form-control" type="text" value="<?=$compet?>" name="competence[]" placeholder="compétences" aria-label="Recipient's text" aria-describedby="my-addon">
		                                       </div>
		                                    <?php endforeach;else: ?>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="number" name="ref_compet[]" min="0" max="100" class="input-group-text btn btn-outline-dark" placeholder="%" id="my-addon" style="width: 100px">
                                        </div>
                                        <input class="form-control" type="text" name="competence[]" placeholder="compétences" aria-label="Recipient's text" aria-describedby="my-addon">
                                       </div>
                                    <?php endif;?>
                                    </div>
                                </div>




                                <div class="row mb-3">
                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Addresse</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="adresse" type="text" class="form-control" id="Address" value="<?=@$users["adresse"]?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="telephone" type="text" class="form-control" id="telephone" value="<?=@$users["telephone"]?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email" value="<?=@$users["email"]?>">
                                    </div>
                                </div>

                                <div class="row mb-3 ">
                                    <div class="col-md-3"></div>
                                    A votre connexion, vous utilisez cette email pour l'identifiant
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

                        <div class="tab-pane fade pt-3 <?php if (isset($page) and !isset($info)) {echo "show active";}?>" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form method="post" action="">
                                <input type="hidden" value="<?=$user["id_utilisateur"]?>" name="id_utilisateur">
                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mot de passe </label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="mdp" value="<?=@$mdp?>" type="password" class="form-control <?=@$colo?>" id="currentPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="mdp1" type="password" class="form-control <?=@$page?>" id="newPassword" value="<?=@$mdp1?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmer mot de passe</label>
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

function plus(ref,name,refer,min,max){
    var place = document.querySelector("."+ref);
    var new_element = document.createElement("div");
    new_element.classList = "input-group mt-2";
    new_element.innerHTML = "<div class='input-group-prepend'><input type='number' min='"+min+"' max='"+max+"' name='"+refer+"[]' class='input-group-text btn btn-outline-dark' placeholder='' id='my-addon' style='width: 100px'></div><input class='form-control' type='text' name='"+name+"[]' placeholder='' aria-label='Recipient's text' aria-describedby='my-addon'>";
    place.appendChild(new_element);
}

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