


    <div class="d-flex align-items-center justify-content-between">
      <a href="/index.php" class="logo d-flex align-items-center">
        <img src="/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">
        <?php echo Env::siteName; ?>
        </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
<!-- bell -->

        <li class="nav-item dropdown"  id="nav_orders_list">


        </li><!-- End Notification Nav -->
<!--cart  -->

        <li class="nav-item dropdown" id="nav_cookies_order">

        </li><!-- End Messages Nav -->



<!--  -->
        <li class="nav-item dropdown" id="userschatlistnav">
         <?php
           // include('userschatNav.php');
         ?>
        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

     <?php if(isset($_SESSION['email'])) { ?>
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="./../profiles/index.php" data-bs-toggle="dropdown">
            <img src="/assets/images/profiles/<?php echo $_SESSION['image'] ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">
            <?php echo $_SESSION['name']? $_SESSION['name']:' ';?>
            </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo isset($_SESSION['name'])? $_SESSION['name']:' ';?></h6>
              <span><?php echo isset($_SESSION['job'])? $_SESSION['job']:' ';?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center"  href="/components/profiles/index.php" >
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
<?php
 if(isset($_SESSION['id'])&& (int)$_SESSION['level']===1){
?>
            <li>
              <a class="dropdown-item d-flex align-items-center"  href="/components/dashboard/index.php" >
                <i class="bi bi-gear"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
<?php
}
?>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/components/myorders/index.php
              ">
                <i class="bi bi-cart"></i>
                <span>my orders </span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#" id="logoutBtn">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
<?php }else{ ?>
        </li><!-- End Profile Nav -->

   <a class="nav-link nav-profile d-flex align-items-center pe-0" href="/components/auth/index.php" >
            <span class=" ps-2">login</span>
          </a><!-- End Profile Iamge Icon -->


          <?php } ?>






      </ul>
    </nav><!-- End Icons Navigation -->


<script>
$(document).ready(function(){
    $('#logoutBtn').click(function(e){
        e.preventDefault(); // Prevent default action of the link
        
        // AJAX request
        $.ajax({
            url: './../../controllers/logout.php',
            type: 'GET',
            success: function(response) {
              var res = JSON.parse(response);
                  console.log(res);
                // Redirect to the desired location
                window.location.href = '/';
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    });
});






</script>

