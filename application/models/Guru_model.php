<?php
 
class Guru_model extends CI_Model {
 
    var $table = 'api_guru'; //nama tabel dari database
    var $column_order = array('idguru','stat_pegawai','jkl','nama','tmt','status'); //field yang ada di table user
    var $column_search = array('stat_pegawai','jkl','nama','tmt','status','uname_tel','no_hp','nuptk'); //field yang diizin untuk pencarian 
    var $order = array('idguru' => 'asc'); // default order 
    public $idguru,$nik,$nuptk,$nama,$email,$jkl,$tanggal_lahir,$stat_pegawai,$tmt,$nohp,$uname_tel,$status;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_one_by_id($idguru){
        $this->db->select('*');
        $this->db->from('api_guru');
        $this->db->where('idguru',$idguru);
       // echo $idsiswa;
        return $this->db->get();
    }
   
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function getKodeJurusanSiswa($idsiswa){
        $this->db->select('kode_jurusan');
        $this->db->where('idsiswa',$idsiswa);
        $dt=$this->db->get('api_siswa')->result_array();
        foreach ($dt as $kode) {
            return $kode['kode_jurusan'];
        }
        

    }
    public function update()
    {
        $post = $this->input->post();
        $data_source=array(
            'idguru' => $post['idguru'], 
            'nama' => $post['nama'],
            'nik'=>$post['nipk'],
            'kode_jurusan'=>$this->convertKodeJurusan($post['komli']),
            'komli' => $post['komli'],
            'kelas' => $post['kelas'],
            'tempat_lahir' => $post['tempat'],
            'tanggal_lahir' => $post['tgl_lahir'],
            'foto_nipd'=>$post['foto_nipd'],
            'status'=>$post['status'] 
        );
        
        return $this->db->update('un_siswa', $data_source, array('idsiswa' => $post['idsiswa']));
    }
  

    public function delete($id)
    {
        return $this->db->delete($this->table, array("idguru" => $id));
    }
  
    public function getTotalTb($tabel,$key,$where){
        $this->db->where($key, $where); // OTHER CONDITIONS IF ANY
        $this->db->from($tabel); //TABLE NAME
        return $this->db->count_all_results();
    }
    public function getSiswaBelumLengkap(){
        $this->db->where("(adm_kurikulum='Belum Lengkap' OR adm_prakerin='Belum Lengkap' OR adm_ukk='Belum Lengkap')", NULL, FALSE);
        $this->db->order_by('kelas');
        $query = $this->db->get('un_siswa');
        
        return $query->result();
    }
    public function getAllguru(){
        $this->db->select('idguru,nama_lengkap');
        $this->db->from('api_guru');
        return $this->db->get()->result();
    }
 
}