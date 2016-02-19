  <script>
	 $(document).ready(function(){
    $(".selectitem").on("click", function(){
  var value =$(this).closest("tr").find('#name').text();
  $("#text").val(value) ;
    });
});</script>