<?php

    require __DIR__.'/vendor/autoload.php';

    define('TITLE', 'Editar vaga');

    use App\Entity\Vaga; // Uso da classe Vaga

    if(!isset($_GET['id']) OR !is_numeric($_GET['id'])){
        header('Location: index.php?status=error');
        exit;
    }

    // CONSULTA VAGA
    $obVaga = Vaga::getVaga($_GET['id']);
    
    //VALIDAÇÃO DA VAGA
    if(!$obVaga instanceof Vaga){
        header('Location: index.php?status=error');
        exit;
    }

    // Validação do POST
    if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){
        
        $obVaga->titulo = $_POST['titulo'];
        $obVaga->descricao = $_POST['descricao'];
        $obVaga->ativo = $_POST['ativo'];

        $obVaga->atualizar();

        header('Location: index.php?status=success');
        exit;

    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/formulario.php';
    include __DIR__.'/includes/footer.php';
?>
