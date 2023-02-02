<?php
namespace App\Models;
use Exception;
class Newsletter extends \App\Model
{
  protected $tablename = 'newsletter';
  protected $pk_name = 'newsletter_id';
  protected $fields = ['newsletter_email'];
}
