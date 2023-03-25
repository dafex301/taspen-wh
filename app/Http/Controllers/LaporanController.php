<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Laporan;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreLaporanRequest;
use App\Http\Requests\UpdateLaporanRequest;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $laporan = Laporan::where('pelapor', $user->id)
            ->orderBy('updated_at', 'desc')->get();

        return view('laporan', [
            'laporan' => $laporan,
        ]);
    }

    /**
     * Display a listing of the resource by PIC.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkPIC()
    {
        $user = auth()->user();

        $laporan = Laporan::where('pic_checked', false)
            ->where('cabang', $user->cabang)
            ->orderBy('updated_at', 'desc')->get();


        return view('laporan', [
            'laporan' => $laporan,
        ]);
    }

    /**
     * Display a listing of the resource by Branch Manager.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkBM()
    {
        $user = auth()->user();

        $laporan = Laporan::where('pic_checked', true)
            ->where('branch_manager_checked', false)
            ->where('pic_rejected', false)
            ->where('dpnp_checked', false)
            ->where('completed', false)
            ->where('cabang', $user->cabang)
            ->orderBy('pic_checked_at', 'desc')->get();

        return view('laporan', [
            'laporan' => $laporan,
        ]);
    }

    /**
     * Display a listing of the resource by Div. PnP.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkDPnP()
    {
        $user = auth()->user();

        $laporan = Laporan::where('branch_manager_checked', true)
            ->where('branch_manager_rejected', false)
            ->where('pic_rejected', false)
            ->where('dpnp_checked', false)
            ->orderBy('updated_at', 'desc')->get();

        return view('laporan', [
            'laporan' => $laporan,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $user = auth()->user();
        $role = $user->Role->name;


        if ($role == 'DPnP') {
            $laporan = Laporan::orderBy('updated_at', 'desc')
                ->where('dpnp_checked', true)
                ->get();
        } else {
            $laporan = Laporan::orderBy('updated_at', 'desc')
                ->where('cabang', $user->cabang)
                ->get();
        }
        return view('history', [
            'laporan' => $laporan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return view lapor with kategori data
        return view('lapor', [
            'kategori' => Kategori::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLaporanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaporanRequest $request)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Check if kategori is 6 (Lain-lain)
        if ($request->kategori == '0') {
            $this->validate($request, [
                'kategori_lain' => 'required|string',
            ]);
        }

        // Change the filename to current timestamp_lokasi_user.name before store to db
        $filePath = $request->file('image')
            ->storeAs('image', time() . '_' . $request->lokasi . '_' . auth()->user()->name . '.' . $request->image->extension(), 'public');

        // Create new Laporan
        $laporan = Laporan::create([
            'pelapor' => auth()->user()->id,
            'cabang' => auth()->user()->cabang,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'kategori' => $request->kategori,
            'kategori_lain' => $request->kategori == 0 ? $request->kategori_lain : null,
            'deskripsi' => $request->deskripsi,
            'image' => $filePath,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        $laporan = Laporan::find($id);

        return view('detail', [
            'laporan' => $laporan,
            'kategori' => Kategori::all()
        ]);
    }


    /**
     * Display the specified resource and role.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function detailRole(String $role, String $id)
    {
        $loginRole = strtolower(auth()->user()->Role->name);

        if ($loginRole != $role) {
            return redirect()->route('laporan.index')->with('error', 'Anda tidak memiliki akses!');
        }

        $laporan = Laporan::find($id);

        return view('detail', [
            'laporan' => $laporan,
            'kategori' => Kategori::all()
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function detailRevisi(String $role, String $id)
    {
        $laporan = Laporan::find($id);

        if ($role == 'pic') {
        }

        // return view('detail', [
        //     'laporan' => $laporan,
        //     'kategori' => Kategori::all()
        // ]);
    }

    /**
     * Verify the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaporanRequest  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function verifikasi(UpdateLaporanRequest $request, String $id)
    {
        $this->validate($request, [
            'lokasi' => 'required|string',
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'immediate_action' => 'required|string',
            'prevention' => 'required|string',
            'completed_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Check if kategori is 0 (Lain-lain)
        if ($request->kategori == '0') {
            $this->validate($request, [
                'kategori_lain' => 'required|string',
            ]);
        }

        // Change the filename to current timestamp_lokasi_user.name before store to db
        $filePath = $request->file('completed_image')
            ->storeAs('completed_image', time() . '_' . $request->lokasi . '_' . auth()->user()->name . '.' . $request->completed_image->extension(), 'public');

        // Create new Laporan
        $laporan = Laporan::find($id);
        $laporan->lokasi = $request->lokasi;
        $laporan->kategori = $request->kategori;
        $laporan->kategori_lain = $request->kategori == 0 ? $request->kategori_lain : null;
        $laporan->deskripsi = $request->deskripsi;
        $laporan->immediate_action = $request->immediate_action;
        $laporan->prevention = $request->prevention;

        if (auth()->user()->Role->name === 'PIC') {
            $laporan->pic = auth()->user()->id;
            $laporan->pic_checked = true;
            $laporan->pic_checked_at = now();
        }
        if (auth()->user()->Role->name === 'DPnP') {
            $laporan->dpnp = auth()->user()->id;
            $laporan->dpnp_checked = true;
            $laporan->dpnp_checked_at = now();
        }

        $laporan->completed = true;
        $laporan->completed_at = now();
        $laporan->completed_by = auth()->user()->id;

        $laporan->completed_image = $filePath;

        $laporan->save();

        return redirect()->route('laporan.history')->with('success', 'Laporan berhasil diubah!');
    }

    /**
     * Follow up the specified resource from PIC to DPP.
     *
     * @param  \App\Http\Requests\UpdateLaporanRequest  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function tindaklanjut(UpdateLaporanRequest $request, String $id)
    {
        $this->validate($request, [
            'lokasi' => 'required|string',
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'immediate_action' => 'nullable|string',
            'prevention' => 'nullable|string',
        ]);

        // Check if kategori is 0 (Lain-lain)
        if ($request->kategori == 0) {
            $this->validate($request, [
                'kategori_lain' => 'required|string',
            ]);
        }


        $laporan = Laporan::find($id);
        $laporan->lokasi = $request->lokasi;
        $laporan->kategori = $request->kategori;
        $laporan->kategori_lain = $request->kategori == 0 ? $request->kategori_lain : null;
        $laporan->deskripsi = $request->deskripsi;
        $laporan->immediate_action = $request->immediate_action;
        $laporan->prevention = $request->prevention;
        $laporan->pic = auth()->user()->id;
        $laporan->pic_checked = true;
        $laporan->pic_checked_at = now();

        $laporan->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditindaklanjuti!');
    }

    public function approve(String $id)
    {
        $laporan = Laporan::find($id);
        $laporan->branch_manager = auth()->user()->id;
        $laporan->branch_manager_checked = true;
        $laporan->branch_manager_checked_at = now();

        $laporan->save();

        return redirect()->route('laporan.checkBM')->with('success', 'Laporan berhasil diapprove!');
    }

    public function reject(String $id)
    {
        $laporan = Laporan::find($id);
        $role = auth()->user()->Role->name;

        if ($role == 'PIC') {
            $laporan->pic = auth()->user()->id;
            $laporan->pic_checked = true;
            $laporan->pic_checked_at = now();
            $laporan->pic_rejected = true;
            $laporan->pic_rejected_reason = request()->reason;
        } elseif ($role == 'BM') {
            $laporan->branch_manager = auth()->user()->id;
            $laporan->branch_manager_checked = true;
            $laporan->branch_manager_checked_at = now();
            $laporan->branch_manager_rejected = true;
            $laporan->branch_manager_rejected_reason = request()->reason;
        } elseif ($role == 'DPnP') {
            $laporan->dpnp = auth()->user()->id;
            $laporan->dpnp_checked = true;
            $laporan->dpnp_checked_at = now();
            $laporan->dpnp_rejected = true;
            $laporan->dpnp_rejected_reason = request()->reason;
        }

        $laporan->save();

        // Route to different page based on role
        // ./$role/laporan page

        return redirect()->route('laporan.check' . $role)->with('success', 'Laporan berhasil direject!');
    }

    public function getRevisiStaff(String $role)
    {
        if ($role === 'pic') {
            $laporan = Laporan::where('pic', auth()->user()->id)
                ->where(function ($query) {
                    $query->where('branch_manager_rejected', true)
                        ->orWhere('dpnp_rejected', true);
                })
                ->get();
        } elseif ($role === 'bm') {
            $laporan = Laporan::where('branch_manager', auth()->user()->id)
                ->where('dpnp_rejected', true)
                ->get();
        }

        return view('revisi', compact('laporan'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function revisi(String $id)
    {
        $laporan = Laporan::find($id);

        $laporan->lokasi = request()->lokasi ?? $laporan->lokasi;
        $laporan->kategori = request()->kategori ?? $laporan->kategori;
        $laporan->kategori_lain = request()->kategori_lain ?? $laporan->kategori_lain;
        $laporan->deskripsi = request()->deskripsi ?? $laporan->deskripsi;

        if (request()->hasFile('image')) {
            File::delete(storage_path($laporan->image));

            $filePath = request()->file('image')
                ->storeAs('image', time() . '_' . $laporan->lokasi . '_' . auth()->user()->name . '.' . request()->image->extension(), 'public');
            $laporan->image = $filePath;
        }

        if ($laporan->pic_rejected) {
            $laporan->pic_checked = false;
            $laporan->pic_checked_at = null;
            $laporan->pic_rejected = false;
            $laporan->pic_rejected_reason = null;

            $laporan->branch_manager_checked = false;
            $laporan->branch_manager_checked = false;
            $laporan->branch_manager_checked_at = null;
            $laporan->branch_manager_rejected = false;
            $laporan->branch_manager_rejected_reason = null;

            $laporan->dpnp_checked = false;
            $laporan->dpnp_checked_at = null;
            $laporan->dpnp_rejected = false;
            $laporan->dpnp_rejected_reason = null;
        }

        if ($laporan->branch_manager_rejected) {
            $laporan->branch_manager_checked = false;
            $laporan->branch_manager_checked_at = null;
            $laporan->branch_manager_rejected = false;
            $laporan->branch_manager_rejected_reason = null;

            $laporan->dpnp_checked = false;
            $laporan->dpnp_checked_at = null;
            $laporan->dpnp_rejected = false;
            $laporan->dpnp_rejected_reason = null;

            $laporan->pic = auth()->user()->id;
            $laporan->pic_checked = true;
            $laporan->pic_checked_at = now();
        }

        if ($laporan->dpnp_rejected) {
            $laporan->branch_manager_checked = false;
            $laporan->branch_manager_checked_at = null;
            $laporan->branch_manager_rejected = false;
            $laporan->branch_manager_rejected_reason = null;

            $laporan->dpnp_checked = false;
            $laporan->dpnp_checked_at = null;
            $laporan->dpnp_rejected = false;
            $laporan->dpnp_rejected_reason = null;

            $laporan->pic = auth()->user()->id;
            $laporan->pic_checked = true;
            $laporan->pic_checked_at = now();
        }

        $laporan->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil direvisi!');
    }

    public function printwordx(String $id)
    {
        $template_file_name = 'laporan.docx';
        $template_file_path = public_path('docs\\' . $template_file_name);

        $temp_output_folder = storage_path('app\\temp\\');
        $temp_output_file_name = 'laporan_' . $id . '.docx';
        $temp_output_file_path = $temp_output_folder . $temp_output_file_name;

        try {
            if (!file_exists($template_file_path)) {
                throw new \Exception('Template file not found');
            }

            copy($template_file_path, $temp_output_file_path);


            $zip_val = new \ZipArchive();

            if ($zip_val->open($temp_output_file_path) === true) {
                $xml_val = $zip_val->getFromName('word/document.xml');

                $laporan = Laporan::find($id);

                $xml_val = str_replace('{lokasi}', $laporan->lokasi, $xml_val);
                $xml_val = str_replace('{deskripsi}', $laporan->deskripsi, $xml_val);

                $zip_val->addFromString('word/document.xml', $xml_val);
                $zip_val->close();

                // Convert to PDF
                $domPdfPath = base_path('vendor/dompdf/dompdf');
                \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
                \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

                $phpWord = \PhpOffice\PhpWord\IOFactory::load($temp_output_file_path);
                $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');

                $temp_output_file_name = 'laporan_' . $id . '.pdf';
                $temp_output_file_path = $temp_output_folder . $temp_output_file_name;

                return response()->download($temp_output_file_path)->deleteFileAfterSend(true);



                // $phpWord = \PhpOffice\PhpWord\IOFactory::load($temp_output_file_path);
                // $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');



                // $temp_output_file_name = 'laporan_' . $id . '.pdf';
                // $temp_output_file_path = $temp_output_folder . $temp_output_file_name;

                // return response()->download($temp_output_file_path)->deleteFileAfterSend(true);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function printpdfx(String $id)
    {
        $laporan = Laporan::find($id);

        $name = $laporan->Pelapor->name;

        /* Set the PDF Engine Renderer Path */
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        /*@ Reading doc file */
        $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path('docs\\laporan.docx'));

        /*@ Replacing variables in doc file */
        $template->setValue('{nama}', $name);
        // $template->setValue('{nik}', $laporan->Pelapor->nik);
        $template->setValue('{cabang}', $laporan->Cabang->name);
        $template->setValue('{tanggal}', $laporan->tanggal);

        $template->setValue('{deskripsi}', $laporan->deskripsi);
        $template->setValue('{kategori}', $laporan->kategori ? $laporan->Kategori->name : $laporan->kategori_lain);
        $template->setValue('{evidence}', $laporan->image);

        $template->setValue('{immediate_action}', $laporan->immediate_action);
        $template->setValue('{prevention}', $laporan->prevention);
        $template->setValue('{completed_image}', $laporan->completed_image);

        $template->setValue('{date_now}', date('d-m-Y'));

        /*@ Save Temporary Word File With New Name */
        $saveDocPath = public_path('docs\\laporan_' . $laporan->id . '.docx');
        $template->saveAs($saveDocPath);

        // Load temporarily create word file
        $Content = \PhpOffice\PhpWord\IOFactory::load($saveDocPath);

        //Save it into PDF
        $savePdfPath = public_path('docs\\laporan_' . $laporan->id . '.pdf');

        /*@ If already PDF exists then delete it */
        if (file_exists($savePdfPath)) {
            unlink($savePdfPath);
        }

        //Save it into PDF
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');
        $PDFWriter->save($savePdfPath);
        // echo 'File has been successfully converted';

        /*@ Remove temporarily created word file */
        if (file_exists($saveDocPath)) {
            unlink($saveDocPath);
        }

        // Open PDF file
        return response()->download($savePdfPath)->deleteFileAfterSend(true);
    }

    public function printPDF(String $id)
    {
        $laporan = Laporan::find($id);

        // Convert $laporan->completed_at datetime to local date dd-mm-yyyy
        $laporan->completed_at = Carbon::parse($laporan->completed_at)->format('d-m-Y');

        return view('print', compact('laporan'));

        // $pdf = PDF::loadView('print', compact('laporan'));

        // return $pdf->download('laporan_' . $laporan->id . '.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaporanRequest  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLaporanRequest $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
