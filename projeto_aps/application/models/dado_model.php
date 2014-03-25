<?php
class Dado_model extends CI_Model {
    
     public function __construct() {
        parent::__construct();
     }  
    /**
     * Salva o cadastro de um novo dado.
     * 
     * @param  array $info
     * @return int last inserted id
     * @throws RuntimeException
     */
    public function save(array $info)
    {
        $sql = '
            INSERT INTO 
                dado (
                    valor
                ) VALUES (
                    ?
                )
        ';
        $this->db->query($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Cadastro de dado não efetuado!');
    }
    
    /**
     * Pega um dado pelo id
     * 
     * @param type $id
     * @return object dado
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                valor
            FROM
                dado
            WHERE 
                id = ?
        ';
        $query = $this->db->query($sql, $id); 
        if ($query->num_rows() > 0 ){
            return $query->row();
        } else {
            throw new RuntimeException('Valor não encontrado!');
        }
        
    }
    
    /**
     * Lista todos os dados cadastrados
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
                dado
        ';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('Não existem dados cadastrados.');
        }
    }
    
    /**
     * Atualiza o cadastro de dados
     * 
     * @param type $id
     * @param array $dados
     * @return boolean
     * @throws RuntimeException
     */
    public function updateDado($id, array $dados)
    {
        $sql= '
            UPDATE
                dado
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
        
        throw new RuntimeException('Dado não atualizado!');
    }
    
    /**
     * Deleta o cadastro de um dado
     * 
     * @param type $id
     * @return boolean
     * @throws RuntimeException
     */
    public function deleteDado($id)
    {
        $sql = '
            DELETE FROM dado WHERE id = ?
        ';
        $this->db->query($sql, $id);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Erro ao deletar dado!');
    }

    
}