<?php

namespace App\controllers;

//Recursos de nosso MVC
use Core\controller\Action;
use App\controllers\AuthController;

//Models utilizados
use App\models\ProdutoModel;
use App\models\InfoModel;
use Core\model\Container;

class IndexController extends Action
{

    public function index()
    {
        // AuthController::validaAutenticacao();

        //faz a instancia de produto com a conexão com banco de dados
        $emprego = Container::getModel('Emprego');

        $empregos = $emprego->getAllEmpregos();
        $this->view->dados = $empregos;
        $this->view->title = "Meu Emprego - Home";


        $this->render("index", "template_front1");
    }


    public function contato()
    {
        $this->render("contato", "template_front2");
    }

    public function ver_vaga()
    {
        // echo "id a ser exibido: " . $_GET['id'];
        $emprego = Container::getModel('Emprego');

        //seta o id no atributos id da classe Usuário
        $emprego->__set('id', isset($_GET['id']) ? $_GET['id'] : "");

        $empregos = $emprego->getEmpregoPorId();

        $this->view->dados = $empregos;

        $this->render("ver_vaga", "template_front2");

    }

    public function login()
    {
        if (AuthController::esta_logado()) {
            header('Location: /admin');
        } else {
            $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
            $this->render("login", "template_front2");
        }
    }
}


// IndexController
