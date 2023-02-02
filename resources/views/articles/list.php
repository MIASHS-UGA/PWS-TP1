<section class="articles">
  <h2>Liste des articles</h2>
  <?php foreach ($articles as $article) { 
    ?>
    <article>
      <h3><?= $article->getArticleTitle()?></h3>
      <p><?= $article->getArticleContent()?></p>
      <small><?= $article->getArticleDate()?></small>
      <small><a href="<?= BASE_URL ?>articles/edit/<?=$article->getArticleId()?>">editer</a></small>
      <small><a href="<?= BASE_URL ?>articles/delete/<?=$article->getArticleId()?>">supprimer</a></small>
    </article>
  <?php } ?>
</section>