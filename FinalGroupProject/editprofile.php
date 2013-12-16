<?php
  // Start the session
  require_once('session.php');

  // Insert the page header
  $page_title = 'Edit Profile';
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
    // Grab the profile data from the POST
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
    $email_address = mysqli_real_escape_string($dbc, trim($_POST['email_address']));
    $phone_num = mysqli_real_escape_string($dbc, trim($_POST['phone_num']));
    $country = mysqli_real_escape_string($dbc, trim($_POST['country']));
    $state = mysqli_real_escape_string($dbc, trim($_POST['state']));
    $error = false;

    // Update the profile data in the database
    if (!$error) {
      if (!empty($first_name) && !empty($last_name) && !empty($email_address) && !empty($phone_num) && !empty($country) && !empty($state)) {
          if (preg_match("/^\(?[2-9]\d{2}\)?[-\s]\d{3}-\d{4}$/", $phone_num)){
            $query = "UPDATE forum_users SET first_name = '$first_name', last_name = '$last_name', email_address = '$email_address', phone_num = '$phone_num', country = '$country', state = '$state' WHERE user_id = '" . $_SESSION['user_id'] . "'";
          }
          else{
              echo '<p class="error">Invalid phone number.</p>';
          }
      }
 
        mysqli_query($dbc, $query);

        // Confirm success with the user
        echo '<p>Your profile has been successfully updated. Would you like to <a href="viewprofile.php">view your profile</a>?</p>';

        mysqli_close($dbc);
        exit();
      }
      else {
        echo '<p class="error">You must enter all of the profile data.</p>';
      }
  } // End of check for form submission
  else {
    // Grab the profile data from the database
    $query = "SELECT first_name, last_name, email_address, phone_num, country, state FROM forum_users WHERE user_id = '" . $_SESSION['user_id'] . "'";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);

    if ($row != NULL) {
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $email_address = $row['email_address'];
      $phone_num = $row['phone_num'];
      $country = $row['country'];
      $state = $row['state'];
    }
    else {
      echo '<p class="error">There was a problem accessing your profile.</p>';
    }
  }

  mysqli_close($dbc);
?>
<div id ="content">
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MM_MAXFILESIZE; ?>" />
    <fieldset>
      <legend>Personal Information</legend>
      <label for="firstname">First name:</label>
      <input type="text" id="firstname" name="firstname" value="<?php if (!empty($first_name)) echo $first_name; ?>" /><br />
      <label for="lastname">Last name:</label>
      <input type="text" id="lastname" name="lastname" value="<?php if (!empty($last_name)) echo $last_name; ?>" /><br />
      <label for="email_address">Email address:</label>
      <input type="text" id="lastname" name="email_address" value="<?php if (!empty($email_address)) echo $email_address; ?>" /><br />
      <label for="phone_num">Phone number:</label>
      <input type="text" id="lastname" name="phone_num" value="<?php if (!empty($phone_num)) echo $phone_num; ?>" /><br />
      <label for="country">Country:</label>
      <input type="text" id="lastname" name="country" value="<?php if (!empty($country)) echo $country; ?>" /><br />
      <label for="state">State:</label>
      <input type="text" id="lastname" name="state" value="<?php if (!empty($state)) echo $state; ?>" /><br />
    </fieldset>
    <input type="submit" value="Save Profile" name="submit" />
  </form>
</div>

<?php
  // Insert the page footer
  require_once('footer.php');
?>
