<?php 
if(isset($_SESSION["utilisateur"]) and $_SESSION["utilisateur"]["type"] == 3):
    $in -> execute(array($_SESSION["utilisateur"]["id"]));
    $user = $in->fetch(PDO::FETCH_ASSOC);
include_once "partials/sidebar.php";?>
<main class="main " id="main">          <!-- Recent Sales -->
                 <div class="col-12">
                    <div class="card recent-sales  overflow-auto">


                        <div class="card-body">
                            <h5 class="card-title">Candidature envoyé</h5>

                            <table class="table text-light table-light table-striped table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Contrat</th>
                                        <th scope="col">Reference offre</th>
                                        <th scope="col">status</th>
                                        <th>Date candidature</th>
                                        <th scope="col">Action</th>
                                        <!-- <th scope="col">date</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list_cd as $lst):?> 
                                <tr>
                                <th scope="row"><?=$lst["contrat"]?></th>
                                <td class="text-primary nav-item" onclick="window.location.href='accueil#publication<?=@$lst['id']?>'"><?=$lst["id"]?> (click pour voir)</td>
                                <td>
                                <?php if($lst["status_candidature"] == "0"):?>
                                <span class="btn "><b>En attente</b></span>
                                <?php elseif($lst["status_candidature"] == 1):?>
                                <span class="btn text-success">acceptée</span>        
                                <?php elseif($lst["status_candidature"] == 2):?>
                                <span class="btn text-danger">Refusée</span>
                                <?php endif;?>
                                </td>
                                        <td class="">
                                        <button class="btn text-dark">
                                            <?php 
                                            $date = date_create($lst["date_candidature"]);
                                            echo date_format($date,"d-m-Y");?>
                                        </button> 
                                        </td>
                                         <form action="" method="post">
                                        <td class="">                                                
                                            <a class="btn btn-danger m-0 p-0text-end" href="?annuler&id_candidature=<?=$lst["id_candidat_entreprise"]?>">
                                            <span class="bi bi-x-circle"></span>
                                            </a>
                                        </td>
                                        </form>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <!-- End Recent Sales -->
</main>     
<?php
include "partials/foot.php";
else:
    rediriger("connexion");
endif;
?>