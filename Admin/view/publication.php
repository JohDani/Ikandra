<?php include_once "partials/sidebar.php";?>
<body style="background-color: black">
    

<div class="main" id="main" >
 <div class="card">
<div class="card-body bg-dark">
                            <h5 class="card-title text-light">Publications <span>| recent</span></h5>

                            <table class="table text-light table-dark table-striped table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Categories</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Entreprise</th>
                                        <th>Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($Gr_pub as $pubs):?>
                                    <tr class="">
                                        <th scope="row">
                                            <?=$pubs["categorie"]?>
                                        </th>
                                        <!-- <td ><?=$pubs["poste"]?></td> -->
                                        <td class=" ">
                                            <!-- Modal trigger button -->
                                            <button
                                                type="button"
                                                class="btn btn-dark "
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalId<?=$pubs["id"]?>"
                                            >
                                            <?=substr(description($pubs["description"]),0,30)?>...
                                            </button>
                                            
                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div
                                                class="modal fade col"
                                                id="modalId<?=$pubs["id"]?>"
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
                                                    <div class="modal-content col-md-12">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark" id="modalTitleId">
                                                        <?=$pubs["poste"]?>
                                                            </h5>
                                                            <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body text-dark">
                                                        <?=$pubs["description"]?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button
                                                                type="button"
                                                                class="btn btn-primary"
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
                                            
                                        </td>
                                        <td class="">
                                        <button class="btn btn-dark"><?=$pubs["nom_entreprise"]?></button>
                                        </td>
                                        <td><?php 
                                        $date = date_create($pubs["date_publication"]);
                                        echo date_format($date, "Y/m/d");
                                        ?></td>
                                         <form action="" method="post">
                                        <td class="">
                                                <?php if($pubs["statue"]== 0):?>
                                                    <a href="?desactiver=<?=$pubs["id"]?>" class="btn btn-danger">Désactiver</a>
                                                <?php elseif($pubs["statue"]== 1):?>
                                                    <a href="?activer=<?=$pubs["id"]?>" class="btn btn-success text-end">Activer</a>
                                                <?php endif;?>
                                        </td>
                                    </form>
                                    </tr>
                                    <?php endforeach;
                                    
                                    if(isset($_GET["activer"])){
                                        $modif_offre -> execute(array(0,$_GET["activer"]));
                                        $suc = "Publication activé avec success";
                                    }elseif(isset($_GET["desactiver"])){
                                        $modif_offre -> execute(array(1,$_GET["desactiver"]));
                                        $suc = "Desacivé avec success";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>


<?php if(isset($err) or isset($disabled) or isset($suc)):?>
<div id="msss" class="col" style="position: fixed; top: 70px; z-index: 150000; right: 20px"  aria-hidden="true">
  <div class="card border bg-<?=@$color?>">
    <div class="card-b p-1">
        <?php if(isset($suc)):?>
        <button class="btn"><i class="fa fa-check-circle fa-2x text-success " aria-hidden="true"></i></button>
        <button class="btn text-success"><?=$suc?></button>
        <?php elseif(isset($err)):?>
            <button class="btn ">
                <i class="fa fa-window-close text-light" aria-hidden="true"></i>
            </button>
            <button class="btn text-light"><?=@$err?></button>
        <?php endif;?>
    </div>
  </div>
</div>

<script>      
    var mss = document.querySelector("#msss");
    setTimeout(() => {
        window.location.href="publication";
    }, 1000);

   setTimeout(() => {
    mss.style.display = "none";
   }, 5000);


</script>
<?php endif;?>

</body>