<template>
  <div class="">





</div>
</template>

    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"  rel = "stylesheet">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
$(document).ready(function(){

 $('#country_name').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
           url:"autocomplet/fetch",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
          }
         });
        }
    });



});
</script>
