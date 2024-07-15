

<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>
        <?php echo Env::siteName; ?>
       </span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
       powered by <a href="#">
        <?php echo Env::auther; ?>
       </a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script type="text/javascript">
          loadPage('./../../components/main/home/navcookiesorder.php','nav_cookies_order','GET',[]);


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
</script>
