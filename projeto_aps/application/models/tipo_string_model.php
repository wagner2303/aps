<?php
class Tipo_string_model extends CI_Model {
    
     public function __construct() {
        parent::__construct();
     }
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
                TString (
                    valor
                ) VALUES (
                    ?
                )
        ';
        
        $this->db->query ($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        
        throw new RuntimeException('Texto não cadastrado!');
    }
    
    /**
     * Pega uma texto pelo seu ID
     * 
     * @param type $id
     * @return object texto
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                valor
            FROM
                TString
            WHERE
                id = ?
        ';
        
        $query = $this->db->query($sql, $id);
        
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('Texto não existe!');
        }
    }
    
    /**
     * Atualiza texto
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
                TString
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
        
        throw new RuntimeException('Texto não atualizado!');
    }

    /**
     * Remove registro de texto
     * 
     * @param numeric id
     * @throws RuntimeException
     * @return int last inserted id
     */
    public function deleteData($id)
    {
        $this->db->query('
            DELETE FROM TString WHERE id = ?
        ', $id);

        if ($this->db->affected_rows() != 1) {
            throw new RuntimeException('Erro ao deletar valor.');
        }

        return true;
    }
    
}