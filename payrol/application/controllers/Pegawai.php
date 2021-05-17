<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->web = $this->db->get('web')->row();
		if ($this->session->userdata('level') != 'pegawai') {
			$this->session->set_flashdata('message', 'swal("Ops!", "Anda haru login sebagai pegawai", "error");');
			redirect('/');
		}
		date_default_timezone_set ( 'asia/jakarta' ); 
	}
	
	public function index()
	{
		$tahun 			= date('Y');
		$bulan 			= date('m');
		$hari 			= date('d');
		$absen			= $this->M_data->absendaily($this->session->userdata('kode_pegawai'),$tahun,$bulan,$hari); 
		if ($absen->num_rows() == 0) { $data['waktu'] = 'masuk'; }
		elseif ($absen->num_rows() == 1) { $data['waktu'] = 'pulang'; }
		else { $data['waktu'] = 'dilarang'; }
		$data['kodepegawai'] = $this->db->get('pegawai')->row()->kode_pegawai;
		$data['web']	= $this->web;
		$data['title']	= 'Dashboard';
		$data['body']	= 'pegawai/home';
		$this->load->view('template',$data);
	}
	//proses absen
	public function proses_absen()
	{
		$id = $this->session->userdata('kode_pegawai');
		$p = $this->input->post();
		$data = [
			'kode_pegawai'	=> $id,
			'keterangan' => $p['ket']
		];
		$this->db->insert('absen',$data);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Melakukan absen", "success");');
		redirect('pegawai');
	}
	//data absen
	public function absensi()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->absensi_pegawai($this->session->userdata('kode_pegawai'))->result();
		$data['title']	= 'Data Absen';
		$data['body']	= 'pegawai/absen';
		$this->load->view('template',$data);
	}
	public function perjalanandinas()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->perjalanandinas_pegawai($this->session->userdata('kode_pegawai'))->result();
		$data['title'] = 'Perjalanan Pegawai';
		$data['body']	= 'pegawai/perjalanandinas';
		$this->load->view('template',$data);
	}
	public function perjalanandinas_add()
	{
		$data['web'] = $this->web;
		$data['data'] = $this->M_data->pegawaiid($this->session->userdata('kode_pegawai'))->row();
		$data['title']	= 'Tambah Data Perjalanan Dinas';
		$data['body']	= 'pegawai/perjalanandinas_add';
		$this->load->view('template', $data);
	}
	public function perjalanandinas_simpan()
	{
		$data = $this->db->get_where("pegawai", array("kode_pegawai" => $this->session->userdata('kode_pegawai')))->row(); 
		$kodejabatan = $data->id_jabatan;
		$this->db->trans_start();
		$insert = array(
			'kode_pegawai' => $this->session->userdata('kode_pegawai'),
			'no_surat_dinas' => $this->input->post('nosuratdinas'),
			'id_jabatan' => $kodejabatan,
			'ket_perjalanan_dinas'=> $this->input->post('ketperjalanandinas'),
			'status_perjalanandinas' => 'diajukan',

		);
		$this->db->insert('perjalanandinas',$insert);

		$cek = $this->db->query("SELECT * FROM perjalanandinas ORDER BY id_perjalanan_dinas DESC LIMIT 1")->row();
		
		$mulai = new DateTime($this->input->post('tanggalmulai'));
		$akhir = new DateTime($this->input->post('tanggalakhir'));
		$jumlah = $akhir->diff($mulai)->days + 1;
		$awal = $this->input->post('tanggalmulai');
		for ($i=0; $i < $jumlah ; $i++) { 
			$detail = array(
				'id_perjalanan_dinas' => $cek->id_perjalanan_dinas,
				'tanggal_dinas' => date('Y-m-d', strtotime('+' . $i . ' days', strtotime($awal))),
			);
			$this->db->insert('detailperjalanandinas',$detail);
		}
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Pengajuan Perjalanan Dinas", "success");');
		redirect('pegawai/perjalanandinas');
	}

	public function perjalanandinas_delete($id)
	{
		$this->db->delete('perjalanandinas', ['id_perjalanan_dinas' => $id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Delete pengajuan perjalanan dinas", "success");');
		redirect('pegawai/perjalanandinas');
	}
	//CURD data cuti
	public function cuti()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->cuti_pegawai($this->session->userdata('kode_pegawai'))->result();
		$pegawai = $this->M_data->pegawaiid($this->session->userdata('kode_pegawai'))->row();
		$dt1 = new DateTime($pegawai->waktu_masuk);
		$dt2 = new DateTime(date('Y-m-d'));
		$d = $dt2->diff($dt1)->days + 1;
		$data['bakti']	= $d;
		$data['title']	= 'Data Permohonan Ketidakhadiran';
		$data['body']	= 'pegawai/cuti';
		$this->load->view('template',$data);
	}
	public function cuti_add()
	{
		$data['web']	= $this->web;
		$pegawai = $this->M_data->pegawaiid($this->session->userdata('kode_pegawai'))->row();
		$dt1 = new DateTime($pegawai->waktu_masuk);
		$dt2 = new DateTime(date('Y-m-d'));
		$d = $dt2->diff($dt1)->days + 1;
		$data['bakti']	= $d;
		$data['title']	= 'Tambah Data Ketidakhadiran';
		$data['body']	= 'pegawai/cuti_add';
		$this->load->view('template',$data);
	}
	public function cuti_simpan()
	{
		$this->db->trans_start();
		$data = array(
			'kode_pegawai'			=> $this->session->userdata('kode_pegawai'),
			'jenis_cuti'	=> $this->input->post('jenis'),
			'alasan'		=> $this->input->post('alasan'),
			'status_cuti'		=> 'diajukan'
		);

		if (isset($_FILES['bukti']['name'])) {
			$config['upload_path'] 		= './bukti/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['overwrite']  		= true;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('bukti')){
				$this->session->set_flashdata('message', 'swal("Ops!", "Bukti gagal diupload", "error");');
				redirect('pegawai/cuti_add');
			}
			else{
				$img = $this->upload->data();
				$data['bukti'] = $img['file_name'];
			}
		}
		
		$this->db->insert('cuti',$data);
		$cek = $this->db->query(" select * from cuti order by id_cuti desc limit 1 ")->row();
		$dt1 = new DateTime($this->input->post('mulai'));
		$dt2 = new DateTime($this->input->post('akhir'));
		$jml = $dt2->diff($dt1)->days + 1;
		$tgl1= $this->input->post('mulai');
		$no  = 1;
		for ($i=0; $i < $jml ; $i++) { 
			$insert = array(
				'id_cuti' => $cek->id_cuti,
				'tanggal' => date('Y-m-d', strtotime('+'.$i.' days', strtotime($tgl1))),
			);
			$this->db->insert('detailcuti',$insert);
		}

		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Pengajuan cuti", "success");');
		redirect('pegawai/cuti');
	}
	public function cuti_update($id)
	{
		$data = array(
			'kode_pegawai'	=> $this->session->userdata('kode_pegawai'),
			'mulai'	=> $this->input->post('mulai'),
			'akhir'	=> $this->input->post('akhir'),
			'alasan'=> $this->input->post('alasan')
		);
		$this->db->update('cuti',$data,['id_cuti'=>$id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Update pengajuan cuti", "success");');
		redirect('pegawai/cuti');
	}
	public function cuti_edit($id)
	{
		$data['web']	= $this->web;
		$data['title']	= 'Update Data Cuti';
		$data['data']	= $this->db->get_where('cuti',['id_cuti'=>$id])->row();
		$data['body']	= 'pegawai/cuti_edit';
		$this->load->view('template',$data);
	}
	public function cuti_delete($id)
	{
		$this->db->delete('cuti',['id_cuti'=>$id]);
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Delete pengajuan cuti", "success");');
		redirect('pegawai/cuti');
	}
	//update profile
	public function profile()
	{
		$data['web']	= $this->web;
		$data['data']	= $this->M_data->pegawaiid($this->session->userdata('nip'))->row();
		$data['title']	= 'Profile Pengguna';
		$data['body']	= 'pegawai/profile';
		$this->load->view('template',$data);
	}
	public function profile_update($id)
	{
		$usr = [
			'nama'	=> $this->input->post('nama'),
			'email'	=> $this->input->post('email'),
		];
		$this->db->trans_start();
		$this->db->update('user',$usr,['kode_pegawai'=>$id]);
		$this->db->update('pegawai',['jenis_kelamin'=>$this->input->post('jenis_kelamin')],['nip'=>$id]);
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'swal("Berhasil!", "Update profile", "success");');
		redirect('pegawai/profile');
	}
	public function ganti_password()
	{
		$data['web']	= $this->web;
		$data['title']	= 'Ganti Password';
		$data['body']	= 'pegawai/ganti password';
		$this->load->view('template',$data);
	}
	public function password_update($id)
	{
		$p = $this->input->post();
		$cek = $this->db->get_where('user',['kode_pegawai'=>$id]);
		if ($cek->num_rows() > 0) {
			$a = $cek->row();
			if (md5($p['pw_lama']) == $a->password) {
				$this->db->update('user',['password'=>md5($p['pw_baru'])],['kode_pegawai'=>$id]);
				$this->session->set_flashdata('message', 'swal("Berhasil!", "Update password", "success");');
				redirect('pegawai/ganti_password');
			}
			else
			{
				$this->session->set_flashdata('message', 'swal("Ops!", "Password lama yang anda masukan salah", "error");');
				redirect('pegawai/ganti_password');
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'swal("Ops!", "Anda harus login", "error");');
				redirect('auth');
		}
	}
	public function slip()
	{
		$tahun 			= date('Y');
		$bulan 			= date('m');
		$data['data']	= $this->M_data->pegawaiid($this->session->userdata('kode_pegawai'))->row();
		$data['absen']  = $this->M_data->absenbulan($this->session->userdata('kode_pegawai'),$tahun,$bulan)->num_rows(); 
        $data['cuti']  	= $this->M_data->cutibulan($this->session->userdata('kode_pegawai'),$tahun,$bulan)->num_rows(); 
        $data['sakit']  = $this->M_data->sakitbulan($this->session->userdata('kode_pegawai'),$tahun,$bulan)->num_rows(); 
        $data['izin']  	= $this->M_data->izinbulan($this->session->userdata('kode_pegawai'),$tahun,$bulan)->num_rows();
		$data['web']	= $this->web;
		$data['title']	= 'Slip Gaji';
		$data['body']	= 'pegawai/slip';
		$this->load->view('template',$data);
	}
	public function print_slip()
	{
		$tahun 			= date('Y');
		$bulan 			= date('m');
		$data['data']	= $this->M_data->pegawaiid($this->session->userdata('kode_pegawai'))->row();
		$data['absen']  = $this->M_data->absenbulan($this->session->userdata('kode_pegawai'),$tahun,$bulan)->num_rows(); 
        $data['cuti']  	= $this->M_data->cutibulan($this->session->userdata('kode_pegawai'),$tahun,$bulan)->num_rows(); 
        $data['sakit']  = $this->M_data->sakitbulan($this->session->userdata('kode_pegawai'),$tahun,$bulan)->num_rows(); 
        $data['izin']  	= $this->M_data->izinbulan($this->session->userdata('kode_pegawai'),$tahun,$bulan)->num_rows();
		$data['web']	= $this->web;
		$data['title']	= 'Slip Gaji '.$this->session->userdata('nama');
		$this->load->view('pegawai/slip_print',$data);
	}
}