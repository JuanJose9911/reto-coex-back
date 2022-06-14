<?php

namespace App\Http\Controllers\contratos;

use App\Http\Controllers\Controller;
use App\Models\TipoContrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    //

    public function create(Request $request)
    {
        try {
            return 13;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function listarTipo()
    {
        try {
            $contratos = TipoContrato::select(
                            'id',
                            'nombre'
                        )
                        ->get();

            return $this->susccesResponse($contratos, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
