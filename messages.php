<?php
    session_start();
    if (isset($_SESSION['user'])) { 
        // si l'utilisateur s'est connecté
        //connexion à la abse de donnée
        include "connexion_bdd.php";

        //requete pour afficher les messages
        $req = mysqli_query($con, "SELECT * FROM messages ORDER BY id_m DESC");
        if (mysqli_num_rows($req) == 0) { 
            // S'il n'y a pas encore de message
            echo "Votre messagerie est vide";
        } else {
            //si oui
            while ($row = mysqli_fetch_assoc($req)) {
                //si c'est vous qui avvez envoyé le mesage on utilise ce format :
                if ($row['email'] == $_SESSION['user']) {
    ?>
                    <div class="message your_message">
                        <span style="color:#fff;">Vous</span>
                        <p><?= $row['msg'] ?></p>
                        <p class="date">Envoyer le <?= $row['date'] ?></p>
                    </div>
                <?php
                } else {
                    //si vous n'êtes pas l'auteur du message , on affiche ce message sur ce format :
                ?>
                    <div class="message others_message">
                        <span><?= $row['email'] ?></span>
                        <p><?= $row['msg'] ?> </p>
                        <p class="date">Reçu le <?= $row['date'] ?></p>
                    </div>
    <?php
                }
            }
        }
    }

?>