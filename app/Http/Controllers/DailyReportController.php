<?php

namespace App\Http\Controllers;

use App\Lote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyReportController extends Controller
{
    public function mostrarLote(Request $request)
    {
          
       $reportes = DB::table('daily_reports')->where('lote_id',$request->lote)->get();
       return response($reportes);
    }
    public function store(Request $request)
    {   
        
        $lote = Lote::find($request->lote_id);

        DB::table('daily_reports')->insert([
            'lote_id'=>$lote->id,
            'date'=>Carbon::now(),
            'feed'=>intval($request->comida),
            'deaths'=>intval($request->muertes)
        ]);
        return 'ok';
    }
}
