<?php
/**
* Classe de repositório de Articles
*/
include_once('../../../config/Repositorio.class.php');
include_once('../../../interface/iCadastro.php');

class RepositorioArticle implements iCadastro
{
	private $conn;

	private function getStatement($sql){
		$conn = Repositorio::GetConnection();
		$conn->beginTransaction();
		return $conn->prepare($sql);
	}

	// Sobrescrevendo o método salvar
	public function salvar($artigo){
		try{
			$sql = "INSERT INTO ARTICLE(art_titulo,art_conteudo,art_dtpublicacao,art_tags,art_publicado,art_imagem,art_banner,cat_id,use_id) VALUES(?,?,?,?,?,?,?,?,?)";
			$ps = getStatement($sql);

			$ps->bindParam(1,$artigo->getTitulo(),PDO::PARAM_STR);
			$ps->bindParam(2,$artigo->getConteudo(),PDO::PARAM_STR);
			$ps->bindParam(3,$artigo->getDtPublicacao(),PDO::PARAM_STR);
			$ps->bindParam(4,$artigo->getTags(),PDO::PARAM_STR);
			$ps->bindParam(5,$artigo->getPublicado(),PDO::PARAM_INT);
			$ps->bindParam(6,$artigo->getImagem(),PDO::PARAM_STR);
			$ps->bindParam(7,$artigo->getBanner(),PDO::PARAM_STR);
			$ps->bindParam(8,$artigo->getCategoria()->getId(),PDO::PARAM_INT);
			$ps->bindParam(9,$artigo->getUser()->getId(),PDO::PARAM_INT);
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

	// Sobrescrevendo o método remover
	public function remover($id){
		try{
			$sql = "DELETE FROM ARTICLE WHERE art_id = ?";
			$ps = self::getStatement($sql);
			
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

	// Sobrescrevendo o método alterar
	public function alterar($artigo){
		try{
			$sql = "UPDATE ARTICLE SET art_titulo = ?,art_conteudo = ?,art_dtpublicacao = ?,art_tags = ?,art_publicado = ?,art_imagem = ?,art_banner = ?,cat_id = ?, user_id = ? WHERE art_id = ?";
			$ps = self::getStatement($sql);
			
			$ps->bindParam(1,$artigo->getTitulo(),PDO::PARAM_STR);
			$ps->bindParam(2,$artigo->getConteudo(),PDO::PARAM_STR);
			$ps->bindParam(3,$artigo->getDtPublicacao(),PDO::PARAM_STR);
			$ps->bindParam(4,$artigo->getTags(),PDO::PARAM_STR);
			$ps->bindParam(5,$artigo->getPublicado(),PDO::PARAM_INT);
			$ps->bindParam(6,$artigo->getImagem(),PDO::PARAM_STR);
			$ps->bindParam(7,$artigo->getBanner(),PDO::PARAM_STR);
			$ps->bindParam(8,$artigo->getCategoria()->getId(),PDO::PARAM_INT);
			$ps->bindParam(9,$artigo->getUser()->getId(),PDO::PARAM_INT);
			$ps->bindParam(9,$artigo->getId(),PDO::PARAM_INT);
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

	// Sobrescrevendo o método buscar
	public function buscar($id){
		try{
			$sql = "SELECT * FROM ARTICLE a, CATEGORIA c, UTILIZADOR u, PERFIL p WHERE a.cat_id = c.cat_id and a.use_id = u.use_id and u.per_id = p.per_id and a.id = ?";
			$ps = self::getStatement($sql);
			$ps->bindParam(1,$id,PDO::PARAM_INT);
			$ps->execute();
			$rs = $ps->fetch(PDO::FETCH_ASSOC);
			
			
			$article = new Article();
			$article->setId($rs['art_id']);
			$article->setTitulo($rs['art_titulo']);
			$article->setConteudo($rs['art_conteudo']);
			$article->setDtPublicacao($rs['art_dtpublicacao']);
			$article->setTags($rs['art_tags']);
			$article->setPublicado($rs['art_publicado']);
			$article->setImagem($rs['art_imagem']);
			$article->setBanner($rs['art_banner']);
			
			$categoria = new Categoria();
			$categoria->setId($rs['cat_id']);
			$categoria->setTitulo($rs['cat_titulo']);
			$categoria->setDescricao($rs['cat_descricao']);
			$categoria->setSubCategoria($rs['cat_subid']);
			$article->setCategoria($categoria);
			
			$user = new Usuario();
			$user->setId($rs['use_id']);
			$user->setNome($rs['use_nome']);
			$user->setUser($rs['use_user']);
			$user->setSenha($rs['use_senha']);
			$user->setAlcunha($rs['use_alcunha']);
			$user->setEmail($rs['use_email']);
			$user->setDtCriacao($rs['use_dtcriacao']);
			$user->setWebSite($rs['use_website']);
			$user->setBiografia($rs['use_biografia']);
			
			$perfil =  new Perfil();
			$perfil->setId($rs['per_id']);
			$perfil->setNome($rs['per_nome']);
			$user->setPerfil($perfil);
			
			$article->setUser($user);
			
			$ps = null;
		}catch (PDOException $e){
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		
		return $article;
	}

	// Sobrescrevendo o método filtrar
	public function filtrar($artigo){
		$listaArtigos = array();
		try{
			$sql = "SELECT * FROM ARTICLE a, CATEGORIA c WHERE a.cat_id = c.cat_id";
			$sqlConector = " AND ";
			
			if($artigo->getTitulo() != null && !empty($artigo->getTitulo())){
				$sql .= $sqlConector."art_titulo LIKE '%?%' \n ";
			}
			if($artigo->getConteudo() != null && !empty($artigo->getConteudo())){
				$sql .= $sqlConector."art_conteudo LIKE '%?%' \n";
			}
			if($artigo->getDtPublicacao() != null && !empty($artigo->getDtPublicacao())){
				$sql .= $sqlConector."art_dtpublicacao = ? \n";
			}
			if($artigo->getTags() != null && !empty($artigo->getTags())){
				$sql .= $sqlConector."art_tags LIKE '%?%' \n";
			}
			if($artigo->getCategoria()->getTitulo() != null && !empty($artigo->getCategoria()->getTitulo())){
				$sql .= $sqlConector."cat_titulo LIKE '%?%' \n";
			}
			if($artigo->getCategoria()->getDescricao() != null && !empty($artigo->getCategoria()->getDescricao())){
				$sql .= $sqlConector."cat_descricao LIKE '%?%' \n";
			}
			
			$ps = self::getStatement($sql);
			$i = 1;
			if($artigo->getTitulo() != null && !empty($artigo->getTitulo())){
				$ps->bindParam($i, $artigo->getTitulo(), PDO::PARAM_STR);
				$i++;
			}
			if($artigo->getConteudo() != null && !empty($artigo->getConteudo())){
				$ps->bindParam($i, $artigo->getConteudo(), PDO::PARAM_STR);
				$i++;
			}
			if($artigo->getDtPublicacao() != null && !empty($artigo->getDtPublicacao())){
				$ps->bindParam($i, $artigo->getDtPublicacao(), PDO::PARAM_STR);
				$i++;
			}
			if($artigo->getTags() != null && !empty($artigo->getTags())){
				$ps->bindParam($i, $artigo->getTags(), PDO::PARAM_STR);
				$i++;
			}
			if($artigo->getCategoria()->getTitulo() != null && !empty($artigo->getCategoria()->getTitulo())){
				$ps->bindParam($i, $artigo->getCategoria()->getTitulo(), PDO::PARAM_STR);
				$i++;
			}
			if($artigo->getCategoria()->getDescricao() != null && !empty($artigo->getCategoria()->getDescricao())){
				$ps->bindParam($i, $artigo->getCategoria()->getDescricao(), PDO::PARAM_STR);
				$i++;
			}
			$ps->execute();
			$listaArtigos = $ps->fech(PDO::FETCH_ASSOC);
			$ps = null;
		}catch (PDOException $e){
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return $listaArtigos;
	}

}
?>