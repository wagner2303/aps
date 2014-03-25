<?php

/*
 * Não esquecer de chamar as views corretas no decorrer do código
 * =P
 */

class Categoria extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('categoria_model');
        $this->load->helper('url_helper');
        $this->load->library(array ('form_validation', 'session'));
        $this->form_validation->set_rules('nomeCategoria', 'Nome Categoria', 'required|max_length[50]');
        $this->form_validation->set_message('required', 'O Campo %s é obrigatório!');
    }
    
     public function index()
    {
        $this->load->view('categoria_view');// Chamar a view correta quando criada
         
    }
    
    public function cadastrar()
    {
        $this->load->model('categoria_model');
        if ($this->form_validation->run() === true) {
            try {
                $this->categoria_model->save(array(
                    $this->input->post('nomeCategoria'),
                ));   
                $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
           } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
            }
        } else {
            $this->load->view('categoria_view'); //Chamar a view certa aqui também =P
        }
    }
    
    public function mostrarCategoria($id)
    {
        $this->load->model('categoria_model');
        try {
            $vetor = $this->categoria_model->getById($id);
            $this->load->view('categoria_view', array(
                'categoria' => $categoria
            ));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function mostrarTodasCategorias()
    {
        $this->load->model('categoria_model');
        try {
            $categoria = $this->categoria_model->listAll();
            $this->load->view('categoria_view', array(
                'categoria' => $categoria,
            ));

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
   
    public function atualizarCategoria($id)
    {
        $this->load->model('categoria_model');
        try {
            $categoria = $this->categoria_model->getById($id);
            if ($this->input->post()) {
                if ($this->form_validation->run() === true) {
                    $this->categoria_model->updateCategoria($id, array(
                        $this->input->post('nomeCategoria'),
                    ));
                    $this->session->set_flashdata('feedback', 'Dados atualizados com sucesso!');
                } else {
                    $this->load->view('categoria_view', array(
                        'categoria' => $categoria,
                    ));
                }
            } else {
                $this->load->view('categoria_view', array(
                    'categoria' => $categoria,
                ));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function apagarCategoria($id)
    {
        $this->load->model('categoria_model');
        try {
            $this->categoria_model->deleteCategoria($id);
            $this->session->set_flashdata('feedback', 'Categoria excluida com sucesso!');
        } catch (Exception $e) {
            $this->session->set_flashdata('feedback', $e->getMessage());
        }
    }
}