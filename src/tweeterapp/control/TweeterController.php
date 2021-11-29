<?php

namespace tweeterapp\control;
use mf\control\AbstractController as AbstractController;
use tweeterapp\model as Model;

class TweeterController extends AbstractController {


    /* Constructeur :
     * 
     * Appelle le constructeur parent
     *
     * c.f. la classe \mf\control\AbstractController
     * 
     */
    
    public function __construct(){
        parent::__construct();
    }


    /* Méthode viewHome : 
     * 
     * Réalise la fonctionnalité : afficher la liste de Tweet
     * 
     */
    
    public function viewHome(){

        $tweets = Model\Tweet::get();
    
        $res = "";

        foreach ($tweets as $t){
            $res = $this->renderTweet($t);
            echo $res;
        }

        $tweets = \tweeterapp\model\Tweet::all();
        $vue = new \tweeterapp\view\TweeterView($tweets);
        echo $vue->renderHome();

        /* Algorithme :
         *  1 Récupérer tout les tweet en utilisant le modèle Tweet
         *  2 Parcourir le résultat 
         *      afficher le text du tweet, l'auteur et la date de création
         *  3 Retourner un block HTML qui met en forme la liste
         */

    }

    /* Méthode viewTweet : 
     *  
     * Réalise la fonctionnalité afficher un Tweet
     *
     */
    
    public function viewTweet(){
        /* Algorithme : 
         *  
         *  1 L'identifiant du Tweet en question est passé en paramètre (id) 
         *      d'une requête GET 
         *  2 Récupérer le Tweet depuis le modèle Tweet
         *  3 Afficher toutes les informations du tweet 
         *      (text, auteur, date, score)
         *  4 Retourner un block HTML qui met en forme le Tweet
         * 
         *  Erreurs possibles : (*** à implanter ultérieurement ***)
         *    - pas de paramètre dans la requête
         *    - le paramètre passé ne correspond pas a un identifiant existant
         *    - le paramètre passé n'est pas un entier 
         * 
         */

        $idTweet = $this->request->get['id'];
        $tweet = Model\Tweet::where('id', '=', $idTweet)->first();
        $res = $this->renderTweet($tweet);
        echo $res;

        $tweets = \tweeterapp\model\Tweet::all();
        $vue = new \tweeterapp\view\TweeterView($tweets);
        echo $v->renderTweet();

    }

    /* Méthode viewUserTweets :
     *
     * Réalise la fonctionnalité afficher les tweet d'un utilisateur
     *
     */
    
    public function viewUserTweets(){
        /*
         *  1 L'identifiant de l'utilisateur en question est passé en 
         *      paramètre (id) d'une requête GET 
         *  2 Récupérer l'utilisateur et ses Tweets depuis le modèle 
         *      Tweet et User
         *  3 Afficher les informations de l'utilisateur 
         *      (non, login, nombre de suiveurs) 
         *  4 Afficher ses Tweets (text, auteur, date)
         *  5 Retourner un block HTML qui met en forme la liste
         *
         *  Erreurs possibles : (*** à implanter ultérieurement ***)
         *    - pas de paramètre dans la requête
         *    - le paramètre passé ne correspond pas a un identifiant existant
         *    - le paramètre passé n'est pas un entier 
         */

        $idUser = $this->request->get['id'];
        $user = Model\User::where('id', '=', $idUser)->first();
        echo "Nom utilisateur : $user->fullname <br> Login : $user->username <br> $user->followers follower(s)";
        $listeTweets = $user->tweets()->get();
        foreach($listeTweets as $l){
            $res = $this->renderTweet($l);
            echo $res;
        }

        $userTweets = \tweeterapp\model\User::all();
        $vue = new \tweeterapp\view\TweeterView($userTweets);
        echo $v->renderUserTweets();

        
    }

    public function renderTweet($t){
        $auteur = $t->author()->first()->fullname;
        /* a ajouter apès avoir fait la méthode urlFor
        $r = new Router(); //On fait un nouveau routeur
        $tweetLink = $r->urlFor('viewtweet', [['id', $t->id]]); // On créer la variable qui contiendra le lien,
        on appelle urlfor en lui passant en paramètre ce qu'on veut récuperer et sa valeur
        ensuite on ajoute une balise a autour des éléments qui doivent avoir un lien : 
        par exemple pour afficher un tweet en détail : <a href="$tweetLink">$t->text</a>
        */

        $html = "<br><div>";
        $html .= "<div>" . $t->text ; "</div>";
        $html .= "<div><span>" . $t->created_at . "</span> - ";
        $html .= "<span>" . $auteur . "</span></div></div>";
        return $html;

        $newTweet = new TweeterView();
    }
}