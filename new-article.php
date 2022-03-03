<?php

require 'includes/database.php';

$errors = [];
$title = '';
$content = '';
$published_at = '';

$required = Array("title", "content");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $title = $_POST['title'];
  $content = $_POST['content'];
  $published_at = $_POST['published_at'];

  foreach($required as $requiredfield) {
    if($_POST[$requiredfield] == '') {
      $errors[] = $requiredfield . ' required';
    }
  }

  // if ($published_at != '') {
  //   $date_time = date_create_from_format('Y-m-d H:i:s', $published_at);
  //
  //   if ($date_time === false) {
  //     $errors[] = 'invalid time and date';
  //   } else {
  //     $date_errors = date_get_last_errors();
  //
  //     if ($date_errors['warning_count'] > 0) {
  //       $errors[] = 'invalid time and date';
  //     }
  //   }
  // }

  if(empty($errors)) {


    $conn = getDB();

    $sql = "INSERT INTO article (title, content, published_at)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($results === false) {
      echo mysqli_error($conn);
    } else {

      if ($published_at == '') {
        $published_at = null;
      }
      mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

      if (mysqli_stmt_execute($stmt)) {

        $id = mysqli_insert_id($conn);

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
          $protocol = 'https';
        } else {
          $protocol = 'http';
        }
        header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/article.php?id=$id");
        exit;
        // echo "inserted ur moms id: $id";

      } else {
        echo mysqli_stmt_error($stmt);
      }
    }
  }
}
?>
<?php require 'includes/header.php'; ?>

<h2>New mom</h2>

<?php require 'includes/article-form.php'; ?>

<?php require 'includes/footer.php'; ?>
