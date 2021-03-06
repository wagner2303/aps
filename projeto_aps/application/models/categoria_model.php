<?php

class Categoria_model extends CI_Model {
    
     public function __construct() {
        parent::__construct();
     }

    

    /**
     * Cadastra uma categoria
     * 
     * @param array $info
     * @return int inserted id
     * @throws RuntimeException
     */
    public function save(array $info) {
        $sql = '
            INSERT INTO 
                categoria (
                    nomeCategoria
                ) VALUES (
                    ? 
                )
        ';
        $this->db->query($sql, $info);
        
//        $this->db->insert('categoria', $info);

        if ($this->db->affected_rows() == 1) {
            return true;
        }

        throw new RuntimeException('Categoria não cadastrada!');
    }

    /**
     * Busca uma categori por id
     * 
     * @param type $id
     * @return object categoria
     * @throws RuntimeException
     */
    public function findCategoria($id) {
        $sql = '
            SELECT
                nomeCategoria
            FROM
                categoria
            WHERE
                id = ?
        ';

        $query = $this->db->query($sql, $id);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            throw new RuntimeException('Essa categoria não existe!');
        }
    }
    
     public function listAll()
    {
        $sql= '
            SELECT
                *
            FROM
                categoria
            ORDER BY
                nomeCategoria ASC
                
        ';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('Não existem categorias cadastradas.');
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
    public function updateCategoria($id, array $dados) {
        $sql = '
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
    public function deleteCategoria($id) {
        $this->db->query('
            DELETE FROM categoria WHERE id = ?
        ', $id);

        if ($this->db->affected_rows() != 1) {
            throw new RuntimeException('Ocorreu um erro ao deletar essa categoria');
        }

        return true;
    }

}
