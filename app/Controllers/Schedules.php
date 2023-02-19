<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Schedule;
class Schedules extends ResourceController
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
        // $db = db_connect();
          

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
        //
        $rules = [
            'order_id' => 'required|is_not_unique[orders.id,id,{order_id}]',
            'technician_id' => 'required|is_not_unique[technicians.id,id,{technician_id}]',//check if this row is available on database OFF COURSE ITS A VALIDATION THING
            'day' => 'required|date',//cat assign date less than to day
            'start_at' => 'required|valid_date[H:i:s]',
            'end_at' => 'required|valid_date[H:i:s]' 
        ];

        if( !$this->validate( $rules )){
            return $this->fail( $this->validator->getErrors() );
        };

        $data = [
            'order_id' => $this->request->getVar( 'order_id' ),
            'technician_id' => $this->request->getVar( 'technician_id' ),
            'day' => $this->request->getVar( 'day' ),
            'start_at' =>  $this->request->getVar( 'start_at' ),
            'end_at' => $this->request->getVar( 'end_at' )
        ];
        $model = new Schedule;
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
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete( $id = null )
    {
        //
    }

    public function schedulebytechbydate( $date = null, $tech = null ){
         //Date should be parsed into 2023-02-19 formart. as YYYY-MM-DD
        
        $db = \Config\Database::connect();
        $builder = $db->table( 'schedules' );
        $builder->select( 'orders.title, start_at , end_at , refr' );
        $builder->where( [ 'technician_id' => $tech, 'day' => $date ] );
        $builder->join( 'technicians', 'technicians.id = schedules.technician_id' );
        $builder->join( 'orders', 'orders.id = schedules.order_id' );
        $result = $builder->get()->getResult();

        return $this->respond( $result);
    }
}
