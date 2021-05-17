<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	function pegawai()
	{
		$this->db->select('*');
	    $this->db->from('user');
	    $this->db->join('pegawai','user.kode_pegawai = pegawai.kode_pegawai');
	    $this->db->join('departemen','pegawai.id_departemen = departemen.departemen_id');
		$this->db->join('status_pegawai','pegawai.id_status_pegawai = status_pegawai.id_status_pegawai');
		$this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
		return $this->db->get();
	}
	function pegawaiid($id)
	{
		$this->db->select('*');
	    $this->db->from('user');
	    $this->db->join('pegawai','user.kode_pegawai = pegawai.kode_pegawai');
	    $this->db->join('departemen','pegawai.id_departemen = departemen.departemen_id');
		$this->db->join('status_pegawai', 'pegawai.id_status_pegawai = status_pegawai.id_status_pegawai');
		$this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
		$this->db->where('user.kode_pegawai',$id);
       	return $this->db->get();
	}

	public function kalenderkerja()
	{
		$this->db->order_by('id');
		return $this->db->get('kalender_kerja');	
	}
	public function kalender_tambah($data)
	{
		$this->db->insert('kalender_kerja',$data);
		
	}
	public function kalender_ubah($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('kalender_kerja', $data);	
	}
	public function kalender_hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('kalender_kerja');
	}

	function absendaily($id,$tahun,$bulan,$hari)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('kode_pegawai',$id);
		$this->db->where('year(waktu)',$tahun);
		$this->db->where('month(waktu)',$bulan);
		$this->db->where('day(waktu)',$hari);
		return $this->db->get();
	}
	public function absen()
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai','absen.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user','pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->order_by('absen.waktu','desc');
		return $this->db->get();
	}
	public function absensi_pegawai($id)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai','absen.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user','pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->where('pegawai.kode_pegawai',$id);
		$this->db->order_by('absen.waktu','desc');
		return $this->db->get();
	}
	public function pengangkatanpegawai()
	{
		$this->db->select('*');
		$this->db->from('pengangkatanpegawai');
		$this->db->join('pegawai','pengangkatanpegawai.id_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pengangkatanpegawai.id_pegawai = user.kode_pegawai');
		$this->db->join('jabatan','pengangkatanpegawai.no_jabatan = jabatan.id_jabatan');
		$this->db->join('departemen','pengangkatanpegawai.no_departemen = departemen.departemen_id');
		$this->db->join('status_pegawai','pengangkatanpegawai.no_urut_status_pegawai = status_pegawai.id_status_pegawai');
		$this->db->order_by('pengangkatanpegawai.id_pengangkatan_pegawai');
		return $this->db->get();
	}
	function pengangkatanpegawaiid($id)
	{
		$this->db->select('*');
		$this->db->from('pengangkatanpegawai');
		$this->db->join('pegawai', 'pengangkatanpegawai.id_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pengangkatanpegawai.id_pegawai = user.kode_pegawai');
		$this->db->join('jabatan', 'pengangkatanpegawai.no_jabatan = jabatan.id_jabatan');
		$this->db->join('departemen', 'pengangkatanpegawai.no_departemen = departemen.departemen_id');
		$this->db->join('status_pegawai', 'pengangkatanpegawai.no_urut_status_pegawai = status_pegawai.id_status_pegawai');
		$this->db->where('pengangkatanpegawai.id_pengangkatan_pegawai', $id);
		return $this->db->get();
	}
	public function cuti()
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('pegawai','cuti.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user','pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->order_by('cuti.id_cuti','desc');
		return $this->db->get();
	}
	public function mutasi()
	{
		$this->db->select('*');
		$this->db->from('mutasi');
		$this->db->join('pegawai', 'mutasi.id_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->join('jabatan', 'mutasi.id_jabatan_lama = jabatan.id_jabatan');
		$this->db->join('departemen','mutasi.id_departemen_lama = departemen.departemen_id');
		$this->db->order_by('mutasi.no_urut', 'desc');
		return $this->db->get();
	}
	public function perjalanandinas()
	{
		$this->db->select('*');
		$this->db->from('perjalanandinas');
		$this->db->join('pegawai', 'perjalanandinas.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->join('jabatan', 'jabatan.id_jabatan = perjalanandinas.id_jabatan');
		$this->db->order_by('perjalanandinas.id_perjalanan_dinas', 'desc');
		return $this->db->get();
	}
	public function perjalanandinas_pegawai($id)
	{
		$this->db->select('*');
		$this->db->from('perjalanandinas');
		$this->db->join('pegawai', 'perjalanandinas.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->join('jabatan', 'jabatan.id_jabatan = perjalanandinas.id_jabatan');
		$this->db->where('pegawai.kode_pegawai', $id);
		$this->db->order_by('perjalanandinas.id_perjalanan_dinas', 'desc');
		return $this->db->get();
	}
	public function cuti_pegawai($id)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('pegawai','cuti.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user','pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->where('pegawai.kode_pegawai',$id);
		$this->db->order_by('cuti.id_cuti','desc');
		return $this->db->get();
	}
	public function laporan($bulan)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai','absen.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user','pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->where('month(waktu)',$bulan);
		$this->db->order_by('absen.waktu','desc');
		return $this->db->get();
	}
	function absenbulan($id,$tahun,$bulan)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('kode_pegawai',$id);
		$this->db->where('keterangan','masuk');
		$this->db->where('year(waktu)',$tahun);
		$this->db->where('month(waktu)',$bulan);
		return $this->db->get();
	}
	function cutibulan($id,$tahun,$bulan)
	{

		$this->db->select('* ');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('kode_pegawai',$id);
		$this->db->where('jenis_cuti','cuti');
		$this->db->where('status_cuti','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		return $this->db->get();
	}
	function sakitbulan($id,$tahun,$bulan)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('kode_pegawai',$id);
		$this->db->where('jenis_cuti','sakit');
		$this->db->where('status_cuti','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		return $this->db->get();
	}
	function izinbulan($id,$tahun,$bulan)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('kode_pegawai',$id);
		$this->db->where('jenis_cuti','izin');
		$this->db->where('status_cuti','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		return $this->db->get();
	}
	function cutitoday($tahun,$bulan,$hari)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('jenis_cuti','cuti');
		$this->db->where('status_cuti','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		$this->db->where('day(tanggal)',$hari);
		return $this->db->get();
	}function izintoday($tahun,$bulan,$hari)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('jenis_cuti','izin');
		$this->db->where('status_cuti','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		$this->db->where('day(tanggal)',$hari);
		return $this->db->get();
	}
	function sakittoday($tahun,$bulan,$hari)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti','cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('jenis_cuti','sakit');
		$this->db->where('status_cuti','diterima');
		$this->db->where('year(tanggal)',$tahun);
		$this->db->where('month(tanggal)',$bulan);
		$this->db->where('day(tanggal)',$hari);
		return $this->db->get();
	}

	function hari($hari){
 
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
 
	return $hari_ini;
 
}
	function tgl_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
		
		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun
	 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
	function hadirtoday($tahun,$bulan,$hari)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('keterangan','masuk');
		$this->db->where('year(waktu)',$tahun);
		$this->db->where('month(waktu)',$bulan);
		$this->db->where('day(waktu)',$hari);
		return $this->db->get();
	}


}

/* End of file M_data.php */
/* Location: ./application/models/M_data.php */