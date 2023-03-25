<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kash Quora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style2.css">
    <style>
        #ques{
            min-height: 500px;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/_dbconn.php';
    include 'partials/_header.php' ?>

    <div>
    


 <div class="container my-4 " id="ques">
       <h1 class="py-2">Search result for <em>"<?php echo $_GET['search']?>"</em></h1>
       <?php 
       $noresult = true;
       $query = $_GET['search'];
       $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title,thread_desc) against ('$query') ";
       $result = mysqli_query($conn, $sql);
       while ($row = mysqli_fetch_assoc($result)) {

           $title = $row['thread_title'];
           $desc = $row['thread_desc'];
           $noresult = false;
           $thread_id= $row['thread_id'];
           $url="threads.php?threadid=".$thread_id;
           echo '<div class="result">
           <h3><a href="'.$url.'">'.$title.'</a></h3>
           <p>'.$desc.'</p>
           </div>';
       }
       if($noresult){
        echo'
        <div class="jumbotron">
        <p class="display-4">No Result Found</p>
        <p class="lead">Make sure all the words are spelled correctly</p>
    </div>';
       }
       ?>

       
 
        </div>
    </div>

    <?php include 'partials/_footer2.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>