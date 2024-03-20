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


    public function __construct($goals,$habits){
        $this->goals=$goals;
        $this->habits=$habits;
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

            if($type=="urgent and Important"){
                $l_ui++;
            }
            elseif($type=="not urgent and Important"){
                $l_ni++;
            }
            elseif($type=="urgent and unimportan"){
                $l_uu++;
            }
            elseif($type=="not Urgent and unimportant"){
                $l_nu++;
            }
        }

        foreach($this->goals as $task){

            // type of task
            $type=$task->info()["type"];

            if($type=="urgent and Important"){
                $ratio=$this->ratio_ui/$l_ui;
                $task->set_ratio($ratio);
            }
            elseif($type=="not urgent and Important"){
                $ratio=$this->ratio_ni/$l_ni;
                $task->set_ratio($ratio);
            }
            elseif($type=="urgent and unimportan"){
                $ratio=$this->ratio_uu/$l_uu;
                $task->set_ratio($ratio);
            }
            elseif($type=="not Urgent and unimportant"){
                $ratio=$this->ratio_nu/$l_nu;
                $task->set_ratio($ratio);
            }
        }


    }

    //Calculate the ratio for goals
    private function calc_ratio_t(){

        $ratio=$this->ratio_habits/count($this->habits);

        foreach($this->habits as $task){
            $task->set_ratio($ratio);
        }
    }

    

}










?>