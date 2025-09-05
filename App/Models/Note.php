<?php

namespace App\Models;

use Core\Database;

class Note {
  public $id;
  public $user_id;
  public $title;
  public $note;
  public $created_at;
  public $updated_at;

  public static function all() {
    $db = new Database(config('database'));

    return $db->query(
      query: "select * from notes where user_id = :user_id",
      class: self::class,
      params: [
        'user_id' => auth()->id
      ]
    )->fetchAll();
  }
}