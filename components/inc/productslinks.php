 
<?php
include('./../../classes/All.php');
?>
<!-- ======================================================================================== -->
<?php
    $catClass = new Cat();
    $parentCategories = $catClass->getsubcats();

    $i=1;
    foreach ($parentCategories as $parentCat) {
?>

    <a class="nav-link collapsed" data-bs-target="#subcat_<?php echo $parentCat['id']; ?>" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span><?php echo $parentCat['name']; ?></span>
        <i class="bi bi-chevron-down ms-auto"></i>
    </a>

    <ul id="subcat_<?php echo $parentCat['id']; ?>" class="nav-content collapse productslinks" data-bs-parent="#sidebar-nav">
        <?php
        // Display subcategories under this parent category
        foreach ($parentCat['subcats'] as $subCat) {
        ?>
            <li>
                <a id="li_<?php echo $i; ?>" onclick="loadindexproducts('<?php echo $subCat['id']; ?>')" href="#">
                    <i class="bi bi-circle"></i><span><?php echo $subCat['name']; ?></span>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>

<?php
     $i++;
    }
?>

<!-- ============================================================================================ -->
<script type="text/javascript">
  $(document).ready(()=>{
    $('#li_1').click();
  })

let xcat_id='';
  function loadindexproducts(cat_id){
     refreshContent(cat_id);
     //console.log(cat_id);
     xcat_id = cat_id;

  }

    function refreshContent(xcat_id) {
       let selectedval =1;
       $.ajax({
         url: '/components/main/home/products.php?xcat_id='+xcat_id+ '&selectedval=' + selectedval,
         type: 'GET',
         success: function(response) {
                // Update the content of the div with the response from PHP
                $('.realtimeProductsDiv').html(response);
             },
             error: function(xhr, status, error) {
              console.error(xhr.responseText);
           }
        });
    }

    $(document).ready(function() {
    // Call the refreshContent function initially
    // refreshContent();
 });
</script>
