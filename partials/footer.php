

<style>
/* body{
    margin:0;
    position: relative;
    padding:0;
} */

.ms{
    display: none;
}

.contxt-menu{
    display:none;
    position: absolute;
    min-width: 200px;
    left: 10px;
    background-color: gray;
    max-width: 100%;
}

.view{
    display: block;
}

.img_profil{
    overflow: hidden;
}

.img_profil img{
    width: 100px;
    height: 100px;
    object-fit: cover;
}


    .side-nav{
        position: fixed;
        top: 0;
        height: 100vh;
        width: 250px;
        z-index:5;
      
    }

    .side-nav:hover {
       overflow-y: auto;  
       scrollbar-width: thin;
       scroll-behavior: smooth;
    }

    .l-home{
      display: none;
    }

    .side-nav + .navbar{
      background-color: none;
    }

    .contents{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        margin-left: 230px;
        gap: 10px;
    }
    .apps{
        min-width: 100px;
        max-width: 100%;
        min-height: 125px;
        overflow: hidden;
        display: flex;
        text-align: center;
        align-items: center;
        justify-content: space-around;
        flex-wrap: wrap;
  
    }

    .apps:hover{
        transform:scale();
        box-shadow: 1px 1px 5px 1px blue;
    }

    .cont{
        margin-left:250px;
        width: 100%;
    }

    .nav-link{
      color: white;
    }

    .closes{
      display: none;
    }

    @media(max-width:765px){

        .side-nav{
        left:0;
        width:0;
        margin: 0;
        overflow-y: auto;
        overflow-x:hidden;
        }
        .l-home{
          display: unset;
        }

        .log{
          display: none;
        }

        .closes{
          display: unset;
        }

        .contents, .cont{
          
            margin-left:0;
        }
      .voir{
    width: 200px;
   }

   .apps{
    wdith: 150px;
   }

   .b-home{
                    display:none;
            }

    }

   

   .apps{
    box-shadow: 1px 1px 1px 1px ;
    border-left: 1px double #60CBFF;
  
   }

</style>








<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/chart.min.js"></script>
<script src="../assets/js/chart.min.js"></script>
<script src="../assets/bootstrap/js/theme.js"></script>
<script src="../assets/DataTables/datatables.min.js"></script>
<script src="../assets/Datatables/RowGroup/js/dataTables.rowGroup.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="../assets/js/bs-init.js"></script>
<script>
    $(document).ready(function(){
    
    $('#tables').DataTable({
       "columnDefs":[{
        "targets":[0,1,2,3,4,5,6],
        "rowGroup": true,
       }],
    //    "order":[[0,asc]],
    //    "searching": true,
    //    
    });

    $(".btn-ms").click(function(e){
        $(".ms").show();
        
    });
   
})

</script>


<script>
  
function redirige(e){
    window.location.href = e;
}


function defaut(e){
e.preventDefault();
}

function retour(){
    window.history.back();
}


    var departement = document.querySelectorAll(".departement");
    var ref = document.querySelector("#reference");
    var place = document.querySelector(".place");
    for(i=0;i<departement.length;i++){
            departement[i].onclick = function(e){
            var new_dep = document.createElement("div");
            new_dep.classList = "input-group p-2";
            new_dep.innerHTML = "<input class='form-control departement valeurs' type='text' name='departement[]' placeholder='' aria-label='' aria-describedby='my-addon'>";
            place.appendChild(new_dep);
            }
    };




    var dp = document.getElementById("dprt");
  var value = document.querySelectorAll(".valeurs");

  dprt.onchange = function(){
    window.location.href="departement?action=ajout&type=poste&id_departement="+dprt.value;
  }

  var cl = document.querySelector("#closer");
  var d = document.querySelector(".dep");
  var a_d = document.querySelector(".a_d");
  cl.onclick = function(){
   window.location.href="departement?listeposte";
  }

</script>




  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>
</html>