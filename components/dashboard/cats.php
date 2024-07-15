
<?php


include './plus/addcats.php';
include './plus/delete.php';

?>


<div class="col p-0 m-0 ">

	<div class="container col text-center">
		<button class="btn btn-primary" id="addcats"> اضافة قسم جديد </button>
	</div>
	<!-- =============================== -->
	<div class="container col" dir="rtl">
		<div class=" d-flex justify-content-between">
			<div>
          		<h4>الاقسام  </h4>
			</div>

			<div>
				<div class="form-control border-0 p-0 m-0">
				      <select class="form-select" id='cattype' name="cattype" aria-label="Default select example">
							<option value="3"> كل الاقسام  </option>
							<option value="1"> الاقسام الرئيسية  </option>
							<option value="2"> الاقسام الفرعية  </option>
					   </select>
				</div>
			</div>

		</div>

		<hr class="">
   <!-- ======================================= -->
		<div id="cats_table">
			   <div class="col text-center " >
                     <span class="spinner-border spinner-border-xl " style="margin-top:50px" role="status" aria-hidden="true"></span>
                </div>
           <!-- cats_table -->
		</div>

	</div>

	<!-- ============================================ -->



</div>






<script type="text/javascript">
	// add cats////////
	$('#addcats').click(()=>{
		$("#catsform")[0].reset();
		$('.addcatstitle').html('اضافة قسم جديد ');
		$('.addcatsbtn').html('حفظ القسم ');
	    $('#process').val('add');
	   	$('#catparent_id').val(0);	//parentid
	  	$('#table').val('cats');
	  	 parent_id=0;	//parentid
		$('.addcats').click();
	})
	////edit cats//////////////////
	function editcat(name,id,select) {
		$("#catsform")[0].reset();
		$('.addcatstitle').html('تحرير قسم ');
		$('.addcatsbtn').html('حفظ التعديل ');
		$('#process').val('edit');
		$('#newdata').val(name);
		$('#row_id').val(id);
		$('#table').val('cats');
		$('#catparent_id').val(select);	//parentid
		if(select && select !=0){
	    		parent_id=select ;	//parentid
	   $('input[name="optionsCat"][value="2"]').prop('checked', true);
	   $('#selectCatDiv').show(); // Show the select Cat
	   	$('#selectCat').val(select); // Show the select Cat
	   }else{
	   $('input[name="optionsCat"][value="1"]').prop('checked', true);
	   $('#selectCatDiv').hide(); // Show the select Cat
	    parent_id =0;
	   }

		$('.addcats').click();
	}
	function deletecat(id) {
		$('.delx-title').html('حذف عنصر ');
		$('#delx-btn').html('حذف ');
		$('#del_process').val('delete');
		$('#del_table').val('cats');
		$('#del_id').val(id);

		$('#delx').click();
		// console.log(id);
	}



    $('#cattype').change(function(){
        parent_id = $(this).val();
     loadPage('./../dashboard/plus/cats_table.php?cattype='+parent_id,'cats_table','GET',[]);
    });
	////load cats with page
     loadPage('./../dashboard/plus/cats_table.php?cattype='+parent_id,'cats_table','GET',[]);/// default page



</script>
