<?php if($list_entreprise->rowcount() == 0 ):?>
  <script>window.location.href="configurer"</script>
<?php endif;?>




<?php include_once "partials/sidebar.php";?>
<div class="main">

                      <div class="container-fluid ">
                              <div class="card shadow">
                                  <div class="card-header py-3">
                                      <div class="btn-group">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                  aria-expanded="false">
                                                      Plus d'option
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                              <a class="dropdown-item" href="profil?action=ajout">Ajouter un Stagaire</a>
                                                  <a class="dropdown-item" href="archives?type=personnels&action">Archives des personnels</a>
                                              <div class="dropdown-divider"></div>
                                              <button class="dropdown-item btn-ms">Multi selection</button>
                                          </div>
                                      </div>
                                  </div>
                              
                                      <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                          <table class="table table-bordered table-striped my-0" id="tables">
                                              <thead>
                                                  <tr>
                                                     
                                                      <th>Noms </th>
                                                      <th>Postes</th>
                                                      <th>Departement</th>
                                                      <th>Contrats</th>
                                                      <th>Salaires</th>
                                                      <th>Debut</th>
                                                      <th>Date</th>
                                                      <th></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                 


                                                  <tr>
                              
                                                      <td>
                                                          <img class="rounded-circle mr-2" width="30" height="30" src="assets/img/avatars/avatar1.jpeg">
                                                          <a href="" >MMe B</a>
                                                      </td>
                                                      <td>Departement</td>
                                                      <td>
                                                          <a href="">R. dr Danh</a>
                                                      </td>
                                                      <td>CDD</td>
                                                      <td>categorie 1 (payé)</td>
                                                      <td>2022-202-200</td>
                                                      <td>2025-09-01</td>
                                                      <td>
                                                      <div class="btn-group">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                  aria-expanded="false">
                                                      Options
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                              <a href="personnels?action=modifier&id=2" class="dropdown-item">
                                                  <i class="fas fa-pencil-alt    "></i>
                                                  &nbsp;<span>Modifier</span>
                                              </a>
                                              <a class="dropdown-item" 
                                              onclick="return confirm('Etes vous sur de supprimer? cette action est irreversible')" 
                                              href="personnels?action=supprimer&id=2">
                                                  <i class="fa fa-trash" aria-hidden="true"></i>
                                                  &nbsp;<span>Supprimer</span>
                                              </a>
                                                  <a class="dropdown-item" href="personnels?action=archiver">
                                                  <i class="fa fa-archive" aria-hidden="true"></i>
                                                  &nbsp;<span>Archiver le personnels</span>
                                              </a>
                                      
                                          </div>
                                      </div>
                                                      </td>
                                                  </tr> 


                                              </tbody>                       
                                          </table>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6 align-self-center">
                                              <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite"></p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                              </div>


                      <div class="contxt-menu">
                          <ul>
                              <li>D</li>
                              <li>D</li>
                              <li>D</li>
                          </ul>
                      </div>
                  
                  
</div>
<script>



var btn_option = document.querySelectorAll(".btn-option");
  function options(p1,p2){
  var option = document.querySelectorAll(p1);
  var ctx = document.querySelector(p2);    
  document.onclick = function(e){
      ctx.classList.toggle('view');
      ctx.style.left = e.clientX + 'px';
      ctx.style.top = e.clientY + 'px';
  }
  document.addEventListener('click', function(e){
  var MenuWidth = ctx.offsetWidth;
  var MenuHeight = ctx.offsetHeight;
  var max_X = window.innerWidth - MenuWidth;
  var max_Y = window.innerHeight - MenuHeight;
  var X = e.clientX > max_X?max_X : e.clientX;
  var Y = e.clientY > max_Y?max_Y : e.clientY;
  ctx.style.left = X+'px';
  ctx.style.top = Y + 'px';    
  })


            
//    if(ctx.classList == "contxt-menu view"){
//   document.onclick = function(){ 

//         ctx.classList.toggle('view');
//      alert(1), 5000

//    }
//     }

  



  }

  for(i=0; i < btn_option.length; i++){

     btn_option[i].onclick = function(e){
         options(".btn-option" , ".contxt-menu");
     };
  }


  // var btn_ms = document.querySelector(".btn-ms");
  //  btn_ms.onclick = function(){
  //  alert(9);
  //  }



</script>

<style>

  a{
      text-decoration: none;
  }
  

  .c{
  
  }

  .btn-plus{
      border-color: green;
      background-color: none;
      border-radius: 10px;
      float: right;
      color: green;
      font-size: 15px;
      min-width: 100px;
      margin: 2px;
      padding: 5px;
  }

  .s{
      display: flex;
      justify-content: right;

  }

  .srch {
      width: 100%;
      display: inline;
      border-radius: 5px;

  }

  .btn-srch{
      position: relative;
      background: none;
      border: none;
      right: 25px;
  }

  .btn-option{
      background-color: unset;
      border: none;
  }

  .pdp{
      display: flex;
      align-items: center;
      flex-direction: column;
      gap: 5px;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 1px 1px 5px 1px;
      min-width: 300px;
      max-width: 100%;
      width: 30%;
  }

  .container{
      width: 100%;
      margin-top: 5px;
      display: flex;
      gap: 10px;

  }

  .informations{

  }

  .informations{
      flex-wrap: wrap;
  }

  .perso{
      display: flex;
      flex-direction: row;
      align-items: left;
      flex-wrap: wrap;
  }

  .info .container label{
      display: block;
  }

  @media screen and (max-width: 480px){

      .container{
          display: block;
      }
      .btn-list{
          width: 100%;
      }
  }

</style>



<?php
include_once "partials/foot.php";
?>