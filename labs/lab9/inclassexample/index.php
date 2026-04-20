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
// inserting them. Let's get it up front and use it for both processes
// to avoid opening the connection twice.
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

// Let's do some basic validation
$errors = '';
if ($havePost) {

   // Clean values for safe output back to the page
   $firstNames = htmlspecialchars(trim($_POST["firstNames"]));
   $lastName = htmlspecialchars(trim($_POST["lastName"]));
   $dob = htmlspecialchars(trim($_POST["dob"]));

   // Check the date format
   $dobTime = strtotime($dob);
   $dateFormat = 'Y-m-d';
   $dobOk = ($dob != '' && $dobTime !== false && date($dateFormat, $dobTime) == $dob);

   $focusId = '';

   if ($firstNames == '') {
      $errors .= '<li>First name may not be blank</li>';
      if ($focusId == '') $focusId = '#firstNames';
   }
   if ($lastName == '') {
      $errors .= '<li>Last name may not be blank</li>';
      if ($focusId == '') $focusId = '#lastName';
   }
   if ($dob == '') {
      $errors .= '<li>Date of birth may not be blank</li>';
      if ($focusId == '') $focusId = '#dob';
   }
   if ($dob != '' && !$dobOk) {
      $errors .= '<li>Enter a valid date in yyyy-mm-dd format</li>';
      if ($focusId == '') $focusId = '#dob';
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
         // Trim the raw post values for the database
         $firstNamesForDb = trim($_POST["firstNames"]);
         $lastNameForDb = trim($_POST["lastName"]);
         $dobForDb = trim($_POST["dob"]);

         // Use the exact field names from the starter SQL
         $insQuery = "INSERT INTO actors (`first`,`last`,`dob`) VALUES (?,?,?)";
         $statement = $db->prepare($insQuery);

         // first, last, dob must match the SQL order above
         $statement->bind_param("sss", $firstNamesForDb, $lastNameForDb, $dobForDb);
         $statement->execute();

         echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' actor added to database.</h4>';
         echo $firstNames . ' ' . $lastName . ', born ' . $dob . '</div>';

         $statement->close();
      }
   }
}
?>

<h3>Add Actor</h3>
<form id="addForm" name="addForm" action="index.php" method="post" onsubmit="return validate(this);">
   <fieldset>
      <div class="formData">

         <label class="field" for="firstNames">First Name(s):</label>
         <div class="value">
            <input type="text" size="60"
               value="<?php if ($havePost && $errors != '') { echo $firstNames; } ?>"
               name="firstNames" id="firstNames" />
         </div>

         <label class="field" for="lastName">Last Name:</label>
         <div class="value">
            <input type="text" size="60"
               value="<?php if ($havePost && $errors != '') { echo $lastName; } ?>"
               name="lastName" id="lastName" />
         </div>

         <label class="field" for="dob">Date of Birth:</label>
         <div class="value">
            <input type="text" size="10" maxlength="10"
               value="<?php if ($havePost && $errors != '') { echo $dob; } ?>"
               name="dob" id="dob" /> <em>yyyy-mm-dd</em>
         </div>

         <input type="submit" value="save" id="save" name="save" />
      </div>
   </fieldset>
</form>

<h3>Actors</h3>
<table id="actorTable">
<?php
if ($dbOk) {

   $query = 'SELECT * FROM actors ORDER BY last, first';
   $result = $db->query($query);

   echo '<tr><th>Name:</th><th>Date of Birth:</th><th></th></tr>';

   if ($result) {
      $numRecords = $result->num_rows;

      for ($i = 0; $i < $numRecords; $i++) {
         $record = $result->fetch_assoc();

         if ($i % 2 == 0) {
            echo "\n" . '<tr id="actor-' . $record['actorid'] . '"><td>';
         } else {
            echo "\n" . '<tr class="odd" id="actor-' . $record['actorid'] . '"><td>';
         }

         echo htmlspecialchars($record['last']) . ', ';
         echo htmlspecialchars($record['first']);
         echo '</td><td>';
         echo htmlspecialchars($record['dob']);
         echo '</td><td>';
         echo '<img src="resources/delete.png" class="deleteActor" width="16" height="16" alt="delete actor"/>';
         echo '</td></tr>';
      }

      $result->free();
   }

   $db->close();
}
?>
</table>

<?php include('includes/foot.inc.php'); ?>