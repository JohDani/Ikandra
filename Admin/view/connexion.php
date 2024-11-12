
<form action="" method="post">
    <div class="d-flex align-items-center justify-content-center w-100" style="height: 75vh">
    
        <div class="form" >
            <h1 class="" style="margin-top: -15px">Connexion</h1>

         
                <div class="input-group mb-2">
                    <input class="form-control" type="text" value="<?=@$email?>" id="email" name="email" placeholder="Votre email" aria-label="Recipient's text" aria-describedby="my-addon">
                    <div class="input-group-append">
                        <span class="input-group-text" id="my-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <input class="form-control" type="password" value="<?=@$mdp?>" name="mdp" placeholder="Votre mot de passe" aria-label="Recipient's text" aria-describedby="my-addon">
                    <div class="input-group-append">
                        <span class="input-group-text" id="my-addon"><i class="fas fa-user-lock    "></i></span>
                    </div>
                </div>

                <h6 class="<?=@$alert["couleur"]?>"><?=@$alert["message"];?></h6>

        

                <center>
                    <button class="connexion btn w-100 border-none mb-1" name="connexion">Connexion</button>
                    <h6><a href="" class="text-dark"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Mot de passe oublié?</a></h6>
                    <h6><a href="inscription">S'inscrire</a></h6>
           


                </center>
        </div>
    </div>
</form>


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
        box-shadow: 1px 1px 5px 2px blue;
        padding: 7% 5%;
        border-radius: 20px;
    }
.connexion{
    color: blanchedalmond;
    margin-left: 0;
    margin: 0;
    background: linear-gradient(-20deg, rgb(39, 39, 39),rgba(0, 183, 255, 0.452));
}

</style>