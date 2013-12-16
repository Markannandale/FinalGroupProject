<?php
// Start the session
  require_once('session.php');

  // Insert the page header
  $page_title = 'Create Reply';
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
        $threads = mysqli_real_escape_string($dbc, trim($_POST['reply']));
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['username'];
        $thread_id = mysqli_real_escape_string($dbc, $_GET['thread_id']);

        if (!empty($threads)) {
            $query = "INSERT INTO forum_topic_replies (topic_id, user_id, reply, username, date_posted) VALUES ('$thread_id', '$user_id', '$threads', '$user_name', NOW())";
            mysqli_query($dbc, $query);

            // Confirm success with the user
            echo '<p>Reply successfully created. Return to <a href="forumtopiclist.php">forum list</a>.</p>';

            mysqli_close($dbc);
            exit();
        }
      }
?>
<div id ="content2">
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['REQUEST_URL']; ?>">
    <fieldset>
        <legend>Reply to Post</legend>
        <label for="threads">Reply:</label>
        <input type="text" id="threads" name="reply" value="<?php if (!empty($threads)) echo $threads; ?>" /><br />
    </fieldset>
    <input type="submit" value="Save Reply" name="submit" />
</form>
</div>
<?php
  // Insert the page footer
  require_once('footer.php');
?>