<?php
namespace App\DAO;
use PDO;
use App\modelo\Plato;

class PlatoDAO{
    
    private $bd;
    
    public function __construct($bd) {
        $this->bd=$bd;
    }
    
    function recuperarPlatos()
    {
        $categorias = ['bebida', 'entrante', 'principal', 'postre', 'otro'];
        $sql = "select id_plato, nombre, precio, categoria from platos where categoria=:categoria order by nombre";
        $platos = [];
        for($i = 0; $i < sizeof($categorias); $i++)
        {
            $stmRecuperarPlatos = $this -> bd -> prepare($sql);
            $stmRecuperarPlatos -> execute([':categoria' => $categorias[$i]]);
            $platos_categoria = array_values($stmRecuperarPlatos -> fetchAll(PDO::FETCH_ASSOC));
            for($j = 0; $j < sizeof($platos_categoria); $j++)
            {
                $platos[] = $platos_categoria[$j];
            }
        }
        return $platos;
    }
    
    public function insertarPlato($nom, $ing, $cat, $sub, $pre, $es) {
        if($this->buscarPorNombre($nom)){
            return "existe";
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
            return "inexistente";
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
            return "No existe";
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
    
    public function modificar_por_id($id_plato, $nom, $ing, $cat, $sub, $pre, $es){
        $consulta1="SELECT * FROM platos WHERE id_plato=:id";
        $stm1=$this->bd->prepare($consulta1);
        $stm1->execute([':id'=>$id_plato]);
        $numFilas=$stm1->rowCount();
        if($numFilas==0){
            return 'No existe';
        }
        
        $consulta="UPDATE platos SET nombre=:n, ingredientes=:i, categoria=:c, subcategoria=:s, precio=:p, estado=:e WHERE id_plato=:id";
        $stm= $this->bd->prepare($consulta);
        $resultado=$stm->execute([':n'=>$nom, ':i'=>$ing, ':c'=>$cat, ':s'=>$sub, ':p'=>$pre, ':e'=>$es, ':id'=>$id_plato]);
        
        if($resultado){
            return true;
        }else{
            return false;
        }
    }
    
    public function obtener_id($nom){
        $consultaSelect= "SELECT id_plato FROM platos WHERE nombre=:n";
        $stm=$this->bd->prepare($consultaSelect);
        $stm->execute([':n'=>$nom]);
        $resultadoSelect= $stm->rowCount();
        
        if($resultadoSelect==0){
            return false;
        }else{
            $registro=$stm->fetch(PDO::FETCH_OBJ);
            $id=$registro->id_plato;
            return $id;
        }
    }
    
    public function buscar_por_cat($categoria){
        if($categoria==='todos'){
            $consulta="SELECT * FROM platos ORDER BY categoria, subcategoria, nombre";
            $stm=$this->bd->prepare($consulta);
            $stm->execute();
        } else{
            $consulta="SELECT * FROM platos WHERE categoria= :c ORDER BY categoria, subcategoria, nombre";
            $stm=$this->bd->prepare($consulta);
            $stm->execute([':c'=>$categoria]);
        }
       
        $resultados=$stm->fetchAll(PDO::FETCH_OBJ);
        return $resultados;
        
    
    }
    
    public function activar_desactivar_por_id($id, $es){
        $consultaSelect= "SELECT * FROM platos WHERE id_plato=:i";
        $stm=$this->bd->prepare($consultaSelect);
        $stm->execute([':i'=>$id]);
        $resultadoSelect= $stm->rowCount();
        
        if($resultadoSelect==0){
            return "inexistente";
        }if($resultadoSelect>0){
            $consultaMod="UPDATE platos SET estado= :e WHERE id_plato= :i";
            $stm2= $this->bd->prepare($consultaMod);
            $resultadoMod=$stm2->execute([':e'=>$es, ':i'=>$id]);
            if($resultadoMod){
                return true;
            }else{
                return "No se ha podido modificar el plato";
            }
        }
    }
}

