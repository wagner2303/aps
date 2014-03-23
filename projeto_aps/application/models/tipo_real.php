<?php
class Tipo_Real extends CI_Model
{   
    /**
     * Cadastra um tipo inteiro
     * @param array $info
     * @return int inserted id
     * @throws RuntimeException
     */
    public function save(array $info )
    {
        $sql = '
            INSERT INTO 
                TReal (
                    valor
                ) VALUES (
                    ?
                )
        ';
        
        $this->db->query ($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        
        throw new RuntimeException('Valor não cadastrado!');
    }
    
    /**
     * Pega uma valor pelo seu ID
     * 
     * @param type $id
     * @return object inteiro
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                valor
            FROM
                TReal
            WHERE
                id = ?
        ';
        
        $query = $this->db->query($sql, $id);
        
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('Valor não existe!');
        }
    }
    
    /**
     * Atualiza valor
     * 
     * @param type $id
     * @param array $dados
     * @return boolean
     * @throws RuntimeException
     */
    public function update($id, array $dados)
    {
        $sql= '
            UPDATE
                TReal
            SET
                valor = ?
            WHERE
                id = ?
        ';
        
        array_push($dados, $id);
        $this->db->query($sql, $dados);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Valor não atualizado!');
    }

    /**
     * Remove registro de valor
     * 
     * @param numeric id
     * @throws RuntimeException
     * @return int last inserted id
     */
    public function deleteData($id)
    {
        $this->db->query('
            DELETE FROM TReal WHERE id = ?
        ', $id);

        if ($this->db->affected_rows() != 1) {
            throw new RuntimeException('Erro ao deletar valor.');
        }

        return $this->db->insert_id();
    }
    
}
