
<?php
	include('connect.php');
	$con_db = getcon();
	try
	{
		if(empty($_POST['id'])||empty($_POST['title']) || empty($_POST['author']) || empty($_POST['isbn']) || empty($_POST['price']))throw new Exception('Field can not be empty');
		$id=$_POST['id'];
		$title=$_POST['title'];
		$author=$_POST['author'];
		$isbn=$_POST['isbn'];
		$edition=$_POST['edition'];
		$status=$_POST['status'];
		$price=$_POST['price'];
		$category=$_POST['category'];
		$copy = $_POST['copy'];
		$campus_name=$_POST['campus_name'];
		$shelf_number=$_POST['shelf_number'];
		//echo $copy;

		if($status=="Available") $status = 1 ;
		else $status =2;

?>	
<div class="table-responsive">
	<?php
		echo '<table class="table">';
		for($i=1 ; $i<=$copy ; $i++,$id++)
			{
				$query = "INSERT INTO `db_leading`.`book_info`(`book_id`,`book_title`,`author` ,`isbn` ,`edition`,`price` ,`campus_name`,`shelf_number` ,`status`,`category`) 
							VALUES ('$id',  '$title',  '$author',  '$isbn',  '$edition', $price, '$campus_name', $shelf_number,'$status','$category')";
			//	echo $query;
				$result = mysqli_query($con_db,$query);			
				if($result)
				{
				?>
				<?php
					if($i==1)
					{
				?>																						
				<tr class="success">
					<td>Book ID</td>
					<td>Title</td>
					<td>Author</td>
					<td>ISBN</td>
					<td>Edition</td>
					<td>Price</td>												
					<td>Status</td>
					<td>Shelf Number</td>
				</tr>
				<?php
					}
				?>
				<tr class="info">
					<td><?php echo $id; ?></td>
					<td><?php echo $title ?></td>
					<td><?php echo $author; ?></td>
					<td><?php echo $isbn; ?></td>
					<td><?php echo $edition; ?></td>
					<td><?php echo $price; ?></td>					
					<td><?php 
						
						if($_POST['status'] == "Available")
							echo "Available";
						else echo "Library Copy"; 
						
						//echo $_POST['status'];
					?></td>
					<td><?php echo $campus_name."  ".$shelf_number; ?></td>						
				</tr>
				<?php
				}
			}
		echo '</table>';
		echo '<br>';
		?>
	</div>
	<?php
		}
		catch(Exception $e)
		{
			$error=$e->getMessage();
		}
	?>
	<?php
		if(isset($error))echo $error;
	?>
