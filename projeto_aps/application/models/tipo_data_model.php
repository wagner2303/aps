<?php
class Tipo_data_model extends CI_Model {
    
     public function __construct() {
        parent::__construct();
     }  
    /**
     * Cadastra um tipo data
     * @param array $info
     * @return int inserted id
     * @throws RuntimeException
     */
    public function save(array $info )
    {
        $sql = '
            INSERT INTO 
                TData (
                    valor
                ) VALUES (
                    ?
                )
        ';
        
        $this->db->query ($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Data não cadastrada!');
    }
    
    /**
     * Pega uma data pelo seu ID
     * 
     * @param type $id
     * @return object data
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                valor
            FROM
                TData
            WHERE
                id = ?
        ';
        
        $query = $this->db->query($sql, $id);
        
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('Data não existe!');
        }
    }
    
    /**
     * Atualiza data
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
                TData
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
        
        throw new RuntimeException('Data não atualizada!');
    }

    /**
     * Remove registro de data
     * 
     * @param numeric id
     * @throws RuntimeException
     * @return int last inserted id
     */
    public function deleteData($id)
    {
        $this->db->query('
            DELETE FROM TData WHERE id = ?
        ', $id);

        if ($this->db->affected_rows() != 1) {
            throw new RuntimeException('Erro ao deletar data.');
        }

        return true;
    }
    
}