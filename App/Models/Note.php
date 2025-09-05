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

  public static function all($search = null) {
    $db = new Database(config('database'));

    return $db->query(
      query: "select * from notes where user_id = :user_id " . (
        $search ? "and title like :search" : null
      ),
      class: self::class,
      params: array_merge(['user_id' => auth()->id], $search ? ['search' => "%$search%"] : [])
    )->fetchAll();
  }
}