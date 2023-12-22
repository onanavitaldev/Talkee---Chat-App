<?php 
  //démarer la session
  session_start();
  if(!isset($_SESSION['user'])){
    // si l'utilisateur n'est pas connecté
    // redirection vers la page de connexion
    header("location:index.php");
  }
  $user = $_SESSION['user'] // recupération de l'email de l'utilisateur
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="lib/tailwind.css">
    <link rel="stylesheet" href="lib/animate.css">
    <title> <?=$user?></title>
</head>
<body>
    <div class="chat">
        <div class="button-email">
            <span class="flex font-bold">
                <img src="user.png" height="22" width="22">
                <?=$user?>
            </span>
            <a href="deconnexion.php" class="Deconnexion_btn">Déconnexion</a>
        </div>
        <!-- messages -->
        <div class="messages_box">Chargement ...</div>
        <!-- Fin messages -->

        <?php 
           //envoi des messages
           if(isset($_POST['send'])){
               // recuperons le message
               $message = $_POST['message']; 
               //connexion à la base de donnée
               include("connexion_bdd.php");
               //verifions si le champs n'est pas vide
               if(isset($message) && $message != ""){
                   //inserer le message dans la base de données
                   $req = mysqli_query($con , "INSERT INTO messages VALUES (NULL ,'$user','$message',NOW())");
                   //on actualise la page
                   header('location:chat.php');
               }else {
                   // si le message est vide , on actualise la page
                   header('location:chat.php');
               }
              
           }
        ?>
        <form action= "" class="send_message" method="POST">
             <input type="text" name="message" placeholder="Exprimez-vous...">
             <input type="submit" value="Envoyer le méssage" name="send">
        </form>
    </div>

    <script>
        // On actualise automatiquement la méssagerie en utilisant la technologie AJAX
        var message_box = document.querySelector('.messages_box');
        setInterval(function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    message_box.innerHTML = this.responseText;
                }
            };

            // récupération de la page messagerie
            xhttp.open("GET","messages.php" , true); 

            // Actualiser le chat tous les 500 millisecondes
            xhttp.send()
        },500)
    </script>
</body>
</html>