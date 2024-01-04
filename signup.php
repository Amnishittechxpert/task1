<?php

session_start(); 

$nameErr = $lastnameErr = $emailErr = $passwordErr  = "";
$name = $lastname = $email = $password= $color = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Name is required";
        }
    }
        if (empty($_POST["lastname"])) {
        $lastnameErr = "lastname is required";
    } else {
        $lastname = test_input($_POST["lastname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
            $lastnameErr = "last name is requid";
        }
    }
        if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (preg_match("/^[a-zA-Z-0-9' ]*$/", $email)) {
            $emailErr = "Invalid email format";
        }
    }
   
function checkPasswordStrength($password) {
    $strength = 0;
   if (strlen($password) >= 8) {
        $strength++;
    }
   if (preg_match('/[a-z]/', $password) && preg_match('/[A-Z]/', $password)) {
        $strength++;
    }
   if (preg_match('/\d/', $password)) {
        $strength++;
    }
   if (preg_match('/[!@#$%^&*()_+{}[\]:;<>,.?~\\-]/', $password)) {
        $strength++;
    }
    return $strength;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $strength = checkPasswordStrength($password);

    if ($strength <= 1) {
        $color = 'red';
        $message = 'Weak Password';
    } elseif ($strength == 2) {
        $color = 'orange';
        $message = 'Medium Password';
    } else {
        $color = 'green';
        $message = 'Strong Password';
    }


}
 }
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Form Validation</title>
<style>
    .error{
        color:red;
    }
    .phpform{
        background-color :grey;
        width: 300px;
        text-align: center;
        padding: 10px;
        border-radius: 25px;
    }
</style>
</head>
<body>
<div class ="phpform" >
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"autocomplete="off">
        Name: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>

        lastname: <input type="text" name="lastname" value="<?php echo $lastname; ?>">
        <span class="error">* <?php echo $lastnameErr; ?></span>
        <br><br>

        Email: <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        <label for="password">Password:</label>
       <input type="password" id="password" name="password" required value="<?php echo $password; ?>"><br><br>
        <span class="error"> <?php echo $passwordErr; ?></span>
        <h1><?php echo '<div style="color: ' . $color . ';">' .$message . '</div>'; ?></h1>
        <button type="submit">Sign Up</button>
    </form>
    </div>
</body>
</html>
<?php
echo $name ;
echo "<br>";
echo $lastname ;
echo "<br>";
echo $email;
echo "<br>";
echo $password ;
echo "<br>";

?>

