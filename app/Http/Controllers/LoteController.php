<?php

namespace App\Http\Controllers;

use App\ControlLote;
use App\DailyReport;
use App\Lote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoteController extends Controller
{
    // // RUTAS CONTROL

        public function store(Request $request)
        {
            if ($request->ajax()) {
                DB::transaction(function() use($request){
                    $lote = new Lote;

                    $lote->fill($request->all());
                    $lote->user_id = Auth::user()->id;
                    $lote->state = 'A';
                    $lote->code = Str::random(8);

                    $lote->save();

                    $control_lote = new ControlLote;

                        $control_lote->lote_id = $lote->id;
                        $control_lote->temperatura_id =  DB::table('temperaturas')->where('dia',1)->value('id');;
                        $control_lote->save();

                    
                });
            }
        }

        public function showLoteControl($lote_id)
        {   
            // return $lote_id;
            $lote = ControlLote::where('lote_id',$lote_id)->first();
            $temp = DB::table('temperaturas')->where('id',$lote->temperatura_id)->first(['tempMax as Max','tempMin as Min']);
           
            return response()->json([
                'lote'=>$lote,
                'temp'=>$temp,
              
            ]);
        }


        public function initControl( $lote_id, Request $request)
        {
            // return $lote_id;
            if ($request->ajax()) {
                $lote = ControlLote::find($lote_id);
                $lote->active = $request->action;
                $lote->save();
            }
        }

        public function isActive(Request $request)
        {
            if ($request->ajax()) {
                
                return ControlLote::where('active',true)->get();
            }
        }

        public function temp(Request $request)
        {
            return DB::table('temperaturas')->get(['tempMax','tempMin']);
        }
    // public function controlLotes()
    // {
    //     $number_of_Lotes = ControlLote::all()->count();
        
    //     if($number_of_Lotes == 0)
    //         return $this->not_Found();//Si no existen lotes en "Control" Se muestra una vista diciendo que no hay :v
        
    //     // $control = ControlLote::with(['lote'])->first();
    //      $lote = Lote::with(['control','report'])->first();
       
    //     return view('lote.control.index')->with(["lote"=>$lote]);
    // }


    // public function not_Found() //Funcion que se ejecuta cuando no existen lotes asignados a un control
    // {   
    //     $lotes = Lote::where('state','W')->get();
    //     $lotes = count($lotes)==0 ?null :$lotes;
    //     return view('lote.control.Lotes_Sin_Asignar')->with(['lotes'=>$lotes]);   
    // }

    // public function store(Request $request)
    // {
    //     $lote = new Lote;
    //    DB::transaction(function () use($request, $lote) {
    //     $new_lote = new Lote;
    //     $new_lote->code = '['.$request['date_in'].'-'.Str::random('4').']';   
    //     $new_lote->quantity = $request['quantity'];
    //     $new_lote->observation = $request['observation'];
    //     $new_lote->date_in = $request['date_in'];
    //     $new_lote->user_id = $request['user_id'];
    //     $new_lote->state = 'A';

    //     $new_lote->save();

    //     $dr = new DailyReport;

    //     $dr->lote_id = $new_lote->id;
    //     $dr->date = $request['date_in'];
    //     $dr->feed = $request['feed'];
    //     $dr->feed_cumulative = $request['feed'];
    //     $dr->total_birds = $request['quantity'];

    //     $dr->save();

    //     $control_lote = new ControlLote;

    //     $control_lote->lote_id = $new_lote->id;
    //     $control_lote->min_temp = $request['min_temp'];
    //     $control_lote->max_temp = $request['max_temp'];
    //     $control_lote->save();


    //     $lote = $new_lote;
        
    //    });
      
    //     return redirect()->back()->with(["lote"=>$lote]);
    // }

    // public function delete(Lote $lote)
    // {
    //     $lote->delete();
    //    return redirect()->back();
    // }

    // public function update(Lote $lote, $request)
    // {
    //     // DB::transaction(function() use ($lote, $request){
    //     //     $lote->update(['state'=>'A']);
    //     //     $control_lote = new ControlLote;

    //     //     $control_lote->lote_id = $lote->id;
    //     //     $control_lote->min_temp = $lote->id;
    //     //     $control_lote->max_temp = $lote->id;
    //     //     $control_lote->save();

    //     //     // $dailyReport = new DailyReport;
    //     //     // $dailyReport->lote_id = $lote->id;
    //     //     // $dailyReport->date = Carbon::now()->toDateString();
    //     //     // $dailyReport->cant_fund = 


    //     // });

    //     // return redirect()->back();
    // }


    //     // RUTAS PRODUCTION

    // public function productionLotes()
    // {   
    //     return view('lote.production.index');
    // }

    // // Listar Todos los Lotes
    public function getLotes(Request $request)
    {
        if($request->ajax()){
            $lotes_produced = Lote::orderBy('date_in','desc')->get();
            return response()->json([
                'rows'=>$lotes_produced
            ]);
        }  
    }

    // // Mostrar detalles de Lote VIsta
    // public function show(Lote $lote)
    // {
    //     return view('lote.production.show')->with(['lote'=>$lote]);
    // }
}
