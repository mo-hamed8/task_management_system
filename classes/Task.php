<?php 


class Task{
    private $id;
    private $description;
    private $date_added;

    // done or not 
    private $status;

    // The percentage of its impact on the general ratio
    private $ratio;
   
    // urgent and Important
    // not urgent and Important
    // urgent and unimportan
    // not Urgent and unimportant
    private $type;


    public function __construct($id,$description,$status,$type){
        $this->id=$id;
        $this->description=$description;
        $this->status=$status;
        $this->type=$type;
    }

    public function set_ratio($ratio){
        $this->ratio=$ratio;
    }

    // return list of information
    public function info(){
        return [
            "id"=>$this->id,
            "description"=>$this->description,
            "status"=>$this->status,
            "type"=>$this->type
        ];
    }
}









?>