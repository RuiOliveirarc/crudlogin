<link rel="stylesheet" href="../css/bootstrap.min.css">

<?php
session_start();
	if (!isset($_SESSION['login'])) {
			$_SESSION['login']="incorreto";
		}
		if ($_SESSION['login']=="correto") {


	
	if($_SERVER['REQUEST_METHOD']=='GET'){

		if(isset($_GET['id_realizador']) && is_numeric($_GET['id_realizador'])){

			$idRealizador=$_GET['id_realizador'];
			$con=new mysqli("localhost","root","","filmes");
			if($con->connect_errno!=0){
				echo '<h1>Ocorreu um erro no acesso à base de dados.<br>'.$con->connect_error. "</h1>";
				exit();
			}
			$sql="Select * from realizadores where id_realizador=?";
			$stm=$con->prepare($sql);
			if($stm!=false){
				$stm->bind_param("i",$idRealizador);
				$stm->execute();
				$res=$stm->get_result();
				$livro=$res->fetch_assoc();
				$stm->close();
			}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Editar realizador</title>
</head>
<body>
	<h1>Editas realizadores</h1>
	<form action="realizador_update.php?id_realizador=<?php echo $livro['id_realizador'];?>" method="post">
		<label>Nome</label><input type="text" name="nome" required value="<?php echo $livro['nome'];?>"><br>
		<label>Data nascimento</label><input type="date" name="data_nascimento" value="<?php echo $livro['data_nascimento'];?>"><br>
		<label>Nacionalidade</label><input type="text" name="nacionalidade" value="<?php echo $livro['nacionalidade'];?>"><br>
		<input type="submit" name="enviar"><br>
	</form>
	<br>
		<a href="index.php">
			<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
  				<path fill-rule="evenodd" d="M6.603 2h7.08a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-7.08a1 1 0 0 1-.76-.35L1 8l4.844-5.65A1 1 0 0 1 6.603 2zm7.08-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zM5.829 5.146a.5.5 0 0 0 0 .708L7.976 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
			</svg>
		</a>
</body>

	<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.js"></script>

</html>
<?php
		}
		else{
			echo("<h1>Houve um erro ao processar o seu pedido.<br>Dentro de segundos será reencaminhado!<h1>");
			header("refresh:5;url=index.php");
		}
	}

	
	}
	else{
		echo "Para entrar nesta página necessita de efetuar <a href='../login.php'>login</a>";
		header("refresh:2;url=../login.php");
	}

?>