<?PHP
$filtre = "";
$motsCles = "";

if (isset($_POST["rechercher_dans"]))
  {
    $filtre = ($_POST["rechercher_dans"]);
    $motsCles   = ($_POST["texte_cherche"]);
  }
recherche($motsCles,$filtre);
?>
