<?php

namespace App;

use Exception;

abstract class Repository
{
  abstract static function list();

  abstract static function get($id);

  abstract static function add($data);

  abstract static function update($data);

  abstract static function delete($id);
}