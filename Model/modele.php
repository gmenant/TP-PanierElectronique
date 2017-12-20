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
function verifConnexion($direction){
          if (!(isset($_SESSION['nomUtilisateur']))){
         echo "<meta http-equiv='refresh' content='1;URL=../controller/index.php?page=Login'>";
        }
         else{eval($direction);}
         }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

function ListeLivres(){
          global $idcom;
        $req=" SELECT no_article,titre, auteur, type_article, prix FROM boutique_livre ORDER BY titre ASC;";
        $res=$idcom->query($req);
        echo '<table>';
        while($enreg=$res->fetch())
         { echo '<tr><td><form action="../controller/index.php?page=Ajout" method="post">
          <input type="hidden" name="id" value='.$enreg["no_article"].'>
          <input type="hidden" name="type" value='.$enreg["type_article"].'>'.$enreg["titre"].''.$enreg["auteur"].' '.$enreg["type_article"].' '.$enreg["prix"].'</div></td><td><input type="submit" value="Ajouter au panier"></form></td></tr>'; }
        echo '</table>';
        }
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function ListeMusiques(){
         global $idcom;
        $req=" SELECT no_article,titre, artiste, type_article, prix FROM boutique_musique ORDER BY titre ASC;";
        $res=$idcom->query($req);
        echo '<table>';
        while($enreg=$res->fetch())
         { echo'<tr><td><form action="../controller/index.php?page=Ajout" method="post">
          <input type="hidden" name="id" value='.$enreg["no_article"].'>
          <input type="hidden" name="type" value='.$enreg["type_article"].'>'.$enreg["titre"].' '.$enreg["artiste"].' '.$enreg["type_article"].' '.$enreg["prix"].'</div></td><td><input type="submit" value="Ajouter au panier"></form></td></tr>'; }
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
        $requeteEnregistre="INSERT INTO profil_utilisateur (nom,id_utilisateur,motdepasse,adresse_ligne1,adresse_ligne2,ville,pays,codepostal,sexe,an_naissance,adresse_email,telephone,solde_compte) VALUES ('$nom','$id','$mdp','$adr1','$adr2','$ville','$pays','$cp','$sexe','$dateNais','$mail','$tel','0')";
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
  echo '<table>';
    while($enreg=$res->fetch()){
      if(isset($enreg['auteur'])){

          echo '<tr><td>
          <form action="../controller/index.php?page=Ajout" method="post">
          <input type="hidden" name="id" value='.$enreg["no_article"].'>
          <input type="hidden" name="type" value='.$enreg["type_article"].'>
          '.$enreg["titre"].' '.$enreg["auteur"].' '.$enreg["type_article"].''.$enreg["prix"].'
          </div>
          </td><td><input type="submit" value="Ajouter au panier"></form></td></tr>';

          }
          else
            {
           echo '<tr><td>
          <form action="../controller/index.php?page=Ajout" method="post">
          <input type="hidden" name="id" value='.$enreg["no_article"].'>
          <input type="hidden" name="type" value='.$enreg["type_article"].'>
          '.$enreg["titre"].' '.$enreg["artiste"].' '.$enreg["type_article"].' '.$enreg["prix"].'</div>
          </td><td><input type="submit" value="Ajouter au panier"></form></td></tr>';
          }
        }

  echo '</table>';

}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
function ajoutAuPanier($num,$type){

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
        global $idcom,$compteur;
      if ($type=='Livre'){
        $requaffiche=" SELECT no_article, titre, auteur, prix FROM boutique_livre WHERE no_article='$num' ";
      }
      else
      {
         $requaffiche=" SELECT no_article, titre, artiste, prix FROM boutique_musique WHERE no_article='$num' ";
      }
        $res=$idcom->query($requaffiche);

      $enreg=$res->fetch();

          echo '<tr><td>
          <form action="../controller/index.php?page=Ajout" method="post">
          <input type="hidden" name="id" value='.$enreg["no_article"].'>
          <input type="hidden" name="type" >
          '.$enreg["titre"].' '.$enreg["auteur"].''.$enreg["prix"].'
          </div>
          </td><td><input type="submit" value="Valider"></form></td></tr>';


         return $compteur;
        }
