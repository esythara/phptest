<?php

/**
  * Gets the article record based on the ID
  *
  *param object $conn Connection to the database
  *param integer $id the article ID
  *
  *return mixed an associative array containing the article with that ID, or null if not found
  */

function getArticle($conn, $id)
{
  $sql = "SELECT *
          FROM article
          WHERE id = ?";

  $stmt = mysqli_prepare($conn, $sql);

  if ($stmt === false) {
    echo mysqli_error($conn);
  } else {
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);

      return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
  }
}


/**
  *validating the article properties
  *param string $title title, required
  *param string $content content, required
  *param string $published_at published at, required
  *
  *return array an array of validation error messages
  */


function validateArticle($title, $content, $published_at)
{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    if ($title == '') {
      $errors[] = 'title required';
    }
    if ($content == '') {
      $errors[] = "content required";
    }
    if ($published_at != '') {
      $date_time = date_create_from_format('Y-m-d H:i:s', $published_at);

      if ($date_time === false) {
        $errors[] = 'invalid time and date';
      } else {
        $date_errors = date_get_last_errors();

        if ($date_errors['warning_count'] > 0) {
          $errors[] = 'invalid date and time';
        }
      }
    }
  }
  return $errors;
}
