
<?php 


if($list_entreprise->rowcount() == 0 and $_SESSION["utilisateur"]["contrat"] == 2):?>
  <script>window.location.href="configurer"</script>
<?php 
else:
        $info_entreprise = $list_entreprise->fetch(PDO::FETCH_ASSOC);
     
endif;?>
<body style="background-color: <?=@$black?>">
    
<div class="col-md-5 card bg-info btn" id="info" style="position: fixed;right: 0;bottom: 10px; z-index: 15000">
<i class="fa fa-info-circle d-inline p-2" aria-hidden="true">Les candidats peuvent vous contacter aux contacts que vous avez fournis</i>
</div>

<script>
    var info = document.getElementById("info");
    setInterval(() => {
        info.style.display = "none";
    }, 6500);

    setInterval(() => {
        info.style.display = "block";
    }, 100000);

</script>

<?php if(isset($err) or isset($disabled) or isset($suc)):?>
<div id="msss" class="col" style="position: fixed; top: 70px; z-index: 150000; right: 10px" tabindex="-1"  aria-hidden="true">
  <div class="card border border-<?=@$color?>">
    <div class="card-b ">
        <?php if(isset($suc)):?>
        <button class="btn"><i class="fa fa-check-circle fa-2x text-success " aria-hidden="true"></i></button>
        <button class="btn text-success"><?=@$suc?></button>
        <?php elseif(isset($err)):?>
            <button class="btn ">
                <i class="fa fa-window-close text-danger" aria-hidden="true"></i>
            </button>
            <button class="btn text-danger"><?=@$err?></button>
        <?php endif;?>
    </div>
</div>

<script>
    <?php if( $list_departement->rowcount() > 0):
        ?>
    var mss = document.querySelector("#msss");

   setTimeout(() => {
    mss.style.display = "none";
   }, 5000);

   <?php else: $disabled = "disabled"; $err = "Les departements ou postes sont vides, veuillez, veuillez les gérer d'abord";endif;?>
</script>
<?php endif;?>
</div>
<?php if(isset($_GET["page"])): $page = $_GET["page"]; include_once "partials/sidebar.php"; if($page == "candidats"): ?>

<div  id="main" class="bg-<?=@$primaire?>">
        




    <div class="article-list mb-5" style="color: black">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Liste des candidats</h2>
            </div>

<div class="input-group mb-3">
    <input class="form-control" type="text" name="" placeholder="code de poste ou nom" aria-label="" aria-describedby="my-addon">
    <div class="input-group-append">
        <button class="btn btn-primary " id="my-addon"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
</div>


            <div class="row articles">
                <div class="item col-md-4 mb-6 shadow">
                    <div class="modal-header align-items-center">
                        <div>
                            <h4 class="name text-dark modal-title"><strong><div class="image mr-2"><?php img_profil('image2.jpeg')?></div>
                            <a href="" class="text-dark">Nom du candidat</a></strong> </h4>
                        </div>

                    </div>
                    <h5><a href="" class='text-dark'><strong>Code offre</strong></a>: <a href="">253</a></h5>
                
                    <p class="description">
                       <div class="dropdown open">
                        <button
                            class="btn btn-secondary form-control dropdown-toggle"
                            type="button"
                            id="triggerId"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                           option
                        </button>
                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <button class="dropdown-item" href="#">Action</button>
                            <button class="dropdown-item disabled" href="#">
                                Disabled action
                            </button>
                        </div>
                       </div>
                       
                   </p>
                    
                    <h6>Date de candidature: 12-21-2005</h6>
                    <div class="mb-2">
                        <a class="action" href="#" class="btn btn-primary"><i class="fa fa-phone text-success" aria-hidden="true"></i>&nbsp;<span>Appeler</span></a>
                        &nbsp;&nbsp;
                        <a class="action" href="#" class="btn btn-danger"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<span>Envoyer E-mail</span></a>
                    </div>
                </div>         
    </div>
    </div>
</div>


<?php else:?>
    offre actuel
<?php endif;?>



<?php elseif(isset($_GET["action"])): $action = $_GET["action"]; if($action == 'publier'):?>
    <div class="container mt-2">
       <br><br><br><br>
<form action="" method="post" class="">
    <div class="row">
        <div class="text-center">
        </div>
    </div>
 <div class="row">
<div class="col-md-4 card shadow p-3">
    <h2>References</h2>
    <select  id="categories" class="btn btn-outline-dark text-start mb-2"  name="categori" placeholder="Categories" >
                    <option value="">Selectionner Categories</option>
                        <?php
                        foreach($categorie as $categories):?>
                            <option <?php if(isset($categori) and $categori == $categories["nom"]){echo "selected";}?> value="<?=$categories["nom"]?>"><?=$categories["nom"]?></option>
                        <?php endforeach;?>
                <option value="n">autre</option>
     </select>
     <input type="text" name="new_categorie" id="new-categorie" class="btn border-dark mb-2 text-start" style="display: none" placeholder="Nouvel categorie">

     <label for=""><h5>Contrat</h5></label>
        <input list="contrat" class="border-secondary btn btn-outline-<?=@$secondaire?>  text-start mb-2 ml-2" value="<?=@$contra?>" name="contrat" placeholder="contrat">
        <datalist  id="contrat">
            <?php foreach($contrat as $contrats):?>
            <option value="<?=$contrats["nom"]?>"></option>
            <?php endforeach;?>
            <option value="n">autre</option>
        </datalist>
        <label for=""><h5>Villes</h5></label>
    <input type="text" name="villes" id="" placeholder="ville" value="<?=@$info_entreprise["pays"]?>" class="btn border-secondary btn-outline-<?=@$secondaire?> mb-2">      
</div>


<div class="col-md-8">
    <h2 class="d-block text-<?=@$secondaire?>">Detail du publication</h2>
    <div class="input-group mb-2 mt-0">
        <input type="text" class="text-start form-control btn border-dark" value="<?=@$titre?>" name="titre" placeholder="Titre du poste">          
    </div>   
    <input type="hidden" name="description" id="description">   
    <div class="card">
        <div class="quill-editor-full  bg-<?=@$primaire?> text-<?=@$secondaire?>"  style="min-height: 200px" id="editors">
                <p><?=@$description?></p>
        </div>
    </div>     
</div>
       
    <div class="button-group">
        <button class="btn btn-primary" id="publie" name="publier">Publier</button>
        <a class="btn btn-danger"  href = "accueil">Annuler</a>
    </div>
</div>
 </div>
</form>
   
</div>
</body>



<?php endif;?>

<?php else: require_once "partials/sidebar.php";

?>


<div class="main " id="main">

<?php if(isset($_GET["ref_pub"]) and isset($_GET["publication"])): ?>
        <div class="col">
<div class="card bg-<?=@$primaire?> text-<?=@$secondaire?>" style="min-height: 70vh">
    <div class="card-body pt-3">
        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
                <button class="nav-link  active bg-<?=@$primaire?> text-<?=@$secondaire?>" data-bs-toggle="tab" data-bs-target="#profile-overview">Publication</button>
            </li>

            <li class="nav-item">
                <button class="nav-link bg-<?=@$primaire?> text-<?=@$secondaire?>" data-bs-toggle="tab" data-bs-target="#profile-edit">Candidats</button>
            </li>
            
            <li class="nav-item">
                <button class="nav-link bg-<?=@$primaire?> text-<?=@$secondaire?>" data-bs-toggle="tab" data-bs-target="#profile-change-password">Modifier la publication</button>
            </li>
        </ul>
        <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <div class="row ">
                    <?php if($pub->rowcount() > 0):?>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3>Poste: <?=$info_pub["poste"]?></h3>          
                        </div>
                            <div class="card-body mb-0">
                                <h5 class="card-title">Categorie: <?=$info_pub["categorie"]?></h5> 
                                <h6><b>Ville: <?=$info_pub["villes"]?></b></h6>
                                <?=@$info_pub["description"]?>
                                </div>
                    </div>
                    <?php else: rediriger("recrutement");endif;?>
                    
                </div>
                
            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->

            <div class="table-responsive">
                <table class="table table-<?=@$primaire?> table-striped border datatable w-100" style="min-height: 40VH">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>email</th>
                            <th>Profil</th>
                            <th>status</th>
                            <th>Date</th>
                            <th>action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list_candidats as $candidats):?>
                        <tr>
                          <td><input type="checkbox" name="" id=""></td>
                          <td><?=$candidats["nom_utilisateur"]?></td>
                          <td><?=$candidats["email"]?></td>
                          <td><?=$candidats["profil"]?></td>
                          <td>en attente</td>
                          <td><?php 
                          $dates = date_create($candidats["date_candidature"]);
                          echo date_format($dates,"Y-m-d")?></td>
                          <td>
                            <div class="dropdown">
                                <button
                                    class="btn btn-secondary dropdown-toggle"
                                    type="button"
                                    id="triggerId"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    option
                                </button>
                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Accepter</a>
                                    <a class="dropdown-item" href="#">Refuser</a>
                                    <a class="dropdown-item" href="profil?id=<?=$candidats["id_utilisateur"]?>&type">Voir son CV</a>
                                    <a class="dropdown-item" href="#">Supprimer</a>
                                </div>
                            </div>
                                              
                          </td>
                          <td>
                          </td>
                        </tr>
                        
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>

                <!-- End Profile Edit Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">

            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form method="post" action="">

                    <div class="row mb-3">
                        <label for="currentPassword" class="col-md-3">Categorie</label>
                        <div class="col-md-3 col-lg-9">
                            <select  id="categories" class="btn btn-outline-dark text-start mb-2"  name="categori" placeholder="Categories" >
                            <option value="">Selectionner Categories</option>
                            <?php
                            foreach($categorie as $categories):?>
                            <option <?php if($info_pub["categorie"] == $categories["nom"]){echo "selected";}?> value="<?=$categories["nom"]?>"><?=$categories["nom"]?></option>
                            <?php endforeach;?>
                            <option value="n">autre</option>
                            </select>
     <input type="text" name="new_categorie" id="new-categorie" class="btn border-dark mb-2 text-start" style="display: none" placeholder="Nouvel categorie">
                        </div>

                        <label for="" class="col-md-4 col-lg-3 col-form-label">Contrat</label>
                        <div class="col-md-8 col-lg-9">
                        <input list="contrat" value="<?=@$info_pub["contrat"]?>" class="border-secondary form-control btn btn-outline-<?=@$secondaire?>  text-start mb-2 ml-2" value="<?=@$contra?>" name="contrat" placeholder="contrat">
                        </div>
                        <datalist  id="contrat">
                            <?php foreach($contrat as $contrats):?>
                            <option value="<?=$contrats["nom"]?>"></option>
                            <?php endforeach;?>
                            <option value="n">autre</option>
                        </datalist>
 
                    </div>

                    <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Ville</label>
                        <div class="col-md-8 col-lg-9">
                        <input type="text" name="villes" id="" placeholder="ville" value="<?=$info_pub["villes"]?>" class="form-control text-start btn border-secondary btn-outline-<?=@$secondaire?> mb-2">      
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Poste</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="titre"  class="form-control" id="renewPassword" value="<?=$info_pub["poste"]?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Description</label>
                        <div class="col-md-8 col-lg-9">

 <input type="hidden" name="description" id="description">   
    <div class="card">
            <div class="quill-editor-full  bg-<?=@$primaire?> text-<?=@$secondaire?>"  style="min-height: 200px" id="editors">
            <p><?=@$info_pub["description"]?></p>
            </div>
    </div>


                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" id="publie" value="<?=$info_pub["id"]?>" class="btn btn-primary" name="modif_pub">Modifier la publication</button>
                    </div>
                </form>
                <!-- End Change Password Form -->

            </div>

        </div>
        <!-- End Bordered Tabs -->

    </div>
</div>

</div>



            <?php else:?>

        <?php  if($list_offres->rowcount()==0){?>
    <br><br>
        
            <div class="card">
                <div class="card-header bg-dark text-light">
        <h2>Historique de publication</h2>        
            </div>
            <div class="card-body py-5">
                        <center>
                            <h4 class="bg-gradient-primary">Voun n'avez pas encore fait des publications</h4>
                            <p><a href="?action=publier" class="btn btn-dark"><i class="bi bi-plus-circle"></i> Creer</a></p>
                        </center>
            </div>                 
            </div>            
        <?php }else{?>
         
                    <div class="article-list mb-5" style="color: black">
                            <div class="container">
                                <div class="intro">
                                    <h2 class="text-center mb-2">Liste des offres</h2>
                                </div>
                                <div class="row articles">
                                <?php 
                            
                                foreach ($offre_list as $listes_offre):?>
                                <div class="card p-3 m-2 col-md-5 mb-2 ">
                                        <div class="modal-header align-items-center">
                                            <div>
                                                <h4 class="name text-dark modal-title p-3"><strong><div class="image mr-2"></div><?=@$listes_offre["poste"]?></strong> </h4>
                                            </div>
                                        </div>
                                        <h5>
                                            <a href="recrutement?publication&ref_pub=<?=@$listes_offre["id"]?>" class='text-dark text-decoration-none'><strong>Code offre: </strong><?=$listes_offre["id"]?></a><a href=""></a>
                                        </h5>

                                        <h5>
                                            <a href="" class='text-dark text-decoration-none'><strong>Nombre candidats: </strong></a> <a href="">253</a>
                                        </h5>                   
                                
                                        <h6>Date de publication: <?php 
                                        $date = date_create($listes_offre["date_publication"]);
                                       echo date_format($date, "Y-m-d")?></h6>
                                        <p class="description">
                                        <div class="dropdown open">
                                            <button
                                                class="btn btn-secondary form-control dropdown-toggle"
                                                type="button"
                                                id="triggerId"
                                                data-bs-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                Option
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                                <a class="dropdown-item" href="recrutement?publication&ref_pub=<?=@$listes_offre["id"]?>">Detail</a>
                                                <button class="dropdown-item text-danger" href="#">
                                                Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                                <?php endforeach;?>
                                
                            </div>
                            </div>
                            <div class="mt-5 mb-4">
                        <center>
                            <h2><a href="?page=candidats">Candidats <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></h2>
                        </center>
                        
                    </div>
                           
<?php };endif;endif;?>



<?php
$date1=date_create("2013-01-01");
$date2=date_create("2013-02-10");
$diff=date_diff($date1,$date2);

// %a outputs the total number of days
// echo $diff->format("%a.");
?>


<style>
    .image{
        width: 50px;
        height: 50px;
        overflow: hidden;
        display: inline;
        
    }

    .image img{
            width: 30px;
            height: 30px;
            object-fit: cover;
    }


</style>


<script>
var btn_contacts = document.querySelector(".btn_contact");
var btn_emails = document.querySelector(".btn_emails");
var contacts = document.querySelector(".contacts");
var emails = document.querySelector(".emails");


    btn_contacts.onclick = function(){
      contacts.classList.toggle("d-inline");   
    }
 
    btn_emails.onclick = function(){
        emails.classList.toggle("d-inline"); 
    }
 

</script>


         
<script>
            var categ = document.getElementById("categories");
            var new_categ = document.getElementById("new-categorie");
            categ.onchange = function(){
                if(categ.value == "n"){
                    new_categ.style.display = "inline";
                }else{
                    new_categ.style.display = "none";
                }
            
            }
        </script>



<script>
                var btn_pubs = document.querySelector("#publie");
                var editors = document.querySelector("#editors");
                var description = document.querySelector("#description");
                btn_pubs.onclick = function(){
                    for (i=0; i< editors.childElementCount - 1; i++){
                        if(editors.children[i].innerText.match(/[a-zA-Z]/g)){
                            description.value = editors.children[i].innerHTML;
                        }
                        
                    };
                }
              </script>