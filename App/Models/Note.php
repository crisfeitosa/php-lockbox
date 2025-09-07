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

  public function note() {
    if (session()->get('show')) {
      return $this->note;
    }

    return str_repeat('*', rand(10, 100));
  }

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

  public static function update($id, $title, $note) {
    $db = new Database(config('database'));

    $set = "title = :title";

    if ($note) {
      $set .= ", note = :note";
    }

    $db->query(
      query: "
        update notes
        set $set
        where id = :id
      ",
      params: array_merge(
        [
          'title' => $title,
          'id' => $id
        ],
        $note ? ['note' => $note] : []
      )
    );
  }

  public static function delete($id) {
    $db = new Database(config('database'));

    $db->query(
      query: "
        delete from notes
        where id = :id
      ",
      params: [
        'id' => $id
      ]
    );
  }
}