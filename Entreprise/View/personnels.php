<?php 


if(isset($_POST["su"])){
    $id_perso = $_POST["id_perso"];
    foreach($id_perso as $pers){
        $sup_perso->execute([$pers]);
    }
    $suc = "Suprimé avec success";
    
}


if(isset($err) or isset($_SESSION["err"]) or ( isset($_SESSION["postule"]) and isset($_SESSION["utilisateur"]) and $_SESSION["utilisateur"]["type"] == "3") or isset($suc)):?>
<div id="msss" class="col" style="position: fixed; z-index: 10; top: 70px; right: 10px" tabindex="-1"  aria-hidden="true">
  <div class="card border border-<?=@$color?>">
    <div class="card-body">
        <?php if(isset($suc)):?>
        <button class="btn"><i class="fa fa-check-circle fa-2x text-success " aria-hidden="true"></i></button>
        <button class="btn text-success"><?=@$suc?></button><br>
        <a href="candidature"></a>
        <?php elseif(isset($err) or isset($_SESSION["err"])):?>
            <button class="btn ">
                <i class="fa fa-window-close text-danger" aria-hidden="true"></i>
            </button>
            <button class="btn text-danger"><?=@$err?></button>
        <?php elseif(isset($_SESSION["utilisateur"]) and $_SESSION["utilisateur"]["type"] == 3 and isset($_SESSION["postule"])):?>
        <i class="fa fa-spinner" aria-hidden="true"></i>
        <?php if(isset($_SESSION["postule"]["message"])):?>
            <button class="btn text-danger text-start">Vous avez déjà postuler à cette offre</button>
        <?php else:?>
        <button class="btn text-success text-start">Une candidature en attente d'envoi</button>
        <a href="#publication<?=$_SESSION["postule"]["id_offre"]?>" class="btn text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir l'offre"><i class="fa fa-eye" aria-hidden="true"></i></a>  
        <button class="btn text-success"  data-bs-toggle="tooltip" data-bs-placement="top" title="Confirmer l'envoi"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
        <button class="btn text-danger"  data-bs-toggle="tooltip" data-bs-placement="top" title="Annuler la candidature"><i class="fa fa-window-close" aria-hidden="true"></i></button>
        <?php endif; endif;?>
    </div>
  </div>
</div>

<?php if(!isset( $err_pr) and !isset($desactive)):?>
<script>
    var mss = document.querySelector("#msss");
    setTimeout(() => {
        location.reload();
    }, 500);
   setTimeout(() => {
    mss.style.display = "none";
   }, 4000);
</script>
<?php endif;endif;?>
        
        
        
        
        
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>



<?php

if (@$personnels->rowcount() == 0 and isset($_GET["poste"])) {
    rediriger("information?ajout");
}

if ($list_entreprise->rowcount() == 0): ?>
  <script>window.location.href="configurer"</script>
<?php endif;?>





<body style="background-color: <?=@$black?>">

<form action="" method="post">

<?php include_once "partials/sidebar.php";?>
<div class="main" id="main">


<div id="wrapper bg-none mt-3">
<?php if (isset($_GET["poste"])): ?>
<div class="d-flex flex-column" id="content-wrapper">
    <div id="content">
    <div class="p-0 m-0">
        <div class="row ">
            <div class="col-md-6 col-xl-4 mb-1" >
                <div class="card shadow bg-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-info font-weight-bold text-xs "><h4></h4></div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="text-light font-weight-bold h5 mb-0 mr-3">Total personnels: <span><?=$personnels->rowcount()?></span>

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php endif;?>


            <div class="m-0 p-0">
                <?php if(!isset($_GET["salaire"])):?>
                 <h3 class="bg-<?=@$primaire?> text-info p-2 m-0 mb-1">Personnels</h3>
                <?php else:
                    function mois($int,$mois){
                        if($_GET["mois"]==$int){
                            echo $mois;
                        }
                    }
                    ?>
                    <h3 class="text-danger">
                    
                        <span class="text-dark">Non payé :</span>
                        <?php 
                        mois(1,"janvier");
                        mois(2,"Fevrier");
                        mois(3,"Mars");
                        mois(4,"Avril");
                        mois(5,"Mai");
                        mois(6,"Juin");
                        mois(7,"Juillet");
                        mois(8,"Aout");
                        mois(9,"Septembre");
                        mois(10,"Octobre");
                        mois(11,"Novembre");
                        mois(12,"Décembre");

                        echo " ".@$_GET["anee"];

                        ?>

                    </h3>
                <?php endif;?>
<?php if ($personnels->rowcount() > 0): ?>
    <form action="" method="post">
                                <div class="card shadow bg-<?=@$primaire?>" >

                                        <div class="p-2 table-responsive bg-<?=@$primaire?> table-<?=@$primaire?> text-light table p-0" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                            <table style="min-height: 300px;" class="table table-<?=@$primaire?> table-striped border text-light w-100" <?php if(!isset($_GET["salaire"])):?> id="tables" <?php endif;?>>
                                                <thead>
                                                    <tr class="">
                                                        <th class="text-start"><input type="checkbox" name="" id="tous"></th>
                                                        <th class="text-secondary p-2">images</th>
                                                        <th class="text-secondary p-2">Noms </th>
                                                        <?php if(!isset($_GET["salaire"])):?>
                                                            <th class="text-secondary p-2">email</th>
                                                        <?php endif;?>
                                                        <th class="text-secondary p-2">Postes</th>
                                                        <th class="text-secondary p-2">
                                                            <?php if(isset($_GET["salaire"])){echo "Date payement";}else{echo "contrat";}?>
                                                        </th>
                                                        <button type="submit" class="modal_selection btn btn-danger btn-sm" style="display: none" name="su"><i class="fas fa-trash-alt    "></i> Supprimer</button>
                                                        <th class="">
                                            
                                                           
                                                        </th>
                                                    <style>
                                                        .modal_selection{
                                                            display: none;
                                                        }
                                                    </style>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($perso as $psl): ?>

                                    <tr class="text-center">

                                                        <td class='text-start'><input type="checkbox" value="<?=$psl["id_personnel"]?>" name="id_perso[]"  id="" class="checkbox"></td>
                                                        <td>

                                                            <div class="photo">

                                                            <?php if (file_exists("../../assets/images/" . $psl["image"])): ?>

                                                                <img src="../../assets/images/<?=$psl["image"]?>" alt="">
                                                                <?php else: ?>
                                                                <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                                                                    <?php endif;?>

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a class="btn text-<?=@$secondaire?>"><?=$psl["nom_personnel"]?></a>
                                                        </td>
                                                    <?php if(!isset($_GET["salaire"])):?>
                                                        <td class="">
                                                <a  class="btn text-<?=@$secondaire?>"><?php if (!empty($psl["email"])) {echo $psl["email"];} else {echo "Acucun";}?></a>
                                                        </td>
                                                    <?php endif;?>
                                                        <td><a href="" class="btn text-<?=@$secondaire?>"><?=@$psl["nom_poste"]?></a></td>
                                                        <td>
                                                            <?php if(!isset($_GET["salaire"])):?>
                                                            <a href="" class="btn text-<?=@$secondaire?>"><?=@$psl["contrat"]?></a>
                                                            <?php else:?>
                                                            <input type="date"  min="<?=date("Y")-5?>-01-01" max="<?=date("Y-m-d")?>" class="form-control" name="date_payement<?=$psl["id_personnel"]?>" id="">
                                                            <?php endif;?>
                                                        </td>
                                                        <td class="text-center">
                                                        <?php if(!isset($_GET["salaire"])):?>
                                                            <div class="dropdown open">
                                                                <button
                                                                    class="btn btn-secondary dropdown-toggle"
                                                                    type="button"
                                                                    id="triggerId"
                                                                    data-bs-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                >
                                                                option
                                                                </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId<?=@$psl["id_personnel"]?>">
                                                <a href="information?action=voir&id=<?=@$psl["id_personnel"]?>" class="dropdown-item">
                                                    <i class="fas fa-pencil-alt    "></i>
                                                    &nbsp;<span>Modifier</span>
                                                </a>

                                                <a href="information?action=voir&id=<?=@$psl["id_personnel"]?>" class="dropdown-item">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    &nbsp;<span>Informations</span>
                                                </a>


                                                            </div>
                                                <?php else:?>
                                                <button class="btn btn-success text-start" name="payer_salaire" value="<?=$psl["id_personnel"]?>"><i class="fa fa-check" aria-hidden="true"></i> Marquer payé</button>
                                                <?php endif;?>
                                                        </td>
                                    </tr>

<?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 align-self-center">
                                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite"></p>
                                            </div>
                                        </div>
                                    </div>
</form>
                                    <?php else: ?>
                                        <center>
                                            <div class="card">
                                                <div class="card-body p-5">
                                                    <?php if(!isset($_GET["salaire"])):?>
                                                    <h5 class="card-title">Vous devez ajouter d'abord</h5>
                                                    <a href="information?ajout" class="btn btn-dark card-text">Ajout</a>
                                                    <?php else:?>
                                                    <h3 class="card-titl p-3">
                                                        Ce liste est vide
                                                    </h3>
                                                    <a href="payements?statue=non_paye" class="btn btn-dark card-text">Voir d'autre payement</a>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                        </center>
                                    <?php endif;?>
                                </div>
                            </div>
                                </div>




</div>



</form>
</body>


<script>
var btn_option = document.querySelectorAll(".btn-option");
    function options(p1,p2){
    var option = document.querySelectorAll(p1);
    var ctx = document.querySelector(p2);
    document.onclick = function(e){
        ctx.classList.toggle('view');
        ctx.style.left = e.clientX + 'px';
        ctx.style.top = e.clientY + 'px';
    }
    document.addEventListener('click', function(e){
    var MenuWidth = ctx.offsetWidth;
    var MenuHeight = ctx.offsetHeight;
    var max_X = window.innerWidth - MenuWidth;
    var max_Y = window.innerHeight - MenuHeight;
    var X = e.clientX > max_X?max_X : e.clientX;
    var Y = e.clientY > max_Y?max_Y : e.clientY;
    ctx.style.left = X+'px';
    ctx.style.top = Y + 'px';
    })



//    if(ctx.classList == "contxt-menu view"){
//   document.onclick = function(){

//         ctx.classList.toggle('view');
//      alert(1), 5000

//    }
//     }





    }

    for(i=0; i < btn_option.length; i++){

       btn_option[i].onclick = function(e){
           options(".btn-option" , ".contxt-menu");
       };
    }


    // var btn_ms = document.querySelector(".btn-ms");
    //  btn_ms.onclick = function(){
    //  alert(9);
    //  }



</script>


<script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>




        <script>

count = 0;
var checkb = document.querySelectorAll(".checkbox");
var modal_selection = document.querySelector(".modal_selection");
var tous = document.getElementById("tous");
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

<style>

    /* .photo {
        width: 40px;
        height: 40px;
        overflow: hidden;
    } */

    .photo img{
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }

    a{
        text-decoration: none;
    }


    .c{

    }

    .btn-plus{
        border-color: green;
        background-color: none;
        border-radius: 10px;
        float: right;
        color: green;
        font-size: 15px;
        min-width: 100px;
        margin: 2px;
        padding: 5px;
    }

    .s{
        display: flex;
        justify-content: right;

    }



    .srch {
        width: 100%;
        display: inline;
        border-radius: 5px;

    }

    .btn-srch{
        position: relative;
        background: none;
        border: none;
        right: 25px;
    }



    .btn-option{
        background-color: unset;
        border: none;
    }

    .pdp{
        display: flex;
        align-items: center;
        flex-direction: column;
        gap: 5px;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 1px 1px 5px 1px;
        min-width: 300px;
        max-width: 100%;
        width: 30%;
    }
/*
    .container{
        width: 100%;
        margin-top: 5px;
        display: flex;
        gap: 10px;

    } */


    .informations{

    }

    .informations{
        flex-wrap: wrap;
    }

    .perso{
        display: flex;
        flex-direction: row;
        align-items: left;
        flex-wrap: wrap;
    }

    .info .container label{
        display: block;
    }

    @media screen and (max-width: 480px){

        .container{
            display: block;
        }
        .btn-list{
            width: 100%;
        }
    }

</style>

<?php

include_once "partials/foot.php";
?>