$(document).ready(function () {
  $('#form').validate({
    rules: {
      name: {
        required:true,
        minlength: 2
      },
      lastName: {
        required:true,
        minlength: 2
      },
      email: {
        required:true,
        email:true
      }
    },
    submitHandler: function(){
      $.ajax({
        type: "POST",
        url: "registration_form.php",
        data: $('#form').serialize(),
        success: function(data) {
          $('.messages').html(data);
          $('.user_data').val('');
          
        }
      })
    }
  });
});