<?php include_once "partials/sidebar.php";?>
<main id="main" class="main">
<div class="pagetitle">
    <h1>Profil</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><?=$user["nom_utilisateur"]." ".$user["prenom"]?></li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-2 d-flex flex-column align-items-center">
                    <i class="fas fa-user-circle fa-8x" aria-hidden="true"></i>
                     
                     <div>
                     <i class="fa fa-camera text-primary fa-1x" aria-hidden="true"></i>&nbsp;
                     <i class="fa fa-trash text-danger" aria-hidden="true"></i>    
                     </div>
                   
                    <h2>
                        <?php if(isset($_GET["type"])){
                             $show_candidat->execute(array($_GET["id"]));
                             $info_candid = $show_candidat->fetch(PDO::FETCH_ASSOC);
                            echo $info_candid["nom_utilisateur"];
                        }else{echo $user["nom_utilisateur"]." ".$user["prenom"];}?>
   
                    </h2>
                   
                </div>
                <?php if(isset($_GET['type'])):
                    
                    ?>
                    <button class="btn btn-success m-1">Accepter</button>
                    <button class="btn btn-danger m-1">Refuser</button>
                <div class="card-body shadow">
                <div class="soc text-start">
                    <label for="" class="form-label"><h6>Contact</h6></label>
                    <ul>
                        <li><a href="#" class="text-decoration-none"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;<?='- '.$info_candid["telephone"]?></a></li>
                        <li><a href="#" class="text-decoration-none"><i class="fa fa-envelope-open" aria-hidden="true"></i>&nbsp;&nbsp;<?='- '.$info_candid["email"]?></a></li>
                        <li><a href="#" class="text-decoration-none"><i class="fas fa-address-card"></i>&nbsp;&nbsp; <?=$info_candid["adresse"]?></a></li>
                    </ul>
                    </div>
                    
                </div>
                <?php endif;?>  
            </div>
        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Information</button>
                        </li>
    <?php if(!isset($_GET["type"])):?>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier le profil</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Securité</button>
                        </li>
    <?php endif;?> 
                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            

<?php if(!isset($_GET["type"])):?>

                            <h5 class="card-title">A propos</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Adresse</div>
                                <div class="col-lg-9 col-md-8">Lot IIV 63</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Telephone</div>
                                <div class="col-lg-9 col-md-8">0335654569</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"></div>
                            </div>
<?php else:
 $competence_candidat->execute(array($_GET["id"]));
 $experience_candidat->execute(array($_GET["id"]));
 $diplome_candidat->execute(array($_GET["id"]));
?>
    <h5 class="card-title">Profil</h5>
                            <p class="small fst-italic">
                            <?="-".$info_candid["profil"]?>
                            </p>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Compétences</div>
                                <div class="col-lg-9 col-md-8">
                                    <ul>
                                        <?php if($competence_candidat->rowcount() > 0):foreach( $competence_candidat as $competence):?>
                                        <li>
                                            <b>- <?=$competence["ref"]?></b>
                                            <p>- <?=$competence["titre"]?></p>
                                        </li>
                                        <?php endforeach;else:?>
                                        <li>Ce candidat n'a encore défini ses compétences</li>
                                        <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Expériences</div>
                                <div class="col-lg-9 col-md-8">
                                    <ul>
                                        <?php if($experience_candidat->rowcount()>0):
                                        foreach($experience_candidat as $experiences):
                                            ?>
                                        <li>
                                            <b><?=$experiences["titre"]?></b> <span><?=$experiences["ref"]?>%</span>
                                        </li>
                                        <?php endforeach;else:?>
                                        <li>Le candidat n'a defini aucun expérience</li>
                                        <?php endif;?>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Diplomes</div>
                                <div class="col-lg-9 col-md-8">
                                    <ul>
                                        <?php if($diplome_candidat->rowcount()>0):
                                            foreach($diplome_candidat as $diplomes):?>
                                        <li>
                                            <b><?=$diplomes["ref"]?></b> <span><?=$diplomes["titre"]?></span>
                                        </li>
                                        <?php endforeach; else:?>
                                        <li>Le candidat n'a fourni aucun information de son diplome</li>
                                        <?php endif?>
                                    </ul>
                                </div>
                            </div>

    
<?php endif;?>
                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form>
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Photo</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="pt-2">
                                            <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-camera"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom et prenom</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="fullName" type="text" class="form-control" id="fullName" value="Sammuel Vononkandresy">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-3 col-form-label">Remarque</label>
                                    <div class="col-md-8 col-lg-9">
                                        <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Departement</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="company" type="text" class="form-control" id="company" value="Departement RH">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Poste</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="job" type="text" class="form-control" id="Job" value="DRH">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Addresse</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="address" type="text" class="form-control" id="Address" value="Lot II V 156">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Telehone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone" type="text" class="form-control" id="Phone" value="+261 33 11 156 63">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email" value="sammuel@gmail.com">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Salaire</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="instagram" type="text" class="form-control" id="Instagram" value="150 000 AR">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Conge annuel</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="Juin">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">enregistrer</button>
                                </div>
                            </form>
                            <!-- End Profile Edit Form -->

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-settings">

                            <!-- Settings Form -->
                            <form>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                            <label class="form-check-label" for="changesMade">
                    Changes made to your account
                  </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                            <label class="form-check-label" for="newProducts">
                    Information on new products and services
                  </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="proOffers">
                                            <label class="form-check-label" for="proOffers">
                    Marketing and promo offers
                  </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                                            <label class="form-check-label" for="securityNotify">
                    Security alerts
                  </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                            <!-- End settings Form -->

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form>

                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control" id="currentPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>
                            <!-- End Change Password Form -->

                        </div>

                    </div>
                    <!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>

</main>