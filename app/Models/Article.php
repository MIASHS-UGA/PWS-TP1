<?php
namespace App\Models;
class Article extends \App\Model
{
  protected $article_id, $article_title, $article_content, $article_date;

  /**
   * Get the value of article_title
   */
  public function getArticleTitle()
  {
    return $this->article_title;
  }

  /**
   * Set the value of article_title
   */
  public function setArticleTitle($article_title): self
  {
    $this->article_title = $article_title;

    return $this;
  }

  /**
   * Get the value of article_id
   */
  public function getArticleId()
  {
    return $this->article_id;
  }

  /**
   * Set the value of article_id
   */
  public function setArticleId($article_id): self
  {
    $this->article_id = $article_id;

    return $this;
  }

  /**
   * Get the value of article_content
   */
  public function getArticleContent()
  {
    return $this->article_content;
  }

  /**
   * Set the value of article_content
   */
  public function setArticleContent($article_content): self
  {
    $this->article_content = $article_content;

    return $this;
  }

  /**
   * Get the value of article_date
   */
  public function getArticleDate()
  {
    return $this->article_date;
  }

  /**
   * Set the value of article_date
   */
  public function setArticleDate($article_date): self
  {
    $this->article_date = $article_date;

    return $this;
  }
}
