 $_SESSION["etape1"]
<?php 
$list_entreprise -> execute(array($_SESSION["utilisateur"]['id']));

unset($_SESSION["etape1"]);

?>

<br>
<body class="bg-<?=@$primaire?> text-<?=@$secondaire?>">
  

<div class="container-fluid mt-5 ">
  <h3 class="bg-dark text-light p-2 mt-1">
    <?php if(isset($_GET["etape"]) and $_GET["etape"] == 2){echo "contrat";}
    elseif(isset($_GET["etape"]) and $_GET["etape"] == 3){echo "Personnalisation";}
    else{echo "Configurer votre entreprise";}?></h3>

  <form action="" method="post" class="">
    <div class="d-flex align-items-center justify-content-center w-100 " style="">
    
    <div class="form col-lg-5 p-5 mt-3 btn btn-outline-light shadow " >
<?php if(isset($_GET["etape"])): $etape=$_GET["etape"]; if($etape == 3):?>
  <div class="row m-0">
    <h2>Theme</h2>
  </div>
  <div class="row">
    <div class="col">
  <button class="btn btn-light mb-2" name="light">Utiliser le mode clair</button><br>
<img class="shadow img-tumbnail"  src="../assets/images/light.png" alt="" width="150">      
    </div>
    <div class="col">
      <button class="btn btn-dark mb-2" name="dark">
        Mode sombre
      </button> <br>
      <img class="shadow" src="../assets/images/dark.png" alt="" width="150">
    </div>
  </div>


<?php elseif($etape==2):?>
 <center>
<i class="fa fa-check-circle text-success fa-5x" aria-hidden="true"></i> <br>

<?php $date = date_create(date('y-m-d'));
date_add($date, date_interval_create_from_date_string('7 days'));
$debut_contrat = date_format($date, 'M/d/Y');?>

<h2 class="text-success">Vous avez un essai de 7 jours </h2>
 </center>
 <h5>Votre contrat commencera le: <b><em><?=$debut_contrat?></em></b></h5>
<?php endif; else:


  
  if($list_entreprise -> rowcount() >= 1){
    rediriger("accueil");
  }
  
  ?>
  
  <h1 class="mb-3" style="">Bienvenue !</h1>

         
<div class="input-group mb-2">
    <input class="form-control" type="text" value="<?=@$nom_e?>" id="email" name="nom_e" placeholder="Nom de votre entreprise" aria-label="Recipient's text" aria-describedby="my-addon">
   
</div>
<div class="input-group mb-2">
    <input class="form-control" type="text" value="<?=@$mdp?>" name="adresse_e" placeholder="Adresse de l'Entreprise" aria-label="Recipient's text" aria-describedby="my-addon">
    
</div>

<div class="input-group mb-2">
    <input class="form-control" list="pays"  name="pays" placeholder="Ville" aria-label="Recipient's text" aria-describedby="my-addon">

</div>

<datalist id="pays">
  <?php foreach ($l_pays as $pays):?>
  <option value="<?=@$pays["nom"]?>"></option>
  <?php endforeach;?>
</datalist>



<?php endif;?>    


            <h6 class="text-danger mt-3 mb-2"><?=@$err?></h6>
        
                <center>

                    <button class="btn btn-primary w-100 border-none mb-1" name="etape"><?=@$btn_titre?></button>
                  
                </center>
  
            </div>
    </div>
</form>
</div>
</body>
<style>
  .form{
    box-shadow: 1px 1px 5px 2px blue;
  }
</style>

<script>
   
</script>