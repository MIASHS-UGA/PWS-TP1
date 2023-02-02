<section class="newsletter">
  <h2>Edition du contact <?= $newsletter->newsletter_id ?></h2>

  <form action="<?= BASE_URL ?>newsletter/edit/<?= $newsletter->newsletter_id ?>" method="post">
    <input type="hidden" name="newsletter_id" value="<?= $newsletter->newsletter_id ?>">
    <label for="newsletter_email">Email : </label>
    <input type="text" name="newsletter_email" value="<?= $newsletter->newsletter_email ?>">
    <input type="submit" value="Editer" name="edition_newsletter">
  </form>
</section>