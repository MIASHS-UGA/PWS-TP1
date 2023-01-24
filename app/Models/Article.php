<?php
namespace App\Models;
class Article extends \App\Model
{
  protected $tablename = 'articles';
  protected $pk_name = 'article_id';
  protected $fields = ['article_title', 'article_content'];
}
