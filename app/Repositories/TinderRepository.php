<?php

namespace App\Repositories;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Models\Perro;
use App\Models\Interaccion;

class TinderRepository
{

    public function guardarPerro($request)
    {

        $perros = Perro::create([
            "nombre" => $request->nombre,
            "url_foto" => $request->url_foto,
            "descripcion" => $request->descripcion
        ]);

        return response()->json(["perros" => $perros], Response::HTTP_OK);
    }

    public function eliminarPerro($request)
    {
        try {
            $perro = Perro::find($request->id);
            if(!$perro){
                throw new Exception("No se encuentra el perro");
            }
            $perro->delete();

            return response()->json(["eliminados"=>"se elimino el perro"], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function actualizarPerro($request)
    {
        try {


            $perros = Perro::findorFail($request->id);
            isset($request->nombre) && $perros->nombre = $request->nombre;
            isset($request->url_foto) && $perros->url_foto = $request->url_foto;
            isset($request->descripcion) && $perros->descripcion = $request->descripcion;
            $perros->save();

            // $perros = Perro::where('id', $request->id)
            //     ->update([
            //         'nombre' => $request->nombre,
            //         'url_foto' => $request->url_foto,
            //         'descripcion' => $request->descripcion
            //     ]);


            return response()->json(["perros" => $perros], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e,
                "mensaje" => $e->getMessage(),
                "linea" => $e->getLine(),
                "archivo" => $e->getFile(),
            ]);
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function verPerro($request)
    {
        try {

        $perros = Perro::where('id', $request->id)->first();

            if(!$perros){
                throw new Exception("No se encuentra el perro");
            }

        return response()->json(["perros" => $perros], Response::HTTP_OK);
        }catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function verPerroAzar($request)
    {
        try {
        
        //$perros = Perro::where('id', $request->id)->first();
        $perrosYaListados = Interaccion::where('id_perro_interesado',1)->get('id_perro_candidato');
        $perros = Perro::inRandomOrder()->whereNotIn('id', $perrosYaListados)->whereNotIn('id', [1,1])
                ->first();
                
            if(!$perros){
                throw new Exception("No se encuentra el perro");
            }

        return response()->json(["perros" => $perros], Response::HTTP_OK);
        }catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function guardarInteraccion($request)
    {
        //valida que no exista la misma interaccion
        $val = Interaccion::where('id_perro_interesado',$request->id_perro_interesado)->
            where('id_perro_candidato',$request->id_perro_candidato)->first();
        if($val){
            return response()->json(["error" => "ya existe esta interaccion"], Response::HTTP_BAD_REQUEST);
        }
        $interaccion = Interaccion::create([
            "preferencia" => $request->preferencia,
            "id_perro_interesado" => $request->id_perro_interesado,
            "id_perro_candidato" => $request->id_perro_candidato
        ]);

        return response()->json(["interaccion" => $interaccion], Response::HTTP_OK);
    }


    public function verInteresadosAceptados($request)
    {

        $interacciones = Interaccion::where('id_perro_interesado', $request->id)->where('preferencia','A')->get('id_perro_candidato');
        $perros = Perro::whereIn('id', $interacciones)->get();
        if(!$perros){
            throw new Exception("No se encuentran interacciones");
        }
        return response()->json(["perros" => $perros], Response::HTTP_OK);


    }
    public function verInteresadosRechazados($request)
    {

        $interacciones = Interaccion::where('id_perro_interesado', $request->id)->where('preferencia','R')->get('id_perro_candidato');
        $perros = Perro::whereIn('id', $interacciones)->get();
        if(!$perros){
            throw new Exception("No se encuentran interacciones");
        }
        return response()->json(["perros" => $perros], Response::HTTP_OK);


    }

    public function cambiarInteraccion($request)
    {   
        try {

            $interaccion = Interaccion::where('id_perro_interesado', $request->id_perro_interesado)->
            where('id_perro_candidato', $request->id_perro_candidato)->
                update([
                    'preferencia' => $request->preferencia
                ]);


            return response()->json(["interaccion" => $interaccion], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e,
                "mensaje" => $e->getMessage(),
                "linea" => $e->getLine(),
                "archivo" => $e->getFile(),
            ]);
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

    }
    
}
