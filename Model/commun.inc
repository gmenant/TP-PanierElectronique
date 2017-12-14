<?PHP
$DB_SERVER="localhost";
$DB_LOGIN="root";
$DB_PASSWORD="A2Z3E4R5T6Y7";
$DB="boutique";
$HTTP_HOST="localhost";
$DOCROOT="CitationsV1";




  $connexion = 'mysql:host=localhost;dbname=boutique';
  $user = "root";
  $mdp = "A2Z3E4R5T6Y7";
  try {
    $db = new PDO($connexion, $user, $mdp);
    $flag_connect = 'connexion effectuée';
     //echo $flag_connect;
    }
  catch (PDOException $e)
  {
    $flag_connect = "Erreur !: " . $e->getMessage() ;
    //echo $flag_connect;
  };

?>
