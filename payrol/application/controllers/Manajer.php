<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->web = $this->db->get('web')->row();
        if ($this->session->userdata('level') != 'manajer') {
            $this->session->set_flashdata('message', 'swal("Ops!", "Anda harus login sebagai manajer", "error");');
            redirect('/');
        }
    }

    public function index()
    {
        $tahun             = date('Y');
        $bulan             = date('m');
        $hari             = date('d');
        $data['web']    = $this->web;
        $data['pegawai'] = $this->M_data->pegawai()->num_rows();
        $data['hadir']    = $this->M_data->hadirtoday($tahun, $bulan, $hari)->num_rows();
        $data['cuti']    = $this->M_data->cutitoday($tahun, $bulan, $hari)->num_rows();
        $data['izin']    = $this->M_data->izintoday($tahun, $bulan, $hari)->num_rows() + $this->M_data->sakittoday($tahun, $bulan, $hari)->num_rows();
        $data['absensi'] = $this->M_data->absen()->num_rows();
        $absen            = $this->M_data->absendaily($this->session->userdata('kode_pegawai'), $tahun, $bulan, $hari);
        if ($absen->num_rows() == 0) {
            $data['waktu'] = 'masuk';
        } elseif ($absen->num_rows() == 1) {
            $data['waktu'] = 'pulang';
        } else {
            $data['waktu'] = 'dilarang';
        }
        $data['departemen'] = $this->db->get('departemen')->num_rows();
        $data['title']    = 'Dashboard';
        $data['body']    = 'manajer/home';
        $this->load->view('template', $data);
    }
    public function absensi()
    {
        $data['web']    = $this->web;
        $data['data']    = $this->M_data->absen()->result();
        $data['title']    = 'Data Absen Pegawai';
        $data['body']    = 'manajer/absen';
        $this->load->view('template', $data);
    }
    public function proses_absen()
    {
        $id = $this->session->userdata('kode_pegawai');
        $p = $this->input->post();
        $data = [
            'kode_pegawai'    => $id,
            'keterangan' => $p['ket']
        ];
        $this->db->insert('absen', $data);
        $this->session->set_flashdata('message', 'swal("Berhasil!", "Melakukan absen", "success");');
        redirect('manajer');
    }
    public function pegawai()
    {
        $data['web']    = $this->web;
        $data['data']    = $this->M_data->pegawai()->result();
        $data['title']    = 'Data Pegawai';
        $data['body']    = 'manajer/pegawai';
        $this->load->view('template', $data);
    }
    public function mutasi()
    {
        $data['web'] = $this->web;
        $data['mutasi'] = $this->M_data->mutasi()->result();
        $data['title'] = "Data Mutasi Pegawai";
        $data['body'] = 'manajer/mutasi';
        $this->load->view('template', $data);
    }
    public function mutasi_terima($id)
    {
        $daftarmutasi = $this->db->get_where('mutasi', array("no_urut" => $id))->row();
        $idpegawai = $daftarmutasi->id_pegawai;
        $jenisdata = $daftarmutasi->jenis_mutasi; 
        
        

        $datajabatanbaru = ['id_jabatan' => $daftarmutasi->id_jabatan_baru];
        $datadepartemenbaru = ['id_departemen' => $daftarmutasi->id_departemen_baru];

        
        if($jenisdata == "promosi"){
            $this->db->trans_start();
            $this->db->update('mutasi', ['status_mutasi' => 'diterima'], ['no_urut' => $id]);
            $this->db->update('pegawai', $datajabatanbaru, ['kode_pegawai' => $idpegawai]);
            $this->db->trans_complete();
            $this->session->set_flashdata('message', 'swal("Berhasil!", "Menerima pengajuan mutasi", "success");');
            redirect('manajer/mutasi');
        }else{
            $this->db->trans_start();
            $this->db->update('mutasi', ['status_mutasi' => 'diterima'], ['no_urut' => $id]);
            $this->db->update('pegawai', $datadepartemenbaru, ['kode_pegawai' => $idpegawai]);
            $this->db->trans_complete();
            $this->session->set_flashdata('message', 'swal("Berhasil!", "Menerima pengajuan mutasi", "success");');
            redirect('manajer/mutasi');   
        }
    }

    public function mutasi_tolak($id)
    {
        $this->db->update('mutasi', ['status_mutasi' => 'ditolak'], ['no_urut' => $id]);
        $this->session->set_flashdata('message', 'swal("Berhasil!", "Menolak pengajuan mutasi", "success");');
        redirect('manajer/mutasi');
    }
    public function cuti()
    {
        $data['web']    = $this->web;
        $data['data']    = $this->M_data->cuti()->result();
        $data['title']    = 'Data Cuti Pegawai';
        $data['body']    = 'manajer/cuti';
        $this->load->view('template', $data);
    }
    public function perjalanandinas()
    {
        $data['web'] = $this->web;
        $data['data'] = $this->M_data->perjalanandinas()->result();
        $data['title'] = 'Data perjalanan Dinas';
        $data['body'] = 'manajer/perjalanandinas';
        $this->load->view('template', $data);

    }
    public function perjalanandinas_add()
    {
        $data['web'] = $this->web;
        $data['pegawai'] = $this->M_data->pegawai()->result();
        $data['data'] = $this->M_data->pegawaiid($this->session->userdata('kode_pegawai'))->row();
        $data['title']    = 'Tambah Data Perjalanan Dinas';
        $data['body']    = 'manajer/perjalanandinas_add';
        $this->load->view('template', $data);
    }
    public function perjalanandinas_terima($id)
    {
        $this->db->update('perjalanandinas', ['status_perjalanandinas' => 'diterima'], ['id_perjalanan_dinas' => $id]);
        $this->session->set_flashdata('message', 'swal("Berhasil!", "Menerima pengajuan perjalanan dinas", "success");');
        redirect('manajer/perjalanandinas');
    }
    public function perjalanandinas_tolak($id)
    {
        $this->db->update('perjalanandinas', ['status_perjalanandinas' => 'ditolak'], ['id_perjalanan_dinas' => $id]);
        $this->session->set_flashdata('message', 'swal("Berhasil!", "Menolak pengajuan perjalanan dinas", "success");');
        redirect('manajer/perjalanandinas');
    }
    public function cuti_terima($id)
    {
        $this->db->update('cuti', ['status_cuti' => 'diterima'], ['id_cuti' => $id]);
        $this->session->set_flashdata('message', 'swal("Berhasil!", "Menerima pengajuan cuti", "success");');
        redirect('manajer/cuti');
    }
    public function cuti_tolak($id)
    {
        $this->db->update('cuti', ['status_cuti' => 'ditolak'], ['id_cuti' => $id]);
        $this->session->set_flashdata('message', 'swal("Berhasil!", "Menolak pengajuan cuti", "success");');
        redirect('manajer/cuti');
    }
}
