<?php
namespace App\DAO;
use PDO;
use App\modelo\Plato;

class PlatoDAO{
    
    private $bd;
    
    public function __construct($bd) {
        $this->bd=$bd;
    }
    
    public function insertarPlato($nom, $ing, $cat, $sub, $pre, $es) {
        if($this->buscarPorNombre($nom)){
            return "Ya existen platos con ese nombre";
        }
        $consulta= "INSERT INTO platos (nombre, ingredientes, categoria, subcategoria, precio, estado) VALUES (:n, :i, :c, :s, :p, :e)"; 
        $stm= $this->bd->prepare($consulta);
        $resultado= $stm->execute([':n'=>$nom, ':i'=>$ing, ':c'=>$cat, ':s'=>$sub, ':p'=>$pre, ':e'=>$es]);
        
        if($resultado){
            return true;
        }else{
            return false;
        }
    }
    
    public function activar_desactivar($nom, $es){
        $consultaSelect= "SELECT * FROM platos WHERE nombre=:n";
        $stm=$this->bd->prepare($consultaSelect);
        $stm->execute([':n'=>$nom]);
        $resultadoSelect= $stm->rowCount();
        
        if($resultadoSelect==0){
            return "No existen platos con ese nombre";
        }if($resultadoSelect>0){
            $consultaMod="UPDATE platos SET estado= :e WHERE nombre= :n";
            $stm2= $this->bd->prepare($consultaMod);
            $resultadoMod=$stm2->execute([':e'=>$es, ':n'=>$nom]);
            if($resultadoMod){
                return true;
            }else{
                return "No se ha podido modificar el plato";
            }
        }
    }
    public function buscarPorCategoría($cat){
        $consulta= "SELECT * FROM platos WHERE categoria= :c ORDER BY categoria, subcategoria ";
        $stm=$this->bd->prepare($consulta);
        $stm->execute([':c'=>$cat]);
        $stm->setFetchMode(PDO::FETCH_CLASS, Plato::class);
        $platos=$stm->fetchAll();
        return $platos;
    }
    public function buscarPorNombre($nom){
        $consultaSelect= "SELECT * FROM platos WHERE nombre=:n";
        $stm=$this->bd->prepare($consultaSelect);
        $stm->execute([':n'=>$nom]);
        $resultadoSelect= $stm->rowCount();
        
        if($resultadoSelect==0){
            return false;
        }else{
            $registro=$stm->fetch(PDO::FETCH_OBJ);
            return $registro;
        }
    }
    public function buscarPorId($id){
        $consultaSelect= "SELECT * FROM platos WHERE id_plato=:i";
        $stm=$this->bd->prepare($consultaSelect);
        $stm->execute([':i'=>$id]);
        $resultadoSelect= $stm->rowCount();
        
        if($resultadoSelect==0){
            return false;
        }else{
            $registro=$stm->fetch(PDO::FETCH_OBJ);
            return $registro;
        }
    }
    
    
    public function borrarPorNombre($nom){
        if(!$this->buscarPorNombre($nom)){
            return "No existen platos con ese nombre";
        }
        $consulta= "DELETE FROM platos WHERE nombre=:n";
        $stm=$this->bd->prepare($consulta);
        $resultado=$stm->execute([':n'=>$nom]);
        
        if($resultado){
            return true;
        }else{
            return false;
        }
    }
    
    public function modificar($antiguo_nombre, $nom, $ing, $cat, $sub, $pre, $es){
        if(!$this->buscarPorNombre($antiguo_nombre)){
            return "No existen platos con ese nombre";
        }
        
        $consulta="UPDATE platos SET nombre=:n, ingredientes=:i, categoria=:c, subcategoria=:s, precio=:p, estado=:e WHERE nombre=:an";
        $stm= $this->bd->prepare($consulta);
        $resultado=$stm->execute([':n'=>$nom, ':i'=>$ing, ':c'=>$cat, ':s'=>$sub, ':p'=>$pre, ':e'=>$es, 'an'=>$antiguo_nombre]);
        
        if($resultado){
            return true;
        }else{
            return false;
        }
    }
}

