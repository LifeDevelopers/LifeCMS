<?php
/**
* Classe de cadastro de Comentario no repositório
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
	 * Methodo para salvar um novo comentario.
	 * Este methodo sobrescreve o methodo salvar da interface iRepositório
	 * @access public
	 * @param Comentario $comentario
	 * @return boolean
	 */
	public function salvar($comentario){
		try{
			$sql = "INSERT INTO COMENTARIO(com_nome,com_email,com_texto,com_dtsubmit,sta_id,art_id) VALUES(?,?,?,?,?,?)";
			$ps = getStatement($sql);

			$ps->bindParam(1,$comentario->getNome(),PDO::PARAM_STR);
			$ps->bindParam(2,$comentario->getEmail(),PDO::PARAM_STR);
			$ps->bindParam(3,$comentario->getTexto(),PDO::PARAM_STR);
			$ps->bindParam(4,$comentario->getData(),PDO::PARAM_STR);
			$ps->bindParam(5,$comentario->getIdStat(),PDO::PARAM_INT);
			$ps->bindParam(6,$comentario->getIdArtigo(),PDO::PARAM_INT);
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
	 * Methodo para remover um comentario.
	 * Este methodo sobrescreve o methodo remover da interface iRepositório
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function remover($id){
		try{
			$sql = "DELETE FROM COMENTARIO WHERE com_id = ?";
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
	 * Methodo para alterar um comentario.
	 * Este methodo sobrescreve o methodo alterar da interface iRepositório
	 * @access public
	 * @param Comentario $comentario
	 * @return boolean
	 */
	public function alterar($comentario){
		try{
			$sql = "UPDATE COMENTARIO SET com_nome = ?,com_email = ?,com_texto = ?,com_dtsubmit = ?,sta_id = ?,art_id = ?";
			$ps = getStatement($sql);
				
			$ps->bindParam(1,$comentario->getNome(),PDO::PARAM_STR);
			$ps->bindParam(2,$comentario->getEmail(),PDO::PARAM_STR);
			$ps->bindParam(3,$comentario->getTexto(),PDO::PARAM_STR);
			$ps->bindParam(4,$comentario->getData(),PDO::PARAM_STR);
			$ps->bindParam(5,$comentario->getIdStat(),PDO::PARAM_INT);
			$ps->bindParam(6,$comentario->getIdArtigo(),PDO::PARAM_INT);
				
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
	 * Methodo para pesquisar um determinado comentario.
	 * Este methodo sobrescreve o methodo buscar da interface iRepositório
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function buscar($id){
		try{
			$sql = "SELECT * FROM COMENTARIO WHERE com_id = ?";
			$ps = getStatement($sql);
			$ps->bindParam(1,$id,PDO::PARAM_INT);
			$ps->execute();
			$rs = $ps->fetch(PDO::FETCH_ASSOC);
				
				
			$comentario = new Comentario();
			$comentario->setId($rs['com_id']);
			$comentario->setNome($rs['com_nome']);
			$comentario->setEmail($rs['com_email']);
			$comentario->setTexto($rs['com_texto']);
			$comentario->setData($rs['com_dtsubmit']);
			$comentario->setIdStat($rs['sta_id']);
			$comentario->setIdArtido($rs['art_id']);
				
			$ps = null;
		}catch (PDOException $e){
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}

		return $categoria;
	}

	/**
	 * Methodo para filtrar uma lista de comentarios.
	 * Este methodo sobrescreve o methodo filtrar da interface iRepositório
	 * @access public
	 * @param Comentario $comentario
	 * @return array
	 */
	public function filtrar($comentario){
		$listaComentarios = array();
		try{
			$sql = "SELECT * FROM COMENTARIO";
			$sqlConector = " AND ";
			
			if($comentario->getNome() != null && !empty($comentario->getNome())){
				$sql .= $sqlConector."com_nome LIKE '%?%' \n ";
			}
			if($comentario->getEmail() != null && !empty($comentario->getEmail())){
				$sql .= $sqlConector."com_email LIKE '%?%' \n";
			}
			if($comentario->getTexto() != null && !empty($comentario->getTexto())){
				$sql .= $sqlConector."com_texto LIKE '%?%' \n";
			}
			if($comentario->getData() != null && !empty($comentario->getData())){
				$sql .= $sqlConector."com_dtsubmit = ? \n";
			}
			if($comentario->getIdStat() != null && !empty($comentario->getIdStat())){
				$sql .= $sqlConector."sta_id = ? \n";
			}
			if($comentario->getIdArtigo() != null && !empty($comentario->getIdArtigo())){
				$sql .= $sqlConector."art_id = ? \n";
			}
				
			$ps = getStatement($sql);
			$i = 1;
			if($comentario->getNome() != null && !empty($comentario->getNome())){
				$ps->bindParam($i, $comentario->getNome(), PDO::PARAM_STR);
				$i++;
			}
			if($comentario->getEmail() != null && !empty($comentario->getNome())){
				$ps->bindParam($i, $comentario->getEmail(), PDO::PARAM_STR);
				$i++;
			}
			if($comentario->getTexto() != null && !empty($comentario->getTexto())){
				$ps->bindParam($i, $comentario->getTexto(), PDO::PARAM_STR);
				$i++;
			}
			if($comentario->getData() != null && !empty($comentario->getData())){
				$ps->bindParam($i, $comentario->getData(), PDO::PARAM_STR);
				$i++;
			}
			if($comentario->getIdStat() != null && !empty($comentario->getIdStat())){
				$ps->bindParam($i, $comentario->getIdStat(), PDO::PARAM_INT);
				$i++;
			}
			if($comentario->getIdArtigo() != null && !empty($comentario->getIdArtigo())){
				$ps->bindParam($i, $comentario->getIdArtigo(), PDO::PARAM_INT);
				$i++;
			}
				
			$ps->execute();
			$listaComentarios = $ps->fech(PDO::FETCH_ASSOC);
			$ps = null;
		}catch (PDOException $e){
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return $listaComentarios;
	}
}
?>