<?php
namespace tweeterapp\model;

class User extends \Illuminate\Database\Eloquent\Model {

       protected $table      = 'user';  /* le nom de la table */
       protected $primaryKey = 'id';     /* le nom de la clé primaire */
       public    $timestamps = false;    /* si vrai la table doit contenir
                                            les deux colonnes updated_at,
                                            created_at */



        public function tweets(){
            return $this->hasMany('tweeterapp\model\Tweet', 'author');
            /* 'Tweet' : le nom de la classe du modele lié */
            /* 'id' : la clé étrangère dans la table liée */
        }

/*
        public function liked() {
            return $this->belongsToMany('Tweet', 'users_tweets', 'author', 'tweet_id');
     
            // 'Tweet'          : le nom de la classe du model lié 
            // 'users_tweets ' : le nom de la table pivot 
     
            // 'author'     : la clé étrangère de ce modèle dans la table pivot 
            // 'tweet_id'        : la clé étrangère du modèle lié dans la table pivot 
        }



        public function followedBy() {
            return $this->belongsToMany('Tweet', 'users_tweets', 'author', 'tweet_id');
     
            // 'Tweet'          : le nom de la classe du model lié 
            // 'users_tweets ' : le nom de la table pivot
     
            // 'author'     : la clé étrangère de ce modèle dans la table pivot
            // 'tweet_id'        : la clé étrangère du modèle lié dans la table pivot
        }

        public function follows() {
            return $this->belongsToMany('Tweet', 'users_tweets', 'author', 'tweet_id');
     
            // 'Tweet'          : le nom de la classe du model lié 
            // 'users_tweets ' : le nom de la table pivot
     
            // 'author'     : la clé étrangère de ce modèle dans la table pivot 
            // 'tweet_id'        : la clé étrangère du modèle lié dans la table pivot 
        }
        */

            
        
     
    
}

?>