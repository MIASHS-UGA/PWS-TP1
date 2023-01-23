<section class="articles">
  <h2>Liste des articles</h2>
  <?php foreach ($articles as $article) { ?>
    <article>
      <h3><?= $article->article_title ?></h3>
      <p><?= $article->article_content ?></p>
      <small><?= $article->article_date ?></small>
      <small><a href="<?= BASE_URL ?>articles/edit/<?=$article->article_id?>">editer</a></small>
      <small><a href="<?= BASE_URL ?>articles/delete/<?=$article->article_id?>">supprimer</a></small>
    </article>
  <?php } ?>
</section>