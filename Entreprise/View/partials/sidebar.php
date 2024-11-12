    <!-- ======= Sidebar ======= -->
  
    
    <aside id="sidebar" class="sidebar bg-<?=@$primaire?> shadow ">

        <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading "><h6>Raccourcis</h6></li>

            <li class="nav-item ">
                <a class="nav-link bg-<?=@$primaire?> text-<?=@$secondaire?>" href="accueil">
                    <i class="bi bi-grid text-<?=@$secondaire?>"></i>
                    <span>accueil</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->
<?php if($user["id_contrat"] == 2):
    if($url == "personnels" and !isset($_GET["salaire"])):
    ?>
        <li class="nav-link bg-<?=@$primaire?> border text-<?=@$secondaire?>" >
           <a href="information?ajout" class="text-<?=@$secondaire?>">Ajouter</a> 
        </li>
        <li class="nav-heading text-<?=@$secondaire?>">Departement et postes</li>
    <div class="acc-list">
 <?php
    
    foreach($departs as $departments):
        $list_post -> execute(array($departments["id_departement"]));
        $postes = $list_post -> fetchAll(PDO::FETCH_ASSOC);
    ?>
            <div id="id<?=$departments["id_departement"]?>" role="tablist" class="mb-2" aria-multiselectable="true">
                <div class="">
                    <div class="card-header" role="tab" id="section2HeaderId">
                        <h6 class="mb-0" style="overflow: hidden">
                            <a data-toggle="collapse" class="nav-link bg-<?=@$primaire?> border text-<?=@$tertiaire?>" 
                            data-parent="#id<?=$departments["id_departement"]?>" href="#enfant<?=$departments["id_departement"]?>" aria-expanded="true" 
                            aria-controls="section2ContentId">
                            <span > <?=$departments["nom_departement"]?> ... </span>&nbsp; H
                            </a>
                        </h6>
                    </div>
                    <div id="enfant<?=$departments["id_departement"]?>" class="collapse in" role="tabpanel" aria-labelledby="section2HeaderId">
                        <li class="nav-item">
                            <?php if($list_post->rowcount() == 0):?>
                                <a href="departement?id=<?=$departments["id_departement"]?>&action=ajout&type=poste" class="nav-link bg-<?=@$primaire?> text-<?=@$secondaire?>">Ajouter une poste</a>
                            <?php else: foreach($postes as $pst):?>
                                <a href="personnels?poste=<?=$pst['id_poste']?>" class="nav-link mt-2 bg-<?=@$primaire?> text-<?=@$secondaire?> border"><?=$pst['nom_poste']?></a>
                            <?php endforeach; endif;?>
                        </li>

                    </div>
                </div>
            </div>

    <?php endforeach;?>
</div>
    <?php elseif($url == "payements" or isset($_GET["salaire"])):
       
        ?>
        

        <li class="nav-link  bg-<?=@$primaire?> text-<?=@$secondaire?>">
            <a href="payements" class="text-<?=@$secondaire?>">Salaire payé</a>
        </li>
        <li class="nav-link  bg-<?=@$primaire?> text-<?=@$secondaire?>">
            <a href="payements?statue=non_paye" class="text-<?=@$secondaire?>">Salaire non payé</a>
        </li>
    <?php elseif($url == "departement" and $list_departement->rowcount()>0):?>
        <li class="nav-link bg-<?=@$primaire?> text-<?=@$secondaire?> border mb-2">
            <a href="departement?action=ajout&type=poste" class="text-<?=@$secondaire?>  text-decoration-none">Ajouter une poste</a>
        </li>

        <li class="nav-link bg-<?=@$primaire?> border mb-2 text-<?=@$secondaire?>">
            <a href="departement?action=ajout&type=departement " class="text-<?=@$secondaire?> text-decoration-none">Ajouter un departement</a>
        </li>
      
        <li  class="nav-link bg-<?=@$primaire?> text-<?=@$secondaire?> border">
            <a type="button" data-toggle="modal" data-target="#suppr_depart" href="" class="text-<?=@$secondaire?>">Suppression departement</a>
        </li>
    <?php else:?>
        <form action="" method="post">
            <li class="nav-item">
                <?php if(isset($_SESSION["recrutement"])):?>
        <button class="nav-link collapsed form-control text-<?=@$secondaire?> bg-<?=$primaire?>"  name="session_recrutement" >
        <i class="bi bi-journal-text "></i><span>GRH</span><i class="bi bi-chevron-right ms-auto"></i>
        </button>
        <li class="nav-item">
                <a class="nav-link collapsed bg-<?=@$primaire?> text-<?=@$secondaire?>"  href="recrutement?action=publier">
                    <i class="bi bi-layout-text-window"></i><span>Publier</span>
                </a>
    </li>
    <li class="nav-item">
                <a class="nav-link collapsed bg-<?=@$primaire?> text-<?=@$secondaire?>"  href="recrutement">
                    <i class="bi bi-clock" aria-hidden="true"></i><span>Offres</span>
                </a>
    </li>
    <li class="nav-item">
                <a class="nav-link collapsed bg-<?=@$primaire?> text-<?=@$secondaire?>"  href="recrutement?page=candidats">
                    <i class="bi bi-people" aria-hidden="true"></i><span>Candidats</span>
                </a>
    </li> 
                <?php else:?>
                <button class="btn nav-link bg-<?=@$primaire?> text-<?=@$secondaire?> collapsed form-control" name="session_recrutement">
                    <i class="bi bi-journal-text"></i><span>Recrutements</span><i class="bi bi-chevron-right ms-auto"></i>
                </button>
                <li class="nav-item">
                <a class="nav-link collapsed text-<?=@$secondaire?> bg-<?=@$primaire?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people"></i><span>Personnels</span><i class="bi bi-chevron-right ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="information?ajout" class="text-<?=@$secondaire?> border mb-1 text-decoration-none">
                        <span>Ajout</span>
                        </a>
                    </li>
                    <li>
                        <a href="personnels" class="text-<?=@$secondaire?> border mb-1 text-decoration-none bg-<?=@$primaire?> card-header">
                    <span class="">Liste</span>
                        </a>
                    </li>

                </ul>
            </li>
            <!-- End Components Nav -->

            <!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link text-<?=@$secondaire?> bg-<?=@$primaire?> collapsed" href="congés">
                    <i class="fa fa-user-times" aria-hidden="true"></i><span>Congés</span><i class="bi bi-chevron-right ms-auto"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-<?=@$secondaire?> bg-<?=@$primaire?> collapsed" href="payements">
                <i class="fas fa-wallet"></i> <span>Verification salaire</span><i class="bi bi-chevron-right ms-auto"></i>
                </a>
            </li>
            <!-- End Tables Nav -->
            <li class="nav-item ">
            </li>
            <!-- End Tables Nav -->
                <?php endif;?>
            </li>
    </form>
          
   
<?php endif; else:?>
    <li class="nav-item">
                <a class="nav-link collapsed bg-<?=@$primaire?> text-<?=@$secondaire?>"  href="recrutement?action=publier">
                    <i class="bi bi-layout-text-window"></i><span>Publier</span>
                </a>
    </li>
    <li class="nav-item">
                <a class="nav-link collapsed bg-<?=@$primaire?> text-<?=@$secondaire?>"  href="recrutement">
                    <i class="bi bi-clock" aria-hidden="true"></i><span>Offres</span>
                </a>
    </li>   
    <li class="nav-item">
                <a class="nav-link collapsed bg-<?=@$primaire?> text-<?=@$secondaire?>"  href="recrutement?page=candidats">
                    <i class="bi bi-people" aria-hidden="true"></i><span>Candidats</span>
                </a>
    </li> 
<?php endif;
if($url == "recrutement" and isset($_GET["ref_pub"]) and isset($pub)):
   if($pub->rowcount() > 0):
?>

<?php endif;?><?php endif;?>
            <li class="nav-heading text-<?=@$secondaire?>">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed bg-<?=@$primaire?> text-<?=@$secondaire?>" href="profil?id=<?=$id_utilisateur?>">
                    <i class="bi bi-person"></i>
                    <span>Profil</span>
                </a>
            </li>


            <!-- End Profile Page Nav -->

            <li class="nav-item">
                <button class="nav-link collapsed bg-<?=@$primaire?> text-<?=@$secondaire?>" type="button" data-toggle="modal" data-target="#my-modal">
                    <i class="bi bi-currency-dollar"></i>
                    <span>Abonnement</span>
                </button>
            </li>

            <!-- End F.A.Q Page Nav -->

           
          
            <!-- <li class="nav-item">
                <a class="nav-link collapsed bg-<?=@$primaire?> text-<?=@$secondaire?>" href="bugs">
                    <i class="bi bi-bug"></i>
                    <span>Signaler un erreur</span>
                </a>
            </li> -->

          



            <li class="nav-item fixed-bottom">
                <form action="" method="post">
                <button class="nav-link collapsed text-danger bg-<?=@$primaire?> text-<?=@$secondaire?>" onclick="return confirm('êtes vous sure de se deconnecter?')" name="deconnexion">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Se deconnecter</span>
                </button>
                </form>
            </li>
            <!-- End Login Page Nav -->


        </ul>

    </aside>
    <!-- End Sidebar-->


    <style>
        a{
            text-decoration: none;
        }
    </style>