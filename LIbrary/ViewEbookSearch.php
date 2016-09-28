<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
<?php
	include('connect.php');
	$con=getcon();
?>
	<?php

		$category=$_POST['category'];
		$value=$_POST['value'];
		//echo $category .'  '.$value;		

	?>
	<div class="table-responsive">
		<table class="table table-bordered">
			<?php
				if($category == "title")
				$querry="SELECT * FROM ebook_info  WHERE book_title LIKE  '%$value%'  GROUP BY edition , book_title";
				else if($category == "author")
				$querry= "SELECT * FROM ebook_info WHERE author LIKE  '%$value%' GROUP BY edition , book_title";
				else if($category == "isbn")
				$querry="SELECT * from ebook_info where isbn LIKE  '%$value%' GROUP BY edition , book_title";
				else if($category == "category")
				$querry="SELECT * from ebook_info where category LIKE  '%$value%' GROUP BY edition , book_title";
				
			//	echo $querry;
					
				$result=mysqli_query($con,$querry);
				
			//	$num=mysqli_num_rows($result);
				// var_dump($num);
				$Available = 0;
				$Total = 0;
				$temp=0;
				$count=0;
				while($row=mysqli_fetch_array($result))
				{
					$count++;
					if($temp==0)
					{
						$temp=1;
			?>					
						<b>
							<td>Title</td>
							<td>Author</td>
							<td>ISBN</td>
							<td>Edition</td>
							<td>Category</td>
							<td>URL</td>
						</tr>					
			<?php
					}
			?>
						<tr>
							<td><?php echo $row['book_title']; ?></td>
							<td><?php echo $row['author'] ?></td>
							<td><?php echo $row['isbn']; ?></td>
							<td><?php echo $row['edition']; ?></td>
							<td><?php echo $row['category']; ?></td>
							<td><a href="<?php echo $row['ebook_link'];?>"> Downlod </a></td>	
							

						</tr>
							
			<?php
				} 	
				if($count==0) echo"No Book Found ";
			?>
		</table>
	</div>
	
</body>
</html>