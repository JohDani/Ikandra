<?php include_once "partials/sidebar.php";?>

<div class="container-fluid bg-light">

<div class="row">
<div class="content w100">


</div>


</div>



</div>
  </div>
</div>

<script>

    var side = document.querySelector(".side-nav");
    var btn_toggle = document.querySelector(".btn-toggle");

  

   btn_toggle.onclick = function(){
    side.classList.toggle("voir");
      
   }

    var closes = document.querySelector('.closes');
    closes.onclick = function(){
        side.classList.toggle("voir"); 
    }
 


</script>
