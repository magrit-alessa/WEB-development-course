
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

  <form id ="events" action="OlesyaBlumenko.php" method="post">
       <input type="text" name="name" id ="name" placeholder="Имя">
       <input type="text" name="lastName" id ="lastName" placeholder="Фамилия">
       <input type="text" name="email" id ="email" placeholder="email">
       <br>

       <p>Тип билета:</p>
       <select name="tickets">
         <option value="free">free</option>
         <option value="standart">standart</option>
         <option value="premium">premium</option>

       </select>

       <button type="submit">Отправить</button>
  </form>
  <?php

  $name = $lastName = $email = $typeTickets = " ";

  $pattern_email = "/[a-zA-Z0-9\-\_]{1,50}[@]{1}[a-zA-Z0-9]{2,20}[\.]{1}[a-zA-Z0-9]{2,15}/";
  
  function validate_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $date = date("d_m_Y");
  $file = "registration_".$date.".txt";
  $file = fopen($file, "a+");

  if(empty($_POST["name"]) || empty($_POST["lastName"]) || empty($_POST["email"]) ){

  die ("Заполните все поля!");
};
if(preg_match($pattern_email , $_POST["email"] )){
  if(strpos(file_get_contents("registration_".$date.".txt"), $_POST['email'])){
    die("email address already exists");
  };
  $name = validate_input($_POST["name"]) ;
  $lastName = validate_input($_POST["lastName"]) ;
  $email = validate_input($_POST['email']);
  $typeTickets = validate_input($_POST["tickets"]);
  fwrite($file, "Name: $name ; Last Name: $lastName ; email: $email ; Type of ticket: $typeTickets \n");
}else{
die("Invalid email");
};
};

  ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
$("#events").validate({
  rules:{
    name:{
      required: true,
      minlength: 2
    },
    lastName:{
      required: true,
      minlength: 2

    },
    email: {
    required: true,
    email: true
    },
    ticket: {
    required: true
  }
  }

});
});

</script>


</body>
</html>
