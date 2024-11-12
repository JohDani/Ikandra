<?php include_once "partials/sidebar.php";?>
<body style="background-color: black">
<div class="main" id="main">
<div class="container">
  <div class="row">


<div class="col">
  <div class="card-header"><h2 class="text-light">Detail</h2></div>
<table class="table table-dark">
  <thead class="thead-light">
    <tr>
      <th>Date payement</th>
      <th>Nom utilisateur</th>
      <th>Reference </th>
      <th>Prix</th>
    </tr>
  </thead>
  <tbody>
    <?php if($rev->rowcount()==0):?>
      <div class="card">
        <h3>Aucun payement pour le moment</h3>
      </div>
    <?php endif;?>
  </tbody>
  <tfoot>

    <?php foreach($reve as $rvr):
      if($rvr["status"] !== '0' or $rvr["reference_transaction"] !== "essai contrat"):
      ?>
   
    <tr>
      <th><?=$rvr["date_payement"]?></th>
      <th><?=$rvr["nom_utilisateur"]?></th>
      <th><?=$rvr["reference_transaction"]?></th>
      <th><?=$rvr["prix"]?></th>
    </tr>
      <?php endif;endforeach;?>
  </tfoot>
</table>  
</div>
</div>
</div>
</div>
</body>