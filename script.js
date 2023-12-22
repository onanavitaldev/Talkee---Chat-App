//confirmation du mot de passe
//Vérifions si le mot de passe et la confirmation sont conformes
var mdp1 = document.querySelector('.mdp1');
var mdp2 = document.querySelector('.mdp2');
mdp2.onkeyup = function(){
    //évenement lorsqu'on écrit dans le champs : confirmation du mot de passe
    message_error = document.querySelector('.message_error');
    if(mdp1.value != mdp2.value){ //s'ils ne sont pas égaux
       //On affiche un message d'erreur
       message_error.innerText = "Les Mots de passes ne sont pas conformes";
    }else {//si non
       //On écrit rien dans message_error
       message_error.innerText = ""
    }

}