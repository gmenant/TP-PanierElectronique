<?PHP
include("../model/modele.php");
include("../view/entete.php");

session_start();
connexion();

?>

<div id="contener">

<?PHP
$page="";
if (isset($_GET["page"]))
{$page = ($_GET["page"]);}

$id_utilisateur ="";
if (isset($_POST["id"]))
  {$id_utilisateur = ($_POST["id"]);}

$motdepasse ="";
if (isset($_POST["psw"]))
  {$motdepasse = ($_POST["psw"]);}

verifConnexion();

switch("$page"){
    case 'identifier':

          $id_utilisateur=$_POST['id'];
          $motdepasse=$_POST['psw'];
          identifieUtilisateur($id_utilisateur);
          if($infosUser and $infosUser['motdepasse'] == $motdepasse){
              $_SESSION['nomUtilisateur'] = $infosUser['nom'];
              $_SESSION['idUtilisateur']  = $id_utilisateur;
              $_SESSION['mdpUtilisateur'] = $motdepasse;
              $_SESSION['adresse_ligne1'] = $infosUser['adresse_ligne1'];
              $_SESSION['adresse_ligne2'] = $infosUser['adresse_ligne2'];
              $_SESSION['ville']          = $infosUser['ville'];
              $_SESSION['pays']           = $infosUser['pays'];
              $_SESSION['codepostal']     = $infosUser['codepostal'];
              $_SESSION['sexe']           = $infosUser['sexe'];
              $_SESSION['an_naissance']   = $infosUser['an_naissance'];
              $_SESSION['adresse_email']  = $infosUser['adresse_email'];
              $_SESSION['telephone']      = $infosUser['telephone'];
              $_SESSION['solde_compte']   = $infosUser['solde_compte'];
              $_SESSION['nbArticles']     = 0;

              echo "<meta http-equiv='refresh' content='1;URL=../controller/index.php?page=Recherche'>";

          }else{
              echo "<br/> Identifiant introuvable ...";
              include '../view/vueLogin.php';
          }

      break;

    case 'validerEnregistrement':
      $nomNewUtilisateur     =  $_POST['nom'];
      $idNewUtilisateur      =  $_POST['id'];
      $mdp1NewUtilisateur    =  $_POST['psw1'];
      $mdp2NewUtilisateur    =  $_POST['psw2'];
      $adr1NewUtilisateur    =  $_POST['adr1'];
      $adr2NewUtilisateur    =  $_POST['adr2'];
      $villeNewUtilisateur   =  $_POST['ville'];
      $cpNewUtilisateur      =  $_POST['cp'];
      $paysNewUtilisateur    =  $_POST['pays'];
      $sexeNewUtilisateur    =  $_POST['sexe'];
      $dateNaisNewUtilisateur=  $_POST['dateN'];
      $mailNewUtilisateur    =  $_POST['mail'];
      $telNewUtilisateur     =  $_POST['tel'];

      if(isset($_POST['nom'])){

          if($mdp1NewUtilisateur == $mdp2NewUtilisateur){

              identifieUtilisateur($idNewUtilisateur);

              if($infosUser){

                  echo("L'id $idNewUtilisateur existe déjà. Ajout impossible.");

                  }else{
                      creatUser($nomNewUtilisateur,$idNewUtilisateur,$mdp1NewUtilisateur,$adr1NewUtilisateur,$adr2NewUtilisateur,$villeNewUtilisateur,$cpNewUtilisateur,$paysNewUtilisateur,$sexeNewUtilisateur,$dateNaisNewUtilisateur,$mailNewUtilisateur,$telNewUtilisateur);

                          if($compteur){
                          $_SESSION['nomUtilisateur'] =  $compteur['nom'];
                          $_SESSION['idUtilisateur']  =  $compteur['id_utilisateur'];
                          $_SESSION['mdpUtilisateur'] =  $compteur['motdepasse'];
                          $_SESSION['adresse_ligne1'] =  $compteur['adresse_ligne1'];
                          $_SESSION['adresse_ligne2'] =  $compteur['adresse_ligne2'];
                          $_SESSION['ville']          =  $compteur['ville'];
                          $_SESSION['pays']           =  $compteur['pays'];
                          $_SESSION['codepostal']     =  $compteur['codepostal'];
                          $_SESSION['sexe']           =  $compteur['sexe'];
                          $_SESSION['an_naissance']   =  $compteur['an_naissance'];
                          $_SESSION['adresse_email']  =  $compteur['adresse_email'];
                          $_SESSION['telephone']      =  $compteur['telephone'];
                          $_SESSION['solde_compte']  =  0;
                          $_SESSION['nbArticles']    =  0;

                          echo "L'utilisateur a bien été créé";
                          echo "<meta http-equiv='refresh' content='1;URL=../controller/index.php?page=Recherche'>";
                              }else{

                                  echo ("Enregistrement impossible...");
                                }
                      }

          }else{
              echo ("<br/> mot de passe incorrect");
          }
      }else{
          echo ("Veuillez renseigner un nom.");
      }
            break;
    case 'resCherch':
        include("../view/menu.php");
        include '../view/vueResCherch.php';

                break;

    case "Recherche":
        include("../view/menu.php");
        include '../view/vueRechercher.php';
                break;

    case "Bibliotheque":
        include("../view/menu.php");
        include '../view/vueListeLivres.php';

        break;

    case "Discotheque":
        include("../view/menu.php");
        include '../view/vueListeDisques.php';
        break;

    case "Compte":
        include("../view/menu.php");
        include '../view/vueCompte.php';
        break;
        
    case 'Quitter':
       SupprimeSession();
       echo "<meta http-equiv='refresh' content='1;URL=../controller/index.php'>";
       break;
    case "CreerCompte":
       include '../view/vueEnregistrement.php';
       break;
    case "Login":
       include '../view/vueLogin.php';
       break;
    case "Ajout":
        //récupérer infos
       include("../view/menu.php");
       include '../view/vueAjout.php';
       break;

    case "AjouteArticle";
      $no_article = $_POST['id'];
      $type_article = $_POST['type'];
       AjoutAuPanier($no_article,$type_article,ArticleAAjouter($no_article,$type_article));
       echo "<meta http-equiv='refresh' content='1;URL=../controller/index.php?page=Panier'>";
       break;
    case "Panier":
        //récupérer infos
       include("../view/menu.php");
       include '../view/vuePanier.php';
       break;

    default:
       include '../view/vueLogin.php';
};


?>

</div>
<?PHP
include("../view/pied.php");
?>
