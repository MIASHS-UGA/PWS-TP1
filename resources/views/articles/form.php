<h2>Ajout d'un article</h2>

<p>Les données du formulaire seront envoyées vers le serveur en méthode HTTP "post" et seront disponibles côté serveur dans la variable PHP $_POST</p>

<form action="" method="post">
  <label for="article_title">Titre : </label>
  <input type="text" name="article_title">
  <label for="article_content">Contenu : </label>
  <textarea name="article_content"></textarea>
  <input type="submit" value="Ajouter" name="ajout_article">
</form>