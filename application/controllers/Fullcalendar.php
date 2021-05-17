<?php
class Fullcalendar extends CI_Controller
{
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
        $kalender = $this->M_data->kalenderkerja();
        foreach ($kalender->result_array() as $value) {
            $data[] = array(
                'id' => $value['id'],
                'title' => $value['title'],
                'ket' => $value['ket'],
                'start' => $value['start_event'],
                'end' => $value['end_event'],
            );
        }
        echo json_encode($data);
    }
    public function kalender_add()
    {
        if ($this->input->post('title')) {
            $data = array(
                    'title' => $this->input->post('title'),
                    'ket' => $this->input->post('ket'),
                    'start_event' => $this->input->post('start'),
                    'end_event' => $this->input->post('end'),
                );
            $this->M_data->kalender_tambah($data);
        }
    }
    public function kalender_update()
    {
     if($this->input->post('id')){
         $data = array
         (
             'title' => $this->input->post('title'),
             'ket'=>$this->input->post('ket'),
             'start_event'=>$this->input->post('start'),
             'end_event'=>$this->input->post('end'),
         );
         $this->M_data->kalender_ubah($data, $this->input->post('id'));
     }   
    }
    public function kalender_delete()
    {   $id = $this->input->post('id');
        if($id){
            $this->M_data->kalender_hapus($id);
        }
    }
}
?>
