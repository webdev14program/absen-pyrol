<?php 
class Get extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->web = $this->db->get('web')->row();
        $this->load->library('Pdf');
        if ($this->session->userdata('level') != 'admin') {
            $this->session->set_flashdata('message', 'swal("Ops!", "Anda harus login sebagai admin", "error");');
            redirect('/');
        }
    }
    public function index()
    {
        // $data['body'] = 'admin/getdata';
        $this->load->view('admin/getdata');
    }
    public function getjabatan()
    {
        $id = $this->input->post('idjabatan');
        $jabatan = $this->M_data->pegawaiid($id)->row();
        echo $jabatan->nama_jabatan;
        
        
        // echo 'aa';
        // $data['data'] = $this->input->post('jabatan');
        // $data['pegawai'] = $this->db->get('pegawai')->result();
    }
    public function getisi()
    {
        $id = $this->input->post('id');
        $jabatan = $this->M_data->pegawaiid($id)->row()->nama_jabatan;
        $departemen = $this->M_data->pegawaiid($id)->row()->departemen;
        $status = $this->M_data->pegawaiid($id)->row()->ket_status_pegawai;
        $data = array(
            'id_jabatan' => $jabatan,
            'id_departemen' => $departemen,
            'id_status_pegawai' => $status,
        );
        echo json_encode($data);
    }
}
?>