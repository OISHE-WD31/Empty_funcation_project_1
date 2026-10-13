<?php
require_once '../../config/db.php';
if(isset($_POST['regester'])){

date_default_timezone_set('Asia/Dhaka'); 

$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$course=$_POST['course'];
$password=$_POST['password'];


$c_password=$_POST['c_password'];
$term_condition=$_POST['term_condition'];

$reg_time=date("Y-m-d");

$inputError=array();
if(empty($first_name)){
    $inputError['first_name']="First Name is required";
}


if(empty($last_name)){
    $inputError['last_name']="Last Name is reqired";
}


if(empty($email)){
    $inputError['email']="Your Email is required";
}


if(empty($phone)){
    $inputError['phone']="Your Phone is required";
}
if(empty($password)){
    $inputError['password']="Your Password is required";
}

if(count($inputError)==0){

$email_db_check=mysqli_query($dbcon,"SELECT * FROM `users` WHERE `email`='$email'");
if(mysqli_num_rows($email_db_check)==0){

}else{
    $email_db_match="This email is already exist";


}

    $phone_db_check=mysqli_query($dbcon,"SELECT * FROM `users` WHERE `phone`='$phone'");
    if(mysqli_num_rows($phone_db_check)==0){

    }else{
        $phone_db_match="This number is already exist";
    }

    if(strlen($password)<2){
        $password_len_check="Your Password must be 5 charecter";
    }else{
        $password_db_check=mysqli_query($dbcon,"SELECT * FROM `users` WHERE `password`='$password'");

        if(mysqli_num_rows($password_db_check)==0){

        if($password==$c_password){
            $password=md5($c_password);
            
          
        }else{
            $confirm_password_match="Confirm password dosent match";
            
        }
           
        }else{
            $password_db_match="This password is already exist";


        }
          $insert_db=mysqli_query($dbcon,"INSERT INTO `users`( `full_name`, `email`, `phone`, `course`, `Password`, `term_condition`,`reg_time`) VALUES ('$first_name','$email','$phone','$course','$password','$term_condition','$reg_time')");

        if($insert_db){
            echo"
            <script>
            alert('successfull');
            window.location.href='regester.php';
            
            </script>
            
            ";

            $first_name=false;
$last_name=false;
$email=false;
$phone=false;
$course=false;
$password=false;


$c_password=false;
$term_condition=false;
        }
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OISHE Institute - Registration</title>

    <link rel="stylesheet" href="css/regestation.css">
</head>
<body>

    <div class="register-container">

        <div class="register-left">
            <div class="logo">OI</div>

            <h1>OISHE<br>Institute</h1>

            <p>
                Start your learning journey with us.
                Register now and become a part of OISHE Institute.
            </p>

            <div class="shape shape-one"></div>
            <div class="shape shape-two"></div>
        </div>

        <div class="register-right">

            <h2>Create Account</h2>
            <p class="subtitle">Fill in your information to register</p>

            <form method="POST">

                <div class="input-row">

                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" placeholder="Enter first name"name="first_name" value="<?php
                        if(isset($first_name)){
                            echo $first_name;
                        }
                        ?>">

                        <label style="color:red;" for=""><?php
                        if(isset( $inputError['first_name'])){
                            echo  $inputError['first_name'];
                        }
                        ?></label>

                    </div>

                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" placeholder="Enter last name" name="last_name" value="<?php
                        if(isset($last_name)){
                            echo $last_name;
                        }
                        ?>">

                       
                        <label for="" style="color:red;"><?php
                        if(isset($inputError['last_name'])){
                            echo $inputError['last_name'];
                        }
                        ?></label>

                    </div>

                </div>

                <div class="input-box">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter your email"  name="email" value="<?php
                    if(isset($email)){
                        echo $email;
                    }
                    ?>">

                    <label for="" style="color:red";><?php
                    if(isset( $inputError['email'])){
                        echo  $inputError['email'];
                    }
                    ?></label>

                      <label for="" style="color:red";><?php
                    if(isset( $email_db_match)){
                        echo  $email_db_match;
                    }
                    ?></label>

                </div>

                <div class="input-box">
                    <label>Phone Number</label>
                    <input type="tel" placeholder="Enter phone number" name="phone" value="<?php
                    if(isset($phone)){
                        echo $phone;
                    }
                    ?>">

                <label for="" style="color:red;"><?php
                if(isset($inputError['phone'])){
                    echo $inputError['phone'];
                }
                ?></label>

                      <label for="" style="color:red;"><?php
                if(isset($phone_db_match)){
                    echo $phone_db_match;
                }
                ?></label>

                </div>

                <div class="input-box">
                    <label>Select Course</label>

                    <select  name="course">
                        <option value="">Choose a course</option>
                        <option>Web Development</option>
                        <option>Graphic Design</option>
                        <option>Digital Marketing</option>
                        <option>Programming</option>
                        <option>Computer Fundamentals</option>
                    </select>
                </div>

                <div class="input-row">

                    <div class="input-box">
                        <label>Password</label>
                        <input type="password" placeholder="Create password" name="password" value="<?php
                        if(isset($password)){
                            echo $password;
                        }
                        ?>">

                    <label for="" style="color:red;">
                        <?php
                        if(isset($inputError['password'])){
                            echo $inputError['password'];
                        }
                        ?>
                    </label>

                     <label for="" style="color:red;">
                        <?php
                        if(isset($password_len_check)){
                            echo $password_len_check;
                        }
                        ?>
                    </label>

                    <label for="" style="color:red;">
                        <?php
                        if(isset($password_db_match)){
                            echo $password_db_match;
                        }
                        ?>
                    </label>

                    </div>

                    <div class="input-box">
                        <label>Confirm Password</label>
                        <input type="password" placeholder="Confirm password" name="c_password">

                             <label for="" style="color:red;">
                        <?php
                        if(isset($confirm_password_match)){
                            echo $confirm_password_match;
                        }
                        ?>
                    </label>

                    </div>

                </div>

                <label class="terms">
                    <input type="checkbox"  name="term_condition">
                    <span>I agree to the terms & conditions</span>
                </label>

                <button type="submit" name="regester">
                    Create Account
                    <span>→</span>
                </button>

                <p class="login-text">
                    Already have an account?
                    <a href="#">Login</a>
                </p>

            </form>

        </div>

    </div>

</body>
</html>




