<?php

namespace Intranet\Http\Controllers\API\Psp\PspGroup;
use JWTAuth;
use Illuminate\Http\Request;
use Intranet\Models\Student;
use Intranet\Models\PspGroup;
use Dingo\Api\Routing\Helpers;
use Intranet\Models\PspStudent;
use Illuminate\Routing\Controller as BaseController;

class PspGroupController extends BaseController
{
    use Helpers;

    //Testeado y funcionando
    public function getAll()
    {
        $pspGroups = PspGroup::get();
                
        return $this->response->array($pspGroups->toArray());
    }

    public function getById($id)
    {
        $pspGroup = PspGroup::where('id',$id)->get();
        return $this->response->array($pspGroup->toArray());
    }

    public function getByNumber($groupNumber){
        $pspGroup = PspGroup::where('numero',$groupNumber)->get();
        return $this->response->array($pspGroup->toArray());   
    }

    public function selectGroup($id){

        try{
        $user =  JWTAuth::parseToken()->authenticate();
        $alumno = Student::where('IdUsuario',$user->IdUsuario)->get()->first();
        $pspAlumno   = PspStudent::where('IdAlumno' , $alumno->IdAlumno)->get()->first();

        $pspAlumno->idPspGroup = $id;
        $alumno->save();

        $mensaje = "Seleccion su grupo satisfactoriamente";

       return json_encode($mensaje);

        } catch (Exception $e) {
            
            $message  = "No se pudo asignar grupo";

            return json_encode($message);

        }

    }


    public function getGroupByStudent(){
        $user =  JWTAuth::parseToken()->authenticate();
        $alumno = Student::where('IdUsuario',$user->IdUsuario)->get()->first();
        $pspAlumno   = PspStudent::where('IdAlumno' , $alumno->IdAlumno)->get()->first();
        $idGroup  = $pspAlumno->idPspGroup;
        $pspGroup = PspGroup::where('id',$idGroup)->get();
        return $this->response->array($pspGroup->toArray());
    }


    public function getStudent(){
        $user =  JWTAuth::parseToken()->authenticate();
        $alumno = Student::where('IdUsuario',$user->IdUsuario)->get()->first();
        return $this->response->array($alumno->toArray());


    }


}   