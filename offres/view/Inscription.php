<form action="" method="post"> <br><br>
<div class="container col-md-5 col-lg-5 col-xlg-8 mt-5" style="height: 80vh">
    
    <div class="form border border-light text-light "  style="background-color: rgba(1,1,1,0.6)">
        <?php if(!isset($_GET["candidat"])):?>
        <div class="mb-4 ">
            <a class="text-success" data-toggle="modal" data-target="#modelId"><b><i class="fa fa-info-circle" aria-hidden="true"></i> Information</b></a>
        </div>
        <?php endif;?>
        <h1 class="" style="margin-top: -15px">Inscription</h1>

<?php if(isset($_GET["candidat"])):?>

    <h6 class="text-danger"><?=@$err?></h6>

        <div class="input-group mb-2">
            <input class="form-control <?=@$nom_err?>" type="text" value = "<?=@$nom_candidat?>" id="nom" name="nom_candiat" placeholder="Nom et prenom" aria-label="Recipient's text" aria-describedby="my-addon">
        </div>

            <div class="input-group mb-2">
                    <input class="form-control <?=@$err_email?>" type="text" value = "<?=@$email_candidat?>" id="email" name="email_candidat" placeholder="Votre email" aria-label="Recipient's text" aria-describedby="my-addon">
            </div>
            <div class="input-group mb-2">
                <input class="form-control <?=@$err_mdp?>" type="password" value="<?=@$mdp_c?>" name="mdp_1" placeholder="Votre mot de passe" aria-label="Recipient's text" aria-describedby="my-addon">
            </div>



            <div class="input-group mb-2">
                <input class="form-control <?=@$err_mdp?>" type="password" value = "<?=@$mdp_2?>" name="mdp_2" placeholder="Confirmer le mot de passe" aria-label="Recipient's text" aria-describedby="my-addon">
            </div>



            <div class="btn-goup">                        
                <button name="inscription_candidat" class="btn btn-primary" data-toggle="modal" data-target="#condition">S'inscrire</button>
            </div>

<?php else: if(!isset($_GET["etape"])):?>
            
            <div class="input-group mb-2">
                <input class="form-control prenom <?=@$prenom_c?>"
                 value="<?=@$prenom?>" name="prenom" placeholder="Votre Prenom" aria-label="Recipient's text" aria-describedby="my-addon">
            </div>

            <div class="input-group mb-2">
                <input class="form-control nom <?=@$nom_color?>" type="text" value = "<?=@$nom?>" name="nom" placeholder="Votre Nom " aria-label="Recipient's text" aria-describedby="my-addon">
            </div>


            
<?php else:?>



            <div class="input-group mb-2">
                    <input class="form-control <?=@$err_email?>" type="text" value = "<?=@$email?>" id="email" name="email" placeholder="Votre email" aria-label="Recipient's text" aria-describedby="my-addon">
            </div>
            <div class="input-group mb-2">
                <input class="form-control <?=@$err_mdp?>" type="password" value="<?=@$mdp?>" name="mdp" placeholder="Votre mot de passe" aria-label="Recipient's text" aria-describedby="my-addon">
            </div>



            <div class="input-group mb-2">
                <input class="form-control <?=@$err_mdp?>" type="password" value = "<?=@$mdp2?>" name="mdp2" placeholder="Confirmer le mot de passe" aria-label="Recipient's text" aria-describedby="my-addon">
            </div>



            <div class="btn-goup">
                <a href="Inscription" class="btn btn-outline-primary">Retour</a>                         
                <button name="inscription" class="btn btn-primary" data-toggle="modal" data-target="#condition">S'inscrire</button>
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
                            <button type="button" class="close btn btn-outline-primary" style="position: absolute; right: 5px" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body text-dark">
                <div class="container-fluid">
                   <h3 class="text-primary"> <input type="radio" name="contrat" value="1" id="" class="contrats"> Fonctionnement simple</h3>
                    <ul>
                        <li>Fonctions: envoyer recrutements, gerer les offres partagés, voir les candidatures</li>
                        <li>Prix/abonnement: <b><?=$contrat1["prix"]?> Ar/mois</b> </li>
                    </ul>

                    <h3 class="text-primary"><input type="radio" name="contrat" value="2" id="" class="contrats"> Fonctionnement Avancée</h3>
                    <ul>
                        <li>Fonctions: tous fonction de la gestion RH: personnels, salaire, poste, recrutements et candidatures,stagaire ... </li>
                        <li>Abonnement: <b><?=$contrat2["prix"]?> Ar/mois</b> Par mois payé par mobile money</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
             
                <button type="button" class="btn btn-danger" data-dismiss="modal">Refuser</button>
                <button type="submit"  name="inscription" class="btn btn-primary btn_insc">Accepter</button>

            </div>
        </div>
    </div>
</div>



<?php endif;?>
      

                
               
<?php if(!isset($_GET["etape"]) and !isset($_GET["candidat"])):?>
            <div class="btn-goup">
                <button type="button" class="btn btn-primary btn_suivant" data-toggle="modal" data-target="#condition">
                    Suivant
                </button>
            </div>    
<?php endif;?>


    </div>
</div>


</form>
<script>
    var contrats = document.querySelectorAll(".contrats");
    var btn_insc = document.querySelector(".btn_insc");
    var prenom = document.querySelector(".prenom");
    var nom = document.querySelector(".nom");
    var btn_suivant = document.querySelector(".btn_suivant");
    
 


    btn_insc.disabled = "true";
    
        contrats.forEach(contrat => {
            contrat.onclick = function(){
                 
                   if(contrat.checked){
                    btn_insc.removeAttribute("disabled");
                   }else{
                    btn_insc.disabled = "true";
                   }
            }
             
        });
    
</script>


<style>
        body{
        background:url('../assets/images/lockscreen-bg.jpg');
        background-size: cover;
    }
     .form{
        padding: 7% 5%;
        border-radius: 20px;
        overflow:hidden;
    }


</style>