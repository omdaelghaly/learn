<?php
// session_start();
include('./../../classes/All.php');
$url = new Url();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo Env::siteName; ?>   </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<!-- ========nav links========= -->
<?php
 include('./../../components/inc/navLinks.php');

?>
  
</head>

<body >
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
<?php
include('./../../components/inc/nav.php')
?>
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
<?php
include('./../../components/inc/sidebar.php')
?>
  </aside><!-- End Sidebar-->



<!-- =========== -->
  <main id="main" class="main " >

<div class="col-12 p-0 m-0" id="my_orders">

    <div class="col-12 text-center " style="min-height:300px" >
        <span class="spinner-border spinner-border-xl " style="margin-top:50px" role="status"
            aria-hidden="true">
        </span>
    </div>



</div>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include('./../../components/inc/footer.php');
  ?>


  <!-- Vendor JS Files -->
 <!-- ========footer links=========== -->
<?php
include('./../../components/inc/footerLinks.php');
?>

</body>

</html>

<script type="text/javascript">



function loadPage(url, elementId, method, data) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        success: function(response) {
            $('#'+elementId).html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error loading page:', error);
        }
    });
}
loadPage('./../../components/myorders/myorders.php','my_orders','GET',[]);
loadPage('./../../components/myorders/nav_orders_list.php','nav_orders_list','GET',[]);

</script>
