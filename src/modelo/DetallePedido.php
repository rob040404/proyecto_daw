<?php
namespace App\modelo;
class DetallePedido
{
    private $id_pedido;
    private $id_plato;
    private $unidades;
    private $nombre_plato;
    private $categoria_plato;
    private $precio_plato;
    
    public function __construct($id_pedido = null, $id_plato = null, $unidades = null, $nombre_plato = null, $categoria_plato = null, $precio_plato = null)
    {
        if(!is_null($id_pedido))
        {
            $this -> id_pedido = $id_pedido;
        }
        if(!is_null($id_plato))
        {
            $this -> id_plato = $id_plato;
        }
        if(!is_null($unidades))
        {
            $this -> unidades = $unidades;
        }
        if(!is_null($nombre_plato))
        {
            $this -> nombre_plato = $nombre_plato;
        }
        if(!is_null($categoria_plato))
        {
            $this -> categoria_plato = $categoria_plato;
        }
        if(!is_null($precio_plato))
        {
            $this -> precio_plato = $precio_plato;
        }
    }
    
    public function setIdPedido($id_pedido): void
    {
        $this -> id_pedido = $id_pedido;
    }

    public function getIdPedido()
    {
        return $this -> id_pedido;
    }
    
    public function setIdPlato($id_plato): void
    {
        $this -> id_plato = $id_plato;
    }
    
    public function getIdPlato()
    {
        return $this -> id_plato;
    }

    public function setUnidades($unidades): void
    {
        $this -> unidades = $unidades;
    }
    
    public function getUnidades()
    {
        return $this -> unidades;
    }
    
    public function setNombrePlato($nombre_plato): void
    {
        $this -> nombre_plato = $nombre_plato;
    }
    
    public function getNombrePlato()
    {
        return $this -> nombre_plato;
    }
    
     public function setPrecioPlato($precio_plato): void
    {
        $this -> precio_plato = $precio_plato;
    }
    
    public function getCategoriaPlato()
    {
        return $this -> categoria_plato;
    }
    
    public function setCategoriaPlato($categoria_plato): void
    {
        $this -> categoria_plato = $categoria_plato;
    }
    
    public function getPrecioPlato()
    {
        return $this -> precio_plato;
    }
}