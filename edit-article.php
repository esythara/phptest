<?php

require 'includes/database.php';
require 'includes/article.php';

$conn = getDB();

if (isset($_GET['id'])) {

  $article = getArticle($conn, $_GET['id']);

  if ($article) {

    $title = $article['title'];
    $content = $article['content'];
    $published_at = $article['published_at'];
  } else {
    die("mom is not here");
  }

} else {
  die("id not supplied, ur mom isn't here");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $published_at = $_POST['published_at'];

  $errors = validateArticle($title, $content, $published_at);

  if (empty($errors)) {
    die("this is a valid mother");
  }
}

?>
<?php require 'includes/header.php'; ?>

<h2>edit ur mom</h2>

<?php require 'includes/article-form.php'; ?>

<?php require 'includes/footer.php'; ?>
