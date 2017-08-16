@if(session()->has('flash_message'))
	<script>
	  swal({
	    title: "{{session('flash_message.title')}}",
	    text: "{{session('flash_message.message')}}",
	    type: "{{session('flash_message.level')}}",
	    timer: 3000,   
	    showConfirmButton: false
	  });
	</script>
@endif

@if(session()->has('flash_message_overlay'))
	<script>
	  swal({
	    title: "{{session('flash_message_overlay.title')}}",
	    text: "{{session('flash_message_overlay.message')}}",
	    type: "{{session('flash_message_overlay.level')}}",
	    confirmButtonText: 'Okay'
	  });
	</script>
@endif

@if(session()->has('flash_message_confirm'))
<script>
	swal({
	  title: "{{session('flash_message_confirm.title')}}",
	  text: "{{session('flash_message_confirm.message')}}",
	  type: "{{session('flash_message_confirm.level')}}",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Confirm",
	  closeOnConfirm: false
},
function(){
  swal("Done!", "", "success");
});
</script>
@endif

<script>
		$('#btn-submit').on('click',function(e, params){
	    var localParams = params || {};

	    if (!localParams.send) {
	      e.preventDefault();
	    }
	    var form = $(this).parents('form');
	    swal({
	        title: "Are you sure?",
	        text: "Please confirm the details are correct before submitting",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, Am Sure.",
	        closeOnConfirm: true
	    }, function(isConfirm){
	        if (isConfirm) {
          $(e.currentTarget).trigger(e.type, {'send': true});
        }
	    });
	});
</script>

<script>
		$('#btn-submit1').on('click',function(e, params){
	    var localParams = params || {};

	    if (!localParams.send) {
	      e.preventDefault();
	    }
	    var form = $(this).parents('form');
	    swal({
	        title: "Are you sure?",
	        text: "Please confirm the details are correct before submitting",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Yes, Am Sure.",
	        closeOnConfirm: true
	    }, function(isConfirm){
	        if (isConfirm) {
          $(e.currentTarget).trigger(e.type, {'send': true});
        }
	    });
	});
</script>


