<?php
  // Start the session
  require_once('session.php');

  // Insert the page header
  $page_title = 'Topic replies';
  require_once('header.php');
  
  require_once('connectvars.php');
  
  // Show the navigation menu
  require_once('navmenu.php');
  
  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
      // Retrieve the forum data from MySQL
      $query = "SELECT topic_id, reply, username, date_posted FROM forum_topic_replies WHERE forum_topic_replies.topic_id = " . mysqli_real_escape_string($dbc, $_GET['thread_id']) . " ORDER BY date_posted DESC";
      $data = mysqli_query($dbc, $query);
      
        // Loop through the array of topics, formatting it as HTML ONLY
          echo '<div id="content2">';
          echo '<h4>Thread:</h4>';
          echo '<table>';
          while ($row = mysqli_fetch_array($data)) {
            echo '<tr><td class="thread">';
            echo '<strong>Reply:</strong> '. $row['reply']. '<br />';
            echo '<strong>Posted by:</strong>' . $row['username']. '<br />';
            echo '<strong>Date posted:</strong>' . $row['date_posted']. '</td></tr>';

          } 
          echo '</table>';
          echo '</div>';

          mysqli_close($dbc);
?>
<?php
  // Insert the page footer
  require_once('footer.php');
?>