<section class="articles">
  <h2>Edition de l'article <?= $article->getArticleTitle() ?></h2>

  <form action="<?= BASE_URL ?>articles/edit/<?= $article->getArticleId() ?>" method="post">
    <input type="hidden" name="article_id" value="<?= $article->getArticleId() ?>">
    <label for="article_title">Titre : </label>
    <input type="text" name="article_title" value="<?= $article->getArticleTitle() ?>">
    <label for="article_content">Contenu : </label>
    <textarea name="article_content"><?= $article->getArticleContent() ?></textarea>
    <input type="submit" value="Editer" name="edition_article">
  </form>
</section>