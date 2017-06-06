<?php

session_start();

if (!isset($_SESSION['is_registred']) or $_SESSION['is_registred'] != true) {
  header('location:/login');
  exit;
}
