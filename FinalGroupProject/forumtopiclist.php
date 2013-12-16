<?php
  // Start the session
  require_once('session.php');

  // Insert the page header
  $page_title = 'Topics';
  require_once('header.php');
  
  require_once('connectvars.php');
  
  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }
  
  // Show the navigation menu
  require_once('navmenu.php');
  
  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  // Retrieve the forum data from MySQL
  $query = "SELECT topic_id, topics, date FROM forum_topics ORDER BY date DESC";
  $data = mysqli_query($dbc, $query);
  
  // Loop through the array of topics, formatting it as HTML ONLY if the user has been authorized
  if (isset($_SESSION['user_id'])) {
    echo '<div id="content2">';
    echo '<h4>Topics:</h4>';
    echo '<table>';
    while ($row = mysqli_fetch_array($data)) {
      echo '<tr><td class="topics">';
      echo '<strong>Topic:</strong> ' ."<a href = threadreply.php?thread_id="
      .$row['topic_id'].">" . $row['topics'] ."</a>"." "."<a href = thread.php?thread_id="
      .$row['topic_id'].">View other Comments" ."</a>".'<br />';
      echo '<strong>Date posted:</strong> '. $row['date']. '</td></tr>';
    } 
    echo '</table>';
    echo '</div>';
    
    mysqli_close($dbc);
  }
  else {
      echo '<h3>You are not authorized to access this webpage</h3>';
  }
?>
<?php
  // Insert the page footer
  require_once('footer.php');
?>