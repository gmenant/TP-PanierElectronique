<ul id="ulVueRechercher">qetjqtj
  <li>Les articles peuvent êtres recherchés par Titre et Auteur/Interprète de Livre CD;</li>
  <li>Vous pouvez</li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
</ul>

<form action="index.php?page=resCherch" method="post">
        <div>
        <table class="rech" summary="Recherche">
            <tr><td>Chercher        </td><td><input type="text" name="rechercher_dans" id="cle">                           </td></tr>
            <tr><td>Dans le groupe  </td><td><select name="texte_cherche" id="auteur"><?PHP //tri();?>
                <option name="boutique_livre_titre" value="">Livres par titre</option>
                <option name="boutique_livre_auteur" value="">Livres par auteur</option>
                <option name="boutique_musique_titre" value="">Albums musicaux par titres</option>
                <option name="boutique_musique_artiste" value="">Albums musicaux par artiste</option>
                <option name="texte_cherche" value="" selected="selected">Catalogue complet</option>

            </select></td></tr>
        </table>

        <input type="submit"></input>
        </div>

</form>
