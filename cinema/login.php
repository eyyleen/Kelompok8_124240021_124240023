<?php
session_start();
include 'konek.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];

            // Redirect berdasarkan role
            if ($row['role'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: index.php");
            }
            exit;
        }
    }

    $_SESSION['error'] = "Email atau password salah!";
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" -->
    <title>SINEMACUUYY</title>
<head>
        <div class="navbar-container">
        <nav class="navbar">
            <div class="navbar-brand">
                <h1 class="navbar-heading">SINEMACUUYY</h1>
            </div>
            <ul class="navbar-menu">
                <li><a style="height: -5em;font-family: algerian; color: white;text-shadow: 2px 2px 0px #6e5a11, 4px 0px 0px #836d24, 6px 0px 0px #a88616, 8px 0px 0px #b08909, 0px 0px 0px #ab995e;
" href="index.php"><strong></strong>Home</a></li>
                <li><a style="font-family: Algerian; color: white; text-shadow: 0px 0px 0px #6e5a11, 4px 0px 0px #836d24, 0px 0px 0px #a88616, 2px 0px 0px #b08909, 1px 0px 0px #ab995e;"href="schedule.php">Schedule</a></li>
                <li><a style="font-family: Algerian; color: white;text-shadow: 2px 2px 0px #6e5a11, 4px 0px 0px #836d24, 6px 0px 0px #a88616, 8px 0px 0px #b08909, 1px 0px 0px #ab995e;"href="contact-us.php">Contact</a></li>
                <li><a style="font-family:Algerian; color: white;text-shadow: 2px 2px 0px #6e5a11, 4px 0px 0px #836d24, 6px 0px 0px #a88616, 8px 0px 0px #b08909, 1px 0px 0px #ab995e;"href="booking.php">Booking</a></li>
                <li><a style="font-family:Algerian; color: white;text-shadow: 2px 2px 0px #6e5a11, 4px 0px 0px #836d24, 6px 0px 0px #a88616, 8px 0px 0px #b08909, 1px 0px 0px #ab995e;"href="movie.php">Movie</a></li>
            
            </ul>
        </nav>
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url('31ed8618df34fff5d3da4331adf79fe3.jpg') no-repeat;
    background-size: cover;
    background-position: center;
}   
.wrapper{ 
left: -60%;
position: relative; 
width: 400px; 
height: 440px; `
background: transparent; 
border: 2px solid rgba(255, 255, 255, 5); 
border-radius: 20px; 
backdrop-filter: blur(20px); 
box-shadow: 0 0 30px rgb(237, 237, 237); 
display: flex; 
justify-content: center; 
align-items: center;
overflow: hidden;
transition: transform .5s ease, height .2s ease;
/* transform: scale(0); */
}
.wrapper .form-box{
    width: 100%;
    padding: 40px;
}
.wrapper .form-box.login{
    transition: transform .18s ease;
    transform: translateX(0);
}
.wrapper .icon-close{
    position: absolute;
    top: 0;
    right: 0;
    width: 45px;
    height: 45px;
    background:rgb(11, 52, 86);
    display: flex;
    justify-content: center;
    align-items: center;
    border-bottom-left-radius: 20px;
    cursor: pointer;
    z-index: 1;
}

    .navbar-brand {
         height: -2em;
        overflow: hidden;
    }

    .navbar-brand:before {
        content: '';
        display: block;
        position: relative;
        top: -195%;
        left: -25%;
        height: 219%;
        width: 200%;
        background:rgb(255, 255, 255);
        box-shadow: 0px 8px 0px rgba(0, 0, 0, 0.1);
        transform: rotateZ(-6deg) skew(-6deg);
    }

    .navbar-brand .navbar-heading {
        margin: 0;
        position: absolute;
        top: -6vmax;
        left: -60vmax;
        padding: 0;
        margin: 0;
        color: #fff;
        font-size: 8em;
        font-family: 'algerian', cursive;
        transform: rotateZ(-10deg);
        text-shadow: 2px 2px 0px #6e5a11, 4px 4px 0px #836d24, 6px 6px 0px #a88616, 8px 8px 0px #b08909, 10px 10px 0px #ab995e;
    }

    nav {
        display: flex;
        align-items: center;
    }

    .navbar {
        display: flex;
        justify-content: center;
    }

    .navbar-menu {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        right: 10px; 
        background-color: NONE;
        border-radius: 50px;
    }

    .navbar ul li {
        float: left;
        display: block;
        transition-duration: 0.5s;
        border-radius: 50px;
    }

    .navbar ul li:hover {
        cursor: pointer;
        background-color:rgb(255, 255, 255);
    }

    .navbar ul li:hover>a {
        color:rgb(120, 51, 51);
    }

    .navbar-menu li ul {
        visibility: hidden;
        opacity: 0;
        position: absolute;
        transition: all 0.5s ease;
        background-color:rgb(255, 255, 255);
    }

    .navbar-menu li a {
        display: block;
        color:rgb(255, 255, 255);
        text-align: center;
        padding: 12px 36px;
        text-decoration: none;
    }

    .navbar-container {
        position: absolute;
        top: 8em;
        right: 1%;
    }
    .form-box h2{
font-size: 2em; 
color:rgb(248, 248, 248); 
text-align: center; 
 } 
 .input-box ,select{
position: relative; 
width: 100%; 
height: 50px; 
border-bottom: 2px solid #162938; 
margin: 30px 0;
margin-bottom: 20px;
margin-top: 10px;
}
.input-box label{
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    font-size: 1em;
    color:rgb(241, 249, 255);
    font-weight: 500;
    pointer-events: none;
}
.input-box input:focus~label,
.input-box input:valid~label{
    top: -5px;
}
    
.input-box input{   
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    color:rgb(255, 255, 255);
    font-weight: 600;
    padding: 0 35px 0 5px;

}

.input-box .icon {
    position: absolute;
    right: 8px;
    font-size: 1.2em;
    color:rgb(255, 255, 255);
    line-height: 57px;
}
.remember-forgot{
font-size: .9em;
color:rgb(255, 255, 255);
font-weight: 500;
margin: -15px 0 15px;
display: flex;
justify-content: space-between;
}

.remember-forgot label input{
    accent-color:rgb(255, 255, 255);
    margin-right: 3px;
}
.remember-forgot a{
    color:rgb(255, 255, 255);
    text-decoration: none;
}
.remember-forgot a:hover{
    text-decoration: underline;
}
.btn{
    width: 100%;
    height: 45px;
    background: #162938;
    border: none;
    outline: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em;
    color: #fff;
    font-weight: 500;
}
.login-register{
    margin: 20px 0 10px;
    text-align: center;
    color:rgb(255, 255, 255);
    margin-top: 10px;
}.guest-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    height: 45px;
    margin-top: 15px;
}

</style>
<body>
    <div class="wrapper" >
            <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
            <div class="form-box login">
                <h2>Login</h2>
                <div class="register-box">
   <?php if (isset($_SESSION['error'])): ?>
  <div class="alert text-center mt-3" role="alert" style="background-color:rgb(247, 247, 247); color: #000; font-weight: bold; padding: 10px; border-radius: 8px;">
    ⚠️ <?= $_SESSION['error']; ?>
    <?php unset($_SESSION['error']); ?>
  </div>
<?php endif; ?>
                <form method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label >Email</label>
                </div>  

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label >Password</label>
                </div>
                <div class="remember-forgot"> 
                <label><input type="checkbox"> 
                Remember me</label> 
                <a href="#">Forgot Password?</a> 
                </div> 
                <button type="submit" class="btn">Login</button>
                <div class="login-register" style="text-align: center; color:rgb(255, 255, 255);"> 
                <p>Don't have an account? <a 
                href="register.php" 
                class="register-link">Register</a>
            </p> 
            <br>
                </div>
                </form>
<a href="tamu.php" class="btn guest-btn">Access As a Guest</a>

            </div>

</body>
</html>