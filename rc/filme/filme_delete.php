<link rel="stylesheet" href="../css/bootstrap.min.css">

<?php
	session_start();
	if (!isset($_SESSION['login'])) {
			$_SESSION['login']="incorreto";
		}
		if ($_SESSION['login']=="correto") {


	$idFilme=$_GET['id_filme'];
	$con=new mysqli("localhost","root","","filmes");

	if ($con->connect_errno!=0) {
			echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
			exit;
	}
	else{

		$sql = "Delete From filmes where id_filme=?";
		$stm=$con->prepare($sql);

		if($stm!=false){

			$stm->bind_param("i",$idFilme);
			$stm->execute();
			$res=$stm->get_result();
			$stm->close();

			echo '<script>alert("Filme eliminado com sucesso");</script>';
			echo 'Aguarde um momento. A reencaminhar página';
			header("refresh:2;url=index.php");
		}
		else{
		}
	}

	
	}
	else{
		echo "Para entrar nesta página necessita de efetuar <a href='../login.php'>login</a>";
		header("refresh:2;url=../login.php");
	}
		
?>

<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.js"></script>