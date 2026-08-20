<?php

require_once("modelo/Prato.php");
require_once("modelo/Pedido.php");

$prato1 = new Prato();
$prato1->setNumero(1);
$prato1->setNome("Camarão à Milanesa");
$prato1->setValor(110.00);

$prato2 = new Prato();
$prato2->setNumero(2);
$prato2->setNome("Pizza Margherita");
$prato2->setValor(80.00);

$prato3 = new Prato();
$prato3->setNumero(3);
$prato3->setNome("Macarrão à Carbonara");
$prato3->setValor(60.00);

$prato4 = new Prato();
$prato4->setNumero(4);
$prato4->setNome("Bife à Parmegiana");
$prato4->setValor(75.00);

$prato5 = new Prato();
$prato5->setNumero(5);
$prato5->setNome("Risoto ao Funghi");
$prato5->setValor(70.00);

$pratos = [];
$pedidos = [];

$pratos[] = $prato1;
$pratos[] = $prato2;
$pratos[] = $prato3;
$pratos[] = $prato4;
$pratos[] = $prato5;


do {

    echo "\n\n------MENU------\n";
    echo "1- Cadastrar pedido\n";
    echo "2- Cancelar\n";
    echo "3- Listar\n";
    echo "4- Total de vendas\n";
    echo "0- Sair\n";

    $opcao = readline("Escolha uma opção: ");

    switch ($opcao) {

        case 1:

            echo "Cadastrar pedido\n\n";

            $nomeCliente = readline("Nome do cliente: ");
            $nomeGarcom = readline("Nome do garçom: ");

            echo "\nPratos disponíveis:\n";

            foreach ($pratos as $prato) {
                    echo $prato->getNumero() . " - " . $prato->getNome() . " - R$ " . $prato->getValor() . "\n";

            }

            $numeroPrato = (int) readline("\nNúmero do prato: ");

            $encontrou = false;

            foreach ($pratos as $prato) {

                if ($prato->getNumero() == $numeroPrato) {

                    $pedido = new Pedido();

                    $pedido->setNomeCliente($nomeCliente);
                    $pedido->setNomeGarcom($nomeGarcom);
                    $pedido->setPrato($prato);

                    $pedidos[] = $pedido;

                    $encontrou = true;

                    break;
                }
            }

            if ($encontrou) {
                echo "\nPedido cadastrado com sucesso!\n";
            } else {
                echo "\nPrato não encontrado!\n";
            }

            break;

        case 3:
            echo "Listar pedidos\n\n";

            if (count($pedidos) == 0) {

                echo "Não tem nenhum pedido cadastrado";

           }else{


            foreach($pedidos as $indice => $pedido) {

                    echo "O cliente ". $pedido->getNomeCliente(). ", foi atendido pelo garçom " . $pedido->getNomeGarcom() . ", pediu um prato de " . $pedido->getPrato()->getNome() . " no valor de R$ " . $pedido->getPrato()->getValor(). ".\n";
                }
            }

            break;
    

        case '2':
            echo "Cancelar pedido\n";

            if(count($pedidos) == 0){

                echo "Não existem pedidos cadastrados";

            }else {

                echo "Pedidos Cadastrados: ";
                
                for ($i=0; $i < count($pedidos) ; $i++) { 
                    echo "Indice: " . $i . "\n\n";
                    echo $pedidos[$i]->getNomeCliente();
                    echo "\n";
                }

                $indice = readline("Informe o índice que deseja deletar: ");

                if($indice >= 0 || $indice <= count($pedidos)){

                    array_splice($pedidos, $indice);

                    echo "Pedido cancelado com sucesso\n\n";

                }else {
                    echo "Não foi possível cancelar o pedido";
                }
            }
            
            break;


        case 4:
            echo "Total de pedidos\n";

                $total = 0;


            foreach ($pedidos as $pedido) {

                $total = $total
                    + $pedido->getPrato()->getValor();
            }


            echo "Total de vendas: R$ "
                . number_format($total). "\n";

            break;

            

        case 0:
            break;

        default:
            echo"Opçao invalida";

    }
}while ($opcao != 0);
