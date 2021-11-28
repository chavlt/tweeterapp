<?php

namespace tweeterapp\view;

class TweeterView extends \mf\view\AbstractView {
  
    /* Constructeur 
    *
    * Appelle le constructeur de la classe parent
    */
    public function __construct( $data ){
        parent::__construct($data);
    }

    /* Méthode renderHeader
     *
     *  Retourne le fragment HTML de l'entête (unique pour toutes les vues)
     */ 
    public function renderHeader(){
        return '<h1>MiniTweeTR</h1>';
    }
    
    /* Méthode renderFooter
     *
     * Retourne le fragment HTML du bas de la page (unique pour toutes les vues)
     */
    public function renderFooter(){
        return 'La super app créée en Licence Pro &copy;2019';
    }

    /* Méthode renderHome
     *
     * Vue de la fonctionalité afficher tous les Tweets. 
     *  
     */
    
    public function renderHome(){

        /*
         * Retourne le fragment HTML qui affiche tous les Tweets. 
         *  
         * L'attribut $this->data contient un tableau d'objets tweet.
         * 
         */
        foreach ($this->data as $tweet){
            $html = "<br><div>" . $tweet . "</div><br>";
            return $html;
        }
        
        
    }
  
    /* Méthode renderUeserTweets
     *
     * Vue de la fonctionalité afficher tout les Tweets d'un utilisateur donné. 
     * 
     */
     
    public function renderUserTweets(){

        /* 
         * Retourne le fragment HTML pour afficher
         * tous les Tweets d'un utilisateur donné. 
         *  
         * L'attribut $this->data contient un objet User.
         *
         */
        foreach ($this->data as $userTweet){
            $html = "<br><div>" . $userTweet . "</div><br>";
            return $html;
        }
        
    }
  
    /* Méthode renderViewTweet 
     * 
     * Rréalise la vue de la fonctionnalité affichage d'un tweet
     *
     */
    
    public function renderViewTweet(){

        /* 
         * Retourne le fragment HTML qui réalise l'affichage d'un tweet 
         * en particulié 
         * 
         * L'attribut $this->data contient un objet Tweet
         *
         */
        
    }



    /* Méthode renderPostTweet
     *
     * Realise la vue de régider un Tweet
     *
     */
    protected function renderPostTweet(){
        
        /* Méthode renderPostTweet
         *
         * Retourne la framgment HTML qui dessine un formulaire pour la rédaction 
         * d'un tweet, l'action (bouton de validation) du formulaire est la route "/send/"
         *
         */
        
    }


    /* Méthode renderBody
     *
     * Retourne la framgment HTML de la balise <body> elle est appelée
     * par la méthode héritée render.
     *
     */
    
    protected function renderBody($selector){

        /*
         * voire la classe AbstractView
         * 
         */
        
    }
}