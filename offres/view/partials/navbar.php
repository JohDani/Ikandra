<?php 
if(isset($_SESSION["utilisateur"])){
    $entretien_candidat->execute(array($_SESSION["utilisateur"]["id"]));
    $list_entretien = $entretien_candidat->fetchAll(PDO::FETCH_ASSOC);    
    $in2 -> execute(array($_SESSION["utilisateur"]["id"]));
    $users = $in2->fetch(PDO::FETCH_ASSOC);
    if($users["status"] == "1"){
        $disabled = "disabled";
    }
}

    ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
<link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Modal trigger button -->


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
        class="modal-dialog modal-dialog-scrollable modal-dialog"
        role="document"
    >
        <div class="modal-content"> 
        <form action="" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Notification</h5>
                <button
                    type="submit"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    name="off_notif"
                ></button>
                
            </div>
        </form>
            <div class="modal-body">
                <?php if($entretien_candidat->rowcount()==0):?>
                    <p class="shadow p-5">
                        Vous n'avez aucune notification pour le moment
                    </p>
                <?php endif; foreach($list_entretien as $entretien):?>
                <p class="shadow text-dark p-2">
                <b>Entretien: </b> 
                <?php 
                $date = date_create($entretien["date_entretien"]);
                echo date_format($date,"M d Y");
                ?>
                <?=$entretien["heure"]?>
                à <?=$entretien["lieu"]?><br>
                <b>contact:</b> <?=$entretien["telephone"]." / ".$entretien["email"]?><br>
                                <em><?php 
                                $date_notif = date_create($entretien["date_notif"]);
                                echo date_format($date_notif,"d-M Y");
                                ?></em>
                </p>

                <?php endforeach;?>
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


<?php if(isset($err) or isset($_SESSION["err"]) or ( isset($_SESSION["postule"]) and isset($_SESSION["utilisateur"]) and $_SESSION["utilisateur"]["type"] == "3") or isset($suc)):?>
<div id="msss" class="col" style="position: fixed; z-index: 10; top: 70px; right: 10px"  aria-hidden="true">
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
    mss.style.display = "none";
   }, 4000);
</script>
<?php endif;endif;?>


   <!-- ======= Header ======= -->
   <header id="header" class="header fixed-top d-flex align-items-center bg-dark shadow">
<div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn text-light"></i>
        <a href="accueil" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block bg-light"><span class="text-dark">I-KAN</span><span >DRA</span></span>
      
    </a>
</div>
<!-- End Logo -->


<?php if(isset($_SESSION["utilisateur"]) and $_SESSION["utilisateur"]["type"] == 3){
    $candidats = 5;
    
    }?>


<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      
    

        <li class="nav-item dropdown">

            <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-chat-left-text"></i>
                <span class="badge bg-success badge-number">3</span>
            </a> -->
            <!-- End Messages Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                <li class="dropdown-header">
                    You have 3 new messages
                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="message-item">
                    <a href="#">
                        <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                        <div>
                            <h4>Maria Hudson</h4>
                            <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                            <p>4 hrs. ago</p>
                        </div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="message-item">
                    <a href="#">
                        <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                        <div>
                            <h4>Anna Nelson</h4>
                            <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                            <p>6 hrs. ago</p>
                        </div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="message-item">
                    <a href="#">
                        <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                        <div>
                            <h4>David Muldon</h4>
                            <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                            <p>8 hrs. ago</p>
                        </div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="dropdown-footer">
                    <a href="#">Show all messages</a>
                </li>

            </ul>
            <!-- End Messages Dropdown Items -->

        </li>
<?php if(!isset($candidats)):?>

        <li class="nav-item dropdown pe-3">
            <a href="connexion" class="text-light text-decoration-none">
                    Connexion        
            </a>
        </li>
        <li class="nav-item dropdown pe-3">
            <a class="btn btn-success" href="#" data-bs-toggle="dropdown">
                    Inscription
            </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile bg-dark">
            <li class="dropdown-header ">
                    <a href="inscription?candidat" class="text-light">Candidat</a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li class="dropdown-header">
                <a href="inscription" class="text-light">  Entreprise</a>
            </li>
            </ul>
         
        </li>
 
<?php else:?>
    <li class="nav-item dropdown pe-3">
    <form action="" method="post">
    <button class="btn btn-danger" name="deconnexion">Deconnexion</button>
</form>
    </li>
<?php endif;?>
    </ul>
</nav>
<!-- End Icons Navigation -->

</header>
<!-- End Header -->





<script>

    function retour(){
        window.history.back();
    }

var loading = document.querySelector(".loading");


window.onload=function(){

  loading.style.display = "flex";
setTimeout(function(){
  loading.style.display = "none";
}, 150);

}

</script>





           
<style>

/* .side-nav{
    position: fixed;
    top: 0;
    height: 100vh;
    width: 200px;
    z-index:5;
} */

.p_profil img{
    border-radius: 50%;
}

.l-home{
  display: none;
}

.side-nav + .navbar{
  background-color: none;
}

.content{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    /* margin-left: 200px; */
    gap: 5px;
}

/* .main{
    margin-left: 250px;
} */
.apps{
    min-width: 100px;
    max-width: 100%;
    min-height: 125px;
    overflow: hidden;
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: space-around;
    flex-wrap: wrap;
    box-shadow: 2px 2px 5px 1px black;

}

.apps:hover{
    transform:scale();
    box-shadow: 1px 1px 5px 1px black;
}


.nav-link{
  color: white;
}

.closes{
  display: none;
}

@media(max-width:765px){

    .side-nav{
    left:0;
    width:0;
    margin: 0;
    overflow-y: auto;
    overflow-x:hidden;
    }
    .l-home{
      display: unset;
    }

    .log{
      display: none;
    }

    .closes{
      display: unset;
    }

    .contents, .cont, .main{
      
        margin-left:0;
    }
  .voir{
width: 200px;
}



.b-home{
                display:none;
        }

}



.apps{
box-shadow: 2px 2px 5px 1px black;
margin: 5px 2px ;
border-radius: 20px;
margin: 8px 10px;

}

</style>


<script>

    function redirige(e){
        window.location.href = e;
    }
    var alrt_cls = document.querySelectorAll(".exit");
    var alerts = document.querySelector(".alert");

        for(i = 0; i<alrt_cls.length; i++){
            alrt_cls[i].onclick = function(){
                alerts.style.display="none";
            }
        }
</script>


