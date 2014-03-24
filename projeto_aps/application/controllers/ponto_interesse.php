<?php
class Ponto_Interesse extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('ponto_interesse_model');
        $this->load->helper('url_helper');
        $this->load->library(array ('form_validation', 'session'));
        $this->form_validation->set_rules('nomePonto', 'Nome do Ponto', 'required|max_length[255]');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_message('required', 'O Campo %s é obrigatório!');
    }
    
     public function index()
    {
        $this->load->view('ponto_interesse_view');
    }
    
    public function cadastrar()
    {
        if ($this->form_validation->run() === true) {
            try {
                $this->ponto_interesse_model->save(array(
                    $this->input->post('ponto_interesse'),
                ));   
                $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
           } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
            }
        } else {
            $this->load->view('ponto_interesse_view');
        }
    }
    
    public function mostrarPontoInteresse($id)
    {
        try {
            $vetor = $this->ponto_interesse_model->getById($id);
            $this->load->view('ponto_interesse_view', array(
                'ponto_interesse' => $ponto_interesse
            ));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function mostrarTodosPontoInteresses()
    {
        try {
            $vetor = $this->ponto_interesse_model->listAll();
            $this->load->view('ponto_interesse_view', array(
                'ponto_interesse' => $ponto_interesse,
            ));

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
   
    public function atualizarPontoInteresse($id)
    {
        try {
            $ponto_interesse = $this->ponto_interesse_model->getById($id);
            if ($this->input->post()) {
                if ($this->form_validation->run() === true) {
                    $this->ponto_interesse_model->updatePonto($id, array(
                        $this->input->post('nomePonto'),
                        $this->input->post('latitude'),
                        $this->input->post('longitude'),
                    ));
                    $this->session->set_flashdata('feedback', 'PontoInteresses atualizados com sucesso!');
                } else {
                    $this->load->view('ponto_interesse_view', array(
                        'ponto_interesse' => $ponto_interesse,
                    ));
                }
            } else {
                $this->load->view('ponto_interesse_view', array(
                    'ponto_interesse' => $ponto_interesse,
                ));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function apagarPontoInteresse($id)
    {
         try {
            $this->ponto_interesse_model->deletePonto($id);
            $this->session->set_flashdata('feedback', 'Ponto excluido com sucesso!');
        } catch (Exception $e) {
            $this->session->set_flashdata('feedback', $e->getMessage());
        }
    }
}
