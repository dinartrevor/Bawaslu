<?php

namespace App\Http\Controllers\Contents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Letter; 
use App\Models\Employee;
use App\Models\EmployeeLetter;
use DB;
use PDF;
// use HnhDigital\PhpNumberConverter\NumConvert;
class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $letters = Letter::with('employee')->orderby('created_at', 'DESC')->get();
        
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
        $data = $request->all();
        DB::beginTransaction();
        try {
            $isi = Letter::where('id',$id)->first();
            DB::delete('delete from employee_letters where letter_id = ?',[$isi->id]);
            if(isset($request->employee_id) && $request->employee_id){
                foreach ($data['employee_id'] as $key => $value) {
                    EmployeeLetter::create(array('letter_id' => $id,
                    'employee_id' => $value));
                }
            }
            $isi->update($data);
            DB::commit();
            return redirect()->route('surat.index')->with('sukses','Data Berhasil Di update');
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
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
        $date = strtotime($letters->start_date);
        $date_end_date = strtotime($letters->end_date);      
        $moonth = date('M', $date);
        $roman = '';
        if($moonth == 'Jan'){
            $roman =  'I';
        }elseif ($moonth == 'Feb') {
            $roman = 'II';
        }elseif ($moonth == 'Mar') {
            $roman =  'III';
        }elseif ($moonth == 'Apr') {
            $roman =  'IV';
        }elseif ($moonth == 'Mei') {
         $roman =  'V';
        }elseif ($moonth == 'Jun') {
         $roman =  'VI';
        }elseif ($moonth == 'Jul') {
         $roman =  'VII';
        }elseif ($moonth == 'Aug') {
         $roman =  'VIII';
        }elseif ($moonth == 'Sept') {
         $roman =  'IX';
        }elseif ($moonth == 'Oct') {
         $roman =  'X';
        }elseif ($moonth == 'Nov') {
         $roman =  'XI';
        }elseif ($moonth == 'Dec') {
         $roman =  'XII';
        }
        $start_date = date('d', $date);
        $end_date = date('d F yy', $date_end_date);
        $end_date_filter_month= date('F yy', $date_end_date);
        $pdf = PDF::loadView('bawaslu.contents.cetak_pdf',compact('letters', 'roman','start_date','end_date', 'end_date_filter_month'));
        $pdf->setPaper('a4','potrait');

        return $pdf->stream();
    }
    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('employees')
         ->where('name', 'like', '%'.$query.'%')
         ->orderBy('created_at', 'desc')
         ->get();
         
      }
      else
      {
       $data = DB::table('employees')
         ->orderBy('created_at', 'desc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
          $loop = 1;
       foreach($data as $row)
       {
        $output .= '
        <tr>
        <td>'.$loop++.'</td>
         <td>'.$row->name.'</td>
         <td>'.$row->position.'</td>
         <td><input type="checkbox" name="employee_id[]" value="'.$row->id.'"></td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
      );

      echo json_encode($data);
     }
    }
}
