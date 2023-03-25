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

    <div id="carouselExampleFade" class="carousel slide carousel-fade " data-bs-ride="carousel">
        <div class="carousel-inner " style="height: 500px ">
            <div class="carousel-item active">
                <img src="img/img 1.jpg" class="d-block w-100 h-50 d-inline-block" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/img 2.jpg" class="d-block w-100 h-50 d-inline-block" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/img 3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    </div>
    <div class="container my-4 mt-4" id="ques">
        <h2 class="text-center my-4">Kash Quora - Browse Categories</h2>
        <div class="row my-4">

            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {

                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_description'];
                echo '<div class="col-md-4 my-2">
                  <div class="card" style="width: 18rem;">
                      <img src="img\cardimg-' .$id . '.jpg" class="card-img-top" style="max-height: 180px;" alt="image for this category">
                      <div class="card-body">
                          <h5 class="card-title"><a href="threadlist.php?catid=' . $id . '">' . $cat . '</a></h5>
                          <p class="card-text">' . substr($desc, 0, 90) . '... </p>
                          <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary">View Threads</a>
                      </div>
                  </div>
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