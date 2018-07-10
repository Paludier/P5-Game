<?php

namespace App\Service;

class EntitiesService
{

    private $default = [
        "cost"=>500,
        "buildTime"=>3,
        "imgName"=>"unit_slot_empty",
        "subPanelAction"=>"",
    ];
    private $base = [
        "type"=>"base",
        "class"=>"building",
        "cost"=>500,
        "buildTime"=>3,
        "imgName"=>"unit_slot_base",
        "onClick"=>"panelInterface.select(this);",
    ];
    private $baseInConstruct = [
        "type"=>"baseInConstruct",
        "class"=>"building",
        "onClick"=>"panelInterface.select(this);",
    ];
    private $main = [
        "type"=>"base",
        "class"=>"building",
    ];
    private $mine = [
        "type"=>"mine",
        "class"=>"building",
        "cost"=>500,
        "buildTime"=>3,
        "imgName"=>"unit_slot_mine",
        "onClick"=>"panelInterface.select(this);",
    ];
    private $mineInConstruct = [
        "type"=>"mineInConstruct",
        "class"=>"building",
        "onClick"=>"panelInterface.select(this);",
    ];
    private $worker = [
        "type"=>"worker",
        "class"=>"unit",
        "cost"=>500,
        "buildTime"=>3,
        "imgName"=>"unit_slot_worker_finished",
    ];
    private $soldier = [
        "type"=>"soldier",
        "class"=>"unit",
        "cost"=>500,
        "buildTime"=>3,
        "imgName"=>"unit_slot_soldier_finished",
    ];
    private $workerSpace = [
        "type"=>"workerSpace",
        "class"=>"upgrade",
        "cost"=>500,
        "buildTime"=>3,
        "imgName"=>"unit_slot_base",
    ];
    private $soldierSpace = [
        "type"=>"soldierSpace",
        "class"=>"upgrade",
        "cost"=>500,
        "buildTime"=>3,
        "imgName"=>"unit_slot_base",
    ];

    
    
    public function entitiesScripts(){
        $sessionAuth = "";
        if (isset($_SESSION['auth'])){
            $sessionAuth = $_SESSION['auth'];
        }
        return "<script>

        class DefaultEntity {
    
            constructor() {
                this.type = \"defaultEntity\";
                this.class = \"building\";
                this.imgName = \"".$this->default["imgName"]."\";
                //this.cost = ".$this->default["cost"].";
                //this.buildTime = ".$this->default["buildTime"].";
            }
        
            subPanelAction(){
                ".$this->default["subPanelAction"]."
            };
        
        }

        class BaseEntity extends DefaultEntity {
    
            constructor(id=0, ownerName=\"\", relation=\"neutral\", content=\"\", workerSpace=\"\", soldierSpace=\"\", marker=null) {
                super();
                this.id = id;
                this.type = \"".$this->base["type"]."\";
                this.class = \"".$this->base["class"]."\";
                this.imgName = \"".$this->base["imgName"]."\";
                this.ownerName = ownerName;
                this.relation = relation;
                this.content = content;
                this.workerSpace = workerSpace;
                this.soldierSpace = soldierSpace;
                this.cost = ".$this->base["cost"].";
                this.buildTime = ".$this->base["buildTime"].";
                this.marker = marker;
            }
            
            onClick() {
                var sessionAuth = '".$sessionAuth."';
                if (sessionAuth !== '') {
                    ".$this->base["onClick"]."
                } else {
                    console.log(sessionAuth);
                }
            }

            subPanelAction(origin){
                build.build('".$this->base["type"]."', origin);
            };
        
        }

        class BaseInConstEntity extends DefaultEntity {
    
            constructor(ownerName=\"\", relation=\"neutral\") {
                super();
                this.type = \"".$this->baseInConstruct["type"]."\";
                this.class = \"".$this->baseInConstruct["class"]."\";
                this.ownerName = ownerName;
                this.relation = relation;
            }
            
            onClick() {
                var sessionAuth = '".$sessionAuth."';
                if (sessionAuth !== '') {
                    ".$this->base["onClick"]."
                } else {
                    console.log(sessionAuth);
                }
            }
        
        }

        class MainEntity extends BaseEntity {
    
            constructor(){
                this.type = \"".$this->main["type"]."\";
            }
            
        }

        class MineEntity extends DefaultEntity {
    
            constructor(id=0, ownerName=\"\", relation=\"neutral\", content=\"\") {
                super();
                this.id = id;
                this.type = \"".$this->mine["type"]."\";
                this.class = \"".$this->mine["class"]."\";
                this.imgName = \"".$this->mine["imgName"]."\";
                this.ownerName = ownerName;
                this.relation = relation;
                this.content = content;
                this.cost = ".$this->mine["cost"].";
                this.buildTime = ".$this->mine["buildTime"].";
            }
        
            onClick() {
                ".$this->mine["onClick"]."
            }

            subPanelAction(origin){
                build.build('mine', origin);
            };
            
        }

        class MineInConstEntity extends DefaultEntity {
    
            constructor(ownerName=\"\", relation=\"neutral\") {
                super();
                this.type = \"".$this->baseInConstruct["type"]."\";
                this.class = \"".$this->baseInConstruct["class"]."\";
                this.ownerName = ownerName;
                this.relation = relation;
            }
            
            onClick() {
                var sessionAuth = '".$sessionAuth."';
                if (sessionAuth !== '') {
                    ".$this->base["onClick"]."
                } else {
                    console.log(sessionAuth);
                }
            }
        
        }

        class WorkerEntity extends DefaultEntity {
    
            constructor(ownerName=\"\", relation=\"neutral\") {
                super();
                this.type = \"".$this->worker["type"]."\";
                this.class = \"".$this->worker["class"]."\";
                this.imgName = \"".$this->worker["imgName"]."\";
                this.ownerName = ownerName;
                this.relation = relation;
                this.cost = ".$this->worker["cost"].";
                this.buildTime = ".$this->worker["buildTime"].";
            }
        
            subPanelAction(origin){
                window.location.replace(\"?p=entity.buy&type=worker&origin=\" + origin);
            };
            
        }

        class SoldierEntity extends DefaultEntity {
    
            constructor(ownerName=\"\", relation=\"neutral\") {
                super();
                this.type = \"".$this->soldier["type"]."\";
                this.class = \"".$this->soldier["class"]."\";
                this.imgName = \"".$this->soldier["imgName"]."\";
                this.ownerName = ownerName;
                this.relation = relation;
                this.cost = ".$this->soldier["cost"].";
                this.buildTime = ".$this->soldier["buildTime"].";
            }
        
            subPanelAction(origin){
                window.location.replace(\"?p=entity.buy&type=soldier&origin=\" + origin);
            };
            
        }

        class WorkerSpaceEntity extends DefaultEntity {
    
            constructor(){
                super();
                this.type = \"".$this->workerSpace["type"]."\";
                this.class = \"".$this->workerSpace["class"]."\";
                this.imgName = \"".$this->workerSpace["imgName"]."\";
                this.cost = ".$this->workerSpace["cost"].";
                this.buildTime = ".$this->workerSpace["buildTime"].";
            }

            subPanelAction(origin){
                window.location.replace(\"?p=entity.buy&type=workerSpace&origin=\" + origin);
            };
            
        }

        class SoldierSpaceEntity extends DefaultEntity {
    
            constructor(){
                super();
                this.type = \"".$this->soldierSpace["type"]."\";
                this.class = \"".$this->soldierSpace["class"]."\";
                this.imgName = \"".$this->soldierSpace["imgName"]."\";
                this.cost = ".$this->soldierSpace["cost"].";
                this.buildTime = ".$this->soldierSpace["buildTime"].";
            }

            subPanelAction(origin){
                window.location.replace(\"?p=entity.buy&type=soldierSpace&origin=\" + origin);
            };
            
        }

        </script>";
    }


    /**
     * Get the value of default
     */ 
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Get the value of base
     */ 
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Get the value of main
     */ 
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Get the value of mine
     */ 
    public function getMine()
    {
        return $this->mine;
    }

    /**
     * Get the value of worker
     */ 
    public function getWorker()
    {
        return $this->worker;
    }

    /**
     * Get the value of soldier
     */ 
    public function getSoldier()
    {
        return $this->soldier;
    }

    /**
     * Get the value of workerSpace
     */ 
    public function getWorkerSpace()
    {
        return $this->workerSpace;
    }

    /**
     * Get the value of soldierSpace
     */ 
    public function getSoldierSpace()
    {
        return $this->soldierSpace;
    }

    /**
     * Get the value of soldierSpace
     */ 
    public function getType($type)
    {
        return $this->$type;
    }
}
