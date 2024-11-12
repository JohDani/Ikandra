<?php 
if(isset($_GET["type"])){
  $type = $_GET["type"];
}

if(isset($action) and isset($_GET["id"])){
                                    
  // $id_personnel = $_GET['id'];
  // $info_pers = $db->prepare("SELECT * , personnels.nom as nom_personnel , poste.nom as nom_poste , departement.nom as nom_departement FROM personnels inner JOIN departement on departement.id = personnels.id_departement inner join poste on poste.id = personnels.id_poste where personnels.id=$id_personnel");
  // $info_pers->execute();

  //     @$inf = @$info_pers->fetch(PDO::FETCH_ASSOC);


  // echo $inf["id"];

      
      
    }
    

if(isset($_GET["action"])):?>

<div style="position:fixed; top:0;width:100%;z-index:10000; left: 0;border: red;right: 50%;" id="my-modal" class="dep" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content ">
        <div class="modal-header btn">
          <!-- <h5 class="modal-title bg-light text-end" id="my-modal-title"><b>
            <?=@$inf["prenom"].@strtoupper($type);?></b></h5> -->
          
        </div>
        <div class="modal-body m-0 p-0">

        <form action="" method="post" >
          <div class="container d-flex align-items-center justify-content-center w-100" style="">

        <div class="form w-50 shadow card p-2 mt-5" >
       <div class="modal-header ">
       <button type="button"  class="btn btn-dark close text-end" id="closer" onclick="window.location.href='departement'">
            <span aria-hidden="true">&times;</span>
          </button>
          
          <h6 class="text-danger text-center w-100 mt-0 mb-2 mt-2"><?=@$err?></h6>&nbsp;&nbsp;&nbsp;
       </div>
       
          <?php if(@strtolower($type) !== "departement"):?>
          <select name="id_departement" id="dprt" class="form-control d_par mb-2 mt-2">
            <option value="0">Selectionner le departement</option>
            <?php foreach($departs as $dt):?>
                <option <?php if(isset($_GET["id_departement"]) and ($_GET["id_departement"] == $dt["id_departement"])){echo "selected";}?> value="<?=$dt['id_departement']?>"><?=$dt['nom_departement']?></option>
            <?php endforeach;?>
          </select>




          <?php endif;?> 
       

   <div class="place">
    <?php if(!(isset($departement))):?>
    <div class="input-group p-2">
    <input class="form-control mb-2 valeurs" type="text" name="departement[]" placeholder="Ajout <?=@$type?>" aria-label="Recipient's text" aria-describedby="my-addon">
    </div> 
    <?php elseif(isset($departement)): foreach($departement as $d): if($d !== ""):?>
    <input class="form-control  valeurs mb-3" type="text" value="<?=$d?>" name="departement[]" placeholder="Ajouter un departement" aria-label="Recipient's text" aria-describedby="my-addon">
    <?php endif;endforeach;endif;?>
  
    <input type="hidden" name="" id='reference'>
    </div>

  
 <div class="input-group-append p-2">
        <input type="button" class="departement input-group-text bg-success text-light" id="my-addon" value="Ajouter plus">
    </div>
  
                <center class="p-2">

                    <button id="terminer" class="btn btn-primary form-control border-none mb-1" name="terminer">Terminer</button>
                  
                </center>
  
            </div>


    </div>
    </form>








        </div>      
      </div><div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<?php else: rediriger('404') ;endif;?>





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

<style>
  .img_pdp img{
    border-radius: 50%;
    width : 150px;
    height: 150px;
  }
</style>