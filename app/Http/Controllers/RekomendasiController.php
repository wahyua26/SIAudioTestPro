<?php

namespace App\Http\Controllers;

use App\Models\DetailAudiometri;
use App\Models\Jabatan;
use App\Models\Rekomendasi;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Phpml\Classification\KNearestNeighbors;
use DateTime;
use DateTimeZone;

class RekomendasiController extends Controller
{
    public function index(){
        $rekomendasi = DB::table('rekomendasis')->join('workspaces', 'workspaces.id', '=', 'rekomendasis.workspace_id')->get();
        return view('rekomendasi.index', ['rekomendasi' => $rekomendasi]);
    }

    public function mintaRekomendasi(){
        $ruang = Workspace::get();
        $bulan = [
            "Januari", "Februari", "Maret", "April", 
            "Mei", "Juni", "Juli", "Agustus", 
            "September", "Oktober", "November", "Desember"
        ];
        $tahun = [
            "2024"
        ];
        //dd($ruang)
        return view('rekomendasi.form', ['ruang' => $ruang, 'bulan' => $bulan, 'tahun' => $tahun]);
    }

    public function detail(Request $request){
        //dd($request);
        $ruang = Workspace::where('workspaces.id', $request->ruangKerja)->select('workspaces.*')->first();
        $hasil = DB::table('audiometris')->join('users', 'users.id', '=', 'audiometris.user_id')->join('jabatans', 'jabatans.id', '=', 'users.jabatan_id')->join('workspaces', 'workspaces.id', '=', 'jabatans.workspace_id')->where('workspaces.id', $request->ruangKerja)->whereRaw('MONTH(audiometris.tanggal) = ?', [$request->bulan])->whereRaw('YEAR(audiometris.tanggal) = ?', [$request->tahun])->avg('audiometris.hasil');
        $tglLahir = DB::table('users')->join('jabatans', 'jabatans.id', '=', 'users.jabatan_id')->join('workspaces', 'workspaces.id', '=', 'jabatans.workspace_id')->where('workspaces.id', $request->ruangKerja)->select('users.tglLahir')->get();
        
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $namaBulan = date("F", strtotime("2024-$bulan-01"));
        //$namaBulanTerjemahan = GoogleTranslate::trans($namaBulan, app()->getLocale());
        $tanggal = 31;
        $usia = 0;
        foreach ($tglLahir as $p) {
            $tanggal_lahir = date('Y-m-d', strtotime($p->tglLahir));
            $birthDate = new \DateTime($tanggal_lahir);
            $today = new \DateTime(sprintf('%04d-%02d-%02d', $tahun, $bulan, $tanggal));

            $y = $today->diff($birthDate)->y;
            $usia = $usia + $y;
        }
        $usia = $usia / $tglLahir->count();
        //dd($usia);
        //dd($ruang, $hasil, $usia);
        return view('rekomendasi.detail', ['ruang' => $ruang, 'hasil' => $hasil, 'usia' => $usia, 'bulan' => $bulan, 'tahun' => $tahun, 'namaBulan' => $namaBulan]);
    }
    
    public function model(Request $request){
        //dd($request);
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $namaBulan = date("F", strtotime("2024-$bulan-01"));
       
        $request->validate([
            'id' => 'required',
            'hasil' => 'required',
            'usia' => 'required',
        ]);

        $ruang = Workspace::where('workspaces.id', $request->id)->first();
        //dd($ruang->nama);

        //loading data
        $data = new \Phpml\Dataset\CsvDataset('D:\Kuliah\TA\siaudiotestpro\public\dataset.csv', features:3, headingRow:true);

        //preprocessing data
        $dataset = new \Phpml\CrossValidation\StratifiedRandomSplit($data, testSize:0.2, seed:42);

        //training
        $classification = new \Phpml\Classification\KNearestNeighbors(k:4);
        $classification->train($dataset->getTrainSamples(), $dataset->getTrainLabels());

        $predicted = $classification->predict($dataset->getTestSamples());

        //evaluating machine learning models
        $accuracy = \Phpml\Metric\Accuracy::score($dataset->getTestLabels(), $predicted);
        //echo 'Test size 20%, seed:42, k:5, accuracy is : ' . $accuracy;

        $predict = $classification->predict([$ruang->bising, $request->hasil, $request->usia]);
        // echo 'accuracy is : ' . $accuracy . ' predict is: ' . $predict;
        if($predict == 1){
            $rekomendasi = 'Ruang kerja sudah baik begitu pula dengan pegawainya';
        }else if($predict == 2){
            $rekomendasi = 'Pengecekan ruang kerja';
        }else if($predict == 3){
            $rekomendasi = 'Pemeriksaan pegawai';
        }else if($predict == 4){
            $rekomendasi = 'Pengecekan ruang kerja dan pemeriksaan pegawai';
        }

        Rekomendasi::create([
            'workspace_id' => $ruang->id,
            'bulan' => $namaBulan,
            'tahun' => $tahun,
            'tingkatBising' => $ruang->bising,
            'rataHasil' => $request->hasil,
            'rataUsia' => $request->usia,
            'rekomendasi' => $rekomendasi,
        ]);

        return redirect()->route('rekomendasi')->with('success', 'Rekomendasi berhasil diminta!');
    }

}
