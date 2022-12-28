var count=0;
$(function () {
    count=$('form .extras > .form-group').length;
    $('#create >div >div> form #category').on('change',function(){
        var catid=$(this).val();
      if(catid!='') {
        $.ajax({
          type: "GET",
          url: document.location.origin+"/admin/get/services/"+catid,
          data: {category_id:catid},
          success: function(data){
              $('#create >div >div> form #service').html(data);
          }, error: function (error) {
            console.log(error);
            alert('Oops, system encountered an problem');
          }
		});
      }
    });
    $('form #extra').on("change",function(){
        extra=false;
       if($(this).val()==1) {
           extra=true;
       }
       if(extra) {
           fiels=$('form .extras > .form-group').length;
           $('form .extras').addClass("exta-style");
           $('form .extras').append('<div class="form-group child-extra'+count+'" style="display:none;">\n'+
                            '<input type="text" class="form-control" name="extras[]" placeholder="Enter Value" id="child-extra'+count+'" /><input type="number" class="form-control" name="prices[]" placeholder="Enter Price" id="price-extra'+count+'" /><button type="button" class="addbtn btn btn-success btn-sm add'+count+'" onclick="addmore('+count+')">Add More</button><button type="button" class="removebtn btn btn-danger btn-sm remove'+count+'" onclick="remove('+count+')">Remove</button>\n'+
                        '</div>');
            $('form .extras > .form-group.child-extra'+count).slideDown(300);
            count++;
       } else {
           $('form .extras > .form-group').slideUp(300,function(){
              $('form .extras').html(''); 
              $('form .extras').removeClass("exta-style");
           });
       }
    });
    $('form #customfield').on("change",function(){
        custom=false;
      if($(this).val()==1) {
          custom=true;
      }
      if(custom) {
          fiels=$('form .custom_field_data > .form-group').length;
          $('form .custom_field_data').addClass("exta-style");
          $('form .custom_field_data').append('<div class="form-group flex field-extra'+count+'"><input name="customfields[]" class="form-control" id="customfield_name'+count+'" value="" placeholder="Enter Field Title" /><button type="button" class="addbtn btn btn-success btn-sm add'+count+'" onclick="addmorefield('+count+')">Add More</button><button type="button" class="removebtn btn btn-danger btn-sm remove'+count+'" onclick="removefield('+count+')">Remove</button></div>');
            $('form .custom_field_data').slideDown(300);
      } else {
          $('form .custom_field_data').slideUp(300,function(){
              $('form .custom_field_data').html(''); 
              $('form .custom_field_data').removeClass("exta-style");
          });
      }
    });
    $('#view').on('hidden.bs.modal',function(){
        $('#view .modal-body').html('<span class="text-center" style="display:block;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>');
    });
});
function addmore(id) {
   fiels=$('form .extras > .form-group').length;
   $('form .extras > .form-group').each(function(){
        $(this).find('.addbtn').remove();
   });
   $('form .extras').append('<div class="form-group child-extra'+count+'" style="display:none;">\n'+
                    '<input type="text" class="form-control" name="extras[]" placeholder="Enter Value" id="child-extra'+count+'" /><input type="number" class="form-control" name="prices[]" placeholder="Enter Price" id="price-extra'+count+'" /><button type="button" class="addbtn btn btn-success btn-sm add'+count+'" onclick="addmore('+count+')">Add More</button><button type="button" class="removebtn btn btn-danger btn-sm remove'+count+'" onclick="remove('+count+')">Remove</button>\n'+
                '</div>');
    $('form .extras > .form-group.child-extra'+count).slideDown(300);
    count++;
}
function remove(id) {
    if($('form .extras > .form-group.child-extra'+id+' > .addbtn').length) {
        $('<button type="button" class="addbtn btn btn-success btn-sm add'+id+'" onclick="addmore('+id+')">Add More</button>').insertAfter('form .extras > .form-group:nth-last-child(2) > input[type=number]');
    }
    $('form .extras > .form-group.child-extra'+id).remove();
}
function addmorefield(id) {
   fiels=$('form .custom_field_data > .form-group').length;
   $('form .custom_field_data > .form-group').each(function(){
        $(this).find('.addbtn').remove();
   });
   $('form .custom_field_data').append('<div class="form-group flex field-extra'+count+'" style="display:none;"><input name="customfields[]" class="form-control" id="customfield_name'+count+'" value="" placeholder="Enter Field Title" /><button type="button" class="addbtn btn btn-success btn-sm add'+count+'" onclick="addmorefield('+count+')">Add More</button><button type="button" class="removebtn btn btn-danger btn-sm remove'+count+'" onclick="removefield('+count+')">Remove</button></div>');
    $('form .custom_field_data > .form-group.field-extra'+count).slideDown(300);
    count++;
}
function removefield(id) {
    if($('form .custom_field_data > .form-group.field-extra'+id+' > .addbtn').length) {
        $('<button type="button" class="addbtn btn btn-success btn-sm add'+id+'" onclick="addmorefield('+id+')">Add More</button>').insertAfter('form .custom_field_data > .form-group:nth-last-child(2) > input');
    }
    $('form .custom_field_data > .form-group.field-extra'+id).remove();
}
function view(id) {
    $.ajax({
      type: "GET",
      url: document.location.origin+'/admin/seo-services/'+id+'/render',
      success: function(data){
    	$('#view .modal-body').html(data);
    	$('#view .modal-body').slideDown(300);
      }, error: function (error) {
        console.log(error);
        alert('Oops!, System encountered an problem');
      }
	});
}
function showservices(catid,pid){
  if(catid!='') {
    $.ajax({
      type: "GET",
      url: document.location.origin+"/admin/get/services/"+catid,
      data: {category_id:catid},
      success: function(data){
          $('div#edit'+pid+' >div >div> form #service').html(data);
      }, error: function (error) {
        console.log(error);
        alert('Oops, system encountered an problem');
      }
	});
  }
}