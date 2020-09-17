<?php

namespace App\Http\Controllers\Contents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Letter; 
use App\Models\Employee;
use App\Models\EmployeeLetter;
use DB;
use PDF;
class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $letters = Letter::with('employee')->get();
        
        return view('bawaslu.contents.surat.index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $employees = Employee::all();
        return view('bawaslu.contents.surat.tambah', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
             $insert = Letter::create($data);
            if(isset($insert['id'])) {

                if(isset($request->employee_id) && $request->employee_id){
                    foreach ($data['employee_id'] as $key => $value) {
                        EmployeeLetter::create(array('letter_id' => $insert['id'],
                        'employee_id' => $value));
                    }
                }
                 DB::commit();
                 return redirect()->route('surat.index')->with('sukses','Data Berhasil Di simpan');
            }
         } catch (\Exception $ex) {
             DB::rollback();
             throw $ex;
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $letters = Letter::where('id',$id)->first();
        $employees = Employee::all();
        $relations =EmployeeLetter::where('letter_id',$id)->select(['letter_id','employee_id'])->get();
        return view('bawaslu.contents.surat.edit', compact('letters', 'employees', 'relations'));
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
        $isi = Letter::where('id',$id)->first();
        $letter = DB::delete('DELETE letters,employee_letters FROM letters LEFT JOIN employee_letters ON employee_letters.letter_id = letters.id  WHERE letters.id = ?', [$isi->id]);
        if($letter){
            return redirect()->route('surat.index')->with('sukses','Data Berhasil Di hapus');
        }else{
            return redirect()->route('surat.index')->with('sukses','Data gagal Di hapus');
        }
    }
    public function cetak_surat($id){
        $letters = Letter::find($id);
        if ($letters) {
            $letters->employee_name = "-";
            $letters->employee_position = "-";
            if (!empty($letters->employee)) {
                $arrEmployee= [];
                $arrEmployeePosition= [];
                foreach($letters->employee as $key => $employee) {
                    array_push($arrEmployee, $employee->name);
                    array_push($arrEmployeePosition, $employee->position);
                    
                }
                $letters->employee_name = implode(", ", $arrEmployee);
                $letters->employee_position = implode(", ", $arrEmployeePosition);
            }
            
        } else {
            $letters = [];
        }
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();        
        $start_date = $letters->start_date;
        $end_date = $letters->end_date;
        $employee_nama = $letters->employee_name;
        $employee_jabatan = $letters->employee_position;
        $category = $letters->category;
        $information_a = $letters->information_a;
        $information_b = $letters->information_b;
        $section->addImage("https://ilmucoding.com/wp-content/uploads/2020/01/Tutorial-Belajar-Framework-Laravel.jpg");
        $section->addText($start_date);
        $section->addText($end_date);
        $section->addText($employee_nama);
        $section->addText($employee_jabatan);
        $section->addText($category);
        $section->addText($information_a);
        $section->addText($information_b);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('surat.docx'));
        } catch (Exception $e) {
        }
        return response()->download(storage_path('surat.docx'));
    }
}
