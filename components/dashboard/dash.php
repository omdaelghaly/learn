<?php
// // session_start();
// include('./../../classes/All.php');
// $url = new Url();
// $funClass = new Fun;


?>


<head>
 
  <style>
      .sidebarDash {
      position: fixed;
      top: 125px; /* Adjust the top position to account for the navbar */
      right: 0;
      bottom: 0;
      width: 200px;
      z-index: 5;
      background-color: #fff;
      padding: 20px;
      overflow-x: hidden;
      transition: all 0.3s ease-in-out;

    }

    .sidebarDash.collapsed {
      right: -200px;

    }

    .content {
      margin-top: 56px; /* Adjust the top margin to account for the navbar */
      margin-right:0px;
      padding: 20px;
      position: relative;
    }

    .content.expanded {
      margin-right: 0;
    }

  </style>



  <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-0 m-0 justify-content-between">
    <a class="navbar-brand col text-center" id="settingTitle" href="#"> 
    الاعدادات  
   </a>
    <button class="navbar-toggler toggleSidebarDash" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"  >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav"  >
      <ul class="navbar-nav m-auto text-center" >
        <li class="nav-item" >
<!--           <a class="nav-link" href="#" id="settingTitle" style="color:white">الرئيسية</a>
 -->        </li>
       
      </ul>
      <button class="btn btn-primary " id="toggleSidebarDash" style="display:block;margin-left:auto;margin-right:5px  ;">
      <span class="navbar-toggler-icon" ></span>
      <button>
    </div>

  </nav>
<!-- end nav========================================================= -->
  <!-- ===========================content page===================== -->
  <div class="content  " style="min-height:300px" id="contentDash" >
        <div class="col text-center mt-5">
          <button class="btn btn-primary" >
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading... 
          </button>
        </div>
  </div>
<!-- ===================================================== -->
  <div class="sidebarDash col text-center" style="">
    <h3>القائمة</h3>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="getDashPage(event,'cats')"> الاقسام  </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="getDashPage(event,'products')" > المنتجات   </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="getDashPage(event,'admins')"> الترقية  </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="getDashPage(event,'orders')"> الطلبات  </a>
      </li>

    </ul>
  </div>

  <script>
    ///nav
    const sidebarDash = document.querySelector('.sidebarDash');
    const content = document.querySelector('.content');
     const toggleSidebarDashBtn = document.getElementById('toggleSidebarDash');

    toggleSidebarDashBtn.addEventListener('click', () => {
      sidebarDash.classList.toggle('collapsed');
      content.classList.toggle('expanded');
    });

    $('.toggleSidebarDash').click(()=>{
      $('#toggleSidebarDash').click();
    })
    ///end nav
    ///route page
   function getDashPage(e,page){ //onclick load page
    e.preventDefault();
     loadPage('./'+page+'.php','contentDash','GET',[]);
     $('#settingTitle').html(event.target.textContent);
   }
     loadPage('./cats.php','contentDash','GET',[]);/// default page




    ///function load page
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

