<?php 
if(isset($_SESSION["utilisateur"])){
    $entretien_candidat->execute(array($_SESSION["utilisateur"]["id"]));
    $list_entretien = $entretien_candidat->fetchAll(PDO::FETCH_ASSOC);    
    $in2 -> execute(array($_SESSION["utilisateur"]["id"]));
    $users = $in2->fetch(PDO::FETCH_ASSOC);
    if($users["status"] == "1"){
        $disabled = "disabled";
        $err = "Votre compte est desactivé";
    }
}

    ?>
    <!--welcome-hero start -->


<?php include_once "../view/partials/sidebar.php";?>

<form action="" method="post">


<main class="main" id="main">


    <?php if (!isset($_GET["categorie"])): ?>
    <section id="home" class="welcome m-0 p-0" id="" style="overflow: hidden; height: auto; background: url(../assets/images/lockscreen-bg.jpg); background-size: cover">
        <div class="container">
            <div class="welcome-hero-txt">
                <h2>La meilleure place que <br> <span class="bg-light text-dark">que vous avez besoin </span></h2>
                <p>
                    Vous êtes dans la meilleure place pour chercher ce que vous convient, <br> selon <span class="bg-light text-dark p-1">vos experiences</span>  et <span class="bg-primary p-1">vos compétences.</span>
                </p>
            </div>
        </div>
    </section>
<?php endif;?>

<section style="">
        <main class="container-fluid bg-gradient-primary " id="">
            <div class="row p-3">
                    <div class="col bg-primary text-light p-3 btn">
                        <center>
                            <h2><?php if ($publications->rowcount() == 0 and $echantillon->rowcount() == 0) {echo "Aucune";} else {echo @$aucune;}?> Poste(s) disponible(s)</h2>
                        </center>
                    </div>
            </div>
            <?php if ($publications->rowcount() == 0 and $echantillon->rowcount() == 0):?>
                            <div class="card p-5">
                               <h4>Vous pouvez voir d'autre dans la catégorie</h4>
                               <br>
                               <a href="#">Accueil</a>
                            </div>
                        <?php endif;?>
    <?php foreach ($pub_ech as $pub): ?>
        <div class="row" >
                <div class="col" id="publication<?=$pub["id"]?>">
                            <div class="single-explore-item">
                                <div class="single-explor-img p-2">

                                    </div>
                                    <div class="single-explore-txt bg-theme-1">
                                        <h2 style="margin-top: -20px"><a href="#" class="text-dark d-none" ><?=@$pub["poste"]?></a></h2>
                                        <p class="explore-rating-price">
                                            <span class="explore-rating ">Ville: </span>
                                            </span>
                                            <a href="#" class="text-dark"><?=@$pub["villes"]?></a>
                                            <span class="explore-rating ">Contrat: </span>
                                            </span>
                                            <a href="?contrat=<?=@$pub["contrat"]?>" class="text-dark"><?=@$pub["contrat"]?></a>
                                        </p>

                                            <div class="row">
                                                <div class="text-justify  text-start w-100 " >
                                                    <div style="overflow: hidden;" class="card-text m-0" style="min-height: 10px">
                                                        <div class="accordion mt-2 m-0" id="accordionExample">
                                                          <div class="card m-0">
                                                            <div class="card-header" id="headingOne">
                                                              <h2 class="mb-0">
                                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                <a href="accueil?categorie=<?=@$pub["categorie"]?>"><?=@$pub["categorie"]?></a>
                                                                <?PHP

?>                                                              </button>
                                                              </h2>
                                                            </div>

                                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                              <div class="card-boy p-2">
                                                               <?=$pub["description"]?>
                                    
                                                               <div class="images mb-2">
                                                <center>
                                                <!-- Modal trigger button -->
                                                   <?php if(file_exists("../../assets/images/".@$pub['images'])):?>
                                                <button
                                                    type="button"
                                                    class="btn shadow op"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#images<?=$pub['images']?>"
                                                    style="width: 100%"
                                                >

                                                <style>
                                                    .op{
                                                        transform: scale(1.1);
                                                    }
                                                    .op:hover{
                                                        transform: scale(1.2);
                                                    }
                                                </style>
                                    
                                                <img class="img-thumbnail" src="../../assets/images/<?=$pub['images']?>" alt="">
                                                
                                                </button>
                                                <?php endif;?>

                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div
                                                    class="modal fade"
                                                    id="images<?=$pub['images']?>"
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
                                                            <!-- <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">
                                                                    Modal title
                                                                </h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"
                                                                ></button>
                                                            </div> -->
                                                            <div class="modal-body">
                                                            <div class="images mb-2">
                                                </div>       <img class=" fa fa-image fa-8x" src="../../assets/images/<?=@$pub['images']?>" alt="">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-secondary"
                                                                    data-bs-dismiss="modal"
                                                                >
                                                                    Fermer
                                                                </button>

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

                                                </center>
                                                </div>
                                             
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>

                                            <div class="row">
                                            </div>
                                           </div>
                        <div class="mt-2">

                                    <?php if (isset($_SESSION["utilisateur"]) and $_SESSION["utilisateur"]["type"] == 3) {
    $verif_candider->execute(array($_SESSION["utilisateur"]["id"], $pub["id"]));
}
if ($verif_candider->rowcount() == 0): ?>
                                    <input type="hidden" name="id_entreprise<?=$pub["id"]?>" value="<?=$pub["id_entreprise"]?>">
                                    <button name="postuler2" <?=@$disabled?> class="btn btn-success" value="<?=$pub["id"]?>">Postuler</button>
                                    <?php else:
    $id_candid = $verif_candider->fetch(PDO::FETCH_ASSOC);?>
	                                    <a  class="btn btn-danger <?=@$disabled?>"href="?annuler&id_candidature=<?=$id_candid["id_candidat_entreprise"]?>#publication<?=$pub["id"]?>">Annuler</a>
	                                    <?php endif;?>

                        </div>
                    </div>

                                </div>

                        </div>

                </div>
            </div>
        <?php endforeach;?>
            </main>
</section>

<style>
    .images img{

        width: 100%;
        max-height: 300px;
        object-fit: cover;
    }
</style>
<!-- <section class="clean-block slider mt-0 mb-0"   style="background: url(../assets/images/lockscreen-bg.jpg);background-blend-mode: soft-light;">
            <div class="container">
                <div class="carousel slide" data-ride="carousel" id="carousel-1">
                    <div class="carousel-inner" role="listbox">
                    <h2 class="mt-3 m-0 p-0">
                        catégories
                    </h2>


                    <?php
$compteur = 0;
foreach ($categorie as $categories):
    $compteur++;

    $prev = $db->prepare("SELECT * FROM categories WHERE id > ? ORDER BY id ASC LIMIT 1");
    $prev->execute(array($categories["id"]));
    $categ_prev = $prev->fetch(PDO::FETCH_ASSOC);

    if ($prev->rowcount() == 0) {
        $vides = "DecouVrir les categoris";
    }

    ?>
	                        <div class="carousel-item p-0 <?php if ($compteur == 1) {echo "active";}?>" style="min-height: 300px;">
	                            <div class="explore-content">
	                                <div class="row">
	                                    <div class=" col-md-4 col-sm-6 ">
	                                        <div class="single-explore-item ">
	                                            <div class="single-explore-txt bg-theme-1">
	                                                <h2 style="margin-top: -20px"><a href="#" class="" >Decouvrir les categories</a></h2>

	                                                    <div class="text-center mt-1 btn w-100 text-light">
	                                                        <h5></h5>
	                                                    </div>
	                                             </div>
	                                                    <div class="modal-footer text-light">
	                                                        <a href="accueil" class="btn btn-primary text-light form-control">Tous les offres</a>
	                                                    </div>
	                                        </div>
	                                    </div>

	                                    <div class=" col-md-4 col-sm-6">
	                                        <div class="single-explore-item ">
	                                            <div class="single-explore-txt bg-theme-1">
	                                                <h2 style="margin-top: -20px; height:40px; max-height: 40px"><a href="#" class="" >
	                                                    <?=$categories["nom"]?></a>
	                                                </h2>

	                                                    <div class="text-center mt-3 bg-dark btn w-100 text-light">
	                                                        <h5>Offre disponible: </h5>
	                                                    </div>
	                                             </div>
	                                                    <div class="modal-footer text-light">
	                                                        <a href="accueil?categorie=<?=$categories["nom"]?>" class="btn btn-primary text-light form-control">Voir</a>
	                                                    </div>
	                                        </div>
	                                    </div>

	                                    <div class=" col-md-4 col-sm-6" style="max-height: 250px">
	                                        <div class="single-explore-item ">
	                                            <div class="single-explore-txt bg-theme-1">
	                                                <?php
    $next = $db->prepare("SELECT * FROM categories WHERE id > ? ORDER BY id ASC LIMIT 1");
    $next->execute(array($categories["id"]));
    $categ_next = $next->fetch(PDO::FETCH_ASSOC);

    if ($next->rowcount() == 0) {
        $vide = "C'est tout";
    }
    ?>
	                                                    <h2 style="margin-top: -20px;height:40px; max-height: 40px"><a href="#" class="" ><?=@$vide . @$categ_next["nom"]?></a></h2>
	                                                    <div class="text-center mt-3 mb-0 bg-dark btn w-100 text-light">
	                                                        <h5>Offre disponible: </h5>
	                                                    </div>
	                                                    </div>
	                                                    <div class="modal-footer text-light">
	                                                        <a href="accueil?categorie=<?=@$categ_next["nom"]?>" class="btn btn-primary text-light form-control">Voir</a>
	                                                    </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    <?php endforeach;?>


                    </div>
                    <div class="">
                    <a class="carousel-control-pre " href="#carousel-1" role="button" data-slide="prev"><button class="btn btn-dark">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
                    <a class="carousel-control-nex" href="#carousel-1" role="button"
                            data-slide="next"><button class="btn btn-dark"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></a></div>
                </div><br><br>
            </div>
</section> -->





    <section   class="main features-icons bg-dark shadow text-light text-center  mt-0  pt-5 pb-5 card mb-0" style="margin-top:">
        <div class="container m-0">
            <div class="row">
                <div class="col-lg-4" >
                    <div class="mx-auto features-icons-item  mb-lg-0 mb-lg-3">
                        <h3><i class="fa fa-users fa-4x text-success fa-animate" aria-hidden="true"></i></h3>
                        <p class="lead mb-0">Les candidats peuvent postules aux offres disponibles, une opportunité de creer ces cv</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mx-auto features-icons-item mb-5 mb-lg-0 mb-lg-3">
                        <h3><i class="fas fa-user-tie fa-4x fa-fw text-secondary "></i></h3>
                        <p class="lead mb-0">Les recruteurs peuvent poster des annonces dans le plateforme en créant ses comptes</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mx-auto features-icons-item ">
                        <h3><i class="fa fa-gift fa-4x text-danger fa-flip" aria-hidden="true"></i></h3>
                        <p class="lead mb-0"> 
                            Les offres disponibles ici peuvent classés et filtrés par catégories
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</form>
<style>
        /*==================================
* Author        : "ThemeSine"
* Template Name : Listrace  HTML Template
* Version       : 1.0
==================================== */

/*==================================
font-family: 'Roboto', sans-serif;
==================================== */


/*=========== TABLE OF CONTENTS ===========
1.  General css (Reset code)
2.  Header-top
3.  Top-area
4.  Welcome-hero
5.  List-topics
6.  Works
7.  Explore
8.  Reviews
9.  Counter
10. Blog
11. Subscribe
12. Footer
==========================================*/

/*-------------------------------------
		1.General css (Reset code)
--------------------------------------*/
*{
    padding: 0;
    margin: 0;
}

*{
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	-o-box-sizing:border-box;
	-ms-box-sizing:border-box;
	box-sizing:border-box;
}
body{
	font-family: 'Poppins', sans-serif;
	font-size:14px;
	color:#a09e9c;
    text-transform:initial;
    max-width:1920px;
    margin:0 auto;
	overflow-x:hidden;
}

 /* a,a:hover,a:active,a:focus {
	display:inline-block;
	text-decoration:none;
    font-size: 16px;
	color: #343a3f;
    font-weight: 500;;
}  */




.welcome-hero {
    position: relative;
    background:url(../images/welcome-hero/banner.jpg)no-repeat;
    background-position:center;
    background-size:cover;
    text-align: center;
    height:800px;
    z-index: 1;
}
.welcome-hero:before{
    position: absolute;
    content: " ";
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background:rgba(65,73,89,.65);
    z-index: -1;
}
.welcome-hero-txt { padding-top: 155px;}

.welcome-hero-txt h2 {
    font-size: 48px;
    color: #fff;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2.4px;
    line-height: 1.4;
}
.welcome-hero-txt p {
    font-size: 18px;
    color: #fcfcfc;
    margin-top: 25px;
}

.welcome-hero-serch-box{margin-top: 78px;display: flex;}
.welcome-hero-form {
    display: flex;
    background: #fff;
    height: 70px;
    border-radius: 3px;
    width: 85%;
}
.single-welcome-hero-form {
    position: relative;
    display: flex;
    flex-direction: row;
    align-items: center;
    width: 50%;
    padding: 0 30px;
}
.single-welcome-hero-form:first-child{border-right: 1px solid #edeff1;}
.single-welcome-hero-form input {
    margin-left: 10px;
    height: 70px;
    width: 300px;
    border: 0;
    background: transparent;
}
.single-welcome-hero-form input[type="text"]{
    font-size: 14px;
    color: #859098;
    text-transform: capitalize;
    font-weight: 500;
}
.welcome-hero-form-icon {
    position: absolute;
    top: 20px;
    right: 30px;
    color: #252d32;
}
.welcome-hero-btn {
    display:  flex;
    justify-content:  center;
    align-items:  center;
    font-size:  14px;
    color:  #fff;
    width:  170px;
    height:  70px;
    background:  #ff545a;
    text-transform:  capitalize;
    margin-left:  30px;
    border-radius: 3px;
    -webkit-transition: 0.3s linear;
    -moz-transition: 0.3s linear;
    -ms-transition: 0.3s linear;
    -o-transition: 0.3s linear;
    transition: 0.3s linear;
}
.welcome-hero-btn:hover{/*background: #fd4043;*/background: #f43032;}

.welcome-hero-btn svg {
    width:  14px;
    height:  auto;
    margin-left:  12px;
}

/*-------------------------------------
        5. List-topuics
--------------------------------------*/
.list-topics-content {
    position: relative;
    top: -98px;
    z-index: 1;
}
.list-topics-content ul li { display: inline-block;}

.single-list-topics-content{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    width: 205px;
    height: 170px;
    background:#fff;
    border-radius: 3px;
    margin-right: 20px;
    margin-bottom: 20px;
    box-shadow: 0 0px 10px rgba(71,71,71,.2);
    -webkit-transition: .3s linear;
    -moz-transition:.3s linear;
    -ms-transition:.3s linear;
    -o-transition:.3s linear;
    transition: .3s linear;
}
.single-list-topics-content h2>a { margin: 13px 0;}
/*.single-list-topics-content:last-child{margin-right: 0;}*/

.single-list-topics-icon [class^="flaticon-"]:before,.single-list-topics-icon [class*=" flaticon-"]:before,.single-list-topics-icon [class^="flaticon-"]:after,.single-list-topics-icon [class*=" flaticon-"]:after {font-size: 45px;color:#343a3f;}
.single-list-topics-content:hover .single-list-topics-icon [class^="flaticon-"]:before,.single-list-topics-content:hover .single-list-topics-icon [class*=" flaticon-"]:before,.single-list-topics-content:hover .single-list-topics-icon [class^="flaticon-"]:after,.single-list-topics-content:hover .single-list-topics-icon [class*=" flaticon-"]:after {color:#fff;}

.single-list-topics-content:hover h2>a,.single-list-topics-content:hover p{color: #fff!important;}
.single-list-topics-content:hover{
    color: #fff;
    background:#ff545a;
    box-shadow: 0 5px 10px rgba(71,71,71,.4);
}

/*-------------------------------------
        6. Works
--------------------------------------*/
.works{padding: 0 0 90px;}
.works-content {margin-top: 73px;}

.single-how-works{
    text-align: center;
    padding:50px 42px;
    border-radius: 3px;
    box-shadow: 0 0px 5px rgba(71,71,71,.2);
    margin-bottom: 30px;
    -webkit-transition: .3s linear;
    -moz-transition:.3s linear;
    -ms-transition:.3s linear;
    -o-transition:.3s linear;
    transition: .3s linear;
}

.single-how-works-icon {
    display: inline-block;
    color: #50616c;
    width: 80px;
    height: 80px;
    line-height: 80px;
    background: #eef2f6;
    border-radius: 50%;
}
.single-how-works h2 a {
    font-size:  18px;
    margin: 35px 0 20px;
}
.single-how-works h2 a span {text-transform:  lowercase;}
.single-how-works p {margin-bottom: 25px;text-transform: initial;}

.single-how-works-icon [class^="flaticon-"]:before,.single-how-works-icon [class*=" flaticon-"]:before,.single-how-works-icon [class^="flaticon-"]:after,.single-how-works-icon [class*=" flaticon-"]:after {font-size: 35px;}
.single-how-works:hover .single-how-works-icon [class^="flaticon-"]:before,.single-how-works:hover .single-how-works-icon [class*=" flaticon-"]:before,.single-how-works:hover .single-how-works-icon [class^="flaticon-"]:after,.single-how-works:hover .single-how-works-icon [class*=" flaticon-"]:after {color:#ff545a;}

.welcome-hero-btn.how-work-btn {
    display: inline-block;
    margin: 0;
    width: 100px;
    height: 35px;
    font-size: 12px;
    background: transparent;
    color: #767f86;
    border: 1px solid #d3d6d9;
    border-radius: 3px;
}

.single-how-works:hover h2 a,.single-how-works:hover p{color: #fff;}
.single-how-works:hover .single-how-works-icon{background: #fff;}
.single-how-works:hover .welcome-hero-btn.how-work-btn{background: #fff;color: #ff545a;}
.single-how-works:hover{box-shadow: 0 0px 10px rgba(71,71,71,.4);background: #ff545a;}

/*-------------------------------------
        7. Explore
--------------------------------------*/
.explore{
    padding:117px 0 95px;
    background: #f8fafb;
}
.explore-content{margin-top: 78px;}

.single-explore-item {
    background: #fff;
    border: 1px solid #edeff1;
    border-radius: 3px;
    margin-bottom: 25px;
    -webkit-transition: .3s linear;
    -moz-transition:.3s linear;
    -ms-transition:.3s linear;
    -o-transition:.3s linear;
    transition: .3s linear;
}
.single-explore-img{position:relative;overflow: hidden;}
.single-explore-img:before {
    position: absolute;
    content: "";
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(162,172,177,.2);
}
.single-explore-img-info {
    position: absolute;
    bottom:-20px;
    left: 0;
    width: 100%;
    opacity:0;
    visibility:hidden;
    -webkit-transition: .3s linear;
    -moz-transition: .3s linear;
    -ms-transition: .3s linear;
    -o-transition: .3s linear;
    transition: .3s linear;
}
.single-explore-item:hover .single-explore-img-info{
    opacity:1;
    visibility:visible;
    bottom:0px
}
.single-explore-img-info button{
    position: absolute;
    bottom: 15px;
    left: 15px;
    width: 83px;
    height: 21px;
    line-height: 21px;
    background: #ff545a;
    border-radius: 3px;
    color: #fcfcfc;
    text-transform: capitalize;
    text-align: center;
    font-size: 12px;
}
.single-explore-image-icon-box {
    text-align: right;
    position: absolute;
    bottom: 10px;
    right:  10px;
}
.single-explore-image-icon-box ul li {
    display:  inline-block;
    width: 30px;
    height:  28px;
    line-height:  28px;
    background: #252d32;
    text-align:  center;
    margin-left:  5px;
    color:  #cbcccd;
}
.single-explore-image-icon-box ul li:hover i{color: #267dff;}

.single-explore-txt {
    padding: 26px 25px 24px 15px;
}
.single-explore-txt.bg-theme-1 .explore-rating{background: #70a9ff;}
.single-explore-txt.bg-theme-2 .explore-rating{background: #00c61c;}
.single-explore-txt.bg-theme-3 .explore-rating{background: #ffcc5d;}
.single-explore-txt.bg-theme-4 .explore-rating{background: #bd70ff;}
.single-explore-txt.bg-theme-5 .explore-rating{background: #ff7a40;}

.explore-rating-price,.explore-rating-price a {
    font-size: 12px;
    color: #777f85;
    text-transform: capitalize;
    font-weight: 400;
    margin: 15px 0 20px;
}
.explore-rating-price a {margin:0;}
.explore-rating {
    display: inline-block;
    width: 32px;
    height: 20px;
    line-height: 20px;
    color: #fff;
    text-align: center;
    border-radius: 3px;
    font-weight: 500;
    margin-right: 10px;
}
.explore-price {color: #f63138;}
.explore-price-box {
    display: inline-block;
    padding: 0 10px;
    margin: 0 8px;
    border-left: 1px solid #dde0e4;
    border-right: 1px solid #dde0e4;
}
.explore-person {
    padding-bottom: 28px;
    border-bottom: 1px solid #e1e5eb;
}
.explore-person-img{
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.explore-person p {font-size: 12px;}
.explore-open-close-part {
    margin-top: 20px;
}
.close-btn {
    color: #f63138;
    text-transform: capitalize;
}
.close-btn.open-btn {color: #00c437;}
.explore-map-icon{text-align: right;}
.explore-map-icon a svg {
    width: 12px;
    height: 14px;
    margin-left: 23px;
    color: #767f86;
}
.explore-map-icon a svg:hover{color: #f63138;}
.single-explore-txt.bg-theme-2 .explore-map-icon a svg:hover{color: #00c437;}
.single-explore-item:hover{box-shadow: 0 10px 20px rgba(21,19,19,.2);}

/*-------------------------------------
        8. Reviews
--------------------------------------*/
.reviews{padding:117px 0 75px;}
.reviews-content {margin-top:36px;}

/*single-testimonial-box */
.single-testimonial-box  {
    padding: 50px 30px;
    box-shadow: 0 0px 5px rgba(71,71,71,.2);
    overflow-x:hidden;
    -webkit-transition: .3s;
    -moz-transition:.3s;
    -ms-transition:.3s;
    -o-transition:.3s;
    transition: .3s;
}
.single-testimonial-box:hover{box-shadow:0 10px 20px rgba(21,19,19,.2);}
.slick-current .single-testimonial-box{box-shadow:0 10px 20px rgba(21,19,19,.2);}
/*testimonial-description*/
.single-testimonial-box{
    width: 404px;
    background:#fff;
}
/* testimonial-info */
.testimonial-info {
    display: flex;
    align-items: center;
    text-transform:capitalize;
}
.testimonial-img {
    position: relative;
    top: 11px;
    margin-right: 5px;
    border-radius:50%;
    -webkit-transition: .3s;
    -moz-transition:.3s;
    -ms-transition:.3s;
    -o-transition:.3s;
    transition: .3s;
}
.testimonial-person {
    margin-left: 15px;
    margin-top: 11px;
}
.testimonial-person h2 {
    color: #505866;
    font-size: 18px;
}
.testimonial-person h4 {
    color: #a2a5ab;
    font-size: 14px;
    font-weight: 400;
    margin-top: 10px;
}
.testimonial-person-star i {
    color: #ffda2b;
    margin: 9px 4px 0 0;
}/* testimonial-info */


/* testimonial-comment */
.testimonial-comment {
    margin-top: 18px;
}
.testimonial-comment p{
    color: #8d939e;
    font-size: 14px;
    font-weight: 300;
}/* testimonial-comment */


/*.slick-slide*/
.slick-initialized .slick-slide {
    display: block;
    padding: 40px 0;
}
.slick-slide.slick-cloned {outline: 0!important;}
.slick-slide {
  margin: 0px 10px;
}
.slick-slide {
  transition: all ease-in-out .3s;
  opacity: .5;
}
.slick-active {
  opacity: .5;
}
.slick-current {
  opacity: 1;
}
/*.slick-slide*/

/*-------------------------------------
        9.  Counter
--------------------------------------*/
.statistics{
    position:relative;
    display: flex;
    align-items: center;
    background:url(../../assets/images/counter/counter-banner.jpg)no-repeat fixed;
    background-position:center;
    background-size:cover;
    padding:127px 0 120px;
}
.statistics:before{
    position:absolute;
    content:'';
    background: rgba(75,75,75,.60);
    height:100%;
    width:100%;
    top:0;
    left:0;
}
/* single-ststistics-box */
.single-ststistics-box {
    text-align: center;
    margin-bottom:30px;

}
/* single-ststistics-box */
.statistics-content{
    display: flex;
    justify-content: center;
    color:#fff;
    font-size:60px;
}
.statistics-content span {
    margin-left: 5px;
}
.single-ststistics-box h3{
    color:#fff;
    font-size:24px;
    text-transform:capitalize;
    font-weight: 500;
}

/*-------------------------------------
        10. Blog
--------------------------------------*/
.blog{padding:120px 0 90px;}
.blog-content{margin-top: 80px;}

.single-blog-item{
    margin-bottom: 30px;
    box-shadow: 0 0px 5px rgba(71,71,71,.2);
    -webkit-transition: .3s;
    -moz-transition:.3s;
    -ms-transition:.3s;
    -o-transition:.3s;
    transition: .3s;
}
.single-blog-item-txt {padding:  25px 28px 27px;}
.single-blog-item-txt h2 a {text-transform:  initial;line-height: 1.8;}
.single-blog-item-txt h4 {
    font-size:  14px;
    color:  #8f949d;
    font-weight:  400;
    margin: 12px 0 20px;
}
.single-blog-item-txt h4 a {
    font-size:  14px;
    padding-right:  14px;
    border-right: 1px solid #dde0e4;
    margin-right:  15px;
    text-transform: uppercase;
}

.single-blog-item:hover h2 a {color:#ff545a;}
.single-blog-item:hover{
    box-shadow: 0 10px 20px rgba(21,19,19,.4);
}


/*-------------------------------------
        11. Subscribe
--------------------------------------*/
.subscription{
    background: #f8fafb;
    padding:150px 0;
}
/*subscribe-title*/
 .subscribe-title {margin-bottom: 52px;}

.subscribe-title h2{
    font-size:24px;
    font-weight: 500;
    text-transform: uppercase;
}
.subscribe-title p{
    color:#7b8088;
    font-size:16px;
    font-weight: 500;
    margin-top: 28px;
}/*subscribe-title*/


/*custom-input-group*/
.subscription-input-group {
    position: relative;
    text-align: center;
    max-width: 630px;
    margin:0 auto;
}

.subscription-input-group .subscription-input-form{
    display: inline-block;
    width: 630px;
    height: 60px;
    padding-left:30px;
    font-size: 16px;
    color: #a5adb3;
    -webkit-border-radius:3px;
    -moz-border-radius:3px;
    border-radius:3px;
    border:1px solid #fff;
    box-shadow: 0 0px 10px rgba(21,19,19,.1);
     -webkit-transition:0.3s linear;
    -moz-transition:0.3s linear;
    -o-transition:0.3s linear;
    transition:0.3s linear;
}
.subscription-input-group:hover .subscription-input-form{
    box-shadow: 0 5px 20px rgba(21,19,19,.4);
}
/*custom-input-group*/

/*appsLand-btn*/
.appsLand-btn {
    position: absolute;
    top: 0;
    right: 0;
    background: #ff545a;
    display: inline-block;
    width: 180px;
    height: 60px;
    line-height: 60px;
    text-decoration: none;
    border-top-right-radius:3px;
    border-bottom-right-radius:3px;
    text-transform:capitalize;
    color: #fff;
    font-size: 16px;
    font-weight: 500;
    border: 0;
    overflow: hidden;
    cursor: pointer;
    -webkit-transition:0.3s ease-in-out;
    -moz-transition:0.3s ease-in-out;
    -o-transition:0.3s ease-in-out;
    transition:0.3s ease-in-out;
}
.appsLand-btn:hover, .appsLand-btn:focus, .appsLand-btn:active {
    text-decoration: none;
    outline: none;
}
.appsLand-btn:hover {
    box-shadow:0 5px 10px rgba(71,71,71,.4);
    background: #f43032;
}
/*appsLand-btn*/

/*-------------------------------------
        12. Footer
--------------------------------------*/
.footer-menu {padding: 45px 0;}
.footer-menu .navbar-header{padding:0;}


.footer-menu ul.footer-menu-item{text-align: right;}
.footer-menu ul.footer-menu-item li{display: inline-block;}
.footer-menu ul.footer-menu-item li a {
    color: #859098;
    font-size: 14px;
    text-transform: uppercase;
    padding-left: 40px;
    -webkit-transition:0.3s linear;
    -moz-transition:0.3s linear;
    -o-transition:0.3s linear;
    transition:0.3s linear;
}
.footer-menu ul.footer-menu-item li a:hover{color: #f43032;}
.hm-footer-copyright {
    padding: 40px 0;
    border-top: 1px solid #e1e5eb;
}
.hm-footer-copyright p,.hm-footer-copyright p a {
    color: #a5adb3;
    font-size: 14px;
    font-weight: 400;
    text-transform: capitalize;
}
.footer-social {text-align: right;}
.footer-social .fa-phone:before {
    position: relative;
    top: 2px;
}
.footer-social a ,.footer-social span {
    display: inline-block;
    color: #afb4bf;
    font-size: 14px;
    margin-left: 15px;
    -webkit-transition: .3s;
    -moz-transition:.3s;
    -ms-transition:.3s;
    -o-transition:.3s;
    transition: .3s;
}
.footer-social a {
    width: 35px;
    height: 35px;
    line-height: 35px;
    background: #eef2f6;
    text-align: center;
    border-radius: 50%;
}
.footer-social span {margin-right:15px;margin-left: 0;color: #a5adb3;}
.footer-social span:hover{color: #ff545a;}
.footer-social a:hover {background:#ff545a;color: #fff;}

/*===============================
    Scroll Top
===============================*/
#scroll-Top  .return-to-top {
    position: fixed;
    right: 30px;
    bottom: 30px;
    display: none;
    width: 40px;
    line-height: 40px;
    height: 40px;
    text-align: center;
    font-size: 20px;
    cursor: pointer;
    color: #fff;
    background:#ff545a;
	border:1px solid #ff545a;
	border-radius:50%;
	-webkit-transition: .5s;
	-moz-transition:.5s;
	-ms-transition:.5s;
	-o-transition:.5s;
    transition: .5s;
	z-index: 2;
}
#scroll-Top  .return-to-top:hover {
    background:#f43032;
	border:1px solid #ff545a;
}

#scroll-Top  .return-to-top i{
    position:relative;
    bottom:0;

}

#scroll-Top  .return-to-top i{
    position: relative;
    animation-name: example;
    animation-direction: alternate;
    animation-iteration-count: infinite;
    animation-duration:1s;
}
@keyframes example {
    0%   {bottom:0px;}
    100%  {bottom:7px;}
}
</style>

<?php
include "partials/foot.php";?>