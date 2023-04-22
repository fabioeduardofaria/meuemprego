<?php
    //utilizamos a notação namespace em toda classe que vamos criar daqui pra frente
    //dessa forma o autoload do composer conseguirá identificar o local da classe
    //e a partir disso podemos importar a classe em qualquer local do nosso projeto
    namespace App;

    //importação da classe Bootstrap seguindo o padrão PSR-4
    use Core\init\Bootstrap;

    //usamos o termo extends para informar que a classe Route irá herdar tudo 
    //tudo que a classe Bootstrap possui
    //dessa forma podemos utilizar os métodos da classe bootstrap
    class Route extends Bootstrap{
       
        //array no qual iremos definir as rotas da nossa aplicação
        //toda rota dever ser inserida aqui
        protected function initRoutes() {
            //IndexController
            $routes['home'] =  array('route' => '/', 'controller' => 'indexController', 'action' => 'index');
            $routes['contato'] =  array('route' => '/contato', 'controller' => 'indexController', 'action' => 'contato');
            $routes['login'] = array('route' => '/login', 'controller' => 'IndexController', 'action' => 'login');

            //AdminController
            $routes['admin'] =  array('route' => '/admin', 'controller' => 'adminController', 'action' => 'index');
            $routes['dashboard'] = array('route' => '/dashboard', 'controller' => 'adminController', 'action' => 'dashboard');

            //UsuarioController
            $routes['usuario'] = array('route' => '/usuario', 'controller' => 'usuarioController', 'action' => 'index');
            $routes['novo_usuario'] = array('route' => '/novo_usuario', 'controller' => 'usuarioController', 'action' => 'cadastrar');
            $routes['salvar_usuario'] = array('route' => '/salvar_usuario', 'controller' => 'usuarioController', 'action' => 'salvar_usuario');
            $routes['usuario_excluir'] = array('route' => '/usuario_excluir', 'controller' => 'UsuarioController', 'action' => 'excluir');
            $routes['usuario_editar'] = array('route' => '/usuario_editar', 'controller' => 'UsuarioController', 'action' => 'editar');
            $routes['usuario_atualizar'] = array('route' => '/usuario_atualizar', 'controller' => 'UsuarioController', 'action' => 'atualizar');

            //AuthController
            $routes['sair'] = array('route' => '/sair', 'controller' => 'AuthController', 'action' => 'sair');   
            $routes['autenticar'] = array('route' => '/autenticar', 'controller' => 'AuthController', 'action' => 'autenticar');

            
            //Rota de exemplo, quebrada em linhas para leitura facilitada
            $routes['produto'] = array(
                'route'         =>      '/produto',
                'controller'    =>      'indexController',
                'action'        =>      'index'
            );           
            
            $this->setRoutes($routes);
        }

        
    }

?>