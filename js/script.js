$(document).ready(function(){
        $(".view").click(function(e){
          e.preventDefault();
          var ssss = $(this).closest('tr').find('.val').text();
          // console.log(value);

          $.ajax({
            type:'post',
            url:'code.php',
            data:{
              'check_view':true,
              's_name': ssss,
            },
            success: function(response){
              // console.log(response);

              $('.view_data').html(response);
              $('#view').modal('show');
            }
          });
        });
      });