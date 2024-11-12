<?php include_once "partials/sidebar.php";?>
<body style="background-color: black">
<main class="main" id="main">
    <div class="card bg-dark">
<table class="table table-dark datatable text-start">
    <thead class="thead-dark">
        <tr>
            <th>Nom utilisateur</th>
            <th>Reference payement</th>
            <th>Contrat</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($p_a as $pam):?>
        <tr>
            <td><?=$pam["nom_utilisateur"]?></td>
            <td><?=$pam["reference_transaction"]?></td>
            <th>type <?=$pam["id_contrat"]?></th>
            <td><?php if($pam["status"]==0){echo "en attente";}elseif($pam["status"]==1){echo "En marche";}else{echo "expirée ou desactivé";}?></td>
            <td>
                <?php if($pam["status"]=="0" or $pam["status"]=="2"):?>
                <a href="?activer-contrat&id=<?=$pam["id_payement_abonnement"]?><?php if($pam["status"]==0){echo "&status";}?>" 
                class="btn-sm btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                <?php elseif($pam["status"]=="1"):?>
                    <a href="?desactiver-contrat&id=<?=$pam["id_payement_abonnement"]?>" class="btn-sm btn btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i></a>  
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php if($pem->rowcount()==0):?>
    <center>
        <div class="card-body p-5"> <h3>Vous n'avez aucune payement</h3></div>

    </center>    
    </div>
<?php endif;?>
</div>
</main>
</body>