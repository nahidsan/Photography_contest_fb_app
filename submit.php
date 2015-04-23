


<?php
require_once('dbconnect.php');



	if (isset($_FILES['userfile'])) { 

          	upload();
          
   


					}
			 



mysql_close($con);




// the upload function
    function upload(){

// print $_FILES['userfile']['tmp_name'];

  move_uploaded_file ( $_FILES['userfile']['tmp_name'] , "upload/".$_FILES['userfile']['name'] );   

 if(file_exists("upload/".$_FILES['userfile']['name'])) {
 
        // check the file is less than the maximum file size
        //if($_FILES['userfile']['size'] < $_REQUEST["MAX_FILE_SIZE"])
            {
        // prepare the image for insertion
        //$imgData =addslashes (file_get_contents("upload/".$_FILES['userfile']['name']));

        // $imgData = addslashes($_FILES['userfile']);
 
        // get the image info..
         // $size = getimagesize("upload/".$_FILES['userfile']['name']);

 	 // our sql query
        $strSql='insert into msg(name, email, mobile_no, message, image) values("'. $_REQUEST["name"] . '","'.$_REQUEST["email"].'","'.$_REQUEST["mobile_no"]. '","'. $_REQUEST["txtMessage"].'","upload/'.$_FILES['userfile']['name'].'")';
        //echo $strSql;
       
        
        if(mysql_query($strSql))
		echo "Thank you very much";
 	else
      		echo "Can't insert data";
        }
    }
    else {
         	
		echo "error";
         }

}
?>