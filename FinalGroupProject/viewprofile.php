<?php
  // Start the session
  require_once('session.php');

  // Insert the page header
  $page_title = 'View Profile';
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

  // Grab the profile data from the database
  if (!isset($_GET['user_id'])) {
    $query = "SELECT username, first_name, last_name, email_address, phone_num, country, state FROM forum_users WHERE user_id = '" . $_SESSION['user_id'] . "'";
  }
  else {
    $query = "SELECT username, first_name, last_name, email_address, phone_num, country, state FROM forum_users WHERE user_id = '" . $_GET['user_id'] . "'";
  }
  $data = mysqli_query($dbc, $query);

  if (mysqli_num_rows($data) == 1) {
    // The user row was found so display the user data
    $row = mysqli_fetch_array($data);
    echo '<div id="content">';
    echo '<table>';
    if (!empty($row['username'])) {
      echo '<tr><td class="label">Username:</td><td>' . $row['username'] . '</td></tr>';
    }
    if (!empty($row['first_name'])) {
      echo '<tr><td class="label">First name:</td><td>' . $row['first_name'] . '</td></tr>';
    }
    if (!empty($row['last_name'])) {
      echo '<tr><td class="label">Last name:</td><td>' . $row['last_name'] . '</td></tr>';
    }
    if (!empty($row['email_address'])) {
      echo '<tr><td class="label">Email address:</td><td>' . $row['email_address'] . '</td></tr>';
    }
    if (!empty($row['phone_num'])) {
      echo '<tr><td class="label">Phone number:</td><td>' . $row['phone_num'] . '</td></tr>';
    }
    if (!empty($row['country'])) {
      echo '<tr><td class="label">Country:</td><td>' . $row['country'] . '</td></tr>';
    }
    if (!empty($row['state'])) {
      echo '<tr><td class="label">State:</td><td>' . $row['state'] . '</td></tr>';
    }
    echo '</table>';
    echo '</div>';
    if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
      echo '<p>Would you like to <a href="editprofile.php">edit your profile</a>?</p>';
    }
  } // End of check for a single row of user results
  else {
    echo '<p class="error">There was a problem accessing your profile.</p>';
  }

  mysqli_close($dbc);
?>

<?php
  // Insert the page footer
  require_once('footer.php');
?>
