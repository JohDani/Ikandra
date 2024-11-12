<?php if ($list_entreprise->rowcount() == 0): ?>
  <script>window.location.href="configurer"</script>
<?php endif;?>

<?php

function non_paye($db, $mois, $personnels)
{
    $personnel = $db->prepare("SELECT * FROM personnels WHERE personnels.id_personnel NOT IN (SELECT id_personnel FROM payement_salaire WHERE mois=? AND anee=?)  AND personnels.id_entreprise=?;");
    if (isset($_GET["anee"])) {
        $personnel->execute(array($mois, $_GET["anee"], $_SESSION["entreprise"]["id"]));
    } else {
        $personnel->execute(array($mois, date("Y"), $_SESSION["entreprise"]["id"]));
    }

    if ($personnels->rowcount() > 0) {
        $compte = $personnel->rowcount() * 100 / $personnels->rowcount();
    } else {
        $compte = 0;
    }

    return $compte;

}

for ($i = 0; $i <= 12; $i++) {
    $n[] = non_paye($db, $i, $personnels);
    if($personnels->rowcount()>0){
    $pe[] = 100 - $n[$i];    
    }else{
    $pe[] = 0;
    }

}

include_once "partials/sidebar.php";?>
<div class="main" id="main" style="background-color: <?=@$black?>">

<?php if (isset($_GET['statue']) and $_GET["statue"] == "non_paye"):

?>

        <div class="container-fluid">
        <h3 class="text-light bg-danger p-2">Salaires non payés <b>2024</b></h3>
        <div class="input-group mb-3">
            <select name="" id="" class="form-control" onchange="window.location.href='?statue=non_paye&anee='+this.value">
                <option value="">Selectionner date</option>
                <?php foreach ($p_ann as $p): ?>
                <option <?php if (isset($_GET["anee"])) {selected($_GET["anee"], $p["anee"]);}?> value="<?=$p["anee"]?>"><?=$p["anee"]?></option>
                <?php endforeach;?>
            </select>
            <button class="btn btn-primary">Année</button>
        </div>
        <div class="row">
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=1<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Janvier</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right">
                            <?=$n[1]?> %</span>
                        </h4>
                        <div class="progress  progress-sm mb-3">
                            <div class="progress-bar
                            <?php if ($n[1] > 50) {echo "bg-warning ";}if ($n[1] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>
                            " aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[1]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=2<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Fevrier</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[2]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar
                            <?php if ($n[2] > 50) {echo "bg-warning ";}if ($n[2] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>

                            " aria-valuenow="<?=$n[2]?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[2]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=3<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Mars</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[3]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar
                            <?php if ($n[3] > 50) {echo "bg-warning ";}if ($n[3] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[3]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=4<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Avril</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[4]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if ($n[4] > 50) {echo "bg-warning ";}if ($n[4] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[4]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=5<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Mai</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[5]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if ($n[5] > 50) {echo "bg-warning ";}if ($n[5] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n["5"]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=6<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0<?php affich();?>">Juin</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[6]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if ($n[6] > 50) {echo "bg-warning ";}if ($n[6] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[6]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=7<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Juillet</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[7]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if ($n[7] > 50) {echo "bg-warning ";}if ($n[7] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[7]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=8<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Aout</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[8]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if ($n[8] > 50) {echo "bg-warning ";}if ($n[8] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[8]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=9<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Septembre</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[9]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if ($n[9] > 50) {echo "bg-warning ";}if ($n[9] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[9]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=10<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Octobre</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[10]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if ($n[10] > 50) {echo "bg-warning ";}if ($n[10] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[10]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=11<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Novembre</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[11]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if ($n[11] > 50) {echo "bg-warning ";}if ($n[11] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[11]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3" onclick="redirige('personnels?salaire=non_payé&mois=12<?php affich();?>')">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Décembre</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$n[12]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php if ($n[12] > 50) {echo "bg-warning ";}if ($n[12] == 100) {echo "bg-danger ";} else {echo "bg-success";}?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$n[12]?>%;"><span class="sr-only"><?=$n[12]?>%</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>

    <div class="container-fluid ">
    <h3 class="text-light bg-success p-2">Salaires payés <b>2024</b></h3>
        <div class="input-group mb-3">
        <select name="" id="" class="form-control" onchange="window.location.href='?anee='+this.value">
                <option value="" >Selectionner date</option>
                <?php foreach ($p_ann as $p): ?>
                <option <?php if (isset($_GET["anee"])) {selected($_GET["anee"], $p["anee"]);}?> value="<?=$p["anee"]?>"><?=$p["anee"]?></option>
                <?php endforeach;?>
            </select>
            <button class="btn btn-primary">Année</button>
        </div>
        <div class="row">
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Janvier</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[1]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[1] == 100){echo " bg-success";}elseif ($pe[1] >= 60) {echo " bg-warning";} if ($pe[1] < 30) {echo " bg-danger";} ?> "
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[1]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Fevrier</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[2]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[2] == 100){echo " bg-success";}elseif ($pe[2] >= 60) {echo " bg-warning";} if ($pe[2] < 30) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[2]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Mars</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[3]?>.%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[3] == 100){echo " bg-success";}elseif ($pe[3] >= 60) {echo " bg-warning";} if ($pe[3] < 30) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[3]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Avril</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[4]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[4] == 100){echo " bg-success";}elseif ($pe[4] >= 60) {echo " bg-warning";} if ($pe[4] < 30) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[4]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Mai</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[5]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar bg-danger <?php  if($pe[5] == 100){echo " bg-success";}elseif ($pe[5] >= 60) {echo " bg-warning";} if ($pe[5] < 30) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[5]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Juin</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[6]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[6] == 100){echo " bg-success";}elseif ($pe[6] >= 60) {echo " bg-warning";} if ($pe[6] < 30) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[6]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Juillet</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[7]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[7] == 100){echo " bg-success";}elseif ($pe[7] >= 60) {echo " bg-warning";} if ($pe[7] < 35) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[7]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Aout</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[8]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[8] == 100){echo " bg-success";}elseif ($pe[8] >= 60) {echo " bg-warning";} if ($pe[8] < 30) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[8]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Septembre</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[9]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[9] == 100){echo " bg-success";}elseif ($pe[9] >= 60) {echo " bg-warning";} if ($pe[9] < 30) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[9]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Octobre</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[10]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[10] == 100){echo " bg-success";}elseif ($pe[10] >= 60) {echo " bg-warning";} if ($pe[10] < 30) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[10]?>%;"><span class="sr-only"><?=$pe[10]?>%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Novembre</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[11]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[11] == 100){echo " bg-success";}elseif ($pe[11] >= 60) {echo " bg-warning";} if ($pe[11] < 30) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[11]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card shadow mb-4 bg-<?=@$primaire?> text-<?=@$secondaire?>">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Décembre</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">TOTAL: <span class="float-right"><?=$pe[12]?>%</span></h4>
                        <div class="progress progress-sm mb-3">
                            <div class="progress-bar <?php  if($pe[12] == 100){echo " bg-success";}elseif ($pe[12] >= 60) {echo " bg-warning";} if ($pe[12] < 30) {echo " bg-danger";} ?>"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pe[12]?>%;"><span class="sr-only">20%</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
</div>


<?php

include_once "partials/foot.php";
?>