<aside id="sidebar" class="sidebar bg-dark" style="">

<ul class="sidebar-nav" id="sidebar-nav">
<?php if (isset($_SESSION["candidat"])): ?>


<?php endif;?>

    <!-- End Dashboard Nav -->

    <li class="nav-item">
        <a class="nav-link bg-dark text-light" href="accueil">
            <i class="bi bi-grid text-light"></i>
            <span>Accueil</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link bg-dark text-light" href="accueil#utilisateur">
            <i class="fa fa-user-circle text-light" aria-hidden="true"></i>
            <span>Utilisateur</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link bg-dark text-light" href="publication">
        <i class="bi bi-journal text-light"></i>
            <span>Publication</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link bg-dark text-light"  type="button" data-toggle="modal" data-target="#my-modal">
            <i class="fas fa-handshake text-light"></i>
            <span>Prix Contrats /</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link bg-dark text-light"  type="button" data-toggle="modal" data-target="#admin">
            <i class="fas fa-user-lock  text-light  "></i>
            <span>Ajouter admin</span>
        </a>
    </li>


<li class="nav-item fixed-bottom text-light" style="left: 10px">
Version 1.0
</li>

</ul>

</aside>