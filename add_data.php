<!DOCTYPE HTML>
<html>

<head>
  <style>
    .error {
      color: #FF0000;
    }

    .container {
      width: 800px;
      margin: 100px 250px;
      background: lightblue;
      font-weight: bold;
      font-size: 18px;
      font-family: arial;
      padding-top: 25px;
      padding-bottom: 25px;
      border-radius: 10px;
      box-shadow: 10 10 5 gray
    }

    .header {
      text-align: center;
      font-style: italic;


    }

    form {
      margin-left: 30px
    }


    input[type="text"],
    input[type="password"],
    input[type="email"] {
      width: 400px;
      height: 30px;
      margin-left: 30px;
    }

    input[type="submit"] {
      border: none;
      width: 150px;
      height: 30px;
      background-color: #f5c0c0;
      margin-left: 30px;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer
    }

    .inputs {
      margin-left: 150px
    }
  </style>
</head>

<body>

  <?php

  // define variables and set to empty values
  $nameErr = $emailErr = $genderErr = $websiteErr = $passErr = $checkErr = $branchErr = "";
  $name = $email = $gender = $comment = $website = $password = $check[] = $branch = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["password"])) {
      $passErr = "Invalid Password";
    }
    if (empty($_POST["branch"])) {
      $branchErr = "Select branch";
    }

    if (empty($_POST["check"])) {
      $checkErr = "Please Select at least one option";
    }




    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST["website"])) {
      $website = "";
    } else {
      $website = test_input($_POST["website"]);
      // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
        $websiteErr = "Invalid URL";
      }
    }

    if (empty($_POST["comment"])) {
      $comment = "";
    } else {
      $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } else {
      $gender = test_input($_POST["gender"]);
    }
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if (count($_POST) > 0) {
    if (empty($genderErr) && empty($websiteErr) && empty($emailErr) && empty($checkErr) && empty($nameErr) && empty($passErr) && empty($branchErr)) {
      $row = $_POST["name"] . "," . $_POST["password"] . "," . $_POST["branch"] . "," . implode("|", $_POST["check"]) . "," . $_POST["email"] . "," . $_POST["website"] . "," . $_POST["comment"] . "," . $_POST["gender"] . PHP_EOL;
      $fp = fopen('test.txt', 'a');
      fwrite($fp, $row);
      fclose($fp);
      header("Location:index.php");
    }
  }
  ?>

  <div class="container">
    <h2 class="header">Welcome To Our Community</h2>
    <form method="post">
      <lable>Name : </lable>
      <input type="text" name="name" value="<?php echo $name; ?>">
      <span class="error">* <?php echo $nameErr; ?></span>
      <br><br>

      <lable>Password : </lable>
      <input type="password" name="password" value="<?php echo $password; ?>">
      <span class="error">* <?php echo $passErr; ?></span>
      <br><br>

      <lable>Email : </lable>
      <input type="text" name="email" value="<?php echo $email; ?>">
      <span class="error">* <?php echo $emailErr; ?></span>
      <br><br>

      <lable>Website : </lable>
      <input type="text" name="website" value="<?php echo $website; ?>">
      <span class="error"><?php echo $websiteErr; ?></span>
      <br><br>
      <lable>Message : </lable>
      <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
      <br><br>

      <lable>Branch : </lable>
      <select name="branch" size="4" multiple="">
        <option value="Mansoura">Egypt</option>
        <option value="Alex">France</option>
        <option value="Assuit">Japan</option>
        <option value="Smart">USA</option>
      </select>
      <span class="error"><?php echo $branchErr; ?></span>
      <br><br>

      <lable>Courses : </lable>
      <input type="checkbox" name="check[]" id="brochure" value="html">Html
      <input type="checkbox" name="check[]" id="brochure" value="css">Css
      <input type="checkbox" name="check[]" id="brochure" value="js">Js
      <input type="checkbox" name="check[]" id="brochure" value="redhat">Redhat
      <span class="error"><?php echo $checkErr; ?></span>
      <br><br>

      <lable>Gender : </lable>
      <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female">Female
      <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
      <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other") echo "checked"; ?> value="other">Other
      <span class="error">* <?php echo $genderErr; ?></span>
      <br><br>

      <div class="inputs">
        <input type="submit" name="submit" value="Submit">
        <!-- <input type="submit" name="file" value="See My Evaluation"> -->
      </div>

    </form>
  </div>

</body>

</html>