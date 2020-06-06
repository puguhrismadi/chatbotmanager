<?php defined('BASEPATH') or exit('No direct script access allowed');
Class Guru extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Siswa_model');
        $this->load->model('Guru_model');
        $this->load->model('Mapel_model');
        $this->load->model('Mengajar_model');
        $this->load->model('Penugasan_model');
        $this->load->model('Materi_model');
        $this->load->model('Presensi_model');
        $this->load->model('Kelas_model');
      
    }
    public function index()
    {
        $data['title'] = 'Dashboard Guru';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function daftar_materi() {
        $data['title'] = 'Daftar Materi Mengajar Guru SMK Taruna Bhakti ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $mail=$this->session->userdata('email');
        $data['namagr'] = $this->Guru_model->getSatuGuru($mail);
        $idguru=$this->Guru_model->getIDguruFromMail($mail);
        $data['mapel'] = $this->Materi_model->getMapelGuru($idguru);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        // $this->load->view('guru/form_input_guru_ajar', $data);
        $this->load->view('guru/daftar_materi', $data);
        $this->load->view('templates/footer');
    }
    public function daftar_penugasan_guru() {
        $data['title'] = 'Daftar Penugasan Mengajar Guru ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $mail=$this->session->userdata('email');
        $data['namagr'] = $this->Guru_model->getSatuGuru($mail);
        $idguru=$this->Guru_model->getIDguruFromMail($mail);
        $data['pelajaran']=$this->Materi_model->getMapelByIdGuru($idguru);
        $data['materi'] = $this->Materi_model->getMateriByIdGuru($idguru);
        $data['tugas']=$this->Penugasan_model->getTugasByGuru($idguru);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        // $this->load->view('guru/form_input_guru_ajar', $data);
        $this->load->view('guru/daftar_penugasan_guru', $data);
        $this->load->view('templates/footer');
    }
    public function form_penugasan_guru($idmateri,$idguru,$idmapel) {
        $data['title'] = 'Form Tambah Penugasan  Guru ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $mail=$this->session->userdata('email');
        $data['namagr'] = $this->Guru_model->getSatuGuru($mail);
        $idguru=$this->Guru_model->getIDguruFromMail($mail);
        $data['idmapel']=$idmapel;
        $data['idmateri']=$idmateri;
        $data['pelajaran']=$this->Mapel_model->getMapelByID($idmapel)->result();
        $data['materi'] = $this->Materi_model->getMateriById($idmateri);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);

        $this->load->view('guru/form_tambah_penugasan', $data);
        $this->load->view('templates/footer');
    }
    public function form_edit_penugasan_guru($idtugas,$idmateri,$idguru,$idmapel) {
        $data['title'] = 'Form Update Penugasan  Guru ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $mail=$this->session->userdata('email');
        $data['namagr'] = $this->Guru_model->getSatuGuru($mail);
        $idguru=$this->Guru_model->getIDguruFromMail($mail);
        $data['idmapel']=$idmapel;
        $data['idmateri']=$idmateri;
        $data['pelajaran']=$this->Mapel_model->getMapelByID($idmapel)->result();
        $data['materi'] = $this->Materi_model->getMateriById($idmateri);
        $data['tugas']=$this->Penugasan_model->get_one_by_id($idtugas)->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);

        $this->load->view('guru/form_edit_penugasan', $data);
        $this->load->view('templates/footer');
    }


    public function proses_simpan_materi_guru() {
        $post = $this->input->post();
        //print_r($post);
        $kodemp = $this->Mapel_model->get_kode_mapel($post['id_mapel']);
        $kodemapelajar = $kodemp . "-" . $post['idguru'];
        $data = array(
            'nomor_nama_kd' => $post['namakd'],
            'topik_pembahasan' => $post['topik'],
            'link_materi' => $post['link_materi'],
            'idguru' => $post['idguru'],
            'id_mapel' => $post['id_mapel'],
            'topik_pembahasan' => $post['topik'],
            'pertemuan_ke' => $post['pertemuanawal'],
            'pertemuan_hingga' => $post['pertemuanakhir'],
            'tapel' => $post['tapel'],
            'status' => '1'
        );
        $save= $this->Materi_model->simpanMateriAjar($data);
        if($save==TRUE){
            redirect(base_url("guru/daftar_materi/sukses_simpan_materi"));
        }else{
            redirect(base_url("guru/daftar_materi/gagal_simpan_materi"));
        }
    }

    function get_materi_mengajar() {
        
        $list = $this->Materi_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nomor_nama_kd;
            $row[] = $field->link_materi;
            $row[] = $field->nama_lengkap;
            $row[] = $field->nama_mapel;
            $row[] = $field->pertemuan_ke;
            $row[] = $field->pertemuan_hingga;
            $row[] = $field->tapel;
           

            $row[] = "<a href='" . base_url("admin/edit_materi/$field->id_materi") . "' class='btn btn-success btn-sm' >Edit</a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Materi_model->count_all(),
            "recordsFiltered" => $this->Materi_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    public function proses_simpan_penugasan(){
        $post=$this->input->post();
        $data=array(
            'id_materi'=>$post['idmateri'],
            'idguru'=>$post['idguru'],
            'id_mapel'=>$post['idmapel'],
            'tipe_tugas'=>$post['tipetugas'],
            'nama_tugas'=>$post['namatugas'],
            'deskripsi_tugas'=>$post['deskripsi'],
            'tgl_penugasan'=>$post['tgl_mulai'],
            'waktu_buka'=>$post['jam_buka'],
            'deadline_tugas'=>$post['tgl_selesai'],
            'waktu_tutup'=>$post['jam_tutup'],
            'tapel'=>$post['tapel'],
            'status'=>1

        );
        //print_r($post);
        $proses=$this->Penugasan_model->simpanPenugasanGuru($data);
        if($proses==TRUE){
            redirect(base_url("guru/daftar_penugasan_guru/sukses_simpan_penugasan"));
        }else{
            redirect(base_url("guru/daftar_penugasan_guru/gagal_simpan_penugasan"));
        }

    }
    public function proses_edit_penugasan(){
        $post=$this->input->post();
        $idtugas=$post['id_penugasan'];
        $data=array(
            'id_materi'=>$post['idmateri'],
            'idguru'=>$post['idguru'],
            'id_mapel'=>$post['idmapel'],
            'tipe_tugas'=>$post['tipetugas'],
            'nama_tugas'=>$post['namatugas'],
            'deskripsi_tugas'=>$post['deskripsi'],
            'tgl_penugasan'=>$post['tgl_mulai'],
            'waktu_buka'=>$post['jam_buka'],
            'deadline_tugas'=>$post['tgl_selesai'],
            'waktu_tutup'=>$post['jam_tutup'],
            'tapel'=>$post['tapel'],
            'status'=>1

        );
        print_r($post);
        $proses=$this->Penugasan_model->updateData($idtugas,$data);
        if($proses==TRUE){
            redirect(base_url("guru/daftar_penugasan_guru/sukses_edit_penugasan"));
        }else{
            redirect(base_url("guru/daftar_penugasan_guru/gagal_edit_penugasan"));
        }

    }

    public function list_presensi_telegram() {
        
        
        $data['title'] = 'Rekap Presensi Online Dengan Bot Telegram ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $mail=$this->session->userdata('email');
        $data['namagr'] = $this->Guru_model->getSatuGuru($mail);
        $idguru=$this->Guru_model->getIDguruFromMail($mail);
        $data['mapel'] = $this->Materi_model->getMapelByIdGuru($idguru);
        $data['kelas']=$this->Presensi_model->getKelasGuru();
        $tgl=date("d-m-Y");
 
        
      
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        // $this->load->view('guru/form_input_guru_ajar', $data);
        $this->load->view('guru/presensi_telegram', $data);
        $this->load->view('templates/footer');
    }
    public function tabel_presensi_telegram() {
        
        $post=$this->input->post();
        //print_r($post);
        $data['title'] = 'Rekap Presensi Online Dengan Bot Telegram ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $mail=$this->session->userdata('email');
        $data['namagr'] = $this->Guru_model->getSatuGuru($mail);
        $idguru=$this->Guru_model->getIDguruFromMail($mail);
       
        $data['siswa'] =$this->Siswa_model->getSiswaKelas($post['nama_kelas'])->result();
        $data['presensi'] = $this->Presensi_model->get_presensi_data($post['nama_mapel'],$post['nama_kelas'],$post['tanggal']);
        $tgl=date("d-m-Y");
 
        $data['presensi'] = $this->Presensi_model->get_presensi_data($post['nama_mapel'],$post['nama_kelas'],$post['tanggal']);
      print_r($post);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        // $this->load->view('guru/form_input_guru_ajar', $data);
        $this->load->view('guru/rekap_presensi_siswa_online', $data);
        $this->load->view('templates/footer');
    }
    function get_presensi() {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $mail=$this->session->userdata('email');
       
        $idguru=$this->Guru_model->getIDguruFromMail($mail);

        $list = $this->Presensi_model->get_datatables($idguru);
        $data = array();
        $no = $_POST['start'];
        $presen=$this->Presensi_model->get_presensi_data();
        
        

        
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nipd;
            $row[] = $field->nama_siswa;
            
            $row[] = $field->kelas;
            $row[] = strtoupper($field->kode_mapel_ajar);
            switch($field->kehadiran):
                case '1':
                    $hadir="Hadir";
                    break;    
                case '':
                    $hadir="Alpa";
                    break;
                case '2':
                    $hadir="Sakit";
                    break;
                case '3':
                    $hadir = "Izin";
                    break;
                default:
                     $hadir ="Tanpa Keterangan";
            endswitch;

            $row[] = $hadir;
            $row[] = $field->tgl_absen;
            $row[] = $field->jam_absen;
            $row[] = $field->keterangan;
           
          

            $row[] = "<a href='" . base_url("guru/edit_materi/") . "' class='btn btn-success btn-sm' >Edit</a>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Presensi_model->count_all(),
            "recordsFiltered" => $this->Presensi_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    public function proses_presensi_guru(){

    }
}
?>