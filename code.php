<?php 
include('include/connection.php');


if (isset($_POST['check_view'])) {
	 $name = $_POST['s_name'];

	 // $query ="select * from users where name='$name'";

	 // $run_query =mysqli_query($conn,$query);

	 // while($row=mysqli_fetch_array($run_query)){
	 // 	echo $return ='<div>'.$row['phone'].'<div>'.'<div>'.$row['name'].'</div>';
	 // }



	 $stmt=$conn -> prepare("select * from users where name= ?");
	 $stmt ->bind_param("s",$name);
	 $stmt->execute();

	 $result = $stmt ->get_result();

	 while ($row =$result -> fetch_assoc()) {
	 	echo $return ='<div>Phone: '.$row['phone'].'<div>'.'<div>Name: '.$row['name'].'</div>';
	 }

}
 ?>