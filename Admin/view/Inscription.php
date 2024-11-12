
<div class="container col-md-5 col-lg-5 col-xlg-8 mt-5" style="height: 75vh">
    
    <div class="form" >
        <div class="card-header mb-3">
            <a class="text-success" data-toggle="modal" data-target="#modelId"><b><i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Information</b></a>
        </div>
        <h1 class="" style="margin-top: -15px">Inscription</h1>
        <form action="" method="post"> 


<?php if(!isset($_GET["etape"])):?>
            <div class="input-group mb-2">
                <select name="contrat"  vqlue ="2" id="" class="form-control <?=@$ctr_color?>">
                    <option value="0" >Contrat</option>
                    <option  <?php if(isset($contrat) and $contrat == 1){echo "selected";}?> value="1" >fonctionnalité Simple</option>
                    <option  <?php if(isset($contrat) and $contrat == 2){echo "selected";}?> value="2" >Fonctionnalité Avancée</option>
                </select>
            </div>


            
            <div class="input-group mb-2">
                <input class="form-control <?=@$prenom_c?>" value="<?=@$prenom?>" name="prenom" placeholder="Votre Prenom" aria-label="Recipient's text" aria-describedby="my-addon">
                <div class="input-group-append">
                    <span class="input-group-text" id="my-addon"><i class="fas fa-user"></i></span>
                </div>
            </div>

            <div class="input-group mb-2">
                <input class="form-control <?=@$nom_color?>" type="text" value = "<?=@$nom?>" name="nom" placeholder="Votre Nom (facultatif)" aria-label="Recipient's text" aria-describedby="my-addon">
                <div class="input-group-append">
                    <span class="input-group-text" id="my-addon"><i class="fas fa-user"></i></span>
                </div>
            </div>


            
<?php else:?>



    <div class="input-group mb-2">
                <input class="form-control <?=@$err_email?>" type="text" value = "<?=@$email?>" id="email" name="email" placeholder="Votre email" aria-label="Recipient's text" aria-describedby="my-addon">
                <div class="input-group-append">
                    <span class="input-group-text" id="my-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="input-group mb-2">
                <input class="form-control <?=@$err_mdp?>" type="password" value="<?=@$mdp?>" name="mdp" placeholder="Votre mot de passe" aria-label="Recipient's text" aria-describedby="my-addon">
                <div class="input-group-append">
                    <span class="input-group-text" id="my-addon"><i class="fas fa-user-lock    "></i></span>
                </div>
            </div>



            <div class="input-group mb-2">
                <input class="form-control <?=@$err_mdp?>" type="password" value = "<?=@$mdp2?>" name="mdp2" placeholder="Confirmer le mot de passe" aria-label="Recipient's text" aria-describedby="my-addon">
                <div class="input-group-append">
                    <span class="input-group-text" id="my-addon"><i class="fas fa-user-lock    "></i></span>
                </div>
            </div>



            <div class="btn-goup">

<a href="Inscription" class="btn btn-outline-primary">Retour</a>
                                
<button name="inscription" class="btn btn-primary" data-toggle="modal" data-target="#condition">
                                    S'inscrire
                                </button>
                            </div>

                            


<?php endif;?>
            <p class="text-danger"><?=@$err?></p>


            <div>
                <p>Si vous avez déjà une compte: <strong><a href="connexion">Se connecter</a></strong></p>
            </div>




            <div class="modal fade" id="condition" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title text-success"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i>&nbsp;<span>Conditions et termes de contrats</span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h3 class="text-info">Fonctionnement simple</h3>
                    <ul>
                        <li>Fonctions: envoyer recrutements, gerer les offres partagés, voir les candidatures</li>
                        <li>Prix/abonnement: <b><?=$contrat1["prix"]?> Ariary</b>/mois</li>
                    </ul>

                    <h3 class="text-info">Fonctionnement Avancée</h3>
                    <ul>
                        <li>Fonctions: tous fonction de la gestion RH: personnels, salaire, poste, recrutements et candidatures,stagaire ... </li>
                        <li>Abonnement: <b><?=$contrat2["prix"]?></b> Par mois payé en banque ou mobile money</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
             
                <button type="button" class="btn btn-danger" data-dismiss="modal">Refuser</button>
                <button type="submit" name="inscription" class="btn btn-primary">Accepter</button>

            </div>
        </div>
    </div>
</div>




        </form>
            <center>
                
               
<?php if(!isset($_GET["etape"])):?>
            <div class="btn-goup">
                <button class="btn btn-primary" data-toggle="modal" data-target="#condition">
                    Suivant
                </button>
            </div>    
<?php endif;?>

            </center>
    </div>
</div>


<style>
     .form{
        box-shadow: 1px 1px 5px 2px blue;
        padding: 7% 5%;
        border-radius: 20px;
        overflow:hidden;
    }
</style>