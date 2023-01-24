<section class="newsletters">
  <h2>Liste des emails enregistrées</h2>
  <?php foreach ($newsletters as $newsletter) { ?>
    <article>
      <p><?= $newsletter->newsletter_email ?></p>
      <small><a href="<?= BASE_URL ?>newsletter/edit/<?=$newsletter->newsletter_id?>">editer</a></small>
      <small><a href="<?= BASE_URL ?>newsletter/delete/<?=$newsletter->newsletter_id?>">supprimer</a></small>
    </article>
  <?php } ?>
</section>