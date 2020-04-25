<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{

    public function get()
    {
        return $this->db->get('mahasiswa')->result();
        // result() ==> mengambil semua data, data dikembalikan berupa object
        // result_array() ==> mengambil semua data, data dikembalikan berupa array
        // sintax ini sama dengan sintax berikut
        // return $this->db->query('SELECT * FROM mahasiswa')->result();
    }

    public function insert()
    {
        // $url => ketika terjadi error pada saat upload, halaman akan di redirect ke alamat ini
        // nantinya halaman ubah akan mempunyai url sendiri
        $url = 'mahasiswa/tambah';
        // tampung hasil input ke dalam sbuah variabel data
        $data = [
            'nama' => $this->input->post('nama'),
            'nim' => $this->input->post('nim'),
            // $this->upload($url) akan mengembalikan nama file  hasil upload
            'foto'  => $this->upload($url)
        ];
        // insert (nama tabel, datanya apa)
        $this->db->insert('mahasiswa', $data);
    }

    public function upload($url)
    {
        // folder dimana file akan disimpan
        $config['upload_path']          = './uploads/';
        // type file yang diizinkan
        $config['allowed_types']        = 'jpeg|jpg|png';
        // maximum size dalam kb
        $config['max_size']             = 200;
        // mengganti nama file (nama file tidak boleh sama)
        $config['encrypt_name']         = TRUE;

        // memanggil setinggan class upload
        $this->load->library('upload', $config);

        // jika uploadnya error
        if (!$this->upload->do_upload('foto')) {
            // tampung pesan errornya dalam variabel $error
            $error = array('error' => $this->upload->display_errors());
            // buat flasdata untuk pesan errornya
            $this->session->set_flashdata('error', $error['error']);
            // mengahlihkan ke halaamn ==> tergantung variabel url yang dikirimkan
            redirect($url);
        } else {
            // jika tidak ada error upload filenya
            $data = $this->upload->data();
            // kembalikan nama file ke method yang memanggilnya
            // nantinya nama file akan masuk ke database
            // filenya akan masuk ke dalam folder sesuai dengan upload_path
            return $data['file_name'];
        }
    }

    public function getRow($id)
    {
        $where = ['id' => $id];
        // ambil data pada tabel mahasiswa dimana id = id yang dikirimkan 
        return $this->db->get_where('mahasiswa', $where)->row();
    }

    public function update()
    {
        $url = 'mahasiswa/ubah';
        $fotoLama = $this->input->post('foto_lama');
        $data = [
            'nama' => $this->input->post('nama'),
            'nim' => $this->input->post('nim'),
            /* 
                jika input tipe file yang namenya foto tidak kosong (ada foto yang diupload) maka jalankan method upload, sebaliknya foto diisi dengan foto lama
            */
            'foto'  => !empty($_FILES["foto"]["name"]) ?  $this->upload($url) : $fotoLama
        ];
        $id = $this->input->post('id');

        // update pada tabel mahasiswa set datanya = $data dimana id = $id
        $this->db->where('id', $id);
        $this->db->update('mahasiswa', $data);
    }

    public function delete($id)
    {
        // delete pada tabel mahasiswa dimana id = $id
        $this->db->where('id', $id);
        $this->db->delete('mahasiswa');
    }
}
