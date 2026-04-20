<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
  include('includes/functions.inc.php'); // functions
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
      
<?php include('includes/menubody.inc.php'); ?>
$insQuery = "INSERT INTO movies (`title`,`year`) VALUES (?,?)";
$statement = $db->prepare($insQuery);
$statement->bind_param("si", $titleForDb, $yearForDb);
<p>Build the movie forms and output here.</p>

<?php include('includes/foot.inc.php'); 
$query = "SELECT * FROM movies ORDER BY title";
echo htmlspecialchars($record['title']);
echo htmlspecialchars($record['year']);
  // footer info and closing tags
?>
