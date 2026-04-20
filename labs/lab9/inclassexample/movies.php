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
// We'll need a database connection both for retrieving records and for
// inserting them. Let's get it up front and use it for both processes.
$dbOk = false;

/* Create a new database connection object, passing in the host, username,
   password, and database to use. The "@" suppresses errors. */
@ $db = new mysqli('localhost', 'root', 'root', 'iit');

if ($db->connect_error) {
   echo '<div class="messages">Could not connect to the database. Error: ';
   echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}

// Have we posted?
$havePost = isset($_POST["save"]);

// Basic validation
$errors = '';
if ($havePost) {

   // Clean values for safe output
   $title = htmlspecialchars(trim($_POST["title"]));
   $year = htmlspecialchars(trim($_POST["year"]));

   $focusId = '';

   if ($title == '') {
      $errors .= '<li>Title may not be blank</li>';
      if ($focusId == '') $focusId = '#title';
   }

   if ($year == '') {
      $errors .= '<li>Year may not be blank</li>';
      if ($focusId == '') $focusId = '#year';
   } elseif (!preg_match('/^[0-9]{4}$/', $year)) {
      $errors .= '<li>Year must be a 4-digit year</li>';
      if ($focusId == '') $focusId = '#year';
   }

   if ($errors != '') {
      echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
      echo $errors;
      echo '</ul></div>';
      echo '<script type="text/javascript">';
      echo '  $(document).ready(function() {';
      echo '    $("' . $focusId . '").focus();';
      echo '  });';
      echo '</script>';
   } else {
      if ($dbOk) {
         // Trim raw values for the database
         $titleForDb = trim($_POST["title"]);
         $yearForDb = trim($_POST["year"]);

         // movies table uses title and year from the starter SQL
         $insQuery = "INSERT INTO movies (`title`,`year`) VALUES (?,?)";
         $statement = $db->prepare($insQuery);
         $statement->bind_param("ss", $titleForDb, $yearForDb);
         $statement->execute();

         echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' movie added to database.</h4>';
         echo $title . ' (' . $year . ')</div>';

         $statement->close();
      }
   }
}
?>

<h3>Add Movie</h3>
<form id="addMovieForm" name="addMovieForm" action="movies.php" method="post">
   <fieldset>
      <div class="formData">

         <label class="field" for="title">Title:</label>
         <div class="value">
            <input type="text" size="60"
               value="<?php if ($havePost && $errors != '') { echo $title; } ?>"
               name="title" id="title" />
         </div>

         <label class="field" for="year">Year:</label>
         <div class="value">
            <input type="text" size="10" maxlength="4"
               value="<?php if ($havePost && $errors != '') { echo $year; } ?>"
               name="year" id="year" /> <em>yyyy</em>
         </div>

         <input type="submit" value="save" id="save" name="save" />
      </div>
   </fieldset>
</form>

<h3>Movies</h3>
<table id="movieTable">
<?php
if ($dbOk) {

   $query = 'SELECT * FROM movies ORDER BY title';
   $result = $db->query($query);

   echo '<tr><th>Title:</th><th>Year:</th></tr>';

   if ($result) {
      $numRecords = $result->num_rows;

      for ($i = 0; $i < $numRecords; $i++) {
         $record = $result->fetch_assoc();

         if ($i % 2 == 0) {
            echo "\n" . '<tr id="movie-' . $record['movieid'] . '"><td>';
         } else {
            echo "\n" . '<tr class="odd" id="movie-' . $record['movieid'] . '"><td>';
         }

         echo htmlspecialchars($record['title']);
         echo '</td><td>';
         echo htmlspecialchars($record['year']);
         echo '</td></tr>';
      }

      $result->free();
   }

   $db->close();
}
?>
</table>

<?php include('includes/foot.inc.php'); ?>
