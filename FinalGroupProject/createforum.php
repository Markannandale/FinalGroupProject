<?php
  // Start the session
  require_once('session.php');

  // Insert the page header
  $page_title = 'Create Topic';
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
  
  if (isset($_POST['submit'])) {
    // Grab the forum data from the POST
    $topics = mysqli_real_escape_string($dbc, trim($_POST['topics']));
    $user_id = $_SESSION['user_id'];
    
    if (!empty($topics)) {
        $query = "INSERT INTO forum_topics (user_id, topics, date) VALUES ('$user_id', '$topics', NOW())";
        mysqli_query($dbc, $query);
            
        // Confirm success with the user
        echo '<p>Topic successfully created. Return <a href="index.php">home</a>.</p>';

        mysqli_close($dbc);
        exit();
    }
  }
  
?>
<div id ="content2">
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Create Forum Topic</legend>
        <label for="topics">Topic Name:</label>
        <input type="text" id="topics" name="topics" value="<?php if (!empty($topics)) echo $topics; ?>" /><br />
    </fieldset>
    <input type="submit" value="Save Topic" name="submit" />
</form>
</div>

<?php
  // Insert the page footer
  require_once('footer.php');
?>