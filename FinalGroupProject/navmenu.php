<?php
  // Generate the navigation menu
  echo '<hr />';
  if (isset($_SESSION['username'])) {
    echo '<div id=navbar>';
    echo '<a href="index.php">Home</a> &#10074; ';
    echo '<a href="createforum.php">Create Topic</a> &#10074; ';
    echo '<a href="forumtopiclist.php">Reply to Topic</a> &#10074; ';
    echo '<a href="viewprofile.php">View Profile</a> &#10074; ';
    echo '<a href="editprofile.php">Edit Profile</a> &#10074; ';
    echo '<a href="deletetopics.php">Delete Topic</a> &#10074; ';
    echo '<a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
    echo '</div>';
  }
  else {
    echo '<div id=navbar>';
    echo '<a href="login.php">Log In</a> &#10074; ';
    echo '<a href="signup.php">Sign Up</a> &#10074; ';
    echo '<a href="viewtopics.php">View Topics</a>';
    echo '</div>';
  }
  echo '<hr />';
?>
