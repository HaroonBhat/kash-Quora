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
        #ques {
            min-height: 500px;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/_dbconn.php';
    include 'partials/_header.php' ?>
    <?php
    $id = $_GET['threadid'];
    $method = $_SERVER['REQUEST_METHOD'];
    $showalert = false;
    if ($method ==  'POST') {
        $comment = $_POST['comment'];
        $sno = $_POST['sno'];
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showalert = true;
        if ($showalert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your comment has been added! 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
    }

    ?>
    <div class="container my-4 " id="ques">

        <div class="row my-4">


            <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {

                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_user = $row['thread_user_id'];
                $sql2 =  "SELECT user_name FROM `users` where sno=$thread_user ";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
            }

            ?>

            <div class="container my-4 text-center">
                <div class="jumbotron">
                    <h1 class="display-4"><?php echo  $title ?></h1>
                    <p class="lead"><?php echo  $desc ?></p>
                    <hr class="my-4">
                    <p>
                    <pre>
                 Forum Rules
                1. No Spam / Advertising / Self-promote in the forums
                2. Do not post “offensive” posts, links or images
                3. Remain respectful of other members at all times
                4. Do not cross post questions</pre>
                    </p>
                    <p class="text-left"><b><?php echo 'POSTED BY :- ' . $row2['user_name'] . ''; ?></b></p>
                </div>
            </div>

        </div>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<div class="container mb-4">
            <h1 class="py-2">Post a comment</h1>
            <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">

                <input type="hidden" name="sno" value="">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Type your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required="true"></textarea>
                    <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '"> 
                </div>
                <button type="submit" class="btn btn-success">POST COMMENT</button>
            </form>
        </div>';
        } else {
            echo " 
            <h1 class='py-2 text-center'>Post a comment</h1>
            <p class= 'text-center display-4 mb-4'>You need to be logged in to post comments. </p>
            ";
        }

        ?>

        <div class="container" id="ques">
            <h2>DISCUSSION</h2>
            <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
            $result = mysqli_query($conn, $sql);
            $noresult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $noresult = false;
                $comment_time = $row['comment_time'];
                $comment_by = $row['comment_by'];
                $sql2 =  "SELECT user_name FROM `users` where sno=$comment_by ";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                echo '<div class="media my-3 mt-4">
                    <img src="img/guest img.jpg" width="54px" class="mr-3" alt="...">
                    <div class="media-body">
                    
                        ' . $content . '        
                        </div>
                        <p class="font-weight-bold my-0">Comment By: ' . $row2['user_name'] . ' [' . $comment_time . ']</p>
                </div>';
            }
            if ($noresult) {
                echo '<div class="jumbotron jumbotron-fluid">
                                    <div class="container">
                                        <p class="display-2">No Comments Found</p>
                                        <p class="lead"> Be the first person to comment</p>
                                    </div>
                                 </div> ';
            }

            ?>

        </div>
    </div>
            <?php
             if($_SERVER['REQUEST_METHOD'] == 'POST'){

             $sql3 =  "SELECT user_email FROM `users` where sno=$comment_by ";
             $result2 = mysqli_query($conn, $sql3);
             $row2 = mysqli_fetch_assoc($result2);
             $email= $row2['user_email'];

                $to      = "$email";
                $subject = "$title";
                $message = 'Your question is answered';
                
                $headers = 'From: lonereyan600@gmail.com' . "\r\n" .
                'Reply-To: $to' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                
                mail($to, $subject, $message, $headers);
            }
            // else {
            //     echo "<h1>not working</h1>";
                
            // }
            ?>

            

    <?php include 'partials/_footer2.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>