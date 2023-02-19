<?php

namespace App\Controllers;
use App\Models\Order;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Orders extends ResourceController
{
    use ResponseTrait;
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new Order;
        $data = $model->findAll();
        return $this->respond( $data );
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new Order;
        $data = $model->find( $id );
        if( empty($data) ){
            return $this->failNotFound("Item not found");
        }

        return $this->respond( $data );
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
            "title" => "required",
            "refr" => "required",
            "status" => "required",
        ];

        if( !$this->validate($rules) ) {
            return $this->fail( $this->validator->getErrors());
        }
        $data = ["title" => $this->request->getVar("title"),
                 "refr" => $this->request->getVar("refr"),
                 "status_id" => $this->request->getVar("status")];
        $model = new Order;
        $model->save( $data );

        return $this->respondCreated( $data );
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
        $rules = [
            'title' => 'required',
            'refr' => 'required',
            'status' => 'required'
        ];

        if( !$this->validate( $rules )){
            return $this->fail( $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getVar("title"),
            'status' => $this->request->getVar("status"),
            'refr' => $this->request->getVar("refr")
        ];
        $model = new Order;
        $model->update( $id, $data );

        return $this->respondCreated( $data );
    
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new Order;
        $data = $model->find( $id );
        if( empty($data)){
            return $this->failNotFound("Item not found");
        }

        $model->delete( $id );
        return $this->respondDeleted( $data );
    }
}
