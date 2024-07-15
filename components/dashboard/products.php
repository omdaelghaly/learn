
<?php
// session_start();
include('./../../classes/All.php');


include './plus/addproducts.php';
include './plus/delete.php';

$catClass = new Cat();
//$funClass = new Fun();

$cats=$catClass->getCatsx('parent_id!=0');


if($cats){

?>


<div class="col p-0 m-0 ">

	<div class="container col text-center">
		<button class="btn btn-primary" id="addproducts"> اضف منتج جديد   </button>
	</div>
	<!-- =============================== -->
	<div class="container col" dir="rtl">
		<div class=" d-flex justify-content-between">
			<div>
				<h4>المنتجات   </h4>
			</div>

			<div>
				<div class="form-control border-0 p-0 m-0">
					<select class="form-select" id='selectedcat' name="selectedcat" aria-label="Default select example">
						<?php
						    $firstcat;
						foreach ($cats as $cat) {
							       if(!$firstcat){
							 	        $firstcat = $cat['id'] ;
							        } ?>

							<option value="<?php echo $cat['id'] ?>"> <?php echo $cat['name'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

		</div>

		<hr class="">

		<div id="products_table">
			   <div class="col text-center " >
                     <span class="spinner-border spinner-border-xl " style="margin-top:50px" role="status" aria-hidden="true"></span>
                </div>
           <!-- cats_table -->
		</div>

	</div>

	<!-- ============================================ -->



</div>

<?php
}else{
	?>

	<div class="container col" dir="rtl">
	  <div class=" d-flex justify-content-between">
			<div>
				<h4>المنتجات   </h4>
			</div>

		</div>
	</div>
  <hr>
         <div class="container col text-center">
         	   يجب عليك اضافة اقسام فرعية اولا.........
         </div>

	<?php
}
?>




<script type="text/javascript">

	// add products////////
	 $('#addproducts').click(()=>{
	 	$("#productsform")[0].reset();
		$('.addproductstitle').html('اضافة منتج جديد ');
		$('.addproductsbtn').html('حفظ المنتج ');
	    $('#process').val('add');
	  	$('#table').val('products');
	  	$('#available').val(1);
		$('.addproducts').click();
	})
	////edit products//////////////////
	function editproduct(cat_id,proname,p,p1,about,old_img,available,id) {
		 $("#productsform")[0].reset();
		 $('.addproductstitle').html('تحرير منتج ');
	    $('.addproductsbtn').html('حفظ التعديل ');
		 $('#process').val('edit');
		 $('#cat_id').val(cat_id);
		 $('#proname').val(proname);
		$('#aboutpro').html(about);
		 $('#price').val(p);
		 $('#price1').val(p1);
		 $('#old_img').val(old_img);
		 var checkbox = document.getElementById('availableChecked');
		 $('#available').val(available);
		 if (available == 1) {checkbox.checked = true;$('.form-check-label').html('<span style="color:green">available</span>');///alert(available);
        }else{  available=0;
        	checkbox.checked = false; $('.form-check-label').html('<span style="color:red">unavailable</span>');};
		 $('#row_id').val(id);//alert(available);
		 $('#table').val('products');
	     $('.addproducts').click();
	 //console.log(cat_id+','+proname+','+p+','+p1+','+','+about+','+old_img+','+available+','+id);

	}
	function deleteproduct(id,cat_id) {
		$('.delx-title').html('حذف عنصر ');
		$('#delx-btn').html('حذف ');
		$('#del_process').val('delete');
		$('#del_table').val('products');
		$('#del_id').val(id);
		$('#cat_id').val(cat_id);
	   $('#url').val('./../../controllers/productsController.php');
		$('#delx').click();
		// console.log(id);
	}


////////load page
      var selectedval=1;  ;
      var cat_id='<?php echo isset($firstcat)?$firstcat:'';?>';
     $('#selectedcat').change(function(){
        cat_id = $(this).val();
     loadPage('./../dashboard/plus/products_table.php?xcat_id='+cat_id+'&selectedval='+selectedval,'products_table','GET',[]);/// onchange

    });
   // alert(selectedval+'--'+cat_id);
	////load products with page
     loadPage('./../dashboard/plus/products_table.php?xcat_id='+cat_id+'&selectedval='+selectedval,'products_table','GET',[]);/// default page



</script>
