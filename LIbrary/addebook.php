
<?php

	include('connect.php');
	$con_db = getcon();
	
		/*
		INSERT INTO `lu_library`.`ebook_info` (`ebook_id`, `book_title`, `author`, `isbn`, `edition`, `category`, `ebook_link`, `entry_date`) VALUES (NULL, 'Esho Programming Sikhi', 'Tamim Shahriyar Subeen', '', '1', 'CSE', 'https://www.dropbox.com/s/tdu3yxqp0bkv77b/Getting%20Started.pdf?dl=0', CURRENT_TIMESTAMP); 
		*/
			
		$title=$_POST['title'];
		$author=$_POST['author'];
		$isbn=$_POST['isbn'];
		$edition=$_POST['edition'];
		$category=$_POST['category'];
		$url=$_POST['url'];

		$query = "INSERT INTO `ebook_info` (`book_title`, `author`, `isbn`, `edition`, `category`, `ebook_link`, `entry_date`) VALUES ('{$title}', '{$author}', '{$isbn}', '{$edition}', '{$category}', '{$url}', CURRENT_TIMESTAMP); ";
		$result = mysqli_query($con_db,$query);
		//echo $query."...<br>"; 
		
		if($result)
		{
		?>
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<td>Title</td>
					<td>Author</td>
					<td>ISBN</td>
					<td>Edition</td>
					<td>Category</td>
					<td>URL</td>
					
				</tr>
				
				<tr>
					<td><?php echo $title ?></td>
					<td><?php echo $author; ?></td>
					<td><?php echo $isbn; ?></td>
					<td><?php echo $edition; ?></td>
					<td><?php echo $category; ?></td>						
					<td>
					<a href="<?php echo $url;?>"> Downlod </a>
					</td>						
				</tr>
			</table>
		</div>
	<?php
		}
	?>