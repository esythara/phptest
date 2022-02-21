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
        echo "inserted ur moms id: $id";

      } else {
        echo mysqli_stmt_error($stmt);
      }
    }
  }
}
?>
<?php require 'includes/header.php'; ?>

<h2>New mom</h2>

<?php if (! empty($errors)): ?>
  <ul>
    <?php foreach ($errors as $error): ?>
      <li><?= $error ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="post">

  <div>
    <label for="title">title</label>
    <input name="title" id="title" placeholder="yr mom" value="<?= htmlspecialchars($title); ?>">
  </div>

  <div>
    <label for="content">content</label>
    <textarea name="content" rows="4" cols="40" id="content" placeholder="content"><?= $content; ?></textarea>
  </div>

  <div>
    <label for="published_at">when it were posted init</label>
    <input type="datetime-local" name="published_at" id="published_at" value="<?= $published_at; ?>">
  </div>

  <button>add</button>

</form>

<?php require 'includes/footer.php'; ?>
