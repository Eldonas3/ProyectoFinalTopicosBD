<?php

namespace App\Models;

use CodeIgniter\Model;

class ProveedoresModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'proveedores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre','descripcione','producto','precio','cantidad_disponible'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    // Retorna info general sobre juguetes que vende una empresa en especifico
    // hay que mandar el nombre

    public function getJugutePorEmpresa(){
        $request = request();
        $nombre = $request->getGet('nombre');
        $db = db_connect();

        $sql = $db->table('juguete as j')
        ->select('j.nombre,j.descripcion,j.precio')
        ->join('proveedores as p','j.id = p.producto')
        ->where('p.nombre',$nombre);

        $query = $sql->get();
        return $query->getResult();  
    }

    //retorna el numero de empresas que ofrecen un juguete especifico
}
