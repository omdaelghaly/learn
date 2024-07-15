<?php

include('./../../../classes/All.php');
session_start();

   $env = new Env;
   $funClass = new Fun;
   $productClass = new Product();

  $xcat_id= isset($_GET['xcat_id'])? $_GET['xcat_id'] :0 ;
  $selectedval= isset($_GET['selectedval'])? $_GET['selectedval'] :0 ;


$products=$productClass->getProducts($xcat_id,$selectedval);
  $fielddata=$productClass->getColumnData('cats','name',$xcat_id);

?>

<div class="col-12 " dir="rtl" style="background: ">
 <div class="row col-12 p-0 m-0  justify-content-center">

<?php
// //////////////////////////////


   if($products){

   foreach($products as $product){

?>

<div class="px-2 py-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xsm-12 product " >
  <div class="card " onclick="productPage('<?php echo $xcat_id ?>','<?php echo $product['id'] ?>')" >

    <img draggable="false" style="height:300px"
    src="/assets/images/products/<?php echo isset($product['image'])?$product['image']:'default.jpg';?>" class="img-rounded card-img-top" alt="...">
    <div class="card-body">
      <div class="w-full overflow-hidden ps-0 pe-2.5 lg:ps-2.5 xl:ps-4 xl:pe-4"><h4 class="text-heading mb-1  font-semibold text-sm md:text-base" style="overflow:hidden;white-space:nowrap;text-overflow: ellipsis;">
                <?php echo isset($product['name'])?$product['name']:'';?>
                               </h4>
     <div class=" text-heading mr-1 mt-1.5 text-sm font-semibold space-s-2 sm:text-base lg:mt-2.5 lg:text-lg">
              <span class="mx-2">
                     <?php echo isset($product['price_after'])?$product['price_after']:'' ?>  ج.م
            </span>

      <del class="font-normal text-gray-800 sm:text-base mx-1">
            <?php echo isset($product['price_before'])?$product['price_before']:'' ?>  ج.م

       </del>
     </div>
    </div>
    </div>
    <div class="card-footer">
      <small class="text-muted"><?php echo $funClass->getTime($product['time'])  ?></small>
    </div>
   </div>
</div>
    
  <?php
   }//end foreach

 }else{ //no products

  ?>


                <div class="col text-center d-flex justify-content-center align-items-center " style="min-height:300px;" >
                           <span class=" p-2 " style="">
                            <h5>لم يتم اضافة اى منتجات فى هذا القسم حتى الان .....</h5>
                                 </span>
                </div>


<?php
 }
  ?>



<style type="text/css">
  .product{
    transition: transform 0.3s ease;
  }
  .product:hover {
    transform: scale(1.05);
    cursor:pointer ;
}
</style>
<script type="text/javascript">
  //console.log("<?php //echo $xcat_id.'-ok_'.$selectedval;?>");

       $("#product_x_title").text('<?php echo $fielddata; ?>');

</script>
<script type="text/javascript">
  function productPage(cat_id,product_id){
        loadOnePro(cat_id,product_id);
  }





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
loadPage('./../../components/myorders/nav_orders_list.php','nav_orders_list','GET',[]);





</script>
