<?php
class Campo extends CI_Model
{   
    /**
     * Salva o cadastro de um novo campo.
     * 
     * @param  array $info
     * @return int last inserted id
     * @throws RuntimeException
     */
    public function save(array $info, $idCategoria)
    {
        $sql = '
            INSERT INTO 
                categoria (
                    nomeCampo, tipoCampo
                ) VALUES (
                    ?, ?
                )
        ';
        $info[] = $idCategoria;
        $this->db->query($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        
        throw new RuntimeException('Cadastro de campo não efetuado!');
    }
    
    /**
     * Procura um campo pelo seu endereço
     * 
     * @param type $id
     * @return object campo
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                nomeCampo, tipoCampo
            FROM
                campo
            WHERE 
                id = ?
        ';
        $query = $this->db->query($sql, $id); 
        if ($query->num_rows() > 0 ){
            return $query->row();
        } else {
            throw new RuntimeException('Campo não encontrado!');
        }
        
    }
    
    /**
     * Lista todas os pontos.
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
                campo
        ';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('Não existem campos cadastrados.');
        }
    }
    
    /**
     * Atualiza o cadastro de um campo
     * 
     * @param type $id
     * @param array $dados
     * @return boolean
     * @throws RuntimeException
     */
    public function updateCampo($id, array $dados)
    {
        $sql= '
            UPDATE
                campo
            SET
                nomeCampo = ?,
                tipoCampo = ?
            WHERE
                id = ?
        ';
        
        array_push($dados, $id);
        $this->db->query($sql, $dados);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Campo não atualizado!');
    }
    
    /**
     * Deleta o cadastro de um campo
     * 
     * @param type $id
     * @return boolean
     * @throws RuntimeException
     */
    public function deleteCampo($id)
    {
        $sql = '
            DELETE FROM campo WHERE id = ?
        ';
        $this->db->query($sql, $id);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Erro ao deletar campo!');
    }

    
}