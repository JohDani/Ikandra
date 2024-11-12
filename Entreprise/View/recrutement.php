<?php if (isset($err) or isset($suc)): ?>
<div id="msss" class="col" style="position: fixed; top: 70px; z-index: 150000; right: 10px" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="card border border-<?=@$color?>">
    <div class="card-b ">
        <?php if (isset($suc)): ?>
        <button class="btn"><i class="fa fa-check-circle fa-2x text-success " aria-hidden="true"></i></button>
        <button class="btn text-success"><?=@$suc?></button>
        <?php elseif (isset($err)): ?>
            <button class="btn ">
                <i class="fa fa-window-close text-danger" aria-hidden="true"></i>
            </button>
            <button class="btn text-danger"><?=@$err?></button>
        <?php endif;?>
    </div>
</div>

<script>

    var mss = document.querySelector("#msss");
    // setTimeout(() => {
    //     <?php if(isset($_GET["ref_pub"]) and isset($page)):?>
    //         $page="";
    //         window.location.href='?publication&ref_pub=<?=$_GET["ref_pub"]?>';
    //         $page = "";
    //     <?php endif;?>
    // }, 300);
   setTimeout(() => {
    mss.style.display = "none";
   }, 5000);

</script>
<?php endif;?>





<?php

if ($list_entreprise->rowcount() == 0 and $_SESSION["utilisateur"]["contrat"] == 2): ?>
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

</div>
<?php if (isset($_GET["page"])): $page = $_GET["page"];include_once "partials/sidebar.php";if ($page == "candidats"): ?>

				<div  id="main" class="">
				    <div class="article-list mb-5" style="color: black">
				        <div class="container">
				            <div class="intro">
				                <h2 class="text-center text-<?=@$secondaire?> bg-<?=@$primaire?> p-2">Liste des candidats</h2>
				            </div>
				            <div class="row articles">
				            <?php if ($candid_entr->rowcount() == 0): ?>
				                <br><br><br><br><br><br>
				                <center>
				                <div class="card p-5 bg-<?=@$primaire?> text-<?=@$secondaire?> col-md-6 mt-5">
				                    <div class="card-body">
				                        <h5 class="card-title text-secondary">Vous n'avez pas encore des candidats aux offres que vous avez publié</h5>
				                    </div>
				                </div>
				                </center>
				            <?php endif;foreach ($list_candid as $candids): ?>
                <div class="card bg-<?=@$primaire?> text-<?=@$secondaire?> col-md-5 p-3 m-3 shadow">
                    <div class="modal-header align-items-center text-<?=@$secondaire?>">
                    <div style="position:absolute; right: 20px; top:6px">
                                <?php if($candids["status"]==0):?>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning"
                                    >
                                        Attente
                                        <span class="visually-hidden">SS</span>
                                    </span>
                                <?php elseif($candids["status"]==1):?>
                               
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success"
                                    >
                                        Aceptée
                                        <span class="visually-hidden">SS</span>
                                    </span>
                                  
                                  
                                <?php elseif($candids["status"]==2):?>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    >
                                        Refusée
                                        <span class="visually-hidden">SS</span>
                                    </span>
                                <?php endif;?>
                                </div>
                        <div>
                            <h4 class="name text-<?=@$secondaire?> modal-title">
                            <strong><div class="image text-<?=@$secondaire?>">
                            <?php if (file_exists("../../assets/images/".$candids["images"])): ?>
                                <a href="profil?id=<?=$candids["id_profil"]?>&ref&action" class="text-<?=@$secondaire?>">
                                <img class="rounded-circle" src="../../assets/images/<?=$candids["images"]?>" style="width: 50px; height:50px;object-fit: cover;" alt="">
                                </a>
                                <?php else: ?>
                                <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                                    <?php endif;?>
                            </div>
                            <a href="profil?id=<?=$candids["id_profil"]?>&ref&action" class="text-<?=@$secondaire?>"><?=$candids["nom_utilisateur"]?></a></strong> </h4>
                        </div>
                        </div>
                    <h5><a href="?publication&ref_pub=<?=$candids["id_offres"]?>" class='text-<?=@$secondaire?>'><strong>Code offre</strong></a>: <?=$candids["id_offres"]?></h5>

                    <h6>Date de candidature:
                        <b>
                        <?php
$date = date_create($candids["date_candidature"]);
echo date_format($date, "d/m/Y")
?>
                        </b>
                    </h6>

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
                        <a class="dropdown-item" href="profil?id=<?=$candids["id_profil"]?>&ref&action">Voir son CV</a>
                            <?php if($candids["status"]==0):?>
                            <a class="dropdown-item text-success" href="?accepter-candidat=<?=$candids['id_candidat_entreprise']?>&page=candidats">Accepter</button>
                            <a class="dropdown-item text-danger" href="?refuser-candidat=<?=$candids['id_candidat_entreprise']?>page=candidats">
                                Refuser
                            </a>
                            <?php elseif($candids["status"]==1):?>
                            <a href="" class="dropdown-item text-danger">Supprimer</a>
                            <?php else:?>
                            <?php endif;?>
                        </div>
                       </div>

                   </p>


                    <div class="mb-2">
                        <a  href="#" class="text-decoration-none"><i class="fa fa-phone text-success" aria-hidden="true"></i>&nbsp;
                        <span>
                            <?php if (!empty($candids["telephone"])) {
    echo $candids["telephone"];
} else {echo "acucune";}?>
                        </span>
                        </a>
                        &nbsp;&nbsp;
                        <a class="action text-decoration-none" mailto="<?=$candids["email"]?>" href="" class="btn btn-danger">
                            <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<span><?=$candids["email"]?></span>
                        </a>
                    </div>
                </div>
                <?php endforeach;?>
    </div>

    <center>
                            <h2 class="mt-3">
                                <a href="recrutements" class='text-<?=@$secondaire?>'>Voir les offres &nbsp;&nbsp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                            </h2>
                        </center>

    </div>

</div>


<?php else: ?>
    offre actuel
<?php endif;?>



<?php elseif (isset($_GET["action"])): $action = $_GET["action"];if ($action == 'publier'): ?>
				    <div class="container mt-2">
				       <br><br><br><br><br>
				            <h1 class="text-<?=@$secondaire?> bg-<?=@$primaire?>  card"></h1>
				                <form action="" method="post" enctype="multipart/form-data">
				            <div class="row">
				                <div class="col-md-4 card bg-<?=@$primaire?> text-<?=@$secondaire?> shadow p-3">
				                    <h2>References</h2>
			                        <div class="container">
			                            <div class="row">
			                        <div class="col-5 ">

			                        </div>
			                        <div class="col-4 ">
			                        </div>
			                    </div>
			                </div>
				                         <select  id="categories" class="btn btn-outline-secondary text-start mb-2"  name="categori" placeholder="Categories" >
				                                <option value="">Selectionner Categories</option>
				                                    <?php
    foreach ($categorie as $categories): ?>
				                                    <option <?php if (isset($categori) and $categori == $categories["nom"]) {echo "selected";}?> value="<?=$categories["nom"]?>"><?=$categories["nom"]?></option>
				                                     <?php endforeach;?>
                                    <option value="n">autre</option>
                        </select>
                                <input type="text" name="new_categorie" id="new-categorie" class="btn border-dark mb-2 text-start" style="display: none" placeholder="Nouvel categorie">
                            <label for=""><h5>Contrat</h5></label>
                            <input list="contrat" class="border-secondary btn btn-outline-<?=@$secondaire?>  text-start mb-2 ml-2" value="<?=@$contra?>" name="contrat" placeholder="contrat">
                         <datalist  id="contrat">
                            <?php foreach ($contrat as $contrats): ?>
                                <option value="<?=$contrats["nom"]?>"></option>
                            <?php endforeach;?>
                                <option value="n">autre</option>
                        </datalist>
                            <label for=""><h5>Villes</h5></label>
                            <input type="text" name="villes" id="" placeholder="ville" value="<?=@$info_entreprise["pays"]?>" class="btn border-secondary btn-outline-<?=@$secondaire?> mb-2">

                            <input type="file" name="photor" class="d-none" id="sary">
                            <label for="sary">
                              <p>Cliquez pour ajouter ou modifier une image</p>
                                <center>
                            <i class="fa fa-image fa-10x text-secondary icone"></i>
                                </center>
                            <img src="../../assets/images/blog-1.jpg" class="shadow card" alt="" id="img">
                            </label>

                            <style>
                                #img{
                                    object-fit: cover;
                                    width: 100%;
                                    height: 150px;
                                    display: none;
                                }
                            </style>
                </div>






                <div class="col-md-8 " >
                    <h2 class="d-block bg-<?=@$primaire?> p-2 text-<?=@$secondaire?>" style="height: auto">Detail du publication</h2>
                        <div class="input-group  mt-0">
                            <input type="hidden" class="text-start form-control btn border-dark" value="<?=@$titre?>" name="titre" placeholder="Titre du poste">
                        </div>
                            <input type="hidden" name="description" id="description">
                         <div class="card" style="max-height: 500px">
                         <div class="quill-editor-default" id="editors" style="max-height: 400px; min-height: 400px;overflow: scroll"><?=@$description?></div>
                        </div>
                </div>

    <div class="button-group mb-4">
        <button class="btn btn-primary" id="publie" name="publier">Publier</button>
        <a class="btn btn-danger"  href = "accueil">Annuler</a>
    </div>
</div>
 </div>
</form>

</div>
</body>



<?php endif;?>

<?php else:require_once "partials/sidebar.php";

    ?>


				<div class="main" id="main">

				<?php if (isset($_GET["ref_pub"]) and isset($_GET["publication"])):
        if ($list_offres->rowcount() == 0) {rediriger("recrutement");}
        ?>
							        <div class="col">
							<div class="card bg-<?=@$primaire?> text-<?=@$secondaire?>" style="min-height: 70vh">
							    <div class="card-body pt-3">
							        <!-- Bordered Tabs -->
							        <ul class="nav nav-tabs nav-tabs-bordered">

							            <li class="nav-item">
							                <button class="nav-link  <?php if (!isset($page) and !isset($mo)) {echo "active";}?> bg-<?=@$primaire?> text-<?=@$secondaire?>" data-bs-toggle="tab" data-bs-target="#pub">Publication</button>
							            </li>

							            <li class="nav-item">
							                <button class="nav-link <?php if (isset($page)) {echo "show active";}?> bg-<?=@$primaire?> text-<?=@$secondaire?>" data-bs-toggle="tab" data-bs-target="#candidats">Candidats</button>
							            </li>

							            <li class="nav-item">
							                <button class="nav-link <?php if (!isset($page) and isset($mo)) {echo "active";}?> bg-<?=@$primaire?> text-<?=@$secondaire?>" data-bs-toggle="tab" data-bs-target="#modif">Modifier la publication</button>
							            </li>
							        </ul>
							        <div class="tab-content pt-2">

							            <div class="tab-pane fade <?php if (!isset($page) and !isset($mo)) {echo "show active";}?> profile-overview" id="pub">
							                <div class="row ">
							                    <!-- <?php if ($pub->rowcount() > 0): ?> -->
							                    <div class="crd mt-2">
							                        <div class="card-header">
							                            <h3>Catégorie: <?=$info_pub["categorie"]?></h3>
							                        </div>
							                            <div class="card-body mb-0">
							                                <h6><b>Ville: <?=@$info_pub["villes"]?></b></h6>
							                                <?=@$info_pub["description"]?>
							                                </div>

							                    </div>
				                                <?php if (file_exists("../../assets/images/" . $info_pub['images'])): ?>
				                                    <img src="../../assets/images/<?=$info_pub["images"]?>" id="imgs" class="card p-1 mt-2" alt="" srcset="">
				                                <style>
				                            #imgs{
				                                width: 100%;
				                                max-height: 500px;
				                                object-fit: cover;
				                            }
				                        </style>
				                                <?php endif;?>
					                    <!-- <?php else:rediriger("recrutement");endif;?> -->
	                </div>
	            </div>

	            <div class="tab-pane <?php if (isset($page)) {echo "show active";}?> fade profile-edit pt-3" id="candidats">

	                <!-- Profile Edit Form -->
	                <?php if ($candidats->rowcount() == 0): ?>
		                <center>
		                <div class="card p-5 bg-<?=@$primaire?> text-<?=@$secondaire?> col-md-6 mt-5">
		                    <div class="card-body">
		                        <h5 class="card-title text-<?=@$secondaire?>">Vous n'avez pas encore des candidats à cette offre</h5>
		                    </div>
		                </div>
		                </center>
		            <?php else: ?>
            <div class="table-responsive">
                <table class="table table-<?=@$primaire?> datatable w-100" style="min-height: 40VH">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>email</th>
                            <th>Profil</th>
                            <th>status</th>
                            <th>Date</th>
                            <th>action</th>
                            <th>CV</th>
                            <th>supp</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list_candidats as $candidats): ?>
                        <tr style="">
                          <td><?=$candidats["nom_utilisateur"]?></td>
                          <td><?=$candidats["email"]?></td>
                          <td><?=$candidats["profil"]?></td>
                          <td>
                            <?php if ($candidats["status"] == 0): ?>
                                <b><span class="text- text-warning">En attente</span></b>
                            <?php elseif ($candidats["status"] == 1): ?>
                                <b><span class="text-success">Acceptée</span></b>
                            <?php elseif ($candidats["status"] == 2): ?>
                                <b><span class="text-danger">Refusée</span></b>
                            <?php endif;?>
                          </td>
                          <td>
                            <span class="btn text-<?=@$secondaire?>">
                            <?php
$dates = date_create($candidats["date_candidature"]);
echo date_format($dates, "Y-m-d")?>
                            </span>
                          </td>
                          <td>
                            <?php if ($candidats["status"] == 0): ?>
                            <div class="dropdown">
                                <button
                                    class="btn text-<?=@$secondaire?> dropdown-toggle"
                                    type="button"
                                    id="triggerId"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    option
                                </button>
                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                    <a class="dropdown-item"  href="?publication&ref_pub=<?=$_GET["ref_pub"]?>&accepter-candidat=<?=$candidats['id_candidat_entreprise']?>">Accepter</a>
                                    <a class="dropdown-item" href="?publication&ref_pub=<?=$_GET["ref_pub"]?>&refuser-candidat=<?=$candidats['id_candidat_entreprise']?>">Refuser</a>
                                    <?php if ($user["id_contrat"] == "2"): ?>
                                    <!-- <a href="" class="dropdown-item">Ajouter aux personnels</a> -->
                                    <?php endif;?>
                                </div>
                            </div>
                            <?php elseif ($candidats["status"] == 1):
    $verif_entretien->execute(array($candidats["id_profil"], $candidats["id_offres"]));
    $entretien = $verif_entretien->fetch(PDO::FETCH_ASSOC);
    ?>
	                            <!-- Modal trigger button -->

	                            <button
	                                type="button"
	                                class="btn text-<?=@$secondaire?>"
	                                data-bs-toggle="modal"
	                                data-bs-target="#candidat<?=$candidats['id_utilisateur']?>"
	                            >
	                                Entretien
	                            </button>

	                            <!-- Modal Body -->
	                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
	                            <div
	                                class="modal fade"
	                                id="candidat<?=$candidats['id_utilisateur']?>"
	                                tabindex="-1"
	                                data-bs-backdrop="static"
	                                data-bs-keyboard="false"

	                                role="dialog"
	                                aria-labelledby="modalTitleId"
	                                aria-hidden="true"
	                            >
	                                <div
	                                    class="modal-dialog modal-dialog-scrollable"
	                                    role="document"
	                                >
	                                <div class="modal-content">
	                                <div class="modal-header">
	                                                                                    <h5 class="modal-title" id="modalTitleId">
	                                                                                        ENTRETIEN
	                                                                                    </h5>
	                                                                                    <button
	                                                                                        type="button"
	                                                                                        class="btn-close"
	                                                                                        data-bs-dismiss="modal"
	                                                                                        aria-label="Close"
	                                                                                    ></button>
	                                                                                </div>
	                                </div>
	                                <form action="" method="post">
	                                    <div class="modal-content">
	                                                                            <div class="modal-body">
	                                                                                <label for="" class=""><b>Date et heure</b></label>
	                                                                                <div class="input-group">
	                                                                                    <input class="form-control" required value="<?=@$entretien["date_entretien"]?>" type="date" min="<?=date("Y-m-d")?>" max="<?=date("Y") + 5?>-01-01" name="date" placeholder="Recipient's text" aria-label="Recipient's text">
	                                                                                    <div class="input-group-append">
	                                                                                        <input class="input-group-text" value="<?=@$entretien["heure"]?>" required type="time" name="heure" id="">
	                                                                                    </div>
	                                                                                </div>
	                                                                                <label for="" class="mt-2"><b>Lieu</b></label>
	                                                                                <div class="input-group mt-3">
	                                                                                    <input class="form-control" type="text" value="<?=@$entretien["lieu"]?>" required name="lieu" placeholder="Lieu d'entretien d'embauche" aria-label="Recipient's text" aria-describedby="my-addon">
	                                                                                </div>
                                                                                    <?php if($verif_entretien->rowcount() == 0):?>
	                                                                                <label for="" class="mt-2"><b>vous devez fournir au moins un contact</b> <br>
                                                                                    <?php endif;?>
	                                                                                </label>
	                                                                                <div class="input-group mt-3">
	                                                                                    <div class="input-group-prepend">
	                                                                                        <span class="input-group-text btn btn-dark" id="my-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
	                                                                                    </div>
	                                                                                    <input id="email" class="form-control" onchange="changer()" type="email" name="email"
                                                                                         value="<?php if($verif_entretien->rowcount()==0){echo $user["email"];}else{echo $entretien["email"];}?>" placeholder="Email" aria-label="Recipient's text" aria-describedby="my-addon">
	                                                                                </div>
	                                                                                <input type="hidden" name="id_candidat" value="<?=$candidats["id_profil"]?>">
	                                                                                <input type="hidden" name="id_offre" value="<?=$candidats["id_offres"]?>">
	                                                                                <div class="input-group mt-3">
	                                                                                    <div class="input-group-prepend">
	                                                                                        <span class="input-group-text btn btn-dark" id="my-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
	                                                                                    </div>
	                                                                                    <input class="form-control" onchange="changer()" id="phone" type="tel" name="telephone" 
                                                                                        value="<?php if($verif_entretien->rowcount()==0){echo $user["telephone"];}else{echo $entretien["telephone"];}?>" placeholder="Votre telephone" aria-label="Recipient's text" aria-describedby="my-addon">
	                                                                                </div>
	                                                                            </div>
                                                                        <?php if($verif_entretien->rowcount() == 0):?>
	                                                                    <div class="modal-footer">
	                                                                        <button type="submit" id="envoi" name="envoi_entretien" class="btn btn-primary">Envoyer</button>
	                                                                    </div>
                                                                        <?php endif;?>
	                                                                    <script>
	                                                                                var email = document.getElementById("email");
	                                                                                var telephone = document.getElementById("phone");

	                                                                            function changer(){
	                                                                                 if(!email.value && !telephone.value){
	                                                                                    document.getElementById("envoi").disabled = "true";
	                                                                                }else{
	                                                                                    document.getElementById("envoi").removeAttribute("disabled");
	                                                                                }
	                                                                            }

	                                                                    </script>

	                                    </div>
	                                </form>
	                                </div>
	                            </div>

	                            <!-- Optional: Place to the bottom of scripts -->
	                            <script>
	                                const myModal = new bootstrap.Modal(
	                                    document.getElementById("modalId"),
	                                    options,
	                                );
	                            </script>

	                            <?php else:echo " - ";endif;?>
                          </td>
                          <td>
                             <a class="btn text-<?=@$tertiaire?>" href="profil?id=<?=$candidats["id_utilisateur"]?>&ref&action"><i class="fas fa-id-card fa-2x"></i></a>
                          </td>
                          <td>
                          <a class="btn btn-danger" href="?publication&ref_pub=<?=$_GET["ref_pub"]?>&supprimer-candidat=<?=$candidats["id_candidat_entreprise"]?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                        </tr>

                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <?php endif;?>
                <!-- End Profile Edit Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">

            </div>

            <div class="tab-pane <?PHP if (isset($mo)) {echo "show active";}?> fade pt-3" id="modif">
                <!-- Change Password Form -->
                <form method="post" action="" enctype="multipart/form-data">

                    <div class="row mb-3">
                        <label for="currentPassword" class="col-md-3">Categorie</label>
                        <div class="col-md-3 col-lg-9">
                            <select  id="categories" class="form-control btn btn-outline-secondary text-start mb-2"  name="categori" placeholder="Categories" >
                            <option value="">Selectionner Categories</option>
                            <option value="n">Autre</option>
                            <?php
foreach ($categorie as $categories): ?>
                            <option <?php if ($info_pub["categorie"] == $categories["nom"]) {echo "selected";}?> value="<?=$categories["nom"]?>"><?=$categories["nom"]?></option>
                            <?php endforeach;?>
                            </select>
     <input type="text" name="new_categorie" id="new-categorie" class="form-control bg-<?=$primaire?> text-<?=$secondaire?> mb-2 text-start" style="display: none" placeholder="Nouvel categorie">
                        </div>

                        <label for="" class="col-md-4 col-lg-3 col-form-label">Contrat</label>
                        <div class="col-md-8 col-lg-9">
                        <input list="contrat" value="<?=@$info_pub["contrat"]?>" class="border-secondary form-control btn btn-outline-<?=@$secondaire?>  text-start mb-2 ml-2" value="<?=@$contra?>" name="contrat" placeholder="contrat">
                        </div>
                        <datalist  id="contrat">
                            <?php foreach ($contrat as $contrats): ?>
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

                    <div class="row mb-3 d-none">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Poste</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="titre"  class="form-control" id="renewPassword" value="<?=$info_pub["poste"]?>">
                        </div>
                    </div>

                    <input type="file" name="imager" id="sary" class="d-none">
                    <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">
                            Description
                        <br>
                        <label for="sary">
                          <div class="images text-center">
                        <?php if (file_exists("../../assets/images/" . $info_pub['images'])): ?>
                        <img src="../../assets/images/<?=$info_pub["images"]?>" id="img" class="card shadow mt-2" alt="" srcset="">
                        <i class="fas fa-image icone d-none fa-8x"></i>
                        <?php else: ?>
                        <i class="fas fa-image icone fa-8x"></i>
                        <img src="" alt="" id="img">
                        <style>
                              .images img{
                                height: 200px;
                                width: 200px;
                                object-fit: cover;
                                display: none;
                            }
                        </style>
                        <?php endif;?>
                        </div>
                        </label>

<style>
    .images{
        overflow: hidden;
    }

    .images img{
        height: 200px;
        width: 200px;
        object-fit: cover;
    }
</style>
                        </label>
                        <div class="col-md-8 col-lg-9">
                        <input type="hidde" name="exist" class="d-none" value="<?=$info_pub["images"]?>">
 <input type="hidden" name="description" id="description">
    <div class="card">
    <div class="quill-editor-default" id="editors" style="height: 200px; overflow: scroll"><?=@$info_pub["description"]?></div>
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



    <?php else: ?>

        <?php if ($list_offres->rowcount() == 0) {?>
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
        <?php } else {?>

                    <div class="article-list mb-5" style="color: black">
                            <div class="container">
                                <div class="intro">
                                    <h2 class="text-center mb-2 text-<?=@$secondaire?> bg-<?=@$primaire?> p-2">Liste des offres</h2>
                                </div>
                                <div class="row articles">
                                <?php

    foreach ($offre_list as $listes_offre): ?>
                                <div class="card p-3 m-2 col-md-5 mb-2 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                                        <div class="modal-header align-items-center">
                                        <?php if (file_exists("../../assets/images/".$listes_offre["images"])): ?>
                                <a href="profil?id=<?=$candids["id_profil"]?>&ref&action" class="text-<?=@$secondaire?>">
                                <img class="rounded-circle" src="../../assets/images/<?=$listes_offre["images"]?>" style="width: 50px; height:50px;object-fit: cover;" alt="">
                                </a>
                                <?php endif;?>
                                            <div>
                                                <h4 class="name text-dark modal-title  p-3"><strong class='text-<?=@$secondaire?>'><?=@$listes_offre["categorie"]?></strong> </h4>
                                            </div>
                                        </div>
                                        <h5>
                                            <a href="recrutement?publication&ref_pub=<?=@$listes_offre["id"]?>" class='text-<?=@$secondaire?> text-decoration-none'><strong>Code offre: </strong><?=$listes_offre["id"]?></a><a href=""></a>
                                        </h5>

                                        <h5>
                                            <a href="" class='text text-<?=@$secondaire?> text-decoration-none'><strong>Nombre candidat: </strong></a> <a href="">
                                                <?php $candidat_offre->execute(array($listes_offre["id"]));
    echo $candidat_offre->rowcount();
    ?>
                                            </a>
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
                                                <a class="dropdown-item text-danger" href="?supprimer-pub&id=<?=@$listes_offre["id"]?>">
                                                Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                                <?php endforeach;?>

                            </div>
                            </div>
                            <div class="mt-5 mb-4">
                        <center>
                            <h2><a href="?page=candidats" class='text-<?=@$secondaire?>'>Candidats <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></h2>
                        </center>

                    </div>

<?php }
;endif;endif;?>



<?php
$date1 = date_create("2013-01-01");
$date2 = date_create("2013-02-10");
$diff = date_diff($date1, $date2);

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
                     var    affich = document.querySelector("#img");
                            var img_src = document.getElementById("sary");
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

                </script>



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



<?php

include_once "partials/foot.php";
?>