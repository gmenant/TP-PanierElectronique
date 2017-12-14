<?PHP
include("../View/entete.php");
include("../View/menu.php");
include("../Model/modele.php");

?>

<div id="contener">

<?PHP

if (isset($_GET["page"]))
{$page = ($_GET["page"]);}


switch("$page"){

case "Recherche":
include '../View/vueRechercher.php';
break;

case "Bibliotheque":
include '../View/vueListeLivres.php';
break;

case "Discotheque":
include '../View/vueListeDisques.php';
break;

case "Quitter":
include '../View/vueLogin.php';
break;

case "CreerCompte":
include '../View/vueEnregistrement.php';
break;

default:
include '../View/vueLogin.php';
};

//include("../View/vueLogin.php");
//include("../View/vueEnregistrement.php");
//include("../View/vueResCherch.php");
//include("../View/vueSolde.php");
//include("../View/vuePanier.php");
//include("../View/vueListeDisques.php");
//include("../View/vueListeLivres.php");


?>


</div>
<?PHP
include("../View/pied.php");
?>
