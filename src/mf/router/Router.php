<?php
namespace mf\router;
use mf\router\AbstractRouter as AbstractRouter;
use tweeterapp\control\TweeterController;

class Router extends AbstractRouter{



    function __construct(){
        parent::__construct();
    }

    public function addRoute($name, $url, $ctrl, $mth){
        /* 
        * Méthode addRoute : ajoute une route a la liste des routes 
        *
        * Paramètres :
        * 
        * - $name (String) : un nom pour la route
        * - $url (String)  : l'url de la route
        * - $ctrl (String) : le nom de la classe du Contrôleur 
        * - $mth (String)  : le nom de la méthode qui réalise la fonctionalité 
        *                     de la route
        *
        *
        * Algorithme :
        *
        * - Ajouter le tablau [ $ctrl, $mth ] au tableau self::$route 
        *   sous la clé $url
        * - Ajouter la chaîne $url au tableau self::$aliases sous la clé $name
        *
        */

       $tab =  [$ctrl, $mth];
       self::$routes[$url] = $tab;
       self::$aliases[$name] = $url;        

    }

    public function setDefaultRoute($url){
        /*
        * Méthode setDefaultRoute : fixe la route par défault
        * Paramètres :
        * - $url (String) : l'URL de la route par default
        * Algorthme:
        * - ajoute $url au tableau self::$aliases sous la clé 'default'
        */

        self::$aliases["default"] = $url;
    }

    public function urlFor($route_name, $param_list=[]){
        /* récupérer le script name du httprequest puis le tableau d'aliases self::aliases qui
        est dans $route_name puis le "?" en dur, l'id, le "=" en dur et le $idTweet qu'on sera
        aller chercher comme dans la méthode viewTweet
        A la fin on doit retourner une chaine de caractère : c'est l'url en entier
        ensuite il faut aller ajouter le lien dans mon renderTweet (cf methode rendertweet)*/
        $base_url = $this->http_req->script_name;
        $route = self::$aliases[$route_name];

        $url= $base_url.$route;
        var_dump($url);

        if(!empty($param_list)){
            foreach($param_liste as $key => $param){
                if($key === array_key_first($param_list)){
                    $url .= "?".$param[0]."=".$param[1];
                }
                else{
                    $url .= "&".$param[0]."=".$param[1];
                }
            }
        }
    }

    public function run(){
        /*
        * Méthode run : execute une route en fonction de la requête 
        *    (la requête est récupérée dans l'atribut $http_req)
        *
        * Algorithme :
        * 
        * - l'URL de la route est stockée dans l'attribut $path_info de 
        *         $http_request
        *   Et si une route existe dans le tableau $route sous le nom $path_info
        *     - créer une instance du controleur de la route
        *     - exécuter la méthode de la route 
        * - Sinon 
        *     - exécuter la route par défaut : 
        *        - créer une instance du controleur de la route par défault
        *        - exécuter la méthode de la route par défault
        */
        $route=$this->http_req->path_info;
        $url=self::$aliases['default'];
        if(isset($route)){
            $url=$route;
        }
        $c = self::$routes[$url][0];
        $m = self::$routes[$url][1];
        $ctrl = new $c();
        //var_dump($ctrl);
        //var_dump($m);
        var_dump($ctrl->$m());
    }

    public static function executeRoute($alias_name){
        $url=self::$aliases[$alias_name];
        $ctrl = new slef::$routes[$url][0]();
        $method = self::$routes[$url][1]();
        var_dump($ctrl->$method());
    }
}