

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
<link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<?php 
if(isset($_POST["Ajout_admin"])){
    $utilisateur->execute(array($_POST["email"]));
    if($utilisateur->rowcount()==0){
    $add = $db->prepare("INSERT INTO utilisateur(email,mdp,types) VALUE(?,?,'1')");
    $add->execute(array($_POST["email"],md5($_POST["mdp"])));        
    }else{
        $errs = "Cet email ne peut pas être utilisé comme admin";
    }

}
?>

<form action="" method="post">
<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-end">
                <button class="btn btn-outline-secondary text-end  close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Contrat type 1: </p> 
                <div class="input-group">
                    <input type="hidden" required value="<?=$contrat1["id_prix_abonnement"]?>" name="id_contrat[]">
                    <input class="form-control btn btn-outline-dark text-start" value="<?=$contrat1["prix"]?>" type="number" min="5000"  name="prix[]" placeholder="prix" aria-label="Recipient's text" aria-describedby="my-addon">
                    <div class="input-group-append">
                        <span class="input-group-text btn btn-outline-dark" id="my-addon">Ariary / mois</span>
                    </div>
                </div>
                <p><b>Contrat type 2: </p> 
                <div class="input-group">
                    <input type="hidden" required value="<?=$contrat2["id_prix_abonnement"]?>" name="id_contrat[]">
                    <input  class="form-control btn btn-outline-dark text-start" value="<?=$contrat2["prix"]?>" min="10000" type="number" name="prix[]" placeholder="prix" aria-label="Recipient's text" aria-describedby="my-addon">
                    <div class="input-group-append">
                        <span class="input-group-text btn btn-outline-dark" id="my-addon">Ariary / mois</span>
                    </div>
                </div>
                <br>
                <div class="container">
                <!-- <div class="row">
                <div class="col"><p>Durée essai</p></div>
                <div class="col text-end">Unité</div>
                </div> -->
                </div>

                <!-- <div class="input-group">
                    <input value="<?=$essai["duree"]?>" class="form-control" type="number" min="1" name="" placeholder="Durée d'essai entreprise" aria-label="Recipient's text" aria-describedby="my-addon">
                    <div class="input-group-append">
                        <span class="input-group-tet" id="my-addon">
                            <select name="essai" id="" class="form-control">
                                <option <?php selected($essai["unit"],"1")?> value="1">Minute</option>
                                <option <?php selected($essai["unit"],"2")?> value="2">Heure</option>
                                <option <?php selected($essai["unit"],"3")?> value="3">Jour</option>
                            </select>
                        </span>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
               <button type="submit" name="gerr_Amin" class="btn btn-success">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<div id="admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-end">
                <button class="btn btn-outline-secondary text-end  close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Email</p> 
                <div class="input-group">
                    <input class="form-control btn btn-outline-dark text-start" value="" type="email" min="5000"  name="email" placeholder="email" aria-label="Recipient's text" aria-describedby="my-addon">
                    <div class="input-group-append">
                        <span class="input-group-text btn btn-outline-dark" id="my-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    </div>
                </div>
                <p><b>Mot de passe</p> 
                <div class="input-group">
                    <input  class="form-control btn btn-outline-dark text-start" value="" min="10000" type="password" name="mdp" placeholder="mot de passe" aria-label="Recipient's text" aria-describedby="my-addon">
                    <div class="input-group-append">
                        <span class="input-group-text btn btn-outline-dark" id="my-addon"><i class="fas fa-user-shield    "></i></span>
                    </div>
                </div>
                <br>
            
            </div>
            <div class="modal-footer">
               <button type="submit" name="Ajout_admin" class="btn btn-success">Ajout</button>
            </div>
        </div>
    </div>
</div>
</form>

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

<ul></ul>
<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <span class="badge bg-danger badge-number"><?=@$errs?></span>
            </a>



<?php if(isset($_SESSION["utilisateur"]) and $_SESSION["utilisateur"]["type"] == 3){$candidats = 5;}?>


<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      
    

        <li class="nav-item dropdown">

          
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

        <!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">
            <a href="../offres/accueil" class="text-light btn text-decoration-none btn btn-danger">
Deconnexion
            </a>
        </li>

        <!-- End Profile Nav -->

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


