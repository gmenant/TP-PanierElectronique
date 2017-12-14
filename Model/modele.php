<?php

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

function ListeLivres(){
include("../Model/commun.inc");
$req=" SELECT no_article,titre, auteur, type_article, prix FROM boutique_livre ORDER BY titre ASC;";
$res=$DB->query($req);
echo '<table>';
while($enreg=$res->fetch())
 { echo"<tr><td><div value=".$enreg["no_article"].">".$enreg["titre"]." ".$enreg["auteur"]." ".$enreg["type_article"]." ".$enreg["prix"].'</div></td><td><input type="button" value="Ajouter au panier"></td></tr>'; }
echo '</table>';
}

function ListeMusiques(){
include("../Model/commun.inc");
$req=" SELECT no_article,titre, artiste, type_article, prix FROM boutique_musique ORDER BY titre ASC;";
$res=$DB->query($req);
echo '<table>';
while($enreg=$res->fetch())
 { echo"<tr><td><div value=".$enreg["no_article"].">".$enreg["titre"]." ".$enreg["artiste"]." ".$enreg["type_article"]." ".$enreg["prix"].'</div></td><td><input type="button" value="Ajouter au panier"></td></tr>'; }
echo '</table>';
}


/*
function connexObjet($base,$param) {
    include_once($param.".inc.php"); 
    $idcom = new mysqli($HTTP_HOST,$DB_LOGIN,$DB_PASSWORD,$base); 
    if (!$idcom) 
    { 
    echo "<script type=text/javascript>"; 
    echo "alert('Connexion Impossible à la base')</script>"; 
    exit(); 
    } 
  return $idcom; 
}

connexObjet('boutique','commun');
*/
