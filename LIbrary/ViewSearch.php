<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title> Leading University Library Management </title> <!-- end of title-->
		<link rel = "stylesheet" href="project_style.css" type = "text/css">	
	</head>
<body>
	
	<?php
	
		$catagori=$_POST['cat_value'];
		$value=$_POST['catagori'];
		//echo $catagori .'  '.$value;		

	?>
	<div class="table-responsive">
		<table class="table table-bordered">
		<?php
			if($catagori == "Key" || $catagori == "title")
			$querry="SELECT * FROM book_info WHERE book_title LIKE  '%$value%'  GROUP BY isbn,campus_name  ORDER BY book_title, edition";
			
			else if($catagori == "author")
			$querry="select * from book_info where author LIKE  '%$value%' GROUP BY isbn,campus_name  ORDER BY book_title, edition";
			else if($catagori == "isbn")
			$querry="select * from book_info where isbn LIKE  '%$value%' GROUP BY isbn,campus_name ORDER BY book_title, edition  ";
			else if($catagori == "book_id")
			$querry="select * from book_info where book_id='$value'";
			else if($catagori == "category")
			$querry="SELECT * from book_info where category LIKE  '%$value%' GROUP BY isbn,campus_name ORDER BY book_title, edition";
			
		//	echo $querry;
			
			include('connect.php');
			$con=getcon();
			
			$result=mysqli_query($con,$querry);
			
			$num=mysqli_num_rows($result);
			// var_dump($num);
			$Available = 0;
			$Total = 0;
			$temp=0;
			
			//foreach($result as $row)
			while($row=mysqli_fetch_array($result))
			{
				if($temp==0)
				{
					$temp=4;
		?>					
					<tr>
						<th>Book ID</th>
						<th>Title</th>
						<th>Author</th>
						<th>ISBN</th>
						<th>Edition</th>
						<th>Location</th>
						<th>Avilable</th>
						<th>Total</th>
					</tr>					
		<?php
				}
				if($row['status']== "Available") $Available++;
				$Total++;
		?>
					<tr>
						<td><?php echo $row['book_id']; ?></td>
						<td><?php echo $row['book_title'] ?></td>
						<td><?php echo $row['author']; ?></td>
						<td><?php echo $row['isbn']; ?></td>
						<td><?php echo $row['edition']; ?></td>
						<td><?php echo $row['campus_name'].",<br>Shelf-Number: ". $row['shelf_number']; ?></td>
						
		<?php
					$ba = $row['isbn'];
					$campus_name = $row['campus_name'];
					
					$qavailable = "SELECT (SELECT COUNT( book_id )  FROM book_info WHERE isbn = '$ba' AND STATUS = 1 and campus_name = '$campus_name') AS 'available',(SELECT COUNT( book_id )  FROM book_info WHERE isbn = '$ba' and campus_name = '$campus_name')AS 'total'";
					//echo $qavailable;
					$result2=mysqli_query($con,$qavailable);
					//echo $qavailable;
					foreach($result2 as $row2)
					{										
		?>
						<td>
						<?php 

						$temp2 = $row2['available'];
						if ($temp2==0) {
							$isbn = $row['isbn'] ;
	
							//echo "rjthj".$row['book_number'];

							$sql = "SELECT DATE_ADD(issue_date, INTERVAL day_limit DAY) as 'date' 
							from book_transaction where issue_date = ( SELECT ((SELECT MIN(issue_date)
							 from book_transaction where book_number in (SELECT book_number 
							 	from book_info where isbn = '".$isbn."') and transaction_status = 0)))";

							//echo $sql;

						//	$sql = "SELECT MAX( $book_number ) AS  'date' FROM book_transaction";

							$found = 0;

							$result3 = mysqli_query($con,$sql);

							//foreach($result3 as $row3)
							while($row3 = mysqli_fetch_array($result3))
							{
								$format_date=date_create($row3['date']);
								echo "Will available after<br>". date_format($format_date,"M,d Y");
								$found = 1;							
								break;
								
							}

							if($found==0)
							{
								echo "Library Copy Only";
							}

							//Select ADDDATE((Select ((select MIN(issue_date) from book_transaction where book_number in (select book_number from book_info where isbn = "SMP1" ) and transaction_status = 0))),INTERVAL 1 DAY)
							//Select transaction_id from book_transaction where issue_date = ( Select ((select MIN(issue_date) from book_transaction where book_number in (select book_number from book_info where isbn = "SMP1" ) and transaction_status = 0)))
							//Select DATE_ADD(issue_date, INTERVAL day_limit DAY) as 'Date' from book_transaction where issue_date = ( Select ((select MIN(issue_date) from book_transaction where book_number in (select book_number from book_info where isbn = "SMP1" ) and transaction_status = 0)))
						}
						else
							echo $temp2;

						?></td>
						<td><?php echo $row2['total'];?></td>
						</tr>
						
		<?php
					}
			}
		?>
	</table>
</div>
		<!--</div><!--end of container-->
	</body>
</html>