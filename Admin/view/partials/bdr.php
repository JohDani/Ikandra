<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <a class="navbar-brand" href="#">i-tantana</a>

    <button class="navbar-toggler hidden-lg-up"

        type="button" data-toggle="collapse"
        data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">

        <i class="fa fa-bars" aria-hidden="true"></i>
    
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavId">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

            <li class="nav-item">
              <a class="nav-link text-primary 
              <?php active("accueil");active("");?>" href="accueil"><i class="fa fa-home" aria-hidden="true"></i> accueil </a>
            </li>

        <li class="nav-item">
          <a href="" class="nav-link text-primary"><i class="fa fa-building" aria-hidden="true"></i> Entreprises</a>
        </li>

        <li class="nav-item dropdown ">
          <a href="" class="nav-link text-primary"><i class="fa fa-gift" aria-hidden="true"></i> Publications</a>
        </li>


        <li class="nav-item dropdown ">
          <a class="nav-link text-primary 
          <?php active("connexion");active("inscription");?> dropdown-toggle "
          id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-building" aria-hidden="true"></i> Entreprise</a>

          <div class="dropdown-menu" aria-labelledby="dropdownId">
            <a class="dropdown-item" href="Connexion">Connexion</a>
            <a class="dropdown-item" href="Inscription">Inscription</a>
            <div class="dropdown-divider"></div>
          <a class="dropdown-item" data-toggle="modal" data-target="#modelId"><i class="fa fa-info-circle" aria-hidden="true"></i> Information</a>
          </div>
        </li>

        <li class="nav-item dropdown ">
          <a href = "candidat" class="nav-link text-primary 
          <?php active("candidat");?> dropdown-toggle "
          id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle" aria-hidden="true"></i> Candidat</a>

          <div class="dropdown-menu" aria-labelledby="dropdownId">
            <a class="dropdown-item" href="">Creer un Cv</a>
          </div>
        </li>



      </ul>

      <div class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-primary" href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" href="#"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </li>
        </ul>
</div>
  </div>
  </nav>


  <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title text-info"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;<span>Information</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
          <div class="container-fluid">
            <h3 class="text-primary text-justify">En tant qu'entreprise: </h3>
              <ul>
                <li class="text-dark">
                    Vous pouvez creer une simple compte pour partager des offres et recrutements &nbsp;
                </li>

                <br>
                <h4 class="text-success">Ou</h4>
                <br>

              <li class="text-dark">
                Creer une compte et acceder au gestion de ressources humaines dans site, vous avez tous les fonctions &nbsp;
                
              </li>
              </ul>
              <p><a href="" data-toggle="modal" data-target="#type">Voir les fonctionnements</a></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn border-primary" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="type" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title text-success"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i>&nbsp;<span>Conditions et termes de contrats</span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h3 class="text-info">Fonctionnement Simple</h3>
                    <ul>
                        <li>Fonctions: envoyer recrutements, gerer les offres partagés, voir les candidatures</li>
                        <li>Prix/abonnement: <b>0.99 Euro</b> Pour chaque candidature</li>
                    </ul>

                    <h3 class="text-info">Fonctionnement Avancée</h3>
                    <ul>
                        <li>Fonctions: tous fonction de la gestion RH: personnels, salaire, poste, recrutements et candidatures,stagaire ... </li>
                        <li>Abonnement: <b>5 Euro par ans, 0.99 Euro par mois</b></li>
                     </ul>
                </div>
            </div>
        </div>
    </div>
</div>













  
  <script>
    $('#exampleModal').on('show.bs.modal', event => {
      var button = $(event.relatedTarget);
      var modal = $(this);
      // Use above variables to manipulate the DOM
      
    });
  </script>

  <style>
    .actives{
        border-bottom: 1px double red;
    }
  </style>