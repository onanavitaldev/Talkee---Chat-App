<!-- 

    Auteur: ONANA vital 👨‍💻
    Technologie(s): PHP/MySQL & JavaScript 🧠

-->
<?php 
  //  Démarer la session
  session_start();
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <!-- Metadonnées -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Liens -->
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="lib/tailwind.css">

    <!-- Titre de la page -->
    <title>Connectez-vous | TalKee</title>
</head>
<body>
    <?php 
       if(isset($_POST['button_con'])){
           // si le formulaire est envoyé
           // se connecter à la base de donnée
           include "connexion_bdd.php";
           // extraire les infos du formulaire
           extract($_POST);
           // verifions si les champs sont vides
           if(isset($email) && isset($mdp1) && $email != "" && $mdp1 != ""){
               // verifions si les identifiants sont justes
               $req = mysqli_query($con , "SELECT * FROM utilisateurs WHERE email = '$email' AND mdp = '$mdp1'");
               if(mysqli_num_rows($req) > 0){
                   // si les identifiants sont justes
                   // Création d'une session qui contient l'email
                   $_SESSION['user'] = $email ;
                   // redirection vers la page de Chat/Conversation
                   header("location:chat.php");
                   // Detruire la variable du message d'inscription
                   unset($_SESSION['message']);
               }else {
                   // si non
                   $error = "Email ou Mots de passe incorrecte(s) !";
               }
           }else {
               // si les champs sont vides
               $error = "Veuillez remplir tous les champs !" ;
           }
       }
    ?>
    <!-- Formulaire de connexion -->
    <form action="" method="POST" class="form_connexion_inscription">
        <h1 class="font-bold text-center text-3xl pt-10">Connexion</h1>
        <p class="text-1xl text-center">
            Identifiez-vous et lancez des conversations avec vos ami(e)s
        </p>
        <br>
        <?php
           // affichons le message qui dit qu'un compte a été créer
           if(isset($_SESSION['message'])){
               echo $_SESSION['message'] ;
           }
        ?>
        <p class="message_error">
            <?php 
               // affichons l'erreur
               if(isset($error)){
                   echo $error ;
               }
            ?>
        </p>
        <input type="email" placeholder="Votre adrèsse email" name="email" class="mb-4">
        <input type="password" placeholder="Votre mot de passe" name="mdp1">
        <input type="submit" class="shadow-lg" value="Se connecter" name="button_con">
        <p class="link">Vous n'avez pas de compte ?  <br>
            <a href="inscription.php" class="underline">Créer un compte</a>
        </p>
        <br>
    </form>
    <!-- ### -->
</body>
</html>