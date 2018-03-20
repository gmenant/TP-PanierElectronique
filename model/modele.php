<?php

require("../model/commun.inc");
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function SupprimeSession(){
        session_destroy();
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function connexion(){
        global $DB_SERVER, $HTTP_HOST, $DB_LOGIN, $DB_PASSWORD, $DB, $DOCROOT, $idcom ;
     try{
         $idcom = new PDO("mysql:host=$HTTP_HOST;dbname=$DB;charset=utf8", $DB_LOGIN, $DB_PASSWORD);
         }
        catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
         }
        return $idcom;
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function verifConnexion(){

          if (!(isset($_SESSION['nomUtilisateur']))){
         $page = '';
        }
         // else{eval($direction);}
        }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

function ListeLivres(){
          global $idcom;
        $req=" SELECT no_article,titre, auteur, type_article, prix FROM boutique_livre ORDER BY titre ASC;";
        $res=$idcom->query($req);
        echo '<table class="centrer tabProduit">';
        while($enreg=$res->fetch())
         { echo '<tr><td><form action="../controller/index.php?page=Ajout" method="post">
          <input type="hidden" name="id" value='.$enreg["no_article"].'>
          <input type="hidden" name="type" value='.$enreg["type_article"].'><td>'.$enreg["titre"].' </td><td> '.$enreg["auteur"].' </td><td> '.$enreg["type_article"].' </td><td> '.$enreg["prix"].' </td></div></td><td><input type="submit" value="Ajouter au panier"></form></td></tr>'; }
        echo '</table>';
        }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function ListeMusiques(){
         global $idcom;
        $req=" SELECT no_article,titre, artiste, type_article, prix FROM boutique_musique ORDER BY titre ASC;";
        $res=$idcom->query($req);
        echo '<table class="centrer tabProduit">';
        while($enreg=$res->fetch())
         { echo'<tr><td><form action="../controller/index.php?page=Ajout" method="post">
          <input type="hidden" name="id" value='.$enreg["no_article"].'>
          <input type="hidden" name="type" value='.$enreg["type_article"].'><td>'.$enreg["titre"].' </td><td> '.$enreg["artiste"].'</td><td> '.$enreg["type_article"].' </td><td>'.$enreg["prix"].'</td></div></td><td><input type="submit" value="Ajouter au panier"></form></td></tr>'; }
        echo '</table>';
        }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
 function identifieUtilisateur($id){
        connexion();
        global $infosUser,$idcom;
        $requeteUserExist=" SELECT nom, id_utilisateur,motdepasse,adresse_ligne1,adresse_ligne2,ville,pays,codepostal,sexe,an_naissance,adresse_email,telephone,solde_compte FROM profil_utilisateur WHERE id_utilisateur='$id'; ";
        $resultatExiste=$idcom->query($requeteUserExist);
        $infosUser=$resultatExiste->fetch();
        return $infosUser;
    }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function creatUser($nom,$id,$mdp,$adr1,$adr2,$ville,$cp,$pays,$sexe,$dateNais,$mail,$tel){
        connexion();
        global $idcom,$compteur;

        $hashed_password = password_hash($mdp, PASSWORD_DEFAULT);

        $requeteEnregistre="INSERT INTO profil_utilisateur (nom,id_utilisateur,motdepasse,adresse_ligne1,adresse_ligne2,ville,pays,codepostal,sexe,an_naissance,adresse_email,telephone,solde_compte) VALUES ('$nom','$id','$hashed_password','$adr1','$adr2','$ville','$pays','$cp','$sexe','$dateNais','$mail','$tel','0')";
        $compteur=$idcom->exec($requeteEnregistre);
        return $compteur;
     }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function recherche($motsCles,$filtre)
{
  connexion();
  global $idcom;

  switch ($filtre){
    case 'boutique_livre_titre':
      $req=" SELECT no_article,titre, auteur, type_article, prix FROM boutique_livre WHERE titre LIKE '%".$motsCles."%';";
    break;
    case 'boutique_livre_auteur':
      $req=" SELECT no_article,titre, auteur, type_article, prix FROM boutique_livre WHERE auteur LIKE '%".$motsCles."%';";
    break;
    case 'boutique_musique_titre':
      $req=" SELECT no_article,titre, artiste, type_article, prix FROM boutique_musique WHERE titre LIKE '%".$motsCles."%';";
    break;
    case 'boutique_musique_artiste':
      $req=" SELECT no_article,titre, artiste, type_article, prix FROM boutique_musique WHERE artiste LIKE '%".$motsCles."%';";
    break;
    default: $req="SELECT * FROM boutique_livre UNION SELECT * FROM boutique_musique ";
  }

  $res=$idcom->query($req);
  echo '<table class="centrer tabProduit">';
    while($enreg=$res->fetch()){
      if(isset($enreg['auteur'])){

          echo '<tr><td>
          <form action="../controller/index.php?page=Ajout" method="post">
          <input type="hidden" name="id" value='.$enreg["no_article"].'>
          <input type="hidden" name="type" value='.$enreg["type_article"].'><td>
          '.$enreg["titre"].' </td><td> '.$enreg["auteur"].' </td><td> '.$enreg["type_article"].' </td><td>'.$enreg["prix"].'</td>
          </div>
          </td><td><input type="submit" value="Ajouter au panier"></form></td></tr>';

          }
          else
            {
           echo '<tr><td>
          <form action="../controller/index.php?page=Ajout" method="post">
          <input type="hidden" name="id" value='.$enreg["no_article"].'>
          <input type="hidden" name="type" value='.$enreg["type_article"].'><td>
          '.$enreg["titre"].' </td><td> '.$enreg["artiste"].' </td><td> '.$enreg["type_article"].' </td><td>'.$enreg["prix"].'</td>
          </div>
          </td><td><input type="submit" value="Ajouter au panier"></form></td></tr>';
          }
        }

  echo '</table>';

}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function validerPanier($num,$type){

        connexion();
        global $idcom,$compteur;
        $ajout="INSERT INTO transaction (id_utilisateur,no_article,type_article,etat) VALUES ('$_SESSION[idUtilisateur]','$num','$type','En attente')";
        $compteur=$idcom->exec($ajout);
        return $compteur;
  }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function ArticleAAjouter($num,$type){
        connexion();
        global $idcom,$ligne1;
      if ($type=='Livre'){
        $auteur_artiste=$ligne1['auteur'];
        $requaffiche=" SELECT no_article, titre, auteur, prix FROM boutique_livre WHERE no_article='$num' ";
        $res=$idcom->query($requaffiche);
        $ligne1=$res->fetch();
         return $ligne1;
      }
      else
      {  $auteur_artiste=$ligne1['artiste'];
         $requaffiche=" SELECT no_article, titre, artiste, prix FROM boutique_musique WHERE no_article='$num' ";
         $res=$idcom->query($requaffiche);
         $ligne1=$res->fetch();
          return $ligne1;
      }

        }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

        function AfficheDetailsArticle($num,$type,$ligne1){

          if ($type=='Livre'){
          echo '<tr><td>
          <form action="../controller/index.php?page=AjouteArticle" method="post">
          <input type="hidden" name="id" value='.$ligne1["no_article"].'>
           <input type="hidden" name="type" value='.$type.'>
          '.$ligne1["titre"].' '.$ligne1["auteur"].''.$ligne1["prix"].'
          </div>
          </td><td><input type="submit" value="Valider"></form></td></tr>';

          }else{
             echo '<tr><td>
          <form action="../controller/index.php?page=AjouteArticle" method="post">
          <input type="hidden" name="id" value='.$ligne1["no_article"].'>
           <input type="hidden" name="type" value='.$type.'>
          '.$ligne1["titre"].' '.$ligne1["artiste"].''.$ligne1["prix"].'
          </div>
          </td><td><input type="submit" value="Valider"></form></td></tr>';
          }
        }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

        function AjoutAuPanier($num,$type,$ligne2){
          connexion();
          global $idcom,$ligne1;

          $NBArt=$_SESSION['nbArticles']++;
          if ($type=='Livre'){
            $_SESSION['no_article'][$NBArt]  =  $ligne2['no_article'];
            $_SESSION['type'][$NBArt]        =  $type;
            $_SESSION['titre'][$NBArt]       =  $ligne2['titre'];
            $_SESSION['auteur'][$NBArt]      =  $ligne2['auteur'];
            $_SESSION['prix'][$NBArt]        =  $ligne2['prix'];
          }else{
            $_SESSION['no_article'][$NBArt]  =  $ligne2['no_article'];
            $_SESSION['type'][$NBArt]        =  $type;
            $_SESSION['titre'][$NBArt]       =  $ligne2['titre'];
            $_SESSION['artiste'][$NBArt]     =  $ligne2['artiste'];
            $_SESSION['prix'][$NBArt]        =  $ligne2['prix'];
          }
        }

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

        function AffichePanier(){
          $total=0;
          for ($i=0; $i <$_SESSION['nbArticles'] ; $i++) {
            if($_SESSION['type'][$i]=='Livre'){
            echo "<tr><td>".$_SESSION['titre'][$i]."</td>
                  <td>".$_SESSION['auteur'][$i]."</td>
                  <td>".$_SESSION['prix'][$i]."  €</td></tr>";
            }else{

            echo "<tr><td>".$_SESSION['titre'][$i]."</td>
                  <td>".$_SESSION['artiste'][$i]."</td>
                  <td>".$_SESSION['prix'][$i]." €</td></tr>";
                }
            
            $total = $total + $_SESSION['prix'][$i];
            
          }
          echo "<tr><td>&nbsp</td></tr><tr><td>Total</td><td></td><td> ".$total." €</td></tr>";
        }

/*
echo "<br><h3>Cet article a été ajouté à votre panier. Vous pouvez modifier les quantités
en affichant celui-ci.<h3>";
//SESSION on place ces variables dans des variables de session
//$nbr=$_SESSION[$nbr_articles]; // juste pour simplifier l$écriture
$_SESSION[$no_article$][$nbr] = $no_article;
$_SESSION[$type_article$][$nbr]= $type_article;
$_SESSION[$titre$][$nbr] =$titre;
$_SESSION[$auteur_artiste$][$nbr]= $auteur_artiste;
$_SESSION[$prix$][$nbr]= $prix;
$_SESSION[$quantite$][$nbr] = 1; // Quantité toujours fixée à 1 par défaut pour l’article
sélectionné
$_SESSION[$nbr_articles$]++; // incrémentation de la quantité d$articles.
}*/
