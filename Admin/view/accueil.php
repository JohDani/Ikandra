<?php include_once "partials/sidebar.php";?>


<main id="main" class="main" style="background-color: black">

<div class="pagetitle bg-light p-2 ">
    <h1>Adminitrateur</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">I-KANDRA</a></li>
            <li class="breadcrumb-item active">Statistique</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6" >
                    <div class="card info-card sales-card bg-dark text-light">
                        <div class="card-body" >
                            <h5 class="card-title">Utilisateurs</h5>

                            <div class="d-flex align-items-center" >
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="btn btn-light"><?= $selct -> rowcount() ?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card bg-dark text-light" onclick="redirige('publication')">
                        <div class="card-body">
                            <h5 class="card-title">Publications</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex text-primary align-items-center justify-content-center">
                                    <i class="bi bi-journal"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="btn btn-light"><?= $G_pub -> rowcount() ?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Revenue Card -->

 
                  <!-- Revenue Card -->
                  <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card bg-dark text-light" onclick="redirige('revenue')">
                        <div class="card-body" >
                            <h5 class="card-title">Revenue <span></span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex bg-secondary text-light align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="btn text-primary"><?=@number_format($revenues["revenue"])?> Ariary</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Revenue Card -->


                  <!-- Revenue Card -->
                  <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card bg-dark text-light" onclick="redirige('payement')">
                        <div class="card-body">
                            <h5 class="card-title">Payements et contrats</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle bg-secondary text-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-wallet    "></i>
                                </div>
                                <div class="ps-3 " id="publication">
                                    <h6 class="btn text-primary form-control"><?=$pem->rowcount()?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Revenue Card -->


        <!-- <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Revenue</h5>

    
              <canvas id="lineChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#lineChart'), {
                    type: 'line',
                    data: {
                      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                      datasets: [{
                        label: 'Line Chart',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>


            </div>
          </div>
        </div> -->


                <!-- Recent Sales -->
                <div class="col-12" >
                    <div class="card recent-sales text-light bg-dark overflow-auto">

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


                 <!-- Recent Sales -->
                 <div class="col-12" id="utilisateur">
                    <div class="card recent-sales text-light bg-dark overflow-auto">
                        <div class="card-body" >
                            <h5 class="card-title">Utilisateur</h5>

                            <table class="table text-light table-dark table-striped table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">email</th>
                                        <th>Type contrat</th>
                                        <th scope="col">Date d'inscription</th>
                                        <!-- <th scope="col">date</th> -->
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php  foreach($selct as $u):    ?>                                   
                                <tr>
                                        <th scope="row"><?=$u["nom_utilisateur"]?></th>
                                        <td ><?=$u["email"]?></td>
                                        <td><?php   
                                        if($u["types"] == 1){
                                            echo "admin";
                                        }elseif($u["types"] == 2){
                                            echo "entreprise";
                                        }elseif($u["types"] == 3){
                                            echo "condidats";
                                        }
                                            ?>
                                        </td>
                                        <td class="">
                                          
                                        <button class="btn btn-dark">  <?php $date = date_create($u["date_creation"]);
                                            echo date_format($date,("Y-m-d"));
                                            ?></button> 
                                        </td>
                                         <form action="" method="post">
                                        <td class=""> 
                                            <?php  if($u["status"] == 0):    ?>
                                                    <a href="?desactiver=<?=$u["id_utilisateur"]?>" class="btn btn-danger m-0 p-0text-end">
                                                        <span class="bi bi-x-circle"></span>
                                                    </a>
                                            <?php  elseif($u["status"] == 1):     ?>
                                                    <a href="?activer=<?=$u["id_utilisateur"]?>" class="btn btn-success m-0 p-0text-end">
                                                        <span class="bi bi-check-circle"></span>
                                                    </a>
                                            <?php  endif; 
                                                ?>    
                                        </td>
                                        </form>
                                    </tr>
                                    <?php  endforeach; 
                                    
                                    if(isset($_GET["activer"])){
                                        $modif -> execute(array(0,$_GET["activer"]));
                                        $suc = "Activé avec success";
                                    }elseif(isset($_GET["desactiver"])){
                                        $modif -> execute(array(1,$_GET["desactiver"]));
                                        $suc = "Desactivé avec success";
                                    }
                                    
                                    ?> 
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <!-- End Recent Sales -->




            </div>
        </div>
        <!-- End Left side columns -->

        <!-- Right side columns -->

</section>


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
        window.location.href="Accueil#utilisateur";
    }, 500);

   setTimeout(() => {
    mss.style.display = "none";
   }, 5000);


</script>
<?php endif;?>


</main>



<!-- End #main -->
