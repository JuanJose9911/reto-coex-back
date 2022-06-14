<?php

namespace App\Http\Controllers\empleados;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Models\Empleado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class EmpleadoController extends Controller
{
    //

    public function create(Request $request)
    {
        try {
            $request = $request->all();
            $v = Validator::make($request,[
                'documento' => 'required|string|unique:empleados,documento',
                'nombre' => 'required|string',
                'apellidos' => 'required|string',
                'telefono' => 'required|string',
                'direccion' => 'required|string',
                'tipo_contrato_id' => 'required|',
                'sueldo' => 'required|numeric',
            ]);

            if( $v->fails() ) return $this->errorResponse( $v->errors()->first(), 400);
            
            return DB::transaction(function() use($request){
                if ( $request['tipo_contrato_id'] == 4){
                    $contrato = Contrato::create([
                        'sueldo' => $request['sueldo'],
                        'tipo_contrato_id' => $request['tipo_contrato_id'],
                    ]);
                }else {
                    $contrato = Contrato::create([
                        'sueldo' => $request['sueldo'],
                        'duracion' => $request['duracion'],
                        'tipo_contrato_id' => $request['tipo_contrato_id'],
                    ]);
                }

                $empleado = Empleado::create([
                    'documento' => $request['documento'],
                    'nombre' =>   $request['nombre'],
                    'apellidos' =>$request['apellidos'],
                    'telefono' => $request['telefono'],
                    'direccion' =>$request['direccion'],
                    'contrato_id' => $contrato['id']
                ]);

                return $this->susccesResponse($empleado, 201);
                
            });

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Request $request, Int $id)
    {
        try {
            $request = $request->all();
            $v = Validator::make($request,[
                'documento' => 'required|string',
                'nombre' => 'required|string',
                'apellidos' => 'required|string',
                'telefono' => 'required|string',
                'direccion' => 'required|string',
                'tipo_contrato_id' => 'required|',
                'sueldo' => 'required|numeric',
            ]);

            if( $v->fails() ) return $this->errorResponse( $v->errors()->first(), 400);

            return DB::transaction(function() use($request, $id){
                $empleado = Empleado::find($id);
                if( empty($empleado) ) return $this->errorResponse('Empleado no registrado', 400);

                $contrato = Contrato::find($empleado->contrato_id);

                if ( empty($contrato) ) return $this->errorResponse('Contrato no registrado', 400);

                if( $request['tipo_contrato_id'] == 4 ){
                    $contrato = $contrato->update([
                        'sueldo' => $request['sueldo'],
                        'tipo_contrato_id' => $request['tipo_contrato_id'],
                    ]);
                }else{
                    $contrato = $contrato->update([
                        'sueldo' => $request['sueldo'],
                        'tipo_contrato_id' => $request['tipo_contrato_id'],
                        'durcion' => $request['duracion']
                    ]);
                }
                
                $empleado = $empleado->update([
                    'documento' => $request['documento'],
                    'nombre' =>   $request['nombre'],
                    'apellidos' =>$request['apellidos'],
                    'telefono' => $request['telefono'],
                    'direccion' =>$request['direccion']
                ]);

                return $this->susccesResponse('Actualizado correctamente', 201);
            }, 5);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function list()
    {
        try {
            $empleados = DB::table('empleados as e')
                    ->join('contratos as c', 'c.id', 'e.contrato_id')
                    ->join('tipo_contratos as tc', 'tc.id', 'c.tipo_contrato_id')
                    ->select(
                        'e.id',
                        'e.documento',
                        'e.nombre',
                        'e.apellidos',
                        'tc.nombre as tipoContrato'
                    )
                    ->orderBy('tipoContrato', 'asc')
                    ->get();

            return $empleados;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function listDetail(Int $id)
    {
        try {
            $empleado = DB::table('empleados as e')
                    ->join('contratos as c', 'c.id', 'e.contrato_id')
                    ->join('tipo_contratos as tc', 'tc.id', 'c.tipo_contrato_id')
                    ->select(
                        'e.id',
                        'e.documento',
                        'e.nombre',
                        'e.apellidos',
                        'e.telefono',
                        'e.direccion',
                        'c.sueldo',
                        'c.duracion',
                        'tc.id as tipoContrato',
                        'tc.nombre as nomContrato'
                    )
                    ->where('e.id', $id)
                    ->first();

            if ( empty($empleado) ) return $this->errorResponse('Empleado no registrado', 400);

            return $empleado;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete(Int $id)
    {
        try {
            $empleado = Empleado::find($id);

            if( empty($empleado) ) return $this->errorResponse('Empleado no registrado', 400);

            $contrato = Contrato::find($empleado->contrato_id);

            $empleado->delete();
            $contrato->delete();

            return $this->susccesResponse('Datos eliminados correctamente');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generarPDF()
    {
        try {
            $empleados = $this->list();
            $fecha = Carbon::now()->format('Y-m-d');

            $data = [
                'title' => 'Reporte general empleados',
                'fecha' => $fecha,
                'empleados' => $empleados
            ];
            
            $pdf = PDF::loadView('pdfEmpleados', $data);


            return $pdf->download('reporte-general.pdf');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function detallePDF(Int $id)
    {
        try {
            $empleado = $this->listDetail($id);
            $fecha = Carbon::now()->format('Y-m-d');

            $data = [
                'title' => 'Reporte empleado:'. $empleado->nombre. ' ' . $empleado->apellidos,
                'fecha' => $fecha,
                'empleado' => $empleado
            ];
            
            $pdf = PDF::loadView('pdfEmpleado', $data);


            return $pdf->download('reporte-empleado.pdf');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
