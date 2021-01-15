<link rel="stylesheet" href="../css/bootstrap.min.css">

<?php

session_start();
	if (!isset($_SESSION['login'])) {
			$_SESSION['login']="incorreto";
		}
		if ($_SESSION['login']=="correto") {



	if($_SERVER['REQUEST_METHOD']=='POST'){
		$nome='';
		$data_nacimento='';
		$nacionalidade='';
		

		if(isset($_POST['nome'])){

			$nome=$_POST['nome'];
		}
		else{
			echo '<script>alert("É obrigatorio o preenchimento do nome.");</script>';
		}
		if (isset($_POST['data_nacimento'])) {
			$data_nacimento=$_POST['data_nacimento'];
		}
		if (isset($_POST['nacionalidade'])) {
			$nacionalidade=$_POST['nacionalidade'];	
		}
		$con=new mysqli("localhost","root","","filmes");

		if ($con->connect_errno!=0) {
			echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
			exit;
		}

		else{
			$idRealizador=$_GET['id_realizador'];
			$sql="update realizadores set nome=?, data_nascimento=?, nacionalidade=? where id_realizador=?";
			$stm=$con->prepare($sql);
			if($stm!=false){

				$stm->bind_param('sssi',$nome,$data_nacimento,$nacionalidade,$idRealizador);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Realizador editado com sucesso");</script>';
				echo 'Aguarde um momento. A reencaminhar página';
				header("refresh:2;url=index.php");
			}
			else{
			}
		}
	}
	else{
		echo "<h1>Houve um erro ao processar o seu pedido<br>Irá ser reencaminhada</h1>";
		header("refresh:2;url=index.php");
	}

	}
	else{
		echo "Para entrar nesta página necessita de efetuar <a href='../login.php'>login</a>";
		header("refresh:2;url=../login.php");
	}
?>

<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.js"></script>