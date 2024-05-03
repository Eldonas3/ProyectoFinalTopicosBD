<?php

namespace App\Models;

use CodeIgniter\Model;

class JuguetesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'juguete';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre','descripcion','categoria','precio','cantidad_disponible','fecha_ingreso'];

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

    // Retorna toda la info de todos los juguetes con un nombre especifico
    public function getJuguetePorNombre(){
        $request = request();
        $nombre = $request->getGet('nombre');
        $db = db_connect();

        $sql = $db->table('juguete')
        ->select('nombre','descripcion','categoria','precio','cantidad_disponible')
        ->where('nombre', $nombre);

        $query = $sql->get();
        return $query->getResult();
    }

    // Retorna todas la cantidades disponibles de un juguete especifico
    public function getCantidadJuguete(){
        $request = request();
        $nombre = $request->getGet('nombre');
        $db = db_connect();
        
        $sql = $db->table('juguete')
        ->select('cantidad')
        ->where('nombre',$nombre);

        $query = $sql->get();
        return $query->getResult();        
    }

    //retorna el numero de empresas que ofrecen un juguete especifico
    public function getNumeroEmpresasPorJuguete(){
        $request = request();
        $nombre = $request->getGet('nombre');
        $db = db_connect();

        $sql = $db->table('juguete as j')
        ->selectCount('p.nombre')
        ->join('proveedores as p','j.id = p.producto')
        ->where('j.nombre',$nombre);    
    }

    //retorna los juguetes de una categoria ingresada
    public function getCategoriaPorJuguete(){
        $request = request();
        $categoria = $request->getGet('categoria');
        $db = db_connect();

        $sql = db_connect();

    }


}
