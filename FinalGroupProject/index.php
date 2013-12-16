<?php
  // Start the session
  require_once('session.php');
    
  // Insert the page header
  $page_title = 'Welcome!';
  require_once('header.php');
  
  require_once('connectvars.php');
  
  // Show the navigation menu
  require_once('navmenu.php');
  
  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  // Retrieve the forum data from MySQL
  $query = "SELECT topic_id, topics, date FROM forum_topics ORDER BY date DESC LIMIT 3";
  $data = mysqli_query($dbc, $query);
  
  echo '<div id="content">';
  echo '<h4>Welcome to ForumZ</h4>';
  echo '<p>Here, users can post topics to discuss, and respond to other users topics. Note, you must be logged in first before you can post topics and/or reply to posts.</p>';
  
  // Loop through the array of topics, formatting it as HTML
    echo '<div id="content3">';
    echo '<h4>Latest Topics:</h4>';
    echo '<table>';
    while ($row = mysqli_fetch_array($data)) {
      echo '<tr><td class="topics">';
      echo '<strong>Topic:</strong> ' ."<a href = thread.php?thread_id="
      .$row['topic_id'].">" . $row['topics'] ."</a>".'<br />';
      echo '<strong>Date posted:</strong> '. $row['date']. '</td></tr>';
    } 
    echo '</table>';
    echo '</div>';
    
    mysqli_close($dbc);
  echo '</div>';
?>

<?php
  // Insert the page footer
  require_once('footer.php');
?>