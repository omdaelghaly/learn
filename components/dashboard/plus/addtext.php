<!-- Button trigger modal -->
<button type="button" class="btn btn-primary"  hidden id="addnewtext" data-bs-toggle="modal" data-bs-target="#exampleModaladdtext">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModaladdtext" tabindex="-1" aria-labelledby="exampleModalLabeladdtext" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col text-center">
           <h5 class="modal-title" id="exampleModalLabeladdtext"> معلومات عن المنتج  </h5>

        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0 m-0">
<!--  -->


<form id='WYSINWYE' class="p-1 m-0 ">
  <fieldset id='view' class='text' contenteditable='false' style='display:none'>
  </fieldset>
  <fieldset id='ctrl' class="mb-1 col text-center">
    <button  id='bold' class="btnxedit"><i class="fas fa-bold"></i> </button>
    <button  id='italic' class=" btnxedit"><i class="fas fa-italic"></i> </button>
    <button  id='underline' class=" btnxedit"><i class="fas fa-underline"></i></button>
    <b>|</b>
    <button  id='justifyLeft' class="btnxedit"> <i class="fas fa-align-left "></i></button>
    <button  id='justifyCenter' class=" btnxedit"><i class="fas fa-align-center"></i></button>
    <button  id='justifyRight' class=" btnxedit"><i class="fas fa-align-right" ></i></button>
    <button  id='fontColor' class=" btnxedit"><i class="fas fa-font"></i></button>
    <button  id='fontSize' class=" btnxedit"><i class="fas fa-text-height"></i></button>


<!--     <button id='HTML' class="fas fa-code"></button>
 -->  </fieldset>
  <fieldset id='edit' class='text form-control mt-2 p-3' dir="rtl" contenteditable='true' style="min-height:300px;">
  </fieldset>
</form>


<!--  -->
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">جيد  </button>
<!--         <button type="button" >  </button>
 -->      </div>
    </div>
  </div>
</div>



<style type="text/css">
    form {
  width: 100%;
  height: fit-content;
  font: 400 16px/1.25 Arial;
}

#view {
  background: gold;
  min-height: 100px;
  font: inherit;
  border-top-left-radius: 6px;
  border-top-right-radius: 6px;
}

#ctrl {
  height: 20px;
}

#edit {
  font: inherit;
  font-family: Consolas;
  border-bottom-left-radius: 6px;
  border-bottom-right-radius: 6px;
}

.btnxedit {
  display: inline-block;
  font: inherit;
  width: 36px;
  height: 24px;
  line-height: 24px;
  margin: 0 -2px;
  vertical-align: middle;
  cursor: pointer;
  border-radius: 1px;
}

b:hover,
button:hover {
  color: rgba(205, 121, 0, 0.8);
}

#HTML {
  float: right
}



</style>


<script type="text/javascript">

$('#WYSINWYE').on('submit', function() {
  return false;
});
$('#edit').focus();
$('#edit').on('keyup', function() {
  $('#view').html($(this).text());
      updateData(); // Call the function to update the content in the 'data' div

});

$('#ctrl button').on('click', function() {
  var ID = this.id;
  if (ID === 'HTML') {
    $('#view').slideToggle('750')
    return;
  }

  if (ID === 'fontColor') {
    var color = prompt("Enter a color name or hex code:", "");
    if (color != null && color !== '') {
      document.execCommand('foreColor', false, color);
    }
    return;
  }

  if (ID === 'fontSize') {
    var size = prompt("Enter a font size (e.g., 12px, 1em):", "");
    if (size != null && size !== '') {
      document.execCommand('fontSize', false, size);
    }
    return;
  }

  return document.execCommand(ID, false, null);


});


function updateData() {
    var editorContent = $('#edit').html(); // Get the content of the text editor
    $('#aboutpro').html(editorContent); // Set the content of the 'data' div
}

var aboutproContent =$('#aboutpro').html();
$('#edit').html(aboutproContent);
$('#edit').focus();


</script>

