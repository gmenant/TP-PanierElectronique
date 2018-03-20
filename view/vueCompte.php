<div id="contenerLogin">
<div class="Compte">&nbsp;</div>


<table>
 
  <tbody>
   
  <?PHP

   echo '<tr><td><h3>Nom</h3></td><td>'.$_SESSION['nomUtilisateur'].'</td></tr>';
   echo '<tr><td><h3>Adresse 1</h3></td><td>'.$_SESSION['adresse_ligne1'].'</td></tr>';
   echo '<tr><td><h3>Adresse 2</h3></td><td>'.$_SESSION['adresse_ligne2'].'</td></tr>';
   echo '<tr><td><h3>Ville</h3></td><td>'.$_SESSION['ville'].'</td></tr>';
   echo '<tr><td><h3>Pays</h3></td><td>'.$_SESSION['pays'].'</td></tr>';
   echo '<tr><td><h3>CP</h3></td><td>'.$_SESSION['codepostal'].'</td></tr>';
   echo '<tr><td><h3>Nom</h3></td><td>'.$_SESSION['sexe'].'</td></tr>';
   echo '<tr><td><h3>Mail</h3></td><td>'.$_SESSION['adresse_email'].'</td></tr>';
   echo '<tr><td><h3>Telephone</h3></td><td>'.$_SESSION['telephone'].'</td></tr>';
   echo '<tr><td><h3>Solde</h3></td><td>'.$_SESSION['solde_compte'].'</td></tr>';
   echo '<tr><td><h3>Nombre articles</h3></td><td>'.$_SESSION['nbArticles'].'</td></tr>';

  ?>

</tbody>
</table>


</div>



