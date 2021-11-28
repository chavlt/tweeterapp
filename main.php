<?php

/* pour le chargement automatique des classes d'Eloquent (dans le répertoire vendor) */
require_once 'vendor/autoload.php';
require_once 'src/mf/utils/AbstractClassLoader.php';
require_once 'src/mf/utils/ClassLoader.php';

$loader = new \mf\utils\ClassLoader('src');
$loader->register();


$config = parse_ini_file("conf/config.ini");
    

/* une instance de connexion  */
$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection( $config ); // configuration avec nos paramètres 
$db->setAsGlobal();            // rendre la connexion visible dans tout le projet
$db->bootEloquent();           // établir la connexion 

//$t = new twitterapp\model\User(); //Test des classes dans Model

/*
// Récupérer les users
$requete = twitterapp\model\User::select();  // SQL : select * from 'user' 
$lignes = $requete->get();   // exécution de la requête et plusieurs lignes résultat 

foreach ($lignes as $u)      // $v est une instance de la classe User
       echo "Identifiant = $u->id, Nom complet = $u->fullname, Username = $u->username <br><br>" ;



// Récupérer les tweets

$requeteDeux = twitterapp\model\Tweet::select();  // SQL : select * from 'user' 
$lignes = $requeteDeux->get();   // exécution de la requête et plusieurs lignes résultat 

foreach ($lignes as $t)      // $v est une instance de la classe User 
       echo "Identifiant = $t->id <br>, Text = $t->text <br>, Auteur = $t->author <br>, Date de création = $t->created_at <br>, Date de mise à jour = $t->updated_at <br><br>" ;


// Récupérer les tweets en les ordonnant par date de modification


$lignesTweet = twitterapp\model\Tweet::select('text', 'updated_at')
                  ->orderBy('updated_at')
                  ->get();

foreach ($lignesTweet as $t)
       echo "Tweet = $t->text <br>, Modifié le = $t->updated_at <br><br>" ;


// Récupérer les tweets qui ont un score positif
$tweetPositif = twitterapp\model\Tweet::select('text', 'score')
                  ->where('score', '>', 0)
                  ->get();

foreach ($tweetPositif as $t)
       echo "Tweet = $t->text <br>, Score = $t->score <br><br>" ;



// Ajout d'un tweet à la BDD

$newTweet = new twitterapp\model\Tweet();
$newTweet->text = "Test d'un nouveau tweet";
$newTweet->author = 5;
$newTweet->save();
echo $newTweet;

// Ajout d'un nouvel user
$newUser = new twitterapp\model\User();
$newUser->fullname = "Nom Prenom";
$newUser->username = "Test";
$newUser->password = "pwd";
$newUser->level = 100;
$newUser->followers = 2;
$newUser->save();
echo $newUser;


// Pour récupérer l'user d'un tweet donné 
$t = twitterapp\model\Tweet::where('id', '=', 72)->first();
$user = $t->user()->first();
echo "$user <br> <br>";


// Pour récupérer les tweets d'un user donné 
$u = twitterapp\model\User::where('id', '=', 2)->first();
$liste_tweets = $u->tweets()->get();
echo $liste_tweets;


// Afficher un tweet donné
$afficheTweet = tweeterapp\model\Tweet::select('id', 'text')
                  ->where('id', '=', 70)
                  ->get();

foreach ($afficheTweet as $t)
       echo "Identifiant = $t->id <br>, Tweet = $t->text <br><br>" ;





// Pour récupérer l'user d'un tweet donné 
$tweet = twitterapp\model\Tweet::where('id' ,'=', 50)->first();
$liked_by = $tweet->likedBy()->get();
echo $liked_by;


// Pour récupérer les tweets likés pour un user donné 
$user_like = twitterapp\model\User::where('id' ,'=', 2)->first();
$tweets_liked = $user_like->liked()->get();
echo $tweets_liked;


// Pour récupérer les utilisateurs qui suivent l'auteur pour un user donné 
$user_follow = twitterapp\model\User::where('id' ,'=', 3)->first();
$followed_by = $user_follow->followedBy()->get();


// Pour récupérer les users suivis par un auteur donné 
$user_follows = twitterapp\model\User::where('id' ,'=', 5)->first();
$liste_follows = $user_follows->follows()->get();
*/


// configuration d'Eloquent (cf partie 1) 
/*
$ctrl = new twitterapp\control\TweeterController();
echo $ctrl->viewHome();
*/

$ctrl = new tweeterapp\control\TweeterController();

$router = new \mf\router\Router();

$router->addRoute('maison', '/home/', '\tweeterapp\control\TweeterController', 'viewHome'); //Affichage de tous les tweets
$router->addRoute('viewtweet', '/view/', '\tweeterapp\control\TweeterController', 'viewTweet'); // Affichage d'un tweet pour un id donné
$router->addRoute('viewusertweets', '/user/', 'tweeterapp\control\TweeterController', 'viewUserTweets'); // Affichage d'un user et de tous ces tweets

$router->setDefaultRoute('/home/');

//print_r(\mf\router\Router::$routes); // Pour tester addRoute() 
$router->run();
//$router->urlFor('viewtweet'); sera utile quand je ferais la vue et qu'il faudra préciser les liens