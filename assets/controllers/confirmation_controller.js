import { Controller } from '@hotwired/stimulus';//symfony uix

export default class extends Controller { //controller de symfony uix

    static targets = ["popup"]; //on cible la popup
    
    connect() {//au moment du chargement on s assure que la popup est bien cachée
        this.popupTarget.classList.add('hidden');//je recupere la balise popup
    }

    show(event) {
        event.preventDefault();//pour ca soumette pas le formulaire tout de suite
        this.popupTarget.classList.remove('hidden');//quand je veux afficher la popup je retire la classe qui permet de la cacher. donc remove

        setTimeout(() => {//on met un timer qui dit
            event.target.submit();//attendre 1sec (en js on parle en milli seconde donc 1000)
        }, 3000);//avant de soumettre le formulaire
    }

    close() {//permet de refermer (cacher) la classe hidden. donc fermer la popup
        this.popupTarget.classList.add('hidden');
    }
}    