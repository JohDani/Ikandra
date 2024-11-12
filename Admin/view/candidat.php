
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
<link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">


<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-light align-items-start sidebar sidebar-dark accordion bg-gradient-light p-0 shadow-lg">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">                    
                    <div class="sidebar-brand-text mx-3 text-dark"><span>Creer un CV</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" href=""><i class="fas fa-user-plus text-dark"></i><span>Detail personnels</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" href=""><i class="fas fa-user text-dark"></i><span>Objectif</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" href=""><i class="fas fa-user text-dark"></i><span>Detail de l'etucation</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" href=""><i class="fa fa-user-circle text-dark"></i><span>Detail des competance</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" href=""><i class="fa fa-id-card text-dark"></i><span>Experience</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" href=""><i class="fas fa-cog text-dark"></i><span>Realisations</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" href=""><i class="fas fa-user-circle text-dark"></i><span>Detail du projet</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link py-2 btn btn-info active text-center" href=""><span>Voir CV</span></a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                
            <div class="container-fluid text-center">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0"></h3>
                </div>
               
                <div class="row text-center">
                    <div class="col-lg-12 col-xl-8">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-secondary font-weight-bold text-center"></h6>
                                <h6 class="text-secondary font-weight-bold text-center">Detail personnels</h6>
                                <div class="dropdown no-arrow">
                                    <button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">
                                        <i class="fas fa-ellipsis-v text-gray-400"></i>
                                    </button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                                        role="menu">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" role="presentation" href="#">&nbsp;Action</a><a class="dropdown-item" role="presentation" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" role="presentation" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-between align-item-center ml- border-bottom">
                                <span class="fa fa-user-circle mt-2" style="font-size: 50px;"></span>
                                <button class="btn btn-md btn-primary mb-4 ml-3">Charger une photo</button>
                                <button class="btn btn-md btn-outline-danger mb-4 ml-3">Retirer</button>
                            </div>
                            <div class="card-body">

                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="prenom">Prenom</label>
                                        <input class="form-control" type="text" placeholder="Prenom" name="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nom">Nom de famille</label>
                                        <input class="form-control" type="text" placeholder="Nom" name="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="titre">Titre de la profession</label>
                                    <input class="form-control" type="text" placeholder="Profession" name="">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="genre">Genre:</label>                                        
                                        <select name="" id=""  class="form-control">
                                            <option value="">Home</option>
                                            <option value="">Femme</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nationnalite">Nationnalite</label>
                                        <input class="form-control" type="text" placeholder="Nationnalite" name="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="">Date de naissance:</label>                                        
                                        <input type="date"class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="">Telephone</label>
                                        <input class="form-control" type="text" placeholder="+33" name="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="titre">Couriel</label>
                                    <input class="form-control" type="text" placeholder="daniel@gmail.com" name="">
                                </div>
                                <a href="" class="text-dark text-decoration-none font-weight-bold"><span class="fa fa-plus-circle"></span> Ajouter une adresse</a>
                            </form>    
                            </div>
                            </div>
<!-- 
objectif -->
<div class="text-center">
    <h4>Objectif</h4>
    <textarea name="" id="" cols="30" rows="6" class="form-control"></textarea>
</div>


<!-- 
etuducation -->
<div class="text-center">
    <h4>Etucation</h4>
    <div class="justify-content-between align-item-center float-bottom">
        <a href="#" class="btn btn-sm border mb-4">Ajouter une formation</a>
        <b class="fa fa-plus-circle text-primary" style="font-size: 40px;" data-toggle="modal" data-target="#my-modal" type="button"></b>
    </div>
</div>

<!-- 
Competance -->
<div class="text-center">
    <h4>Competance</h4>
    <div class="justify-content-between align-item-center float-bottom">
        <a href="#" class="btn btn-sm border mb-4">Ajouter une Competance</a>
        <b class="fa fa-plus-circle text-primary" style="font-size: 40px;" data-toggle="modal" data-target="#mymodal" type="button"></b>
    </div>
</div>

<!-- 
experience -->
<div class="text-center">
    <h4>Experience</h4>
    <div class="justify-content-between align-item-center float-bottom">
        <a href="#" class="btn btn-sm border mb-4">Ajouter un travail</a>
        <b class="fa fa-plus-circle text-primary" style="font-size: 40px;" data-toggle="modal" data-target="#mydal" type="button"></b>
    </div>
</div>

<!-- 
realisation -->
<div class="text-center">
    <h4>Realisation</h4>
    <div class="justify-content-between align-item-center float-bottom">
        <a href="#" class="btn btn-sm border mb-4">Ajouter une realiation</a>
        <b class="fa fa-plus-circle text-primary" style="font-size: 40px;" data-toggle="modal" data-target="#mydales" type="button"></b>
    </div>
</div>

<!-- 
Detail du projet -->
<div class="text-center">
    <h4>Detail du projet</h4>
    <div class="justify-content-between align-item-center float-bottom">
        <a href="#" class="btn btn-sm border mb-4">Ajouter les details du projet</a>
        <b class="fa fa-plus-circle text-primary" style="font-size: 40px;" data-toggle="modal" data-target="#my" type="button"></b>
    </div>
</div>





                        </div>
                    </div>
                    
                </div>
            </div>                
    </div>



    <!-- modal etudiant -->
    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded">                
                <div class="modal-body mt-4">
                    <form action="" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="">Nom de l'ecole/college</label>                                        
                                <input type="text"class="form-control"  placeholder="ESPIC">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Diplome/Cours</label>
                                <input class="form-control" type="text" placeholder="BACC +2" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="">Annee de debut</label>                                        
                                <input type="date"class="form-control"  placeholder="">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Annee de fin</label>
                                <input class="form-control" type="date" placeholder="" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0"></div>
                            <div class="col-sm-6">                                
                                <input type="checkbox" name=""> <label for="">Actuellement inscrit</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0 text-center">
                               <a href="" class="text-decoration-none"><i class="fa fa-plus-circle text-primary"></i>Ajouter une description</a>
                            </div>                           
                        </div>
                        <div class="btn-group ml-4">
                            <a href="#" class="btn btn-outline-danger text-center rounded" data-dismiss="modal" aria-label="Close">Retour</a>&nbsp;&nbsp;&nbsp;
                            <a href="#" class="btn btn-primary text-center rounded">Ajouter</a>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>


<!-- compence -->
<div id="mymodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">            
            <div class="modal-body">
                <form action="" method="post">
                <div class="form-group row mt-4">                    
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control" placeholder="MicrosoftOffice">
                        </div>
                        <div class="col-sm-6">
                            <select name="" id="" class="form-control">
                                <option value="">Novice</option>
                                <option value="">Intermediare</option>
                                <option value="">Avancer</option>
                                <option value="">Matriser</option>
                                <option value="">Expert</option>
                            </select>
                        </div>                    
                </div>
                <a href="#" class="btn btn-outline-danger text-center rounded" data-dismiss="modal" aria-label="Close">Retour</a>&nbsp;&nbsp;&nbsp;
                <a href="#" class="btn btn-primary text-center rounded">Ajouter</a>
            </div>  
            </div>
            </form>
        </div>
    </div>
</div>




<!-- experience -->

<div id="mydal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content rounded">                
                <div class="modal-body mt-4">
                    <form action="" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="">Nom de l'entreprise</label>                                        
                                <input type="text"class="form-control"  placeholder="Miscrof">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Titre du poste</label>
                                <input class="form-control" type="text" placeholder="Designer graphique" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="">Annee de debut</label>                                        
                                <input type="date"class="form-control"  placeholder="">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Annee de fin</label>
                                <input class="form-control" type="date" placeholder="" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0"></div>
                            <div class="col-sm-6">                                
                                <input type="checkbox" name=""> <label for="">Travail actuellement</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0 text-center">
                               <a href="" class="text-decoration-none"><i class="fa fa-plus-circle text-primary"></i>Ajouter des details</a>
                            </div>                           
                        </div>
                        <a href="#" class="btn btn-outline-danger text-center rounded" data-dismiss="modal" aria-label="Close">Retour</a>&nbsp;&nbsp;&nbsp;
                            <a href="#" class="btn btn-primary text-center rounded">Ajouter</a>
                        </div>
                        
                    </form>
                </div>
            </div>
    </div>
</div>


<!-- realisation -->
<div id="mydales" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Reussite</label>
                        <input class="form-control" type="text"  placeholder="Recompense ou Leadership" name="">
                    </div>
                    <div class="form-group">
                        <label for="">Details</label>
                        <input class="form-control" type="text"  placeholder="Veuillez saisir quelque chose" name="">
                    </div>
                    <a href="#" class="btn btn-outline-danger text-center rounded" data-dismiss="modal" aria-label="Close">Retour</a>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="btn btn-primary text-center rounded">Ajouter</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- detail du projet -->
<div id="my" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body mt-3">
            <form action="" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="">Titre du projet</label>                                        
                                <input type="text"class="form-control"  placeholder="Miscrof">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Role</label>
                                <input class="form-control" type="text" placeholder="Designer graphique" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="">Annee de debut</label>                                        
                                <input type="date"class="form-control"  placeholder="">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Annee de fin</label>
                                <input class="form-control" type="date" placeholder="" name="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0"></div>
                            <div class="col-sm-6">                                
                                <input type="checkbox" name=""> <label for="">En cours</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nom de l'entreprise</label>
                            <input class="form-control" type="text"  placeholder="Miscroft" name="">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0 text-center">
                               <a href="" class="text-decoration-none"><i class="fa fa-plus-circle text-primary"></i>Ajouter des details</a>
                            </div>                           
                        </div>
                        <a href="#" class="btn btn-outline-danger text-center rounded" data-dismiss="modal" aria-label="Close">Retour</a>&nbsp;&nbsp;&nbsp;
                            <a href="#" class="btn btn-primary text-center rounded">Ajouter</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>










    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>