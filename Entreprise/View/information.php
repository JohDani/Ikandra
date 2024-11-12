<?php 

include_once "partials/sidebar.php";

 if($list_departement->rowcount() == 0){
    $disabled = "disabled";
    $err = "Veuillez configurer d'abord les postes et departements";
    $color = "danger";
 }

 if(isset($_GET["id"])){
    if(isset($_GET["type"])){
        $competence_candidat->execute(array($_GET["id"]));
        $experience_candidat->execute(array($_GET["id"]));
        $diplome_candidat->execute(array($_GET["id"]));
        $show_candidat->execute(array($_GET["id"]));
        $info_candid = $show_candidat->fetch(PDO::FETCH_ASSOC);
    }else{
        $info_pers->execute(array($_GET["id"]));    
        $profils=$info_pers->fetch(PDO::FETCH_ASSOC);
    }

    
 }

?>

<body style="background-color: <?=@$black?>">
    
<main id="main" class="main">
<div class="pagetitle">
   
</div>
<!-- End Page Title -->
<?php if(isset($err) or isset($disabled) or isset($suc)):?>
<div id="msss" class="col" style="position: fixed; top: 70px; z-index: 150000; right: 10px"  aria-hidden="true">
  <div class="card border border-<?=@$color?>">
    <div class="card-b ">
        <?php if(isset($suc)):?>
        <button class="btn"><i class="fa fa-check-circle fa-2x text-success " aria-hidden="true"></i></button>
        <button class="btn text-success"><?=$suc?></button>
        <br>
        <a href="personnels" class="btn ml-2">Voir les personnels</a>
        <?php elseif(isset($err)):?>
            <button class="btn ">
                <i class="fa fa-window-close text-danger" aria-hidden="true"></i>
            </button>
            <button class="btn text-danger"><?=@$err?></button>
        <?php endif;?>
    </div>
  </div>
</div>

<script>
    <?php if( $list_departement->rowcount() > 0):
        ?>
    var mss = document.querySelector("#msss");

   setTimeout(() => {
    mss.style.display = "none";
    window.refresh();
   }, 5000);

   <?php else: $disabled = "disabled"; $err = "Les departements ou postes sont vides, veuillez, veuillez les gérer d'abord";endif;?>
</script>
<?php endif;?>

<section class="section profile ">
    <div class="row">

        <div class="">

            <div class="card bg-<?=@$primaire?> text-<?=@$secondaire?>">
                <div class="card-body pt-3">
                

            <div class=" d-flex flex-wrap ">
                <div class="col-lg-6"> 
                   
                    <?php if(isset($_GET["id"])):?>
                        <?php if(!isset($_GET["type"])):?><h2 id="nom_view" class="text-<?=@$secondaire?> mt-3"><?=@$profils["nom_personnel"]?></h2><?php endif;?>
                        <h3 class="text-<?=@$tertiaire?>"><?=@$info_candid["nom_utilisateur"]?></h3>
                        <p id="profil_view"><?=@$profils["nom_poste"].@$info_candid["profil"]?></p>
                    <?php else:?>
                    <h2 id="nom_view" class="text-<?=@$tertiaire?>"></h2>
                    <h3 id="profil_view">profil</h3>
                    <?php endif;?>
                    <div class="social-links mt-2">
                
                    </div>
                </div>
                <div class="col text-center p-2 card bg-<?=$primaire?>" style="position: absolute; right: 20px">
                    <div class="profil text-center" >
                       <!-- <img class="" id="pdp" src="" alt="">  -->
                       <?php if(isset($_GET["id"])):
                        if(isset($_GET["type"])):
                         if(file_exists("../../assets/images/".$info_candid["images"])):?>
                        <img id="pdps" src="../../assets/images/<?=@$info_candid["images"]?>" alt="">
                        <i class="fa fa-user-circle fa-7x d-none icone" aria-hidden="true"></i>
                        <?php else:?>
                        <i class="fa fa-user-circle fa-6x icone" aria-hidden="true"></i>
                        <img src="" id="pdps" alt="" class="ppd">
                        <?php endif;else: 
                        if(file_exists("../../assets/images/".$profils["image"])):?>
                        <img id="pdps" src="../../assets/images/<?=@$profils["image"]?>" alt="">
                        <i class="fa fa-user-circle fa-7x d-none icone" aria-hidden="true"></i>
                        <?php else:?>
                        <i class="fa fa-user-circle fa-7x icone" aria-hidden="true"></i>
                        <img src="" id="pdps" alt="" class="ppd">
                        <?php endif;endif;else:?>
                        <img src="" id="pdps" alt="" class="ppd">
                        <i class="fa fa-user-circle fa-7x icone" aria-hidden="true"></i>
                        <?php endif;?>
                    </div>
                   
                <style>

                
                    .profil{
                        object-fit: cover;
                        overflow: hidden;
                        
                    }

                    #pdps{
                        width: 115px;
                        height: 115px;
                        object-fit: cover;
                        
                    }

                    .ppd{
                        display: none;
                    }

                    #pdp{
                        width: 115px;
                        height: 115px;
                        object-fit: cover;
                    }

                </style>

                </div>
                </div>
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-dark nav-tabs nav-tabs-bordered p-2">

                        <li class="nav-item">
                            <?php if(isset($_GET["action"]) and !isset($_GET["ajout"])):?><button class="btn text-<?=@$secondaire?> <?php if(!isset($_GET["ajout"])){echo "active";}?>" data-bs-toggle="tab" data-bs-target="#profile-overview">Information</button><?php endif;?>
                        </li>

                        <li class="nav-item">
                            <?php if(!isset($_GET["type"])):?><button class="btn text-<?=@$secondaire?> <?php if(isset($_GET["ajout"])){echo "active";}?>" data-bs-toggle="tab" data-bs-target="#profile-edit"><?php if(isset($_GET["id"])){echo "Modifier";}else{echo "Ajout";}?></button><?php endif;?>
                        </li>
                        
                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade <?php if(isset($_GET["action"]) and !isset($_GET["ajout"])){echo "active  show";}?> profile-overview" id="profile-overview">
                        <div class="container">
                            <div class="row"> 
                        <div class="col-md-6" id="borrdd" >
                            <div class="row">Information personnelle</div>

                            <div class="row">
                                <div class="col-2 label text-<?=@$secondaire?>">
                                    <i class="fa fa-address-card" aria-hidden="true"></i>   
                            </div>
                                <div class="col text-<?=@$tertiaire?>">- <?=@$profils["nom_personnel"].@$info_candid["nom_utilisateur"]?></div>
                            </div>

                            <style>
                                #borrdd{
                                border-right: 1px solid;
                                }
                                
                                @media(max-width:767px){
                                        #borrdd{
                                            border-right: none;
                                        }
                                    }
                                
                            </style>

                            <div class="row">
                                <div class="col-2 label text-<?=@$secondaire?>">
                                    <i class="fas  fa-map-marker-alt" aria-hidden="true"></i>
                                </div>
                                <div class="col  text-<?=@$tertiaire?>">- <?=@$profils["adresse"].@$info_candid["adresse"]?></div>
                            </div>

                            <div class="row">
                                <div class="col-2 label text-<?=@$secondaire?>">
                                    <i class="fas fa-envelope fa-1x"></i>
                                </div>
                                <div class="col text-<?=@$tertiaire?>">- <?=@$profils["email"].@$info_candid["email"]?></div>
                            </div>
                            <div class="row">
                                <div class="col-2 label text-<?=@$secondaire?>">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                                <div class="col text-<?=@$tertiaire?>">- <?=@$profils["telephone"].@$info_candid["telephone"]?></div>
                            </div>
                            <div class="row">
                                <div class="col-2 label text-<?=@$secondaire?>">
                                    Remarque:
                                </div>
                                <div class="col text-<?=@$tertiaire?>">- <?=$profils["remarque"].@$info_candid["remarques"]?></div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="row">
                                <span class="col">Informations professionnelles</span>
                            </div>
                            <?php if(isset($_GET["type"])):?>
                                <div class="row">
                                <div class="col label text-<?=@$secondaire?>">Diplômes</div>
                                <div class="col text-<?=@$tertiaire?>">
                                <?php if($diplome_candidat->rowcount() == 0){echo "Ce candidat n'a défini aucun Diplôme";}?>
                                    <ul>
                                        <?php foreach($diplome_candidat as $diplome):?>
                                        <li><b><?=$diplome["ref"]?></b> <?=$diplome["titre"]?></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col label text-<?=@$secondaire?>">Experience</div>
                                <div class="col text-<?=@$tertiaire?>">
                                <?php if($experience_candidat->rowcount() == 0){echo "Aucun expérience défini par le candidat";}?>
                                    <ul>
                                        <?php foreach($experience_candidat as $experience):?>
                                        <li><b><?=$experience["ref"]?></b> <?=$experience["titre"]?></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col label text-<?=@$secondaire?>">Compétences</div>
                                <div class="col text-<?=@$tertiaire?>">
                                <?php if($competence_candidat->rowcount() == 0){echo "Ce candidat n'a défini aucun compétence";}?>
                                    <ul>
                                        <?php foreach($competence_candidat as $competence):?>
                                        <li><b><?=$competence["ref"]?></b> <?=$competence["titre"]?></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                            <?php else:?>
                            <div class="row">
                                <div class="col label text-<?=@$secondaire?>">Departement</div>
                                <div class="col text-<?=@$tertiaire?>"><?=@$profils["nom_departement"]?></div>
                            </div>

                            <div class="row">
                                <div class="col label text-<?=@$secondaire?>">Poste</div>
                                <div class="col text-<?=@$tertiaire?>"><?=@$profils["nom_poste"]?></div>
                            </div>

                            <div class="row">
                                <div class="col label text-<?=@$secondaire?> ">Salaire</div>
                                <div class="col  text-<?=@$tertiaire?>"><?php
                                echo @number_format(@$profils["salaire"])?>  <b>Ar</b></div>
                            </div>

                            <div class="row">
                                <div class="col label text-<?=@$secondaire?>">Contrats</div>
                                <div class="col  text-<?=@$tertiaire?>"><?=@$profils["contrat"]?></div>
                            </div>
                            <div class="row">
                                <div class="col label text-<?=@$secondaire?>">Date debut</div>
                                <div class="col  text-<?=@$tertiaire?>">
                                <?=@$profils["date_debut"]?>
                                </div>
                            </div>
                            <?php endif;?>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="tab-pane <?php if(isset($_GET['ajout'])):?>active<?php endif;?> pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form method="post" action="" enctype="multipart/form-data">
                                <?php if(isset($_GET["id"])):?>
                                    <input type="hidden" name="re_faire" value="<?=@$profils["image"]?>">
                                    <input type="hidden" name="verif" value="<?=$profils["id_poste"]?>">
                                <?php endif;?>
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Importer image: </label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="file" accept="image/*" name="sary" id="sarye" class="d-none">
                                        <div class="pt-2">
                                            <label for="sarye">
                                        <i class="fa fa-camera fa-2x m-auto text-<?=@$tertiaire?>" aria-hidden="true"></i>    
                                            </label>
                                        </div>
                                    </div>
                                </div>
                           
                                
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Nom et prenom</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="nom" onchange="prev('nom_view', this)" placeholder="Nom et prenom" type="text" class="form-control bg-<?=@$primaire?> text-<?=@$secondaire?>" id="fullName" value="<?=@$profils["nom_personnel"]?>">
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="company" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Departement</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="id_depart"  class="form-control bg-<?=@$primaire?> text-<?=@$secondaire?>" id="opt_departement">
                                            <option value="0">Selectionner le departement</option>
                                            <?php foreach($departs as $dio):?>
                                            <option class="s_dep" 
                                            <?php if(isset($id_depart) and $id_depart == $dio["id_departement"]){echo "selected";}?> value="<?=$dio["id_departement"]?>"><?=$dio["nom_departement"]?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3" >
                                    <div id="postes">
                                <label for="Job" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Poste</label>
                                
                                    <div class="col-md-8 col-lg-9">
                                       <input type="text" class="form-control bg-<?=@$primaire?> text-<?=@$secondaire?>" id="new_post" name="new_post" value="<?=@$new_post?>" placeholder="Nouveau poste"> 
                                        <select name="id_post" class="form-control bg-<?=@$primaire?> text-<?=@$secondaire?>" id="option">
                                            <option value="0" selected>Selection Poste</option>
                                            <?php foreach($poster as $pts):?>
                                            <option <?php if(isset($id_poste) and $id_poste == $pts["id_poste"] or (isset($profils["id_poste"]) and $profils["id_poste"] == $pts["id_poste"])){echo "selected";}?> value="<?=$pts["id_poste"]?>" style="display: none" class="poste ref_<?=$pts["id_departement"]?>"><?=$pts["nom_poste"]?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    </div>

                                </div>

                                <style>
                                    .pote{
                                        display :none;
                                    }
                                </style>

                                <div class="row mb-3">
                                    <label for="Country" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Adresse</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="adresse" type="text" class="form-control bg-<?=@$primaire?> text-<?=@$secondaire?> border <?=@$adr?>" id="adresse" value="<?php if(isset($_GET["id"])){echo $profils["adresse"];}else{echo @$adresse;}?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Salaire</label>
                                    <div class="col-md-8 col-lg-9">
                                      
                                        <div class="input-group">
                                            <input name="salaire" type="number" class="form-control bg-<?=@$primaire?> text-<?=@$secondaire?>" id="salaire" value="<?php if(isset($_GET["id"])){echo $profils["salaire"];}else{echo @$salaire;}?>">  
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="my-addon"><b>Ariary</b></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Contrats</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="input-group">
                                            <input name="contrat" type="" class="form-control bg-<?=@$primaire?> text-<?=@$secondaire?>" id="contrat" value="<?php if(isset($_GET["id"])){echo $profils["contrat"];}else{echo @$contrats;}?>">  
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Date debut</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="date" value="<?php if(isset($_GET["id"])){echo $profils["date_debut"];}else{echo date("Y-m-d");}?>" type="date" min="<?=date("Y")-20?>-01-01" max="<?=date("Y")+5?>-01-01" class="form-control text-<?=@$secondaire?> bg-<?=@$primaire?>"  id="debut" placeholder="ex: 2024-01-12" value="<?=@$email?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Telephone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="telephone" type="text" class="form-control text-<?=@$secondaire?> <?=@$ttc?> bg-<?=@$primaire?>" id="telehone" value="<?php if(isset($_GET["id"])){echo $profils["telephone"];}else{echo @$telephone;}?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email"  class="form-control text-<?=@$secondaire?> bg-<?=@$primaire?> <?=@$ttc." ".$em_cl?>"  id="email" value="<?php if(isset($_GET["id"])){echo $profils["email"];}else{echo @$email;}?>">
                                    </div>
                                </div>

                              

                                <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-3 col-form-label text-<?=@$tertiaire?>">Remarque</label>
                                    <div class="col-md-8 col-lg-9">
                                        <textarea name="remarque" class="form-control bg-<?=@$primaire?> text-<?=@$secondaire?>" id="about" style="height: 80px"><?php if(isset($_GET["id"])){echo $profils["remarque"];}else{echo @$remarque;}?></textarea>
                                    </div>
                                </div>
                                    
                                <div class="text-center " style="">
                                    <button type="submit" name="ajout_personnel" id="enregistre"  class="btn btn-primary form-control <?php if(isset($disabled)){echo "d-none";}?>">Enregistrer</button>
                                </div>
                                    
                            </form>
                            <!-- End Profile Edit Form -->

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form>

                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control" id="currentPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
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
<style>
    #postes{
        display: none;
    }
</style>


<script>
   

    var nom_input = document.getElementById("fullName");
    var nom_view = document.getElementById("nom_view");
    var btn_save = document.querySelector("#enregistre");
    var date_d = document.getElementById("debut");



   

    if(!nom_input.value){
        nom_view.innerText = "Information";
        btn_save.disabled = "true";
    }else{
        // nom_view.innerText = this.value;
        btn_save.removeAttribute("disabled");
    }

    nom_input.onchange = function(){
        if(!nom_input.value){
        nom_view.innerText = "Information";
        btn_save.disabled = "true";
    }else{
        nom_view.innerText = this.value;
        btn_save.removeAttribute("disabled");
    }
    }

    var opt_post = document.getElementById("option");
    var depart = document.getElementById("opt_departement");
    var s_dep = document.querySelectorAll(".s_dep");


    var new_post = document.querySelector("#new_post");
    var postes = document.querySelector("#postes");
    var poste = document.querySelectorAll(".poste");
    var adresse = document.getElementById("adresse");
    var salaire = document.getElementById("salaire");


    var contrat = document.getElementById("contrat");

    btn_save.onclick = function(e){
        if(opt_post.style.display == "block" && opt_post.value == 0){
            e.preventDefault();
            opt_post.focus();
        }else if(new_post.style.display == "block" && !new_post.value){
            e.preventDefault();
            new_post.focus();
        }else if(!adresse.value){
            e.preventDefault();
            adresse.focus();
        }else if(!salaire.value){
            e.preventDefault();
            salaire.focus();
        }else if(!contrat.value){
            e.preventDefault();
            contrat.focus();
        }else if(!date_d.value){
            e.preventDefault();
            date_d.focus();
        }
    }

    depart.onchange = function(){
        if(depart.value !== "0"){
             postes.style.display = "flex";   
        var elem = document.querySelectorAll(".ref_"+depart.value);

        localStorage.setItem("depart", depart.value);

     if(elem.length == 0){
        opt_post.style.display = "none";
        new_post.style.display = "block";
     }else{
        opt_post.style.display = "block";
        new_post.style.display = "none";
        poste.forEach(elements => {
            elements.style.display = "none";
        });
        elem.forEach(elemen => {
        elemen.style.display = "block";
        });
      
     };

        }else{
            postes.style.display = "none";
        }
    }




    var departement = localStorage.getItem("depart");

   if(departement){
    if(departement !== "0"){

        s_dep.forEach(s_depart => {
            if(departement == s_depart.value){
                s_depart.setAttribute("selected","");
            };
        });
        
    postes.style.display = "flex";    
    var elements = document.querySelectorAll(".ref_"+departement);


     if(elements.length == 0){
        opt_post.style.display = "none";
        new_post.style.display = "block";
     }else{
        opt_post.style.display = "block";
        new_post.style.display = "none";

        poste.forEach(elements => {
            elements.style.display = "none";
        });
        elements.forEach(elemen => {
        elemen.style.display = "block";
        });
     };

        }else{
            postes.style.display = "none";
        }
   }






                            var affich = document.querySelector("#pdps");
                            var img_src = document.getElementById("sarye");
                            var icones = document.querySelector(".icone");                             
                               var enregistre = localStorage.getItem("importé");

                            if(enregistre){
                                affich.style.display = "unset";
                                icones.style.display = "none";

                                const sources = new Image();
                                sources.src = enregistre;
                                affich.src= sources.src;
                            }
      
                                img_src.onchange = function(){

                                const sary = img_src.files[0];
                                
                                affich.style.display = "block";
                                icones.style.display = "none";
                                affich.style.display = "unset";

                                const affichage = new FileReader();

                                    affichage.onload = function(e){ 
                                    
                                    affich.src = e.target.result;

                                    localStorage.setItem("importé", e.target.result);  
                                }
                                
                            affichage.readAsDataURL(sary);
                                }



                                function prev(e, i){
                                document.querySelector("#"+e).innerText = i.value;           }


                                var fullN = document.getElementById("fullName");
                            </script>



<?php

include_once "partials/foot.php";
?>