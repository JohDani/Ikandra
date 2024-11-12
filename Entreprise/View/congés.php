
<?php if($list_entreprise->rowcount() == 0 ):?>
  <script>window.location.href="configurer"</script>
<?php endif;?>
<?php include_once "partials/sidebar.php";?>
<body style="background-color: <?=@$black?>">

<main class="main" id="main">
<div class="card bg-<?=@$dark?>">
<div class="card-header bg-dark mb-2">
  <form action="" method="post">
  <!-- Modal trigger button -->
  <button
    type="button"
    class="btn btn-primary btn-"
    data-bs-toggle="modal"
    data-bs-target="#modalId"
  >
    Ajouter au congé
  </button>
  
  <!-- Modal Body -->
  <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
  <div
    class="modal fade"
    id="modalId"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
  >
    <div
      class="modal-dialog modal-dialog-scrollable "
      role="document"
    >
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title" id="modalTitleId">
          
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body ">
                 <div class="container">
          <div class="row">
            <select name="id_personnel" required id="" class="form-control">
            <option value="0">Selectionner le personnel</option>
            <?php foreach($perso as $prs):?>
            <option value="<?=$prs["id_personnel"]?>"><?=$prs["nom_personnel"]?></option>
            <?php endforeach;?>
          </select>
          </div>
          <div class="row mt-3">
          <label for="" class="col-3 col-form-label"><b>Debut:</b> </label>
          <div class="col">
          <input type="date" required min="<?=date("Y")-1?>-12-31"  max="<?=date("Y")+1?>-12-31" class="col form-control" name="debut" id="">
          </div>
          </div>
          <div class="row mt-3">
          <label for="" class="col-3 col-form-label"><b>Durée:</b> </label>
          <div class="col">
          <div class="input-group">
            <input class="form-control" min="1" required type="number" name="duree" placeholder="Durée du congé" aria-label="Recipient's text" aria-describedby="my-addon">
            <div class="input-group-append">
              <span class="input-group-text" id="my-addon">
                <select name="unite" id="" class="btn">
                  <option value="1">Jour</option>
                  <option value="2">Mois</option>
                </select>
              </span>
            </div>
          </div>
          </div>
          </div>
          <div class="row mt-3">
          <label for="" class="col-3 col-form-label"><b>Raison:</b> </label>
          <div class="col">
          <textarea name="raison" class="form-control"placeholder="Type/raison du congé" id="" cols="30" rows="4"></textarea>
          </div>
          </div>
          </div>
        </div>
        <div class="modal-footer">
        <input type="submit" value="enregistrer" name="ajout_conge" class="btn btn-primary">
        </div>
      </div>
    </div>
  </div>
  
  <!-- Optional: Place to the bottom of scripts -->
  <script>
    const myModal = new bootstrap.Modal(
      document.getElementById("modalId"),
      options,
    );
  </script>
    </form>
</div>

<section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class=" p-3 mb-5 ">
          <?php if(isset($err)):?>
          <div class="card-header bg-<?=@$bg?> text-light  text-center">
            <?=@$err?>
          </div>
          <?php endif;?>
            <div class="card-body p-4">
<?php if($list_conge->rowcount() > 0):?>
              <!-- Table with stripped rows -->
              <table class="table table-<?=@$primaire?> datatable">
                <thead>
                  <tr>
                    <th>
                    Nom 
                    </th>
                    <th>Poste</th>
                    <th data-type="date" data-format="YYYY/DD/MM">Date debut</th>
                    <th data-type="date" data-format="YYYY/DD/MM">Date fin</th>
                    <th>Raison</th>
                    <th class="text-center">
                      <a onclick = "return confirm('Cette action est irreversible, êtes vous sure de tous supprimer?')" href="?tout-supprimer&id=<?=@$_SESSION["entreprise"]["id"]?>" class="text-danger text-decoration-none">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($list_conge as $conges):?>
                  <tr>
                    <td><?=$conges["nom_personnel"]?></td>
                    <td><?=$conges["nom_poste"]?></td>
                    <td><?=$conges["date_debut"]?></td>
                    <td><?=$conges["date_fin"]?></td>
                    <td><?=$conges["raison"]?></td>
                    <td class="text-center">
                    <a href="?supprimer-conge&id=<?=$conges["id_conge"]?>" class="text-decoration-none text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
<?php else:?>
  <center>
  <div class="col-md-5 text-<?=@$primaire?>">
      Il n'y a aucun personnel en congé en ce moment
  </div>
  </center>
<?php endif;?>

    </section>
</main>

</body>
