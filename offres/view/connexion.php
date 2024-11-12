<body class="" style="background:url(../assets/images/lockscreen-bg.jpg); background-size: cover">
<form action="" method="post">
    <div class="d-flex align-items-center  justify-content-center w-100" style="height: 80vh">
    
        <div class="form border mt-5 border-light text-light mt-5 col-md-5 col-sm-12 col-xl-4" style="background-color:rgba(1,1,1,0.2)">
     
            <h1 class="" style="margin-top: -20px">Connexion</h1>
         <h5 class="<?=@$alert["couleur"]?>"><?=@$alert["message"];?></h5>
                <div class="input-group mb-2 w-100">
                    <input class="form-control" type="text" value="<?=@$email?>" id="email" name="email" placeholder="Votre email" aria-label="Recipient's text" aria-describedby="my-addon">
                </div>
                <div class="input-group mb-2">
                    <input class="form-control" type="password" value="<?=@$mdp?>" name="mdp" placeholder="Votre mot de passe" aria-label="Recipient's text" aria-describedby="my-addon">
                </div>

                

        

                <center>
                    <button class="btn w-100 btn-primary" name="connexion">Connexion</button>
                    <!-- <h6><a href="inscription">S'inscrire en tant qu'entreprise</a></h6>
                    <h6><a href="candidat?inscription">S'inscrire en tant que candidat</a></h6> -->
                    <h6 class=""></h6>   
                    
                </center>
        </div>
    </div>
</form>
</body>


<!-- Button trigger modal -->

<!-- Modal -->
<
<script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM
        
    });
</script>


<script>
    var btn_connexion = document.querySelector(".connexion");

    var email = document.getElementById("email");
    btn_connexion.onclick = function(e){
        if(email.value == ""){
           // customvalidities("Le champ d'email ne doit pas être vide");
            //e.preventDefault();
        }
    }
</script>
<style>
    

    .form{
        padding: 7% 5%;
        border-radius: 20px;
    }
.connexion{
    color: blanchedalmond;
    margin-left: 0;
    margin: 0;
      margin-top: 10px;
    background: linear-gradient(-20deg, rgb(39, 39, 39),rgba(0, 183, 255, 0.452));
}

</style>