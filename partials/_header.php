    <?php
    session_start();

    echo '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Kash Quora</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Categories
          </a>
          <ul class="dropdown-menu">';
          $sql = "SELECT category_name , category_id  FROM `categories` LIMIT 3";
          $result =mysqli_query($conn,$sql);
          while($row =mysqli_fetch_assoc($result)){

           echo ' <li><a class="dropdown-item" href="/forum/threadlist.php?catid= '.$row['category_id'].' ">'. $row['category_name'].'</a></li>
        ';
          }
         echo ' </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>';

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      echo ' <form class="form-inline my-2 my-lg-0" role="search" action="search.php" method="get">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        <p class="text-light my-0 mx-2">Welcome '.$_SESSION['username'].' </p>
         <a href="partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a>
        </form>';
    } 
    else {
    echo ' <form class="form-inline my-2 my-lg-0" role="search" action="search.php" method="get">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
          
          </form>
          <button class="btn btn-primary ml-2" data-bs-toggle="modal" data-bs-target="#loginmodal">LOGIN</button>
          <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#signupmodal">SIGNUP</button>
         
          ';
    }
    echo ' </div>
    </div>
    
  </div>

</nav>
    ';
    include 'partials/_loginmodal.php';
    include 'partials/_signupmodal.php';
    if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == true) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> You can now login
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == true) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Success!</strong> username or password not correct
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
      


    ?>