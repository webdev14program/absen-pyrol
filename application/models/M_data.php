<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{

	function pegawai()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('pegawai', 'user.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('departemen', 'pegawai.id_departemen = departemen.departemen_id');
		$this->db->join('status_pegawai', 'pegawai.id_status_pegawai = status_pegawai.id_status_pegawai');
		$this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
		return $this->db->get();
	}

	function pegawai_add($id)
	{
		$sql = "SELECT * FROM `user`
				WHERE kode_pegawai LIKE '%$id%'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function count_hadir_pegawai($id)
	{
		$sql = "SELECT  count(*) AS jum_hadir  FROM `absen`
				WHERE absen.kode_pegawai LIKE '%$id%'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function count_lembur_pegawai($id)
	{
		$sql = "SELECT COUNT(*) AS lembur FROM `absen_lembur`
				WHERE absen_lembur.kode_pegawai LIKE '%$id%'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function pegawaiid($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('pegawai', 'user.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('departemen', 'pegawai.id_departemen = departemen.departemen_id');
		$this->db->join('status_pegawai', 'pegawai.id_status_pegawai = status_pegawai.id_status_pegawai');
		$this->db->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan');
		$this->db->where('user.kode_pegawai', $id);
		return $this->db->get();
	}

	public function kalenderkerja()
	{
		$this->db->order_by('id');
		return $this->db->get('kalender_kerja');
	}
	public function kalender_tambah($data)
	{
		$this->db->insert('kalender_kerja', $data);
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

	function absendaily($id, $tahun, $bulan, $hari)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('kode_pegawai', $id);
		$this->db->where('year(waktu)', $tahun);
		$this->db->where('month(waktu)', $bulan);
		$this->db->where('day(waktu)', $hari);
		return $this->db->get();
	}
	public function absen()
	{
		// $this->db->select('*');
		// $this->db->from('absen');
		// $this->db->join('pegawai','absen.kode_pegawai = pegawai.kode_pegawai');
		// $this->db->join('user','pegawai.kode_pegawai = user.kode_pegawai');
		// $this->db->order_by('absen.waktu','desc');
		// return $this->db->get();

		$sql = "SELECT absen.id_absen,absen.kode_pegawai,absen.waktu,user.nama,absen.keterangan,
IF(absen.keterangan = 'Masuk',
   CASE
    WHEN hour(waktu)<8 THEN 'Masuk'
    WHEN hour(waktu)=8 THEN 'Telat'
    WHEN hour(waktu)=9 THEN 'Telat'
    WHEN hour(waktu)=10 THEN 'Telat'
    WHEN hour(waktu)=11 THEN 'Telat'
   	WHEN hour(waktu)=12 THEN 'Telat'
   	WHEN hour(waktu)=13 THEN 'Telat'
    WHEN hour(waktu)=14 THEN 'Telat'
    WHEN hour(waktu)=15 THEN 'Telat'
   END,
  CASE
    WHEN hour(waktu)>16 THEN 'Keluar'
  END) AS status
FROM absen
INNER JOIN user
ON absen.kode_pegawai=user.kode_pegawai";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function absensi_pegawai($id)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai', 'absen.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->where('pegawai.kode_pegawai', $id);
		$this->db->order_by('absen.waktu', 'desc');
		return $this->db->get();
	}
	public function pengangkatanpegawai()
	{
		$this->db->select('*');
		$this->db->from('pengangkatanpegawai');
		$this->db->join('pegawai', 'pengangkatanpegawai.id_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pengangkatanpegawai.id_pegawai = user.kode_pegawai');
		$this->db->join('jabatan', 'pengangkatanpegawai.no_jabatan = jabatan.id_jabatan');
		$this->db->join('departemen', 'pengangkatanpegawai.no_departemen = departemen.departemen_id');
		$this->db->join('status_pegawai', 'pengangkatanpegawai.no_urut_status_pegawai = status_pegawai.id_status_pegawai');
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
		$this->db->join('pegawai', 'cuti.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->order_by('cuti.id_cuti', 'desc');
		return $this->db->get();
	}
	public function mutasi()
	{
		$this->db->select('*');
		$this->db->from('mutasi');
		$this->db->join('pegawai', 'mutasi.id_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->join('jabatan', 'mutasi.id_jabatan_lama = jabatan.id_jabatan');
		$this->db->join('departemen', 'mutasi.id_departemen_lama = departemen.departemen_id');
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
		$this->db->join('pegawai', 'cuti.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->where('pegawai.kode_pegawai', $id);
		$this->db->order_by('cuti.id_cuti', 'desc');
		return $this->db->get();
	}
	public function laporan($bulan)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->join('pegawai', 'absen.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->where('month(waktu)', $bulan);
		$this->db->order_by('absen.waktu', 'desc');
		return $this->db->get();
	}
	function absenbulan($id, $tahun, $bulan)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('kode_pegawai', $id);
		$this->db->where('keterangan', 'masuk');
		$this->db->where('year(waktu)', $tahun);
		$this->db->where('month(waktu)', $bulan);
		return $this->db->get();
	}
	function cutibulan($id, $tahun, $bulan)
	{

		$this->db->select('* ');
		$this->db->from('cuti');
		$this->db->join('detailcuti', 'cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('kode_pegawai', $id);
		$this->db->where('jenis_cuti', 'cuti');
		$this->db->where('status_cuti', 'diterima');
		$this->db->where('year(tanggal)', $tahun);
		$this->db->where('month(tanggal)', $bulan);
		return $this->db->get();
	}
	function sakitbulan($id, $tahun, $bulan)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti', 'cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('kode_pegawai', $id);
		$this->db->where('jenis_cuti', 'sakit');
		$this->db->where('status_cuti', 'diterima');
		$this->db->where('year(tanggal)', $tahun);
		$this->db->where('month(tanggal)', $bulan);
		return $this->db->get();
	}
	function izinbulan($id, $tahun, $bulan)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti', 'cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('kode_pegawai', $id);
		$this->db->where('jenis_cuti', 'izin');
		$this->db->where('status_cuti', 'diterima');
		$this->db->where('year(tanggal)', $tahun);
		$this->db->where('month(tanggal)', $bulan);
		return $this->db->get();
	}
	function cutitoday($tahun, $bulan, $hari)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti', 'cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('jenis_cuti', 'cuti');
		$this->db->where('status_cuti', 'diterima');
		$this->db->where('year(tanggal)', $tahun);
		$this->db->where('month(tanggal)', $bulan);
		$this->db->where('day(tanggal)', $hari);
		return $this->db->get();
	}
	function izintoday($tahun, $bulan, $hari)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti', 'cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('jenis_cuti', 'izin');
		$this->db->where('status_cuti', 'diterima');
		$this->db->where('year(tanggal)', $tahun);
		$this->db->where('month(tanggal)', $bulan);
		$this->db->where('day(tanggal)', $hari);
		return $this->db->get();
	}
	function sakittoday($tahun, $bulan, $hari)
	{
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->join('detailcuti', 'cuti.id_cuti = detailcuti.id_cuti');
		$this->db->where('jenis_cuti', 'sakit');
		$this->db->where('status_cuti', 'diterima');
		$this->db->where('year(tanggal)', $tahun);
		$this->db->where('month(tanggal)', $bulan);
		$this->db->where('day(tanggal)', $hari);
		return $this->db->get();
	}

	function hari($hari)
	{

		switch ($hari) {
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
	function tgl_indo($tanggal)
	{
		$bulan = array(
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

		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}
	function hadirtoday($tahun, $bulan, $hari)
	{
		$this->db->select('*');
		$this->db->from('absen');
		$this->db->where('keterangan', 'masuk');
		$this->db->where('year(waktu)', $tahun);
		$this->db->where('month(waktu)', $bulan);
		$this->db->where('day(waktu)', $hari);
		return $this->db->get();
	}
}

/* End of file M_data.php */
/* Location: ./application/models/M_data.php */