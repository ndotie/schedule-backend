<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Technician as TechModel;
use CodeIgniter\API\ResponseTrait;

class Technician extends ResourceController
{
    use ResponseTrait;
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $model = new TechModel;
        $techs = $model->findAll();
        return $this->respond( $techs );
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            'name' => 'required|string',
            'phone'  => 'required' //required some regular expression of the phone
        ];
        if( !$this->validate( $rules )) {
            return $this->fail( $this->validator->getErrors());
        }
        $data = [
            'name' => $this->request->getVar( 'name' ),
            'phone' => $this->request->getVar( 'phone' )
        ];
        $model = new TechModel;
        $model->save( $data );
        return $this->respondCreated( [...$data, 'id' => $model->getInsertID()]);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
