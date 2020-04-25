<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        // menggunakan construct dari construcrtnya CI_controller
        parent::__construct();
        // memanggil / load file Mahasiswa_model
        $this->load->model('Mahasiswa_model');
    }

    public function index()
    {
        // $data['mahasiswa'] ==> akan menerima data dari yang dikirimkan dari mahasiswa model dengan method get
        $data['mahasiswa'] = $this->Mahasiswa_model->get();

        // $data ==> kemudian datanya kita kirimkan ke halaman index
        $this->load->view('mahasiswa/index', $data);
    }

    public function tambah()
    {
        // set_rules 3 parameter 
        // 1 ==> name dari form input
        // 2 ==> tulisan yang akan dicetak jika error
        // 3 ==> rulenya apa (boleh lebih dari 1)
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'Nim', 'required');

        // jika validasi bernilai false tampilkan halaman tambah mahasiswa
        // validasinya bernilai false ketika pertama membuka halaman  tambah
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('mahasiswa/tambah');
        } else {
            // jika bernilai true
            $this->Mahasiswa_model->insert();
            // membuat flashdata, flashdata ini akan dikirmkan ke view
            $this->session->set_flashdata('berhasil', 'Data Berhasil Ditambahkan');
            // redirect = mengalihakn ke halaman lain
            redirect('mahasiswa');
        }
    }

    // $id untuk menampung id yang dikirimkan dari index
    public function ubah($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'Nim', 'required');

        if ($this->form_validation->run() == FALSE) {
            // kemudian $id tersebut dikrimkan ke mahasiswa model method get row
            $data['mahasiswa'] = $this->Mahasiswa_model->getRow($id);
            $this->load->view('mahasiswa/ubah', $data);
        } else {
            // jika validation bernilai true jalankan method update
            $this->Mahasiswa_model->update();
            $this->session->set_flashdata('berhasil', 'Data Berhasil Diubah');
            redirect('mahasiswa');
        }
    }

    public function hapus($id)
    {
        // mengambil file mahasiswa berdasarkan id
        // karena kita butuh nama file foto
        $mahasiswa = $this->Mahasiswa_model->getRow($id);
        // unlink ==> menghapus file 
        // ./ ==> root folder
        unlink('./uploads/' . $mahasiswa->foto);
        $this->Mahasiswa_model->delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('berhasil', 'Data Berhasil Dihapus');
            redirect('mahasiswa');
        }
    }
}
