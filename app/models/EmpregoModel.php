<?php

namespace App\Models;

use Core\Model\Model;

class EmpregoModel extends Model
{

	private $id;
	private $id_usuario;
	private $titulo;
	private $descricao;
	private $modalidade;
	private $habilidade;
	private $ativo;
	private $qtde_vaga;
	private $local_trabalho;
	private $telefone;
	private $email;
	private $salario;
	private $created_at;
	private $updated_at;
	private $deleted_at;

	public function __get($atributo)
	{
		return $this->$atributo;
	}

	public function __set($atributo, $valor)
	{
		$this->$atributo = $valor;
	}

	public function getAllEmpregos()
	{
		$sql = "select e.id, e.id_usuario, u.nome, u.sobrenome, e.titulo, e.descricao, e.modalidade , 
			e.habilidade, e.ativo, e.qtde_vaga, e.local_trabalho, e.telefone, e.email, e.salario, 
			e.created_at from empregos as e inner join usuarios as u on e.id_usuario = u.id";
		// 		SELECT
		//    autor.autor_nome,
		//    frase.frase_frases
		// FROM
		//    autor
		// INNER JOIN
		//    frase ON autor.autor_id = frase.autor_id
		// WHERE
		//    autor.autor_nome = 'pedro'
		return $this->db->query($sql)->fetchAll();
	}






















	//ABAIXO AINDA A VALIDAR O USO



	//validar se um cadastro pode ser feito
	public function validarCadastro()
	{
		$valido = true;

		if (strlen($this->__get('nome')) < 3) {
			$valido = false;
		}

		if (strlen($this->__get('email')) < 3) {
			$valido = false;
		}

		if (strlen($this->__get('senha')) < 3) {
			$valido = false;
		}

		return $valido;
	}

	//recuperar um usuário por e-mail
	public function getUsuarioPorEmail()
	{
		$query = "select nome, email from usuarios where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	//recuperar um usuário por id
	public function getUsuarioPorId()
	{
		$query = "select id, nome, sobrenome, email, senha, nivel from usuarios where id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function autenticar()
	{
		$query = "select id, nome, sobrenome, nivel, email, ativo from usuarios where email = :email and senha = :senha";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha'));
		$stmt->execute();

		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

		if ($usuario['id'] != '' && $usuario['nome'] != '') {
			$this->__set('id', $usuario['id']);
			$this->__set('nome', $usuario['nome']);
			$this->__set('sobrenome', $usuario['sobrenome']);
			$this->__set('nivel', $usuario['nivel']);
			$this->__set('email', $usuario['email']);
			$this->__set('ativo', $usuario['ativo']);
		}

		return $this;
	}

	//Informações do Usuário
	public function getInfoUsuario()
	{
		$query = "select nome from usuarios where id = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function getUsuarios()
	{
		$sql = "select id, nome, sobrenome, email, nivel, ativo, created_at from usuarios where id != " . $_SESSION['id'];

		return $this->db->query($sql)->fetchAll();
	}

	public function getTotalUsuarios()
	{
		$query = "select count(id) as qtdeUsuarios from usuarios";

		return $this->db->query($query)->fetchObject()->qtdeUsuarios;
	}

	public function deletarUsuario($id)
	{
		$query = "delete from usuarios where id = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $id);
		$stmt->execute();

		return true;
	}

	//salvar
	public function salvar()
	{
		$query = "insert into usuarios(nome, sobrenome, email, senha, nivel) values (:nome, :sobrenome, :email, :senha, :nivel)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':sobrenome', $this->__get('sobrenome'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha')); //md5() -> hash 32 caracteres
		$stmt->bindValue(':nivel', $this->__get('nivel'));
		$stmt->execute();

		return $this;
	}

	//atualizar
	public function atualizar()
	{
		$query = "update usuarios set 
							nome = :nome, 
							sobrenome = :sobrenome, 
							email = :email, 
							senha = :senha, 
							nivel = :nivel, 
							updated_at = :updated_at 
							where id=:id";
		$stmt = $this->db->prepare($query);

		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':sobrenome', $this->__get('sobrenome'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha')); //md5() -> hash 32 caracteres
		$stmt->bindValue(':nivel', $this->__get('nivel'));
		$stmt->bindValue(':updated_at', $this->__get('updated_at'));
		$stmt->bindValue(':id', $this->__get('id'));

		$stmt->execute();

		return $this;
	}
}
