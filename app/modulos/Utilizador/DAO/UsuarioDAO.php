<?php
/**
 * Classe de cadastro de Utilizador no repositório
 * @author Roberto Ramos <robertolopesramos@gmail.com>
 * @version 0.1
 * @access public
 */
include_once('../../../config/Repositorio.class.php');
include_once('../../../interface/iRepositorio.php');

class ComentarioDAO implements iRepositorio{

	private $conn;

	/**
	 * Methodo para receber uma conexão com o repositório.
	 * @access public
	 * @param String $sql
	 * @return Connexão
	 */
	private function getStatement($sql){
		$conn = Repositorio::GetConnection();
		$conn->beginTransaction();
		return $conn->prepare($sql);
	}

	/**
	 * Methodo para salvar um novo utilizador.
	 * Este methodo sobrescreve o methodo salvar da interface iRepositorio
	 * @access public
	 * @param Usuario $usuario
	 * @return boolean
	 */
	public function salvar($usuario){
		try{
			$sql = "INSERT INTO UTILIZADOR(use_nome,use_user,use_senha,use_alcunha,use_email,use_dtcriacao,use_website,use_biografia,per_id) VALUES(?,?,?,?,?,?,?,?,?)";
			$ps = getStatement($sql);

			$ps->bindParam(1,$usuario->getNome(),PDO::PARAM_STR);
			$ps->bindParam(2,$usuario->getUser(),PDO::PARAM_STR);
			$ps->bindParam(3,$usuario->getSenha(),PDO::PARAM_STR);
			$ps->bindParam(4,$usuario->getAlcunha(),PDO::PARAM_STR);
			$ps->bindParam(5,$usuario->getEmail(),PDO::PARAM_STR);
			$ps->bindParam(6,$usuario->getDtCriacao(),PDO::PARAM_STR);
			$ps->bindParam(7,$usuario->getWebSite(),PDO::PARAM_STR);
			$ps->bindParam(8,$usuario->getBiografia(),PDO::PARAM_STR);
			$ps->bindParam(9,$usuario->getPerfil()->getId(),PDO::PARAM_INT);
			$ps->execute();
			$ps->commit();
			if($ps->rowCount() != 1){
				throw new PDOException("Erro ao inserir dados no Banco.");
			}
			$ps = null;
		}catch(PDOException $e){
			$ps->rollBack();
			echo "<p>Erro ao inserir dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return true;
	}

	/**
	 * Methodo para remover um utilizador.
	 * Este methodo sobrescreve o methodo remover da interface iRepositorio
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function remover($id){
		try{
			$sql = "DELETE FROM UTILIZADOR WHERE use_id = ?";
			$ps = getStatement($sql);

			$ps->bindParam(1,$id,PDO::PARAM_INT);
			$ps->execute();
			$ps->commit();
			if($ps->rowCount()!= 1){
				throw new PDOException("Erro ao tentar deletar dados do Banco.");
			}
			$ps = null;
		}catch(PDOException $e){
			$ps->rollBack();
			echo "<p>Erro ao tentar deletar dados do Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return true;
	}

	/**
	 * Methodo para alterar um utilizador.
	 * Este methodo sobrescreve o methodo alterar da interface iRepositorio
	 * @access public
	 * @param Usuario $usuario
	 * @return boolean
	 */
	public function alterar($usuario){
		try{
			$sql = "UPDATE UTILIZADOR SET use_nome = ?,use_user = ?,use_senha = ?,use_alcunha = ?, use_email = ?,use_dtcriacao = ?,use_website = ?,use_biografia = ?,per_id = ?";
			$ps = getStatement($sql);

			$ps->bindParam(1,$usuario->getNome(),PDO::PARAM_STR);
			$ps->bindParam(2,$usuario->getUser(),PDO::PARAM_STR);
			$ps->bindParam(3,$usuario->getSenha(),PDO::PARAM_STR);
			$ps->bindParam(4,$usuario->getAlcunha(),PDO::PARAM_STR);
			$ps->bindParam(5,$usuario->getEmail(),PDO::PARAM_STR);
			$ps->bindParam(6,$usuario->getDtCriacao(),PDO::PARAM_STR);
			$ps->bindParam(7,$usuario->getWebSite(),PDO::PARAM_STR);
			$ps->bindParam(8,$usuario->getBiografia(),PDO::PARAM_STR);
			$ps->bindParam(9,$usuario->getPerfil()->getId(),PDO::PARAM_INT);

			$ps->execute();
			$ps->commit();
			if($ps->rowCount()!= 1){
				throw new PDOException("Erro ao tentar alterar dados no Banco.");
			}
			$ps = null;
		}catch (PDOException $e){
			$ps->rollBack();
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return true;
	}

	/**
	 * Methodo para pesquisar um determinado Utilizador.
	 * Este methodo sobrescreve o methodo buscar da interface iRepositorio
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function buscar($id){
		try{
			$sql = "SELECT * FROM UTILIZADOR u,PERFIL p WHERE u.use_id = ? and u.per_id = p.per_id";
			$ps = getStatement($sql);
			$ps->bindParam(1,$id,PDO::PARAM_INT);
			$ps->execute();
			$rs = $ps->fetch(PDO::FETCH_ASSOC);


			$usuario = new Usuario();
			$usuario->setId($rs['use_id']);
			$usuario->setNome($rs['use_nome']);
			$usuario->setUser($rs['use_user']);
			$usuario->setSenha($rs['use_senha']);
			$usuario->setAlcunha($rs['use_alcunha']);
			$usuario->setEmail($rs['use_email']);
			$usuario->setDtCriacao($rs['use_dtcriacao']);
			$usuario->setWebSite($rs['use_website']);
			$usuario->setBiografia($rs['use_biografia']);
			
			$perfil = new Perfil();
			$perfil->setId($rs['per_id']);
			$perfil->setNome($rs['per_nome']);
						
			$usuario->setPerfil($perfil);

			$ps = null;
		}catch (PDOException $e){
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}

		return $usuario;
	}

	/**
	 * Methodo para filtrar uma lista de Utilizadores.
	 * Este methodo sobrescreve o methodo filtrar da interface iRepositorio
	 * @access public
	 * @param Usuario $usuario
	 * @return array
	 */
	public function filtrar($usuario){
		$listaUsuarios = array();
		try{
			$sql = "SELECT * FROM UTILIZADOR";
			$sqlConector = " AND ";
				
			if($usuario->getNome() != null && !empty($usuario->getNome())){
				$sql .= $sqlConector."use_nome LIKE '%?%' \n ";
			}
			if($usuario->getUser() != null && !empty($usuario->getUser())){
				$sql .= $sqlConector."use_user LIKE '%?%' \n";
			}
			if($usuario->getAlcunha() != null && !empty($usuario->getAlcunha())){
				$sql .= $sqlConector."use_alcunha LIKE '%?%' \n";
			}
			if($usuario->getEmail() != null && !empty($usuario->getEmail())){
				$sql .= $sqlConector."use_email LIKE '%?%' \n";
			}
			if($usuario->getDtCriacao() != null && !empty($usuario->getDtCriacao())){
				$sql .= $sqlConector."use_dtcriacao = ? \n";
			}
			if($usuario->getWebSite() != null && !empty($usuario->getWebSite())){
				$sql .= $sqlConector."use_website LIKE '%?%' \n";
			}
			if($usuario->getBiografia() != null && !empty($usuario->getBiografia())){
				$sql .= $sqlConector."use_biografia LIKE '%?%' \n";
			}

			$ps = getStatement($sql);
			$i = 1;
			if($usuario->getNome() != null && !empty($usuario->getNome())){
				$ps->bindParam($i, $usuario->getNome(), PDO::PARAM_STR);
				$i++;
			}
			if($usuario->getUser() != null && !empty($usuario->getUser())){
				$ps->bindParam($i, $usuario->getUser(), PDO::PARAM_STR);
				$i++;
			}
			if($usuario->getAlcunha() != null && !empty($usuario->getAlcunha())){
				$ps->bindParam($i, $usuario->getAlcunha(), PDO::PARAM_STR);
				$i++;
			}
			if($usuario->getEmail() != null && !empty($usuario->getEmail())){
				$ps->bindParam($i, $usuario->getEmail(), PDO::PARAM_STR);
				$i++;
			}
			if($usuario->getDtCriacao() != null && !empty($usuario->getDtCriacao())){
				$ps->bindParam($i, $usuario->getDtCriacao(), PDO::PARAM_STR);
				$i++;
			}
			if($usuario->getWebSite() != null && !empty($usuario->getWebSite())){
				$ps->bindParam($i, $usuario->getWebSite(), PDO::PARAM_STR);
				$i++;
			}
			if($usuario->getBiografia() != null && !empty($usuario->getBiografia())){
				$ps->bindParam($i, $usuario->getBiografia(), PDO::PARAM_STR);
				$i++;
			}

			$ps->execute();
			$listaUsuarios = $ps->fech(PDO::FETCH_ASSOC);
			$ps = null;
		}catch (PDOException $e){
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return $listaUsuarios;
	}
}
?>