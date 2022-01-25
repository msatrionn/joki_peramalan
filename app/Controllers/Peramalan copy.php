<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_peramalan;

class Peramalan extends Controller
{
    public function __construct()
    {
        $this->model = new M_peramalan;
    }
    public function index()
    {

        $data['peramalan'] = $this->model->getAllData()->getResultArray();
        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('peramalan/index', $data);
        echo view('templates/v_footer');
    }
    public function tambah()
    {
        $data = [
            'id_peramalan' => $this->request->getPost('id_peramalan'),
            'id_barang' => $this->request->getPost('id_barang'),
            'id_rekap' => $this->request->getPost('id_rekap'),
            'tanggal_peramalan' => $this->request->getPost('tanggal_peramalan'),
            'jumlah_barang' => $this->request->getPost('jumlah_barang')
        ];
        //insert data
        $success = $this->model->tambah($data);
        if ($success) {
            session()->setFlashdata('message', 'Ditambahkan');
            return redirect()->to(base_url('peramalan'));
        }
    }
    public function hapus($id)
    {
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setFlashdata('message', 'Dihapus');
            return redirect()->to(base_url('peramalan'));
        }
    }
    public function ubah()
    {
        $id = $this->request->getPost('id_peramalan');

        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'id_rekap' => $this->request->getPost('id_rekap'),
            'tanggal_peramalan' => $this->request->getPost('tanggal_peramalan'),
            'jumlah_barang' => $this->request->getPost('jumlah_barang')
        ];
        //insert data
        $success = $this->model->ubah($data, $id);
        if ($success) {
            session()->setFlashdata('message', 'Diubah');
            return redirect()->to(base_url('peramalan'));
        }
    }
    public function view_ramal()
    {
        echo view('peramalan/ramal');
        // var_dump($this->request->getPost());
        $alpha = $this->request->getPost('alpha');
        echo(" alpha =".$alpha);
        $beta = $this->request->getPost('beta');
        echo(" beta =".$beta);
        echo("<br>");

        $paku = [180, 195, 236, 204,194, 234];
        //  $data['peramalan']=$this->model->ramal()->getResultArray();
        $ambil=$this->model->ramal()->getResultArray();
        //  foreach ($ambil as $key => $value) {
        //      $paku[]=$value['jumlah_barang'];
        //     }
        //     array_unshift($paku,[135]);
        // foreach ($paku as $key => $value) {
        //          var_dump($value);
        //  }


        for ($i = 0,$j = 1; $i <= count($paku), $j<= count($paku)-1; $i++, $j++ ) 
        {
            $pakua[] = $paku[$i];
            $pakub[] = $paku[$j];
            $total_pengurangan[]=$paku[$j]-$paku[$i];
        }
        
        foreach ($pakua as $value) {
            
            $paku_a[] = $value * $alpha;  
        }
        foreach ($pakub as $value) {
            $paku_b[] = $value * $alpha;     
        }
        $tots=($pakua + $total_pengurangan);
        foreach ($tots as $key => $value) {
                $tote[]=$value*(1-$alpha);
                $tot=$tote;
        }
            
        $mulus = ($pakub + $tot);
        array_unshift($mulus, $pakua[0]);
        foreach ($mulus as $key => $value) {
        }



        for ($i = 0,$j = 1; $i <= count($mulus), $j<= count($mulus)-1; $i++, $j++ ) 
        {
            $mulusa[] = $mulus[$i];
            $mulusb[] = $mulus[$j];
            $totmul[]= $mulus[$j]-$mulus[$i];
        }
        foreach ($totmul as $value) {
            $totbets[]=$value * $beta;

        }

         $subtracteds = array_map(function ($x, $y) { return $y-$x; } , $pakua, $pakub);
         $pengurangan = array_combine(array_keys($pakua), $subtracteds);
          foreach ($pengurangan as $value) {
              $betas[]= $value * (1-$beta);
        }
        echo "<br>";
        foreach ($betas as $value) {
        }
        echo "<br>";
        $subtracted = array_map(function ($x, $y) { return $x+$y; } , $totbets, $betas);
        $trend     = array_combine(array_keys($mulusa), $subtracted);
        for ($i = 0,$j = 1; $i <= count($trend), $j<= count($trend)-1; $i++, $j++ ) 
        {
            $trenda[] = $trend[$i];
            $trendb[] = $trend[$j];
        }
        foreach ($trenda as $key => $value) {
             $bets[]=
        }
        foreach ($pengurangan as $value) {
              $betas[]= $trenda * (1-$beta);
        }
        $subtracted = array_map(function ($x, $y) { return $x+$y; } , $totbets, $betas);
        $trend     = array_combine(array_keys($mulusa), $subtracted);
         foreach ($trenda as $key =>$value) {
            echo ("<br>"." total trend "."<br>".$value);
        }


        















        // var_dump($pakua);
        // echo $mulus;
        //     $mulus =((int)$alpha * $arr1) + ((1 - (int)$alpha) * ($arr1 +$totalpaku));
        //     $trend= (int)$beta*($mulus1-$arr2)+(1 - (int)$beta)*($paku[$j]-$paku[$i+1]);
        //     echo(" mulus = ". $mulus);
        //     echo(" trend = ". $trend);
        // }
         for ($i=0,$j = 1; $i < count($barang),$i < count($barang)-1 ; $i++,$j++) {
                    $levels =($alpha * $barang[$j]) + ((1 - $alpha) * ($barang[$i] +($barang[$j]-$barang[$i])));
                    $trends= $beta*($levels-$barang[$j])+(1 - $beta)*($barang[$j]-$barang[$i]);
                    // $level =($alpha * $barang[$j]) + ((1 - $alpha) * ($levels +$trends));
                    // $trend = $beta*($level-$levels)+(1 - $beta)*$trends[$j];
                    // $forecasting12=$level11+$trend11;
                    $levelsa= $barang[$i];
                    var_dump($levelsa);

                    $data = [
                    // 'judul' => 'Barang',
                    'level'=>$levels,
                    'trend'=>$trends
                    ];
                    echo view('peramalan/ramal',$data);
                }
      
    }
}
