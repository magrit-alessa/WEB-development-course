<?php

 class XML {
		public function xml_file($userData) {
			$name = $_POST["name"];
			$lastName = $_POST["lastName"];
			$email = $_POST["email"];
			$ticket = $_POST["ticket"];

			  
			  if(!file_exists("registration.xml")){
			    $dom = new DomDocument('1.0', 'UTF-8');
			    $document = $dom->appendChild($dom->createElement('Document'));
			    $dom->save('registration.xml');
			   }

			  if(strpos(file_get_contents("registration.xml"), $email)){
                 die("email address already exists");
                };

                  $sxml = simplexml_load_file('registration.xml');
				  $new_elemtn_index = count($sxml->Order);
				  $sxml->Order[$new_elemtn_index]->Name =$name;
				  $sxml->Order[$new_elemtn_index]->LastName = $lastName;
				  $sxml->Order[$new_elemtn_index]->Email = $email;
				  $sxml->Order[$new_elemtn_index]->TicketType = $ticket;
				  $xmlContent = $sxml->asXML('registration.xml');
				  echo $successMessage = "Thank You for your registration!";
				exit();
			
		}
	}


?>