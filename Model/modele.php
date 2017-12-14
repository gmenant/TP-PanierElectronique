<?PHP
foreach ($_POST as $key=>$value)
  {
  $cmd='if(isset($key)){
  $'.$key.'=$value;
  unset ($_POST["'.$key.'"]);} else {$'.$key.'="";}';
  eval ($cmd);
  }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

function ListeLivres(){
include("../Model/commun.inc");
$req=" SELECT no_article,titre, auteur, type_article, prix FROM boutique_livre ORDER BY titre ASC;";
$res=$db->query($req);
echo '<table>';
while($enreg=$res->fetch())
 { echo"<tr><td><div value=".$enreg["no_article"].">".$enreg["titre"]." ".$enreg["auteur"]." ".$enreg["type_article"]." ".$enreg["prix"].'</div></td><td><input type="button" value="Ajouter au panier"></td></tr>'; }
echo '</table>';
}

function ListeMusiques(){
include("../Model/commun.inc");
$req=" SELECT no_article,titre, artiste, type_article, prix FROM boutique_musique ORDER BY titre ASC;";
$res=$db->query($req);
echo '<table>';
while($enreg=$res->fetch())
 { echo"<tr><td><div value=".$enreg["no_article"].">".$enreg["titre"]." ".$enreg["artiste"]." ".$enreg["type_article"]." ".$enreg["prix"].'</div></td><td><input type="button" value="Ajouter au panier"></td></tr>'; }
echo '</table>';
}
