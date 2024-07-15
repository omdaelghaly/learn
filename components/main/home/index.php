<?php

   $env = new Env;
   $funClass = new Fun;
   $productClass = new Product();


?>

<div class="col-12 d-flex justify-content-between"  >
   <div class="pagetitle " id="btnselectedval">
    <div class="form-control border-0 p-0 m-0">
       <select class="form-select" id='selectedval' name="selectedval" aria-label="Default select example">

        <option value="1"> الاحدث  </option>
        <option value="2">الاقدم  </option>
        <option value="3">  الاعلى سعرا </option>
        <option value="4"> الاقل سعرا </option>
     </select>
  </div>
</div>

<div id="btnbackpage">

</div>

<div>

      <h4 id="product_x_title">
         ......
      </h4>

</div>

</div>
<!-- End Page Title -->

<section class="section dashboard ">
   <div class="row ">

    <!-- Left side columns -->
    <div class="col-12 " >
     <div class="row" >


      <!-- =============================posts========================== -->
      <div class="realtimeProductsDiv col-12 p-0 m-0" >

         <div class="col-12 text-center " style="min-height:300px" >
            <span class="spinner-border spinner-border-xl " style="margin-top:50px" role="status" aria-hidden="true"></span>

         </div>


      </div>
   </div>
</div><!-- End Left side columns -->

<!-- ================================================================ -->


</div>
</section>











<script>
  let selectedval=1;
     $('#selectedval').change(function(){
        selectedval = $(this).val();
        refreshpro(xcat_id,selectedval);
        //console.log(xcat_id+'--'+selectedval);
    });


 //    // Function to refresh the content of the div
    function refreshpro(cat_id,selectedval) {
       $.ajax({
         url: '/components/main/home/products.php/?xcat_id=' + xcat_id + '&selectedval=' + selectedval,
         type: 'GET',
         success: function(response) {
                $('.realtimeProductsDiv').html(response);
             },
             error: function(xhr, status, error) {
              //console.error(xhr.responseText);
           }
        });
        $('#btnselectedval').show();
        $('#btnbackpage').html(` `);

    }
    
 //    $(document).ready(function() {
 //    // Call the refreshContent function initially
 //    refreshContent('<?php //echo$xcat_id; ?>');
 // });
     function loadOnePro(cat_id,pro_id) {

       $.ajax({
         url: '/components/main/home/onePro.php/?xcat_id='+cat_id+'&pro_id='+pro_id ,
         type: 'GET',
         success: function(response) {
                $('.realtimeProductsDiv').html(response);
                $('#btnselectedval').hide();
             $('#btnbackpage').html(` <a onclick="refreshpro(${cat_id}, 1)" href="#">
            <i class="fas fa-arrow-left"></i><span>back</span></a>  `);

             },
             error: function(xhr, status, error) {
              console.error(xhr.responseText);
           }
        });
       //console.log(cat_id+'-'+pro_id);
    }

    





///////////////////


// socket.on('new_post_s',(data)=>{
//   refreshContent();

//   console.log('posts refresh');

// })



</script>

