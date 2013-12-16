<?php
// Start the session
  require_once('session.php');

  // Insert the page header
  $page_title = 'Topics Posted';
  require_once('header.php');
  
  require_once('connectvars.php');
  
  // Show the navigation menu
  require_once('navmenu.php');
  
  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  // Retrieve the forum data from MySQL
  $user_id = $_SESSION['user_id'];
  $query = "SELECT topic_id, user_id, topics, date FROM forum_topics WHERE user_id = '$user_id' ORDER BY date DESC";
  $data = mysqli_query($dbc, $query);
  
  if (isset($_GET['idtodelete']))  //This means we clicked on the delete link
    {
        $idtodelete = $_GET['idtodelete'];
        $deletequery = "DELETE from forum_topics where user_id=$idtodelete";
        mysqli_query($dbc,$deletequery);
    }
  
  // Loop through the array of topics, formatting it as HTML
    echo '<div id="content2">';
    echo '<h4>Topics:</h4>';
    echo '<table>';
    while ($row = mysqli_fetch_array($data)) {
      echo '<tr><td class="topics">';
      echo '<strong>Topic:</strong> ' . $row['topics'] . "<a href = \"".$_SERVER['PHP_SELF']."?idtodelete="
      .$row['user_id']."\"> Delete</a>".'<br />';
      echo '<strong>Date posted:</strong> '. $row['date']. '</td></tr>';
    } 
    echo '</table>';
    echo '</div>';
    
    mysqli_close($dbc);
?>
<?php
  // Insert the page footer
  require_once('footer.php');
?>
