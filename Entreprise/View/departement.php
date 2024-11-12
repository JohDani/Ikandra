<?php if($list_entreprise->rowcount() == 0 ):?>
  <script>window.location.href="configurer"</script>
<?php endif;?>

<?php include_once "partials/sidebar.php";?>
<body style="background-color: <?=@$black?>">
<main  class="main" id="main">


<form action="" method="post">
<div id="suppr_depart" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title">Suppression departement</h5>
        <button class="close btn btn-dark" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 15px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select class="form-control" name="dep_s[]" id="" multiple>
          <?php foreach($departs as $dpt):?>
          <option value="<?=$dpt["id_departement"]?>"><?=$dpt["nom_departement"]?></option>
          <?php endforeach;?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="submit" name="suppr_dep" class="btn btn-danger">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<div class="p-2">


<?php if(isset($_GET["action"])){include_once "Modal.php";}?>
<h2 class=" fs-2 card p-2 text-<?=@$secondaire?> bg-<?=@$primaire?> mb-3 m-0 p-1 form-conrol">Liste des postes</h2>
    <div class="card shadow bg-<?=@$primaire?> p-3">
      <select name="" id="s_dep" class="btn btn-dark border-light form-control d-inline">
      <option value="0">Tous les departements</option>
  
    <?php foreach($departs as $drt):?>
          <option class="text-left  p-1" <?php if(isset($_GET["id_departement"]) and ($_GET["id_departement"] == $drt["id_departement"])){echo "selected";}?> value="<?=$drt["id_departement"]?>"><?=$drt["nom_departement"]?></option>
    <?php endforeach;?>
  </select>  

<form action="" method="post">
<?php if($list_departement->rowcount()>0): if($sel_post->rowcount()==0):?>
  <div class="card mt-3">
    <div class="card-body">
      <h5 class="card-title ">Vous n'avez aucune poste</h5>
      <p class="card-text">
        <a href="?action=ajout&type=poste">Ajouter</a>
      </p>
    </div>
  </div>   
<?php else:?>
                                        <div class="table-responsive m-0 table mt-2 p-2 table-<?=@$primaire?>" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                            <table class="table table-striped my-0 w-100  table-<?=@$primaire?>" id="tables">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" name="" id="tous"></th>
                                                        <th class="text-secondary">  Poste </th>
                                                        <th class="text-secondary">Departement</th>
                                                        <!-- <th class="text-secondary">Minimum</th> -->
                                                        <th class="text-secondary">Maximum</th>
                                                        <th class="text-secondary">personnels</th>
                                                        <th class="text-secondary">Action</th>
                                                        <th>
                                                          <button type="submit" onclick="return confirm('Le données les personnels et données correspondants seront aussi supprimés. Etes vous sûre de supprimer?')" name="multi-suppr"  class="btn btn-danger modal_selection"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </th>
                                                      <style>

                                                      </style>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>

                                              
          <?php  foreach($poster as $dp):
          
            ?>
            <tr>        
              <td>  <input type="checkbox" name="checkbox[]" value="<?=$dp["id_poste"]?>" id="" class="checkbox"></td>
                <td class="bg-">
                    <input type="hidden" name="id_poste[]" value="<?=$dp["id_poste"]?>">
                                                      <div class="input-group">
                                                        <div class="input-group-prepend">
                                                          <span class="input-group-text btn" id="my-addon">
                                                        
                                                          </span>
                                                        </div>
                                                        <input class="form-control text-start btn text-<?=@$secondaire?>" type="text" name="nom_poste[]" value="<?=$dp["nom_poste"]?>" id="" >    
                                                        <!-- <input class="form-control" type="text" name="" placeholder="Recipient's text" aria-label="Recipient's text" aria-describedby="my-addon"> -->
                                                      </div>
                                                      </td>
                                                        <td class="text-primary text-center">
                                                           <select class="btn text-<?=@$secondaire?>" name="departement[]" id="">
                                                            <?php foreach ($departs as $dprt):?>
                                                                <option <?php if($dprt["id_departement"] == $dp["id_departement"]){echo "selected";}?> value="<?=$dprt["id_departement"]?>"><?=$dprt["nom_departement"]?></option>
                                                                <?php endforeach;?>
                                                           </select>
                                                        </td>
                                                      <!-- <td>
                                                      </td> -->
                                                        <td>
                                                          <?php
                                                         
                                                             
                                                          
                                                          ?>
                                                      <input style="width: 100px" type="number" value="<?=@$dp["min"]?>" placeholder="min" name="min[]" id="" class="d-none btn btn-outline-primary bg-none" min="0">
                                                        
                                                        <input style="width: 100px" type="number" value="<?=@$dp["max"]?>"  name="max[]" placeholder="max" name="duree[]" id="" class="btn btn-outline-primary bg-none" min="0">
                                                    </td>
                                                    <td class="text-start text-<?=@$secondaire?>">
                                                              <?php   $poste_personnel->execute(array($dp["id_poste"]));
                                                              echo $poste_personnel->rowcount();
                                                              ?>
                                                    </td>
                                                        <td>
                                                            <a href="departement?supprimer&id_poste=<?=$dp["id_poste"]?>" onclick="return confirm('Etes vous sure de vouloir supprimer? ')" class="btn btn-sm"><i class="fa fa-trash-alt text-danger fa-2x" aria-hidden="true"></i></a>
                                                            &nbsp;
                                                       </td>
                                                       
                                                       <td>
                                                        <a href="personnels?poste=<?=$dp["id_poste"]?>" class="text-primary"><i class="fa fa-users fa-2x" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>

          <?php endforeach;?>



                                                </tbody>                       
                                            </table>
                                            
                                        </div>
<div class="main" id="main">
<button class="btn btn-success" name="ok">Enregistrer les modifications</button> 
<?php endif;else:?>
  <center>
<div class="card mt-3">
  <div class="card-body">
    <h5 class="card-title">Vous devez d'abord ajouter des departements</h5>
    <a href="departement?action=ajout&type=departement" class="btn btn-dark card-text">Ajout departement</a>
  </div>
</center>  
</div>
<?php endif;?>

<!-- <div class="modal_selection" style="display:none;position:fixed; top:0;width:100%;z-index:500000; left: 0;border: red;right: 50%; background-color: rgba(1,1,1,0.4)" id=""  role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">

  <div class="modal-dialog bg-dark text-light" role="">
    <div class="modal-content">
      <div class="modal-header p-1 m-1">
     
          <button type="button" class="close btn btn-light" onclick="window.location.href='departement'" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body text-center">
      <span class="btn btn-light col-md-5 mb-2"><input type="checkbox" name="" id="deselect">&nbsp;&nbsp;<label for="deselect">deselectionner tous</label></span> 
      <span class="btn btn-light col-md-5 mb-2"><input type="checkbox" name="" class="" id="tous"> &nbsp;&nbsp;<label for="tous">Selectionner tous</label></span><br>
   
      <button onclick="return confirm('Le données les personnels et données correspondants seront aussi supprimés. Etes vous sûre de supprimer?')" name="multi-suppr" type="submit" class="btn btn-danger mb-2" >
      <i class="fas fa-x fa-trash-alt text-danger"></i>&nbsp;&nbsp; Supprimer les éléments selectionnés </button>
    


      </div>
    </div>
  </div>
</div> -->
</div>
                                      </form>
                                    </div>
                                </div>
                            </div>
                                </div>


                    
            


                                                            </main>
</body>
<script>
  var s_dep = document.querySelector("#s_dep");
  s_dep.onchange = function(){

    if(s_dep.value == 0){
        window.location.href = "departement";
    }else{
          window.location.href = "?id_departement="+s_dep.value;  
    }

  }



  a_d.onclick = function(){
    d.style.display = "block";
  }


</script>


<!-- <div class="main">

</div> -->















<button class="btn btn-success" name="ok">Enregistrer les modifications</button>




</form><div class="main" id="main">

</div>

<script>

count = 0;
var checkb = document.querySelectorAll(".checkbox");
var modal_selection = document.querySelector(".modal_selection");
var tous = document.getElementById("tous");
modal_selection.style.display = "none";
var cc = checkb.length;
checkb.forEach(select => {

tous.onclick = function(){
  if(tous.checked){
    for(i=0; i<checkb.length;i++){
      checkb[i].checked = true;
      count = checkb.length;
      modal_selection.style.display = "block";
    }
  }else{
    for(i=0; i<checkb.length;i++){
      checkb[i].checked = false;
      count = 0;
      modal_selection.style.display = "none";
    }
  }
}

  select.onclick = function(){
    if(select.checked){
        count++
    }else{
        count--;
    }
    if(cc == count){
        modal_selection.style.display = "block";
        tous.checked = true;
    }else{
        tous.checked = false;
        if(count == 0){
            modal_selection.style.display = "none";
        }else{
            modal_selection.style.display = "block";
        }
    };
    }

});
</script>



<!-- <script>

count = 0;
var checkb = document.querySelectorAll(".checkbox");
var modal_selection = document.querySelector(".modal_selection");
var tous = document.getElementById("tous");
var deselect = document.getElementById("deselect");
checkb.forEach(select => {

  deselect.onclick = function(){
if(deselect.checked){
    for(i=0; i<checkb.length;i++){
      checkb[i].checked = false;
      modal_selection.style.display = "none";
      deselect.checked = false;
    }
  }else{
    
  }
  }
tous.onclick = function(){
  if(tous.checked){
    for(i=0; i<checkb.length;i++){
      checkb[i].checked = true;
    }
  }else{
    for(i=0; i<checkb.length;i++){
      checkb[i].checked = false;
      modal_selection.style.display = "none";
    }
  }
}

  select.onclick = function(){
    if(select.checked == true){
      count++;
      modal_selection.style.display="block";
    }else{
      count --;
    }

 if(count == checkb.length){
 tous.checked = true;
 }
 else{
  tous.checked = false;
 }  
 if(count == 0){
  modal_selection.style.display="none";
}
  }


});
</script> -->

<?php

include_once "partials/foot.php";
?>