<ul id="ulVueRechercher">qetjqtj
  <li>Les articles peuvent êtres recherchés par Titre et Auteur/Interprète de Livre CD;</li>
  <li>Vous pouvez</li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
</ul>

<form action="../view/vueCit.php" method"post">

  <div>

  <table class="rech" summary="Recherche">
<tr><td>Chercher </td><td><input type="text" name="cle" id="cle">                           </td></tr>
<tr><td>Dans le groupe  </td><td><select name="auteur" id="auteur"><?PHP //tri();?>
  <option>Livres par titre</option>
    <option value="">Livres par auteur</option>
    <option value="">Albums musicaux par titres</option>
    <option value="">Albums musicaux par artiste</option>
    <option value="" selected="selected">Catalogue complet</option>

</select></td></tr>
  </table>

  <input type="submit"></input>
  </div>
</div>

</form>
