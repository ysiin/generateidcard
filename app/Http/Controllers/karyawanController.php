<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\datakaryawan;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = datakaryawan::orderBy('id', 'asc')->paginate(10);

        return view('idcard.index', compact('data'))->with('data1', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('idcard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'foto' => 'required',
        ]);

        $foto1 = $request->foto;

        $path = $foto1->store('images', 'public');

        $data = [
            'nama' => $request->nama,
            'nip' => $request->nip,
            'foto' => $path
        ];

        datakaryawan::create($data);
        return redirect()->to('idcard');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = datakaryawan::find($id);

        //path ke template
        $templatePath = public_path('assets/template.jpg');
        //path ke foto
        $fotoKaryawanPath =  public_path('storage/' . $karyawan->foto);

        // font
        $font = public_path('Roboto-Black.ttf');

        // Ukuran layout PDF
        $width = 53.9;
        $height = 85.6;

        // Margin
        $margin = 0;

        // Buat objek mPDF dengan pengaturan ukuran dan margin
        $mpdf = new \Mpdf\Mpdf([
            'format' => [$width, $height],
            'margin_left' => $margin,
            'margin_right' => $margin,
            'margin_top' => $margin,
            'margin_bottom' => $margin,
        ]);

        // Tambah halaman baru
        $mpdf->AddPage();

        // Hitung lebar dan tinggi gambar sesuai dengan ukuran layout tanpa margin
        $gambarWidth = $width - 2 * $margin;
        $gambarHeight = $height - 2 * $margin;


        // Menambahkan template ke dalam dokumen PDF
        $mpdf->Image($templatePath, $margin, $margin, $gambarWidth, $gambarHeight, 'jpg', false);

        // Menambahkan foto karyawan di atas template
        $fotoKaryawanWidth = 100; // Sesuaikan lebar foto karyawan
        $fotoKaryawanHeight = 100; // Sesuaikan tinggi foto karyawan
        $fotoKaryawanX = 0;
        $fotoKaryawanY = 0;
        $mpdf->Image($fotoKaryawanPath, $fotoKaryawanX, $fotoKaryawanY, $fotoKaryawanWidth, $fotoKaryawanHeight, 'png');

        //set font
        $mpdf->SetDefaultFont($font);

        // Menambahkan Nama dan NIP 
        $nama = $karyawan->nama;
        $nip = $karyawan->nip;


        // Hitung lebar dan tinggi teks
        $teksWidth = $width - 2 * $margin;
        $namaHeight = 100; // Sesuaikan tinggi nama
        $nipHeight = 110; // Sesuaikan tinggi nip

        //tambahkan nama ke pdf
        $mpdf->WriteHTML('<div style="
        font-size: 13px;
        color: white;position:absolute; left:' . $margin . 'mm; top:' . $margin . 'mm; width:' . $teksWidth . 'mm; height:' . $namaHeight . 'mm; text-align:center; vertical-align:middle; line-height:' . $namaHeight . 'mm;">
        <b>' . $nama . '</b>
        </div>');

        //tambahkan nip ke pdf
        $mpdf->WriteHTML('<div style="
        font-size: 13px;
        color: white;position:absolute; left:' . $margin . 'mm; top:' . $margin . 'mm; width:' . $teksWidth . 'mm; height:' . $nipHeight . 'mm; text-align:center; vertical-align:middle; line-height:' . $nipHeight . 'mm;">
        <b>' . $nip . '</b>
        </div>');

        // Path untuk menyimpan output PDF
        $outputPath = 'idcard_' . $karyawan->nip . '.pdf';

        //storage path idcard
        $storagePath = storage_path('app/public/idcard/'); 

        // Simpan idcard  ke dalam folder
        $pdfContent =  $mpdf->Output('', 'S');

        // Simpan ke dalam lokal
        file_put_contents($storagePath . $outputPath, $pdfContent);

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $outputPath . '"');
        echo $pdfContent ;

        exit;

        return view('idcard.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
