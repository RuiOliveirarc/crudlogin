<link rel="stylesheet" href="../css/bootstrap.min.css">

<?php
	session_start();
	if (!isset($_SESSION['login'])) {
			$_SESSION['login']="incorreto";
		}
		if ($_SESSION['login']=="correto") {


	if($_SERVER['REQUEST_METHOD']=='POST'){
		$titulo='';
		$sinopse='';
		$idioma='';
		$data_lancamento='';
		$quantidade=0;

		if(isset($_POST['titulo'])){

			$titulo=$_POST['titulo'];
		}
		else{
			echo '<script>alert("É obrigatorio o preenchimento do titulo.");</script>';
		}
		if (isset($_POST['sinopse'])) {
			$sinopse=$_POST['sinopse'];
		}
		if (isset($_POST['quantidade']) && is_numeric($_POST['quantidade'])) {
			$quantidade=$_POST['quantidade'];
		}
		if (isset($_POST['idioma'])) {
			$idioma=$_POST['idioma'];
		}
		if (isset($_POST['data_lancamento'])) {
			$data_lancamento=$_POST['data_lancamento'];
		}
		$con=new mysqli("localhost","root","","filmes");

		if ($con->connect_errno!=0) {
			echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
			exit;
		}

		else{
			$idFilme=$_GET['filme'];
			$sql="update filmes set titulo=?, sinopse=?, idioma=?, quantidade=?, data_lancamento=? where id_filme=?";
			$stm=$con->prepare($sql);
			if($stm!=false){

				$stm->bind_param('sssisi',$titulo,$sinopse,$idioma,$quantidade,$data_lancamento,$idFilme);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Livro editado com sucesso");</script>';
				echo 'Aguarde um momento. A reencaminhar página';
				header("refresh:5;url=index.php");
			}
			else{
			}
		}
	}
	else{
		echo "<h1>Houve um erro ao processar o seu pedido<br>Irá ser reencaminhada</h1>";
		header("refresh:5;url=index.php");
	}

	
	}
	else{
	echo "Para entrar nesta página necessita de efetuar <a href='../login.php'>login</a>";
	header("refresh:2;url=../login.php");
	}
?>

<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.js"></script>