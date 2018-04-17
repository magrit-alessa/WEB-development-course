
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

  <form id ="events" action="#" method="POST">
       <input type="text" name="name" class="value"placeholder="Имя">
       <input type="text" name="lastName" class="value" placeholder="Фамилия">
       <input type="text" name="email" class="value" placeholder="email">
       <br>

       <p>Тип билета:</p>
       <select name="tickets">
         <option value="free">free</option>
         <option value="standart">standart</option>
         <option value="premium">premium</option>

       </select>

       <button type="submit">Отправить</button>
       <p class = "result"></p>
  </form>
  <?php
 
  $link = '127.0.0.1:3306';
  $userName = 'root';
  $password = 'root';
  $db = "events";
  $name = $lastName = $email = $typeTickets = " ";
  $pattern_email = "/[a-zA-Z0-9\-\_]{1,50}[@]{1}[a-zA-Z0-9]{2,20}[\.]{1}[a-zA-Z0-9]{2,15}/";
  
  function validate_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  };

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  $connect= mysqli_connect($link, $userName ,$password ) or die('Erorr connect');
  
    if(!mysqli_select_db($connect, $db)){

      mysqli_query($connect,"CREATE DATABASE $db");
      $connect = mysqli_connect($link, $userName ,$password, $db);

       mysqli_query($connect,"CREATE TABLE EventsOrders( 
          Name CHAR(25) NOT NULL,
          Last_Name CHAR(25) NOT NULL,
          Email CHAR(50) NOT NULL,
          Type_of_ticket CHAR(25) NOT NULL
          )
        ");

    }else{
      $connect = mysqli_connect($link, $userName ,$password, $db);
    };

  if(empty($_POST["name"]) || empty($_POST["lastName"]) || empty($_POST["email"]) ){

  die ("Заполните все поля!");
};
if(preg_match($pattern_email , $_POST["email"] )){
  $name = validate_input($_POST["name"]) ;
  $lastName = validate_input($_POST["lastName"]) ;
  $email = validate_input($_POST['email']);
  $typeTickets = validate_input($_POST["tickets"]);

  $testEmail = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM EventsOrders WHERE Email = '$email'"), MYSQLI_NUM);
  if(!empty($testEmail)){
    die("email address already exists");
  };
  mysqli_query($connect,"
      INSERT INTO EventsOrders( Name, Last_Name, Email, Type_of_ticket)
      VALUES ('$name', '$lastName', '$email', '$typeTickets')
        ");
  
}else{
die("Invalid email");
};
 mysqli_close($connect); 
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
