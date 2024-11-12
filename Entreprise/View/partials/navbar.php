
<?php 



$in->execute(array($_SESSION["utilisateur"]["id"]));
$user=$in->fetch(PDO::FETCH_ASSOC);

if($user["theme"] == "1"){

$primaire="dark";//couleur_principal(bg)
$black = "rgba(1,1,1,0.8)";
$secondaire = "light";//couleur secod (couleur_text)
$tertiaire = 'secondary';

}

?>



<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
<link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


<form action="" method="post">
<div id="my-modal" class="modal fade" tabindex=""role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close btn btn-dark" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="btn m-auto"><b>Abonnement: </b> contrat type 2</h5>
            </div>
            <div class="modal-body">
                <?php if($attente_abonn->rowcount() > 0):?>
                <h4>Payement en attente</h4>
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
                <?php endif;?>
                <p>Debut abonnement: <b><?=$abonn["debut_contrat"]?></b></p>
                <p>Fin abonnement: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?=$abonn["fin_contrat"]?></b></p>
                <b>Mobile money: /0324525654/ Danieltiana Randrianjatovo</b>  <br>
                <input type="hidden" value="<?=$user["prix"]?>" name="prix">
                <span class="btn text-start"><b>Prix: <?=$user["prix"]?></b> 
                
                Ar</span>


                
                
            </div>
           
            <div class="modal-footer">
                
           <div class="input-group">
            <input class="form-control" type="text" required name="reference_transaction" placeholder="Reference de transaction" aria-label="Recipient's text" aria-describedby="my-addon">
            <div class="input-group-append">
            <button class="input-group-text bg-primary text-light" id="my-addon" name="payer_contrat">envoyer</button>
            </div>
           </div>
                
            </div>
        </div>
    </div>
</div>
</form>

   <!-- ======= Header ======= -->
   <header id="header" class="header fixed-top d-flex align-items-center bg-<?=@$primaire?> shadow">
   <?php if($url !== "configurer"):?>
    <i class="bi bi-list toggle-sidebar-btn text-<?=@$secondaire?>"></i>
    <?php endif;?>



<div class="d-flex align-items-center justify-content-between">
    <a href="accueil" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block bg-light"><span class="text-dark">I-KAN</span><span >DRA</span></span>
      
    </a>
</div>
<!-- End Logo -->


<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        <li class="nav-item dropdown">

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
        <!-- End Messages Nav -->

        <li class="nav-item dropdown " style="margin-right: 10px">

            <a class="nav-link nav-profi text-secondary d-flex align-items-center  text-<?=@$secondaire?>" href="#" data-bs-toggle="dropdown">
            <?php if(file_exists("../../assets/images/".$user["images"])):?>
                    <img src="../../assets/images/<?=$user["images"]?>" id="prof" class="rounded-circle">
                <?php else:?>
                    <i class="fas text-secondary fa-3x fa-user-circle" aria-hidden="true"></i>
                    <?php endif;?>
                    
                <b><span class="d-none d-md-block dropdown-toggle ps-3 "><?=$user["nom_utilisateur"]." ".$user["prenom"]?></span></b>&nbsp;&nbsp;
            </a>
            <!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrw profile text-<?=@$secondaire?> bg-<?=@$primaire?>">
                    
                <li class="dropdown-header">
                <?php if(file_exists("../../assets/images/".$user["images"])):?>
                    <img src="../../assets/images/<?=$user["images"]?>" id="profs" class="rounded-circle">
                <?php else:?>
                    <i class="fas text-secondary fa-8x fa-user-circle" aria-hidden="true"></i>
                    <?php endif;?>
                    <h6 class="text-<?=@$secondaire?>"><?=$user["nom_utilisateur"]." ".$user["prenom"]?></h6>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
<?php if(strtolower($url) !== "configurer"):?>
               
                <li>
                    <a class="dropdown-item d-flex align-items-center text-<?=@$secondaire?>" href="profil">
                        <i class="bi bi-person"></i>
                        <span>Mon Profil</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <form action="" method="post">
                    <button class="dropdown-item btn text-<?=@$secondaire?>" name="change">
                    <i class="fas fa-exchange-alt" aria-hidden="true"></i>
                    Changer le theme
                </button>
                    </form>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

<?php endif;?>

                <li>
                    <form action="" method="post">
                    <button name="deconnexion" class="dropdown-item d-flex align-items-center text-danger" >
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Se deconnecter</span>
                </button>
                </form>
                </li>

            </ul>
            <!-- End Profile Dropdown Items -->
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
.prf{
    /* object-fit: cover; */
    
}




#prof{
    width: 50px;
    height: 50px;
    object-fit: cover;
}

#profs{
    width: 100px;
    height: 100px;
    object-fit: cover;
}

::-webkit-scrollbar {
  width: 7px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
    border-radius: 10px;
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}

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

        <?php if($url !== "information"):?>
            localStorage.removeItem("importé");
        <?php endif;?>
</script>

