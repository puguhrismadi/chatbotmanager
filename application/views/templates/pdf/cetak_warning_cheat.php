<style>
body {
    font-size:10pt;
}
th {
    align:left;
}
small {
    font-size:10pt;
}
.headsmall {
    font-size:8pt;
    align:center;
}
table {
  border-collapse: collapse;
  
}
#tbkerangka {
    
}
#nilaisiswa{
    font-size:9pt;
}

#nilaisiswa table,#nilaisiswa th,#nilaisiswa td {
  border: 1px solid black;
}
p {
    text-align: justify;
  text-align-last: left;
}
.ttd {
 text-indent:70px;   
}
.tengahin {
    text-align:center;
}
</style>
<?php
function buatPredikat($nilai){
    if($nilai>92){
        $predikat="Sangat Baik";
    }elseif($nilai>83){
        $predikat="Baik";
    }elseif($nilai>74){
        $predikat="Cukup";
    }elseif($nilai<75){
        $predikat="Kurang";
    }
    return $predikat;
}

foreach($siswa as $one): ?>
	<table width="97%" id="tbkerangka">
   
        <tr>
            <th colspan="3"><h3><u>SURAT KETERANGAN LULUS CHEAT</u> </h3></th>
        </tr>
        <tr>
        <th colspan="3"><p>Nomor : <?php echo $konfig[0]['nomor_surat_skl']; ?></p></th>
           
        </tr>
        <tr>
            <td colspan="3"><p><p>data ini di cetak dari aplikasi kelulusan SMK Taruna Bhakti pada : <?php
date_default_timezone_set('Asia/Jakarta');
echo date("d m Y h:i:s"); ?> </p></td>

        </tr>
        <tr>
            <td colspan="3"><p>Kepala SMK Taruna Bhakti Depok Selaku Ketua Penyelenggara Ujian Sekolah Tahun Pelajaran 2019/2020 berdasarkan :  </p></td>

        </tr>
        <tr>
            <td colspan="3"><p>&nbsp;&nbsp;&nbsp;&nbsp; 1. Ketuntasan dalam mengakali aplikasi . </p></td>
        
        </tr>
        <tr>
            <td colspan="3"><p>&nbsp;&nbsp;&nbsp;&nbsp; 2. Waktu Cetak Dokumen Tidak Sesuai waktu Pengumuman dengan Mengakali Aplikasi. </p></td>
        
        </tr>
        <tr>
            <td colspan="3"><p>&nbsp;&nbsp;&nbsp;&nbsp; 3. Rapat Pleno Dewan Guru tentang Kelulusan pada tanggal 30 April 2020. </p></td>
        
        </tr>
        <tr>
            <td colspan="3"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p></td>

        </tr>
        <tr>
            <td colspan="3"><p>menerangkan bahwa :  </p></td>
        
        </tr>
       
        <tr>
            <td > &nbsp;&nbsp;&nbsp;&nbsp;   Nama </td>
            
            <td width="2%">: </strong></td>
            <td >&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $one->nama; ?></td>
        </tr>
        <tr>
            <td> &nbsp;&nbsp;&nbsp;&nbsp;   Nomor Induk Siswa </td>
            
            <td>: </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $one->nipd; ?></strong></td>
        </tr>
        <tr>
            <td> &nbsp;&nbsp;&nbsp;&nbsp;   Tempat, Tanggal Lahir </td>
            
            <td>: </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $one->tempat_lahir; ?>, <?php echo $one->tanggal_lahir; ?></strong></td>
        </tr>
        <tr>
            <td> &nbsp;&nbsp;&nbsp;&nbsp;    Nomor Induk Siswa Nasional</td>
            
            <td>: </td>
            <td>&nbsp;&nbsp;&nbsp; <b><?php echo $one->nisn; ?></b></td>
        </tr>
       
        <tr>
            <td>  &nbsp;&nbsp;&nbsp;&nbsp;   Kompetensi Keahlian</td>
           
            <td>:   </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $one->komli; ?></b></td>
        </tr>
        <tr>
            <td>  &nbsp;&nbsp;&nbsp;&nbsp;   Dinyatakan</td>
           
            <td>:  </td>
            <td>&nbsp;&nbsp;&nbsp; <b><?php if($one->status==1){ echo "LULUS"; }else { echo "TIDAK LULUS"; } ?></b></td>
        </tr>
        <tr>
            <td colspan="3"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p></td>

        </tr>
        <tr>
            <td colspan="2">
            <p></p>
            <p>dengan nilai sebagai berikut : </p> <br> <br></td>
        
        </tr>
     
    </table>
	<table align="center" id="nilaisiswa" border="1" border-style="solid" width="90%">
        <tr>
            
            <th width="10%">No</th>
            <th width="75%" >Mata Pelajaran</th>
            <th width="15%">Nilai Ujian Sekolah </th>
            
        </tr>
        <tr>
            <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;<b>Kelompok A</b> </td>
        </tr>
        <tr>
        
        <td class="tengahin">1</td>
            <td>Pendidikan Agama Dan Budi Pekerti</td>
            <td class="tengahin">0</td>
           
        </tr>
        <tr>
        
        <td class="tengahin">2</td>
            <td>Pendidikan Pancasila dan Kewarganegaraan</td>
            <td class="tengahin">0</td>
           
        </tr>
        <tr>
        
        <td class="tengahin">3</td>
            <td>Bahasa Indonesia</td>
            <td class="tengahin">0</td>
           
        </tr>
        <tr>
     
        <tr>
        
            <td class="tengahin">4</td>
            <td>Matematika</td>
            <td class="tengahin">0</td>
           
        </tr>
       <tr>    
        <td class="tengahin">5</td>
            <td>History of cheater Indonesia</td>
            <td class="tengahin">77</td>
           
        </tr>
        <tr>
        
            <td class="tengahin">6</td>
            <td>Bahasa Cheater</td>
            <td class="tengahin"><?php echo $one->n_bing; ?></td>
           
        </tr>
        
        <tr>
            <td colspan="3"> &nbsp;&nbsp;&nbsp;&nbsp;<b>Kelompok B</b></td>
        </tr>
        <tr>
        
        <td class="tengahin">1</td>
            <td>Seni Budaya</td>
            <td class="tengahin">0</td>
           
        </tr>
        <tr>
        
            <td class="tengahin">2</td>
            <td>Pendidikan Jasmani, Olahraga, dan Kesehatan  </td>
            <td class="tengahin">0></td>
           
        </tr>
        <tr>
        
            <td rowspan="3" class="tengahin">3</td>
            <td colspan="2">Muata Lokal</td>  
        </tr>
        <tr>  
           <td>Bahasa Sunda</td>
           <td class="tengahin">0></td>
           
       </tr>
        <tr>
            <td>Native</td>
            <td class="tengahin">0</td>
            
        </tr>
       
        <tr>
            <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;<b> Kelompok C</b></td>
        </tr>
        <tr>
        
        <td class="tengahin">1</td>
            <td>Simulasi Dan Komunikasi Digital</td>
            <td class="tengahin">0</td>
           
        </tr>
        <tr>
        
            <td class="tengahin">2</td>
            <td>Fisika</td>
            <td class="tengahin">0</td>
           
        </tr>
        <tr>
        
            <td class="tengahin">3</td>
            <td>Kimia</td>
            <td class="tengahin">0</td>
           
        </tr>
        <tr>
        
            <td class="tengahin">4</td>
            <td>Dasar Program Keahlian</td>
            <td class="tengahin">0</td>
            
        </tr>
        <tr>
        
            <td class="tengahin">5</td>
            <td>Kompetensi Keahlian</td>
            <td class="tengahin">0</td>
            
        </tr>
        <tr>
            <th colspan="2">Rata - Rata Nilai :</th>
            
            <td class="tengahin"><?php $rata=array($one->n_agama,$one->n_pkn,$one->n_bind,$one->n_mtk,$one->n_sejarah,$one->n_bing,$one->n_sbud,$one->n_penjasor,$one->n_native,$one->n_sunda,$one->n_kjuruan1,$one->n_kjuruan2,$one->n_kjuruan3,$one->n_kjuruan4,$one->n_kjuruan5); $avg=array_sum($rata)/count($rata); echo round($avg,2); ?></td>
            
        </tr>
    </table>	
   

   <table width="100%">
     
       <tr >
           <td width="50%" ></td>
           <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
           <td class="ttd"><img width="240px" src="<?php echo base_url('assets/img/cheater.jpg'); ?>" alt=""></td>
       </tr>
      
   </table>
   <?php endforeach; ?>