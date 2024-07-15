
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/index.php">
          <i class="bi bi-grid"></i>
          <span style="font-size:23pxz"> User Dash </span>
        </a>

<!-- links -->
      <li class="nav-item productslinks">

     </li>
<!-- -->



<script type="text/javascript">
//       loadPage('./inc/productslinks.php','productlinks','GET',[]);/// default page


    // Function to refresh the content of the div
    function refreshproductslinks() {
        $.ajax({
            url: '/components/inc/productslinks.php',
            type: 'GET',
            success: function(response) {
                // Update the content of the div with the response from PHP
                $('.productslinks').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

 $(document).ready(function() {
    // Call the refreshContent function initially
    refreshproductslinks();
});




</script>
