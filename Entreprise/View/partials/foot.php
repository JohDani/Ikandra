
<?php 

if(isset($desactive_account) or ($user["status"] == "1")):
 
  $prix_payement->execute(array($user["id_contrat"]));
  $prix = $prix_payement->fetch(PDO::FETCH_ASSOC);      

  ?>
<div id="coming" style="left:0;position: fixed; z-index: 1590000; height: 100vh; top:0; width: 100%; background-color: rgba(1,5,0,0.6); overflow: hidden">
 <center>
<div class="card text-light col-md-5 mt-5" style="background-color: rgba(1,1,1,0.6)">
  <div class="card-header bg-dark text-warning text-start">
    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span>
      Alert
    </span>
  </div>
 
  <div class="card-body">
    <?php if(isset($desactive_account)):?>
    <form action="" method="post">
    <div class="card-footer ">    
    <p class="card-title">
    <?php if(isset($_GET["attente"]) and $attente_abonn->rowcount() > 0):?>
      <h4>Payement(s) en attente(s)</h4>
     <table  class="table table-dark" >
      <tr>
        <th>Reference</th>
        <th>date_payement</th>
      </tr>
      <?php foreach($attente as $attent):?>
      <tr>
        <td><?=$attent["reference_transaction"]?></td>
        <td><?=$attent["date_payement"]?></td>
      </tr>
      <?php endforeach;?>
     </table>
    <?php else:?>
      <h4 class="">Votre contrat est expiré</h4>  
        <span>Payement Mobile Money</span><br>
        <i class="fa fa-phone" aria-hidden="true"></i> 
        <span>033 11 114 12</span>
        <br>Danieltiana RANDRIANJATOVO
    <?php endif;?>
      </div>
      <div class="text-start p-2">
      <?php if( $attente_abonn->rowcount() > 0):?>
        <?php if(isset($_GET["attente"])):?>
        <a href="accueil" class="text-primary">Cacher les Payements en attente</a> <br>
        <?php else:?>
      <a href="?attente" class="text-primary">Afficher les Payements en attente</a> <br>
        <?php endif;endif;?>
      <span class="text-start">Abonement à contrat type  <?=@$user["id_contrat"]?></span><br>


      <span>A payer: <?=number_format($prix["prix"])?> Ar</span>
      </div>
      </div>
    </p>
    <div class="input-group">
        <input type="hidden" name="prix" value="<?=$prix["prix"]?>">
        <input class="form-control " required type="text" name="reference_transaction" placeholder="Reference de transaction" aria-label="Recipient's text" aria-describedby="my-addon">
        <div class="input-group-append">
          <button class="input-group-text bg-primary text-light" id="my-addon" name="payer_contrat">envoyer</button>
        </div>
      </div>
    <div class="card-footer" >
<button name="deconnexion" class="btn btn-danger mt-2">Se deconnecter</button>
    </div>
  </form>
    <?php else:?>
    <h3 class="">Votre compte est desactivé par l'administrateur</h3>
    <p class="text-secondary">
      Vous pouvez accéder aux fonctionnalités lorsque <br>
      votre compte sera reactivé
    </p>
    <div class="card-footer" >
    <form action="" method="post">
      <button name="deconnexion" class="btn btn-danger">Se deconnecter</button>
    </form>
  </div>

    <?php endif;?>
  </div>
  
</div>
</center>
</div>
<?php endif;?>

<script>
<?php
$dates = date_create($abonn["fin_contrat"]);
?>


var countDownDate = new Date("<?=date_format($dates,"M d,Y H:i:s")?>").getTime();



// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + " Jours " + hours + "h "
  + minutes + "m " + seconds + "s " + "restants";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
    window.location.href = "accueil?desactiver_payement=<?=@$abonn["id_payement_abonnement"]?>";
  }
}, 1000);
</script>

