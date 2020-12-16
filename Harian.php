<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Harian extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Harian_model', 'harian');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null){
            $harian = $this->harian->getHarian();
        } else {
            $harian = $this->harian->getHarian($id);
        }
        
        
        if ($harian) {
            $this->response([
                'status' => true,
                'data' => $harian
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Id tidak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'Id tidak dicantumkan' 
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            if($this->harian->deleteHarian($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Deleted the resource'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Id tidak ada'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'Mobil' => $this->post('Mobil'),
            'Paket_10_Hari' => $this->post('Paket_10_Hari'),
            'Paket_20_Hari' => $this->post('Paket_20_Hari'),
            'Paket_30_Hari' => $this->post('Paket_30_Hari')
        ];

        if ($this->harian->createHarian($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'Data baru berhasil ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menambah data!!!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id =$this->put('id');
        $data = [
            'Mobil' => $this->put('Mobil'),
            'Paket_10_Hari' => $this->put('Paket_10_Hari'),
            'Paket_20_Hari' => $this->put('Paket_20_Hari'),
            'Paket_30_Hari' => $this->put('Paket_30_Hari')
        ];

        if ($this->harian->updateHarian($data, $id) > 0){
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal merubah data!!!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}