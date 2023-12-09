<?php
namespace App\modelo;
class Pedir
{
    private $id_reserva;
    private $id_plato;
    private $unidades;
    
    public function __construct($id_reserva = null, $id_plato = null, $unidades = null)
    {
        if(!is_null($id_reserva))
        {
            $this -> id_reserva = $id_reserva;
        }
        if(!is_null($id_plato))
        {
            $this -> id_plato = $id_plato;
        }
        if(!is_null($unidades))
        {
            $this -> unidades = $unidades;
        }
    }
    
    public function setId_reserva($id_reserva): void
    {
        $this -> id_reserva = $id_reserva;
    }

    public function getId_reserva()
    {
        return $this -> id_reserva;
    }
    
    public function setId_plato($id_plato): void
    {
        $this -> id_plato = $id_plato;
    }
    
    public function getId_plato()
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
    
}