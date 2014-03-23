<?php
class Categoria extends CI_Model
{   
    /**
     * Cadastra uma categoria
     * 
     * @param array $info
     * @return int inserted id
     * @throws RuntimeException
     */
    public function save(array $info )
    {
        $sql = '
            INSERT INTO 
                categoria (
                    nomeCategoria
                ) VALUES (
                    ? 
                )
        ';
        
        $this->db->query ($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        
        throw new RuntimeException('Categoria não cadastrada!');
    }
    
    /**
     * Mostra as categorias
     * 
     * @param type $id
     * @return object categoria
     * @throws RuntimeException
     */
    public function listCategoria($id)
    {
        $sql= '
            SELECT
                nomeCategoria
            FROM
                categoria
            WHERE
                id = ?
        ';
        
        $query = $this->db->query($sql, $id);
        
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('Essa categoria não existe!');
        }
    }
    
    /**
     * Atualiza categoria
     * 
     * @param type $id
     * @param array $dados
     * @return boolean
     * @throws RuntimeException
     */
    public function updateCategoria($id, array $dados)
    {
        $sql= '
            UPDATE
                categoria
            SET
                nomeCategoria = ?
            WHERE
                id = ?
        ';
        
        array_push($dados, $id);
        $this->db->query($sql, $dados);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Categoria não atualizada!');
    }

    /**
     * Remove registro de categoria pelo id
     * 
     * @param numeric id
     * @throws RuntimeException
     * @return int last inserted id
     */
    public function deleteAddress($id)
    {
        $this->db->query('
            DELETE FROM categoria WHERE id = ?
        ', $id);

        if ($this->db->affected_rows() != 1) {
            throw new RuntimeException('Ocorreu um erro ao deletar essa categoria');
        }

        return $this->db->insert_id();
    }
    
}