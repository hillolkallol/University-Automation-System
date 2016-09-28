<?php
session_start();
	if(isset($_POST[logout]))
	{
		session_destroy();
		header('Location: index.php');
		echo '<script type="text/javascript">';
			echo 'alert("You Are Safe")';
		echo '</script>';
	}
	
	else
		{
			session_destroy();
			header('Location: index.php');
			echo '<script type="text/javascript">';
				echo 'alert("You Are Safe")';
			echo '</script>';
		}
?>