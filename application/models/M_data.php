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
		$sql2 = "SELECT configurasi_absen.waktu_awal FROM configurasi_absen WHERE tipe_jam='pulang'";
		$query2 = $this->db->query($sql2);
		foreach ($query2->result() as $key) {
			$datax = array(
				'waktuawal' => $key->waktu_awal,
				// echo json_encode($datax);
			);
		}
		$jamawalpulang = strtotime($datax['waktuawal']);
		$sql3 = "SELECT configurasi_absen.waktu_akhir FROM configurasi_absen WHERE tipe_jam='masuk'";
		$query3 = $this->db->query($sql3);
		foreach ($query3->result() as $key) {
			$datay = array(
				'waktuakhir' => $key->waktu_akhir,
			);
			// echo json_encode($datay);
		}
		$jamakhirmasuk = strtotime($datay['waktuakhir']);
		$penentuantelat = ceil(($jamawalpulang-$jamakhirmasuk)*0.2);
		// $telat = ceil($selisih*0.2);
		$hasilakhir = $jamakhirmasuk+$penentuantelat;
		$jamtelat = date("H:i:s",$hasilakhir);
		// echo $jamtelat;
		$sql = "SELECT absen.id_absen,absen.kode_pegawai,absen.waktu,user.nama,absen.keterangan FROM absen INNER JOIN user
		ON absen.kode_pegawai=user.kode_pegawai";
		$query = $this->db->query($sql);
		$datas=array();
		foreach ($query->result() as $key) {
			$status = "";
			if($key->keterangan=="pulang"){
				$status = "Keluar";
			} elseif ($key->keterangan=="masuk") {
				$temp = explode(" ",$key->waktu);
				$checkjam =strtotime($temp[1]);
				// echo "$jamakhirmasuk-$checkjam";
				if($checkjam<=$jamakhirmasuk){
					$status="Masuk";
				} elseif ($checkjam<=$hasilakhir) {
					$status="Telat";
				}else{
					$status="Sangat Telat";
				}
			}
			$data = array(
				'kodepegawai' => $key->kode_pegawai,
				'waktu' => $key->waktu,
				'nama' => $key->nama,
				'keterangan' => $key->keterangan,
				'status'=>$status
			);
			array_push($datas,$data);
		}
		return $datas;
		// $jamtelat = ceil($telat/60);
		//wait, habis batere pos cas lah dlu ak bngung
		// $menittelat = $telat%60;
		//kito anggep be, men dibawah 20%, dio telat, men diatasny dio ikutin jam setny be token_get_all
		//jam setny brp be??
		// echo ("$selisih $jamtelat $menittelat");
		// $selisihjam = $selisih/60


// 		$sql = "SELECT absen.id_absen,absen.kode_pegawai,absen.waktu,user.nama,absen.keterangan,
// IF(absen.keterangan = 'Masuk',
//    CASE
//     WHEN hour(waktu)<8 THEN 'Masuk'
//     WHEN hour(waktu)=8 THEN 'Telat'
//     WHEN hour(waktu)=9 THEN 'Telat'
//     WHEN hour(waktu)=10 THEN 'Sangat Telat'
//     WHEN hour(waktu)=11 THEN 'Sangat Telat'
//    	WHEN hour(waktu)=12 THEN 'Sangat Telat'
//    	WHEN hour(waktu)=13 THEN 'Sangat Telat'
//     WHEN hour(waktu)=14 THEN 'Sangat Telat'
//     WHEN hour(waktu)=15 THEN 'Sangat Telat'
//    END,
//   CASE
//     WHEN hour(waktu)>16 THEN 'Keluar'
//   END) AS status
// FROM absen
// INNER JOIN user
// ON absen.kode_pegawai=user.kode_pegawai";
// 		$query = $this->db->query($sql);
// 		return $query->result_array();
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
	public function pengaturanabsenid($id)
	{
		$this->db->select('*');
		$this->db->from('configurasi_absen');
		$this->db->where('configurasi_absen.no_urut', $id);
		return $this->db->get();
	}
	public function pengaturanlemburid($id)
	{
		$this->db->select('*');
		$this->db->from('configurasi_lembur');
		$this->db->where('configurasi_lembur.no_lembur', $id);
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
	public function gaji()
	{
		$this->db->select('*');
		$this->db->from('gaji');
		$this->db->join('pegawai', 'gaji.kode_pegawai = pegawai.kode_pegawai');
		$this->db->join('user', 'pegawai.kode_pegawai = user.kode_pegawai');
		$this->db->order_by('gaji.id_gaji', 'desc');
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
