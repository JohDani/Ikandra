<?php include_once "../view/partials/sidebar.php";?>
<?php if(isset($_GET["inscription"])):?>

<body class="bg-gradient-primary">
<div class="container">
    <div class="card shadow-lg o-hidden border-0 my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-flex">
                    <div class="flex-grow-1 d-flex align-items-center text-dark justify-content-center bg-register-image">
                       <div>
                        <h2>Pour candidats</h2>

                       </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h4 class="text-dark mb-4">Inscrivez vous gratuitement</h4>
                        </div>
                        <form class="user">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Votre prenom" name="prenom"></div>
                                <div class="col-sm-6"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Votre prenom" name="last_name"></div>
                            </div>
                            <div class="form-group"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Adresse mail" name="email"></div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="password" id="examplePasswordInput" placeholder="Mot de passe" name="password"></div>
                                <div class="col-sm-6"><input class="form-control form-control-user" type="password" id="exampleRepeatPasswordInput" placeholder="confirmer mot de passe" name="password_repeat"></div>
                            </div><button class="btn btn-primary btn-block text-white btn-user" type="submit">S'inscrire</button>
                        </form>
                        <div class="text-center"><a class="small" href="candidats?recuperation">Mot de passe oublié?</a></div>
                        <div class="text-center"><a class="small" href="connexion">Se connecter</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>


<?php else:?>
<main class="main p-3" id="main" style="margin:0">

<div class="pagetitle">
<form action=""  method="post">
<button name="deconnexion" class="btn btn-danger mb-2">Deconnexion</button>
</form>
<nav>
    <ol class="breadcrumb">
Gérer vos activités
    </ol>
</nav>
</div>
<!-- End Page Title -->

<section class="section dashboard">
<div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
        <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Option</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Ajout</a></li>
                            <li><a class="dropdown-item" href="#">Archives</a></li>
                        </ul>
                    </div>

                    <div class="card-body" onclick="redirige('profil')">
                        <h5 class="card-title">Informations</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-journal"></i>
                            </div>
                           
                            <div class="ps-3 ml-3">
                                <h6>Votre CV</h6>
                                <span class="text-muted small pt-2 ps-1">Voir</span>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
            <!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                

                    <div class="card-body" onclick="redirige('accueil?type=developper')">
                        <h5 class="card-title">Suggestion des offres</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa fa-building" aria-hidden="true"></i>
                            </div>
                            <div class="ps-3 ml-3">
                                <h6>150</h6>
                                <span class="text-muted small pt-2 ps-1">offres</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Revenue Card -->




                                    <!-- Customers Card -->
                                    <div class="col-xxl-4 col-md-6">

<div class="card info-card customers-card">

<div class="filter">
<a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
<li class="dropdown-header text-start">
    <h6>Filter</h6>
</li>

<li><a class="dropdown-item" href="#">Today</a></li>
<li><a class="dropdown-item" href="#">This Month</a></li>
<li><a class="dropdown-item" href="#">This Year</a></li>
</ul>
</div>

<div class="card-body" onclick="redirige('departement')">
<h5 class="card-title">Historique candidature</span></h5>

<div class="d-flex align-items-center">
<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
    <i class="bi bi-people"></i>
</div>
<div class="ps-3 ml-3">
    <h6>1244</h6>
</div>
</div>

</div>
</div>

</div>
<!-- End Customers Card -->


         

        </div>
    </div>
    <!-- End Left side columns -->





    

    <!-- Right side columns -->
    <div class="col-lg-4 ">

        <!-- Recent Activity -->
        <div class="card ">
            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Option</h6>
                    </li>

                    <li><a class="dropdown-item" href="profil">Modifier</a></li>
                </ul>
            </div>
<h2 class="card-title bg-light text-center m-0"><b>Votre Profil</b></h2>

            <div class="card-body bg-dark  text-light">

            <div class="profil">
                <center><fa class="fas fa-6x fa-user-circle"></fa></center>    
                </div>

                <div class="activity p-5">
                    <div class="activity-item d-flex">
                        <div class="activite-label text-light">Nom </div>
                        <i class='bi bi-circle-fill text-dark activity-badge align-self-start'></i>
                        <div class="activity-content">
                            Randria
                        </div>
                    </div>
                    <!-- End activity item-->

                    <div class="activity-item d-flex">
                        <div class="activite-label text-light">Adresse</div>
                        <i class='bi bi-circle-fill text-primary activity-badge align-self-start'></i>
                        <div class="activity-content">
                          Lot II V 154
                        </div>
                    </div>
                    <!-- End activity item-->

                    <div class="activity-item d-flex">
                        <div class="activite-label text-light">Profil</div>
                        <i class='bi bi-circle-fill text-primary activity-badge  align-self-start'></i>
                        <div class="activity-content">
                        Web designer
                        </div>
                    </div>
                    <!-- End activity item-->
                </div>

            </div>
        </div>
        <!-- End Recent Activity -->

    </div>
    <!-- End Right side columns -->

       <!-- Recent Sales -->
       <div class="col">
                <div class="card recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>


                </div>
            </div>
            <!-- End Recent Sales -->
</div>
</section>
</main>
<?php endif;

?>