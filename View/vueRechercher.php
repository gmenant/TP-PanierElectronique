<ul class="centrer" id="ulVueRechercher">
  <li>Les articles peuvent êtres recherchés par Titre et Auteur/Interprète de Livre CD</li>
  <li>1</li>
  <li>2</li>
  <li>3</li>
  <li>4</li>
  <li>5</li>
</ul>

<form action="index.php?page=resCherch" method="post">
        <div>

        <table class="rech centrer" summary="Recherche">

            <tr><td>Chercher</td>

            <td><input type="text" name="texte_cherche" id="cle">   </td></tr>

            <tr><td>Dans le groupe  </td><td>

            <select name="rechercher_dans" id="auteur">

                <option name="boutique_livre_titre"     value="boutique_livre_titre">    Livres par titre                      </option>
                <option name="boutique_livre_auteur"    value="boutique_livre_auteur">   Livres par auteur                     </option>
                <option name="boutique_musique_titre"   value="boutique_musique_titre">  Albums musicaux par titres            </option>
                <option name="boutique_musique_artiste" value="boutique_musique_artiste">Albums musicaux par artiste           </option>
                <option name="texte_cherche"            value="texte_cherche" selected="selected">Catalogue complet            </option>

            </select></td></tr>
            <tr><td><input type="submit"></input></td></tr>
        </table>


        </div>

</form>
