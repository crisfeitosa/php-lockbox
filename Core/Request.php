<?php

namespace Core;

class Request {
  public function get($key, $default = null, $prefix = null) {
    return isset($_GET[$key])
      ? ($prefix ?: null) . $_GET[$key]
      : $default;
  }
}