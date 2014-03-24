<?php
class Ponto_Interesse extends CI_Model
{   
    /**
     * Salva um ponto de interesse.
     * 
     * @param  array $info
     * @return int last inserted id
     * @throws RuntimeException
     */
    public function save(array $info, $idCategoria)
    {
        $sql = '
            INSERT INTO 
                PontoInteresse (
                    nomePonto, latitude, longitude
                ) VALUES (
                    ?, ?, ?
                )
        ';
        $info[] = $idCategoria;
        $this->db->query($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        
        throw new RuntimeException('Cadastro de ponto não efetuado!');
    }
    
    /**
     * Recupera um ponto pelo seu id
     * 
     * @param type $id
     * @return object ponto
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                nomePonto, latitude, longitude
            FROM
                PontoInteresse
            WHERE 
                id = ?
        ';
        $query = $this->db->query($sql, $id); 
        if ($query->num_rows() > 0 ){
            return $query->row();
        } else {
            throw new RuntimeException('Ponto não encontrado!');
        }
        
    }
    
    /**
     * Lista todos os pontos cadastrados.
     * 
     * @return type
     * @throws RuntimeException
     */
    public function listAll()
    {
        $sql= '
            SELECT
                *
            FROM
                PontoInteresse
                
        ';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('Não existem pontos cadastrados.');
        }
    }
    
    /**
     * Atualiza o cadastro de de um ponto
     * 
     * @param type $id
     * @param array $dados
     * @return boolean
     * @throws RuntimeException
     */
    public function updatePonto($id, array $dados)
    {
        $sql= '
            UPDATE
                PontoInteresse
            SET
                nomePonto = ?,
                latitude = ?,
                longitude = ?
            WHERE
                id = ?
        ';
        
        array_push($dados, $id);
        $this->db->query($sql, $dados);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Ponto nao atualizado!');
    }
    
    /**
     * Deleta o cadastro do ponto
     * 
     * @param type $id
     * @return boolean
     * @throws RuntimeException
     */
    public function deletePonto($id)
    {
        $sql = '
            DELETE FROM PontoInteresse WHERE id = ?
        ';
        $this->db->query($sql, $id);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Erro ao deletar ponto!');
    }

}