
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

  <form id ="events" action="#" method="post">
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
   
   abstract class ValidateForm{
     
     function validate_form($uName, $uLastName, $uEmail){
      if(empty($uName) || empty($uLastName) || empty($uEmail) ){

        die ("Заполните все поля!");

          };
        if(!preg_match("/[a-zA-Z0-9\-\_]{1,50}[@]{1}[a-zA-Z0-9]{2,20}[\.]{1}[a-zA-Z0-9]{2,15}/" , $uEmail)){
            die("Invalid email");
            };

        $uName =trim($uName);
        $uLastName =trim($uLastName);
        $uEmail=trim($uEmail);
}
}


class FileTXT extends ValidateForm{
  
  function filetxt(){
    $date = date("d_m_Y");
    $file = "registration_".$date.".txt";
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $file = fopen($file, "a+");
  $this->validate_form($_POST["name"], $_POST["lastName"], $_POST['email'] );
      if(strpos(file_get_contents("registration_".$date.".txt"), $_POST['email'])){
        die("email address already exists");
    };
    fwrite($file,"Name:".$_POST["name"]."; Last Name: ".$_POST["lastName"]."; email:".$_POST['email']."; Type of ticket:".$_POST["tickets"]."\n");
  };
  }
}



class MySQL extends ValidateForm{
  
  function mySQL(){
   $link = '127.0.0.1:3306';
   $userName = 'root';
   $password = 'root';
   $db = "events";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $connect= mysqli_connect($link, $userName, $password ) or die('Erorr connect');
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

      $this->validate_form($_POST["name"], $_POST["lastName"], $_POST['email']);
      $testEmail = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM EventsOrders WHERE Email =' ".$_POST['email']."'"), MYSQLI_NUM);
      if(!empty($testEmail)){
      die("email address already exists");
      };
      mysqli_query($connect,"
      INSERT INTO EventsOrders( Name, Last_Name, Email, Type_of_ticket)
      VALUES ('".$_POST["name"]."', '".$_POST["lastName"]."', '".$_POST['email']."', '".$_POST["tickets"]."')
        ");
    };

  }

}

   class FileXML extends ValidateForm{
    
    function fileXML(){
      if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(!file_exists('registration.xml')){
    $dom = new DomDocument('1.0', 'UTF-8');
    $document = $dom->appendChild($dom->createElement('Document'));
    $dom->save('registration.xml');
   }

  
  $this->validate_form($_POST["name"], $_POST["lastName"], $_POST['email'] );
  if(strpos(file_get_contents("registration.xml"), $_POST['email'])){
    die("email address already exists");
  };
  

  $sxml = simplexml_load_file('registration.xml');

  $sxml->Order->Name[] =$_POST["name"];
  $sxml->Order->LastName[] = $_POST["lastName"];
  $sxml->Order->Email[] = $_POST['email'];
  $sxml->Order->TicketType[] = $_POST["tickets"];
  $xmlContent = $sxml->asXML('registration.xml');
    
    };
  }
}
 
//    class FileXML{
//      function validate_input($data){
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
//   }

//     function empty_form($uName, $uLastName, $uEmail){
//       if(empty($uName) || empty($uLastName) || empty($uEmail) ){

//   die ("Заполните все поля!");
// };
//   }

//     function FileXML(){
//     if(!file_exists("registration.xml")){

//     $dom = new DomDocument('1.0', 'UTF-8');
//     $document = $dom->appendChild($dom->createElement('Document'));
//     $dom->save('registration.xml');

//    }
//   if(empty($_POST["name"]) || empty($_POST["lastName"]) || empty($_POST["email"]) ){

//   die ("Заполните все поля!");
// };
// if(preg_match("/[a-zA-Z0-9\-\_]{1,50}[@]{1}[a-zA-Z0-9]{2,20}[\.]{1}[a-zA-Z0-9]{2,15}/" , $_POST["email"] )){
//   if(strpos(file_get_contents("registration.xml"), $_POST['email'])){
//     die("email address already exists");
//   };
//   $name = $this->validate_input($_POST["name"]) ;
//   $lastName = $this->validate_input($_POST["lastName"]) ;
//   $email = $this->validate_input($_POST['email']);
//   $typeTickets = $this->validate_input($_POST["tickets"]);
   
//   $sxml = simplexml_load_file("registration.xml");
//   $sxml->Order->Name[] = $name;
//   $sxml->Order->LastName[] = $lastName;
//   $sxml->Order->Email[] = $email;
//   $sxml->Order->TicketType[] = $typeTickets;

//   $xmlContent = $sxml->asXML("registration.xml");
  
// }else{
// die("Invalid email");
//     };


    
//    }
//  }

$obj = new MySQL();
$obj->mySQL();
 
// };

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
