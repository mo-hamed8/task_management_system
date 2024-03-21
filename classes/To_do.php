<?php 

class To_do{

    // raily, non-recurring goals
    private $goals;

    // repetitive daily habits
    private $habits;

    private $ratio_ui=30;
    private $ratio_ni=10;
    private $ratio_uu=7;
    private $ratio_nu=3;


    private $ratio_habits=50;


    public function __construct($date="today"){
        $date=($date=="today"? date("Y-m-d"):$date);

        require "connect_db.php";
        require "classes/Task.php";

        //   Daily goals
        $sql="select * from tasks where date_added='$date' AND type!='habit' AND status!= 'done';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $this->goals[]=new Task($row["id"],$row["description"],$row["status"],$row["type"]);
            }
          } 
          else {
            echo "0 results";
          }
        

        //   Daily habits
        $sql1="select * from tasks where date_added='$date' and type='habit' and status!='done' ;";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            // output data of each row
            while($row = $result1->fetch_assoc()) {
              $this->habits[]=new Task($row["id"],$row["description"],$row["status"],$row["type"]);
            }
          } 
          else {
            echo "0 results";
          }

          $conn->close();

          $this->calc_ratio_g();
          $this->calc_ratio_h();
    }

    // Calculate the ratio for goals
    private function calc_ratio_g(){

        $num=count($this->goals);

        // length of urgent and Important
        $l_ui=0;

        // length of not urgent and Important
        $l_ni=0;

        // length of urgent and unimportan
        $l_uu=0;

        // length of not Urgent and unimportant
        $l_nu=0;

        foreach($this->goals as $task){

            // type of task
            $type=$task->info()["type"];

            if($type=="urgent and important"){
                $l_ui++;
            }
            elseif($type=="not urgent and important"){
                $l_ni++;
            }
            elseif($type=="urgent and unimportant"){
                $l_uu++;
            }
            elseif($type=="not urgent and unimportant"){
                $l_nu++;
            }
        }

        foreach($this->goals as $task){

            // type of task
            $type=$task->info()["type"];

            if($type=="urgent and important"){
                $ratio=$this->ratio_ui/$l_ui;
                $task->set_ratio($ratio);
            }
            elseif($type=="not urgent and important"){
                $ratio=$this->ratio_ni/$l_ni;
                $task->set_ratio($ratio);
            }
            elseif($type=="urgent and unimportant"){
                $ratio=$this->ratio_uu/$l_uu;
                $task->set_ratio($ratio);
            }
            elseif($type=="not urgent and unimportant"){
                $ratio=$this->ratio_nu/$l_nu;
                $task->set_ratio($ratio);
            }
        }


    }

    //Calculate the ratio for habits
    private function calc_ratio_h(){

        $ratio=$this->ratio_habits/count($this->habits);

        foreach($this->habits as $task){
            $task->set_ratio($ratio);
        }
    }

    public function display_habits(){
        $list=[];

        if($this->habits!=null){
            foreach($this->habits as $task){
                $list[]=$task->info();
            }
        }
        return $list;
    }
    
    public function display_goals(){
        $list=[];

        if($this->goals!=null){
            foreach($this->goals as $task){
                $list[]=$task->info();
            }
        }
        return $list;
    }
}










?>