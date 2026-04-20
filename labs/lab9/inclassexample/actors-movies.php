<?php
include('includes/init.inc.php'); // include the DOCTYPE and opening tags
include('includes/functions.inc.php'); // functions
?>
<title>PHP &amp; MySQL - ITWS</title>

<?php
include('includes/head.inc.php');
// include global css, javascript, end the head and open the body
?>

<h1>PHP &amp; MySQL</h1>

<?php include('includes/menubody.inc.php'); ?>

<?php
$dbOk = false;

/* Change these if your real db credentials are different */
@ $db = new mysqli('localhost', 'root', 'root', 'iit');

if ($db->connect_error) {
  echo '<div class="messages">Could not connect to the database. Error: ';
  echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
  $dbOk = true;
}
?>

<h3>Movies and Their Actors</h3>
<table id="movieActorTable">
<?php
if ($dbOk) {
  $query = "
    SELECT 
      m.movieid,
      m.title,
      m.year,
      a.first,
      a.last
    FROM movies m
    LEFT JOIN movie_actors ma ON m.movieid = ma.movieid
    LEFT JOIN actors a ON ma.actorid = a.actorid
    ORDER BY m.title, a.last, a.first
  ";

  $result = $db->query($query);

  if (!$result) {
    echo '<tr><td>Query failed: ' . htmlspecialchars($db->error) . '</td></tr>';
  } else {
    echo '<tr><th>Movie</th><th>Year</th><th>Actor</th></tr>';

    $numRecords = $result->num_rows;

    for ($i = 0; $i < $numRecords; $i++) {
      $record = $result->fetch_assoc();

      if ($i % 2 == 0) {
        echo "\n" . '<tr>';
      } else {
        echo "\n" . '<tr class="odd">';
      }

      echo '<td>' . htmlspecialchars($record['title']) . '</td>';
      echo '<td>' . htmlspecialchars($record['year']) . '</td>';
      echo '<td>';

      if ($record['first'] !== null && $record['last'] !== null) {
        echo htmlspecialchars($record['last']) . ', ' . htmlspecialchars($record['first']);
      } else {
        echo 'No actor linked';
      }

      echo '</td></tr>';
    }

    $result->free();
  }

  $db->close();
}
?>
</table>

<?php include('includes/foot.inc.php'); ?>