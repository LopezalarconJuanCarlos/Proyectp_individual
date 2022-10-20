<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
class ProductosController extends Controller
{
    public function Productos()
    {
        $productos_a = Producto::all();
        $productos_b = \DB::select('SELECT * FROM tb_productos');
        return view ("vistap")
            ->with(['productos1'=> $productos_a])
            ->with(['productos2'=> $productos_b]);


    }

    public function detallep($id)
    {
        $productos_a = Producto::find($id);
        return view("detallep")
            ->with(['detallep' => $productos_a]);
    }

  //------------------------------ALTA----------------------------------------------------------------------------
    public function altaProductos()
    {
        $productos_a = Producto::all();
        return view("formulariop")
            ->with(['productos'=> $productos_a]);
    }   
    public function registrar(Request $request){
 //----------------------------------VALIDACION DE CAMPOS (REQUERIDOS)---------------------------------------------
 $this->validate($request,[
    'clave' => 'required',
    'nombre'=> 'required',
    'app' => 'requeried',
    'ap'=> 'requeried',
    'fn'=> 'requeried',
    'email'=>'requeried',
    'pass'=>'reuqueried'
]);

//Usuarios:: create($request->only('clave','nombre','app', 'ap','fn','gen','foto','email','pass','nivel'))
Usuarios::create(array(
    'clave'=>$request->input('clave'),
    'nombre'=>$request->input('nombre'),
    'app'=>$request->input('app'),
    'ap'=>$request->input('ap'),
    'fn'=>$request->input('fn'),
    'gen'=>$request->input('gen'),
    'foto'=>$request->input('foto'),
    'email'=>$request->input('email'),
    'pass'=>$request->input('pass'),
    'nivel'=>$request->input('nivel'),
    'activo'=> '1'
));

return redirect()->route('lista');

}

//--------------------------Editar----------------------------------------------------------------------------------
public function editar(Usuarios $id){
    $nivel = Nivel:: all();
    
    return view("editar")
    ->with(['usuarios'=> $id])
    ->with(['nivel'=> $nivel]);
}

public function salvar(Usuarios $id, Request $request ){
    //$id->update($request->only('clave','nombre','app','fn','gen','foto','email','pass','nivel','activo'))
    //dd($request->all());
    $query = Usuarios::find($id->id_usuairos);
    $query->clave - $request->clave;
    $query->nombre = trim($request->nombre);
    $query->app = trim($request->app);
    $query->ap = trim($request->ap);
    $query->fn = $request->fn ;
    $query->gen = $request->gen;
    $query->foto - trim($request->foto);
    $query->email = trim($request->email);
    $query->pass - trim($request->pass);
    $query->nivel = $request->nivel;


    $query-> save();
    return redirect()->route("editar", [$id->$id_producto]);
}

}
