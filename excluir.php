<?php

    require __DIR__.'/vendor/autoload.php';

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
    if(isset($_POST['excluir'])){
        
        $obVaga->excluir();

        header('Location: index.php?status=success');
        exit;

    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/confirmar-exclusao.php';
    include __DIR__.'/includes/footer.php';
?>
