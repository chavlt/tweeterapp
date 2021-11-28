<?php

namespace tweeterapp\model;
use \Illuminate\Database\Eloquent\Model;

class Tweet extends \Illuminate\Database\Eloquent\Model {

       protected $table      = 'tweet';  /* le nom de la table */
       protected $primaryKey = 'id';     /* le nom de la clé primaire */
       public    $timestamps = true;    /* si vrai la table doit contenir
                                            les deux colonnes updated_at,
                                            created_at */


        public function author(){
            return $this->belongsTo('tweeterapp\model\User', 'author');
            /* 'author' : le nom de la classe du model lié (user) */
            /* 'id' : la clé étrangère dans la table courante */
        }

        
        /* public function likedBy() {
            return $this->belongsToMany('twitterapp\model\User', 'users_tweets', 'tweet_id', 'author');
     
            // 'User'        : le nom de la classe du model lié 
            // 'users_tweets ' : le nom de la table pivot 
            // 'tweet_id'        : la clé étrangère de ce modèle dans la table pivot 
            // 'user_id'     : la clé étrangère du modèle lié dans la table pivot 
        } */
        
   

}
?>