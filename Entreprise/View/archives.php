<?php if($list_entreprise->rowcount() == 0 ):?>
  <script>window.location.href="configurer"</script>
<?php endif;
// include_once "partials/sidebar.php";

if(isset($_GET["id_payement_abonnement"])){
  $modif_pay_abon->execute(array('0', $_GET["id_payement_abonnement"]));
  header("location: accueil");
}

?>
<body style="background-color: <?=@$black?>">
  

<br>
<h1 class="bg-success text-light mt-5">Archives</h1>
<button class="btn btn-info mb-2" onclick="retour()"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Retour</button>
<select name="" id="" class="btn btn-primary mb-2">
  <option value="">Personnels</option>
  <option value="">Candidats</option>
</select>
<button class="btn-danger btn mb-2">Suppression des archives</button>

<div
  class="table-responsive" id="dataTable"
>
  <table
    class="table table-socondary datatable" id=""
  >
    <thead>
      <tr>
        <th scope="col">Nom</th>
        <th scope="col">Debut</th>
        <th scope="col">FIn de contrat</th>
        <th scope="col">Raison</th>
        <th scope="col">Type</th>
        <th scope="col">Option</th>
      </tr>
    </thead>
    <tbody>
      <tr class="">
        <td scope="row">R1C1</td>
        <td>R1C2</td>
        <td>R1C3</td>
        <td scope="row">Item</td>
        <td>Item</td>
        <td>Item</td>
      </tr>
    </tbody>
  </table>
</div>
</body>
<?php
include_once "partials/foot.php";
?>