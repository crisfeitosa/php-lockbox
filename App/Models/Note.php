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
      return decrypt($this->note);
    }

    return str_repeat('*', strlen($this->note));
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

  public static function create($data) {
    $database = new Database(config('database'));

    $database->query(
      query: "insert into notes (user_id, title, note, created_at, updated_at)
        values (
          :user_id,
          :title,
          :note,
          :created_at,
          :updated_at
        )",
      params: array_merge($data, [
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ])
    );
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
        $note ? ['note' => encrypt($note)] : []
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