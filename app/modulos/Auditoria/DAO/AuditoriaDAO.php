<?php
/**
 * Classe de registro de Auditoria no repositório
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
	 * Methodo para salvar um novo registro de auditoria.
	 * Este methodo sobrescreve o methodo salvar da interface iRepositorio
	 * @access public
	 * @param Auditoria $auditoria
	 * @return boolean
	 */
	public function salvar($auditoria){
		try{
			$sql = "INSERT INTO AUDITORIA(use_id,aud_data,tip_id,aud_descricao) VALUES(?,?,?,?)";
			$ps = getStatement($sql);

			$ps->bindParam(1,$auditoria->getUsuario()->getId(),PDO::PARAM_INT);
			$ps->bindParam(2,$auditoria->getData(),PDO::PARAM_STR);
			$ps->bindParam(3,$auditoria->getTipoAuditoria()->getId(),PDO::PARAM_INT);
			$ps->bindParam(4,$auditoria->getDescricao(),PDO::PARAM_STR);
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
	 * Methodo para remover um registro de auditoria.
	 * Este methodo sobrescreve o methodo remover da interface iRepositorio
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function remover($id){
		try{
			$sql = "DELETE FROM AUDITORIA WHERE aud_id = ?";
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
	 * Methodo para alterar um registro de auditoria.
	 * Este methodo sobrescreve o methodo alterar da interface iRepositorio
	 * @access public
	 * @param Auditoria $auditoria
	 * @return boolean
	 */
	public function alterar($auditoria){
		try{
			$sql = "UPDATE AUDITORIA SET use_id = ?,aud_data = ?,tip_id = ?,aud_descricao = ?";
			$ps = getStatement($sql);

			$ps->bindParam(1,$auditoria->getUsuario()->getId(),PDO::PARAM_INT);
			$ps->bindParam(2,$auditoria->getData(),PDO::PARAM_STR);
			$ps->bindParam(3,$auditoria->getTipoAuditoria()->getId(),PDO::PARAM_INT);
			$ps->bindParam(4,$auditoria->getDescricao(),PDO::PARAM_STR);

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
	 * Methodo para pesquisar um determinado registro de auditoria.
	 * Este methodo sobrescreve o methodo buscar da interface iRepositorio
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function buscar($id){
		try{
			$sql = "SELECT * FROM AUDITORIA a, TIPOAUDITORIA t, UTILIZADOR u WHERE a.tip_id = t.tip_id AND a.use_id = u.use_id AND a.aud_id = ?";
			$ps = getStatement($sql);
			$ps->bindParam(1,$id,PDO::PARAM_INT);
			$ps->execute();
			$rs = $ps->fetch(PDO::FETCH_ASSOC);


			$auditoria = new Auditoria();
			$auditoria->setId($rs['aud_id']);
			
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
			$usuario->setPerfil($perfil);
			
			$auditoria->setData($rs['aud_data']);
			$tipoauditoria = new TipoAuditoria();
			$tipoauditoria->setId($rs['tip_id']);
			$auditoria->setTipoAuditoria($tipoauditoria);
			$auditoria->setDescricao($rs['aud_descricao']);
			$ps = null;
		}catch (PDOException $e){
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}

		return $auditoria;
	}

	/**
	 * Methodo para filtrar uma lista de registro de auditoria.
	 * Este methodo sobrescreve o methodo filtrar da interface iRepositorio
	 * @access public
	 * @param Auditoria $auditoria
	 * @return array
	 */
	public function filtrar($auditoria){
		$listaAuditoria = array();
		try{
			$sql = "SELECT * FROM AUDITORIA a, TIPOAUDITORIA t, UTILIZADOR u WHERE a.tip_id = t.tip_id AND a.use_id = u.use_id ";
			$sqlConector = " AND ";
				
			if($auditoria->getUsuario() != null && !empty($auditoria->getUsuario())){
				$sql .= $sqlConector."use_id = ? \n ";
			}
			if($auditoria->getData() != null && !empty($auditoria->getData())){
				$sql .= $sqlConector."aud_data = ? \n";
			}
			if($auditoria->getTipoAuditoria() != null && !empty($auditoria->getTipoAuditoria())){
				$sql .= $sqlConector."tip_id = ? \n";
			}
			if($auditoria->getDescricao() != null && !empty($auditoria->getDescricao())){
				$sql .= $sqlConector."aud_descricao LIKE '%?%' \n";
			}

			$ps = getStatement($sql);
			$i = 1;
			if($auditoria->getUsuario() != null && !empty($auditoria->getUsuario())){
				$ps->bindParam($i, $auditoria->getUsuario()->getId(), PDO::PARAM_INT);
				$i++;
			}
			if($auditoria->getData() != null && !empty($auditoria->getData())){
				$ps->bindParam($i, $auditoria->getData(), PDO::PARAM_STR);
				$i++;
			}
			if($auditoria->getTipoAuditoria() != null && !empty($auditoria->getTipoAuditoria())){
				$ps->bindParam($i, $auditoria->getTipoAuditoria()->getId(), PDO::PARAM_INT);
				$i++;
			}
			if($auditoria->getDescricao() != null && !empty($auditoria->getDescricao())){
				$ps->bindParam($i, $auditoria->getDescricao(), PDO::PARAM_STR);
				$i++;
			}

			$ps->execute();
			$listaAuditoria = $ps->fech(PDO::FETCH_ASSOC);
			$ps = null;
		}catch (PDOException $e){
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return $listaAuditoria;
	}
}
?>