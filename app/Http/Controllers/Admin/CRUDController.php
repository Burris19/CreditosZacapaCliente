<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class CRUDController extends Controller
{
    protected $rules = array();
    protected $repo = null;
    protected $module = '';
    protected $root = 'admin';


    function __construct($middleware = 'auth')
    {
        //$this->middleware($middleware);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->repo->getAll();
        return view($this->root . '/' . $this->module  .'/list',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->root . '/' . $this->module . '/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =$request->all();
        $validator = \Validator::make($data, $this->rules);
        $success = true;
        $message = "Registro guardado exitosamente";
        $record = null;
        if ($validator->passes())
        {
            $record = $this->repo->create($data);
            return compact('success','message','record','data');
        }
        else
        {
            $success=false;
            $message = $validator->messages();
            return compact('success','message','record','data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $action = $request->only('action');
        $data = $this->repo->findOrFail($id);
        if($action['action']=='delete')
        {
            return view($this->root . '/' . $this->module . '/delete',compact('data'));
        }
        else if ($action['action']=='edit')        {

            return view($this->root . '/' . $this->module .'/edit',compact('data'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $record_old = $this->repo->findOrFail($id);
        $data = $request->all();

//        return compact('record_old','data');
        $validator = \Validator::make($data, $this->rules);
        $success = true;
        $message = "Registro guardado exitosamente";
        $record = null;

        if ($validator->passes())
        {
            $record = $this->repo->update($record_old, $data);
            return compact('success','message','record');
        }
        else
        {
            $success=false;
            $message=$validator->messages();
            return compact('success','message','record');
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
        if($this->repo->delete($id))
        {
            return ['success'=>'true','message'=>'Registro eliminado exitosamente'];
        }
        else
        {
            return ['success'=>'false','message'=>'Ocurrio un error al intentar ser eliminado'];
        }
    }
}
