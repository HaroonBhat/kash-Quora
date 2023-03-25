<?php
    $showalert=false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        include '_dbconn.php';

        $username=$_POST['username'];
        $pass =$_POST['loginpass'];

        $sql = "SELECT * FROM `users` where user_name= '$username'";
        $result = mysqli_query($conn,$sql);
        $numrows = mysqli_num_rows($result);
        if($numrows==1){
            $row = mysqli_fetch_assoc($result);
                if(password_verify($pass, $row['user_pass'])){
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['sno'] = $row['sno'];
                    $_SESSION['username'] = $username;
                    header("location: /forum/index.php");
                }
                else{
                    header("Location: /forum/index.php?loginsuccess=false&error=$showError");
                }

                
              

        }
        else{
            header("Location: /forum/index.php?loginsuccess=false&error=$showError");
        }
    }
