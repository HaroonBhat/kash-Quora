<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kash Quora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/contactus.css">
</head>

<body class="bg">
    <?php
    include 'partials/_dbconn.php';
    include 'partials/_header.php' ?>
    <?php

    $insert = false;


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {



        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];


        $sql = "INSERT INTO `contact` ( `full name`, `email`, `phone no`, `message`) VALUES ( '$name', '$email', '$phone', '$message')";

        $result = mysqli_query($conn, $sql);
        if ($result) {

            $insert = true;
        } else {
            echo "We  could not update the record successfully";
        }
    }
    ?>

    <?php


    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show'  role='alert'>
  <strong>Success !</strong> Your report have been submited successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    }
    ?>
    </div>

    <div class="container contact_zero">

        <h1 class="contact_one">Contact Us</h1>
        <br>
        <p class="contact_two"> Enter your details</p>
        <div>
            <form action="contact.php" method="POST" class="contact_three">
                <label for="text" class="contact_four">YOUR NAME</label>
                <input type="text" name="name" id="name" placeholder="Full Name" required="true"><br>
                <label for="Email" class="contact_four">EMAIL ADDRESS</label><br>
                <input type="email" name="email" id="email" placeholder="Eg. example@gmail.com"><br>
                <label for="Phone Number" class="contact_four">PHONE NUMBER</label><br>
                <input type="text" name="phone" id="phone" placeholder="Eg +1800000000" required="true" minlength="10" maxlength="10" onkeypress="return onlyNumberKey(event)"><br>
                <label for="message" class="contact_four">MESSAGE</label><br>
                <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your comments"></textarea>
                <button type="submit" class="btn end ">Submit</button>

            </form>
        </div>

    </div>

    <script>
        function onlyNumberKey(evt) {

            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>
    <?php include 'partials/_footer2.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>