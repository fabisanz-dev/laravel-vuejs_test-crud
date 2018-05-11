<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarea;
use Illuminate\Validation\Rule;

class TareaController extends Controller
{
    public function paginado()
    {
        return Tarea::paginate();
    }
    
    public function index()
    {
        return Tarea::orderBy('id','DESC')->get();
    }

    public function store(Request $request)
    {
        $this->validation($request, null);

        $tarea = new Tarea;
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->save();

        return response()->json(['message'=>'Tarea agregada correctamente'], 201);
    }

    public function update(Request $request, $id)
    {
        /* llamo al metodo de validacion pasandole un segundo parametro: id, 
        para ignorar la validacion:unique, ya que confundira la validacion al momento de actualizar*/
        $this->validation($request, $id);
        
        $tarea = Tarea::findOrFail($id);     
        $this->comprobarRegistro($tarea);

        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->save();

        return response()->json(['message'=>'Tarea Actualizada correctamente'], 200);
    }
    
    public function delete($id)
    {
        $tarea = Tarea::findOrFail($id);
        $this->comprobarRegistro($tarea);

        $tarea->delete();
        return response()->json(['message'=>'Recurso eliminado'], 200);
    }

    /**funciones auxiliares complementarias */
    //validation
    public function validation($request, $id)
    {
        return  $this->validate($request, 
            [
                'titulo' => [
                    'required',
                     Rule::unique('tareas')->ignore($id),
                ],
                'descripcion' => 'required'
            ]);

    }
    //verificar existencia del registro por su id
    public function comprobarRegistro($registro){
        if(!$registro)
        {
            return 404;
        }
    }
}
