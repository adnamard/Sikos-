<?php

namespace App\Models;

use CodeIgniter\Model;

class KamarModel extends Model
{
    protected $table            = 'kamar';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'luas', 'harga', 'stok', 'deskripsi', 'gambar'];

    public function getKamar($nama = false) #Jika ga ada parameter maka tampilakn semua dengan findall
    {
        if ($nama == false) {
            return $this->findAll();
        }

        return $this->where(['nama' => $nama])->first(); #kalau ada maka tampilakn array pertama
    }
}
