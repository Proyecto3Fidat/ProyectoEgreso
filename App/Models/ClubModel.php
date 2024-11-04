<?php

namespace App\Models;

class ClubModel
{

   private  $idClub;
    private  $nombreClub;

    public function __construct($nombreClub)
    {
        $this->nombreClub = $nombreClub;
    }

    public function getNombreClub()
    {
        return $this->nombreClub;
    }

    public function setNombreClub($nombreClub)
    {
        $this->nombreClub = $nombreClub;
    }


}