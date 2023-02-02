<section class="articles">
  <h2>Edition de l'article <?= $article->article_title ?></h2>

  <form action="<?= BASE_URL ?>articles/edit/<?= $article->article_id ?>" method="post">
    <input type="hidden" name="article_id" value="<?= $article->article_id ?>">
    <label for="article_title">Titre : </label>
    <input type="text" name="article_title" value="<?= $article->article_title ?>">
    <label for="article_content">Contenu : </label>
    <textarea name="article_content"><?= $article->article_content ?></textarea>
    <input type="submit" value="Editer" name="edition_article">
  </form>
</section>