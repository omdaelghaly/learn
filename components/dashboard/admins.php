
<?php


// include './plus/addcats.php';
// include './plus/delete.php';

?>


<div class="col p-0 m-0 ">

	<div class="container col text-center" dir="rtl">

		  <form>
                <div class="row mb-3">
                  <label for="search" class="col-sm-2 col-form-label">Search</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="search" placeholder="Search by email....">
                  </div>
                </div>
        </form>
	</div>
	<!-- =============================== -->
	<div class="container col" dir="rtl">
		<h4 id="users_admin_title">users/admins </h4>
		<hr class="">

		<div id="admins_table">
			   <div class="col text-center " >
                     <span class="spinner-border spinner-border-xl " style="margin-top:50px" role="status" aria-hidden="true"></span>
                </div>
           <!-- cats_table -->
		</div>

	</div>

	<!-- ============================================ -->



</div>






<script type="text/javascript">

$(document).ready(function(){
    $('#search').keyup(function(){
              //console.log($(this).val());
          if($(this).val()){
            $('#users_admin_title').html('users/admins');
             let email = $(this).val();
          	loadPage('./../dashboard/plus/admins_table.php?table=users&column=email&columnData='+email,'admins_table','GET',[]);/// default page



          }else{
          	 $('#users_admin_title').html('admins');
          	loadPage('./../dashboard/plus/admins_table.php?table=users&column=level&columnData=1','admins_table','GET',[]);/// default page
          }
    });


     $('#users_admin_title').html('admins');
     loadPage('./../dashboard/plus/admins_table.php?table=users&column=level&columnData=1&email=null','admins_table','GET',[]);/// default page
});








</script>
