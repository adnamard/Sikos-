<?php

namespace App\Models;

use CodeIgniter\Model;

class SewaModel extends Model
{
    protected $table            = 'sewa';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'kamar_id', 'jumlah'];

    public function getSewa()
    {
        return $this->findAll();
    }

    public function getSewaById($user_id)
    {
        return $this->select('sewa.*, kamar.*, sewa.id')
            ->join('kamar', 'kamar.id = sewa.kamar_id') //Dari tabel komik, kita ambil idnya dan dijoin ke tabel sewa field komik_id
            ->where('sewa.user_id', $user_id)
            ->findAll();
    }

    public function getCheckoutCountAllFindAll()
    {
        return $this->select('sewa.*, kamar.*, sewa.id')
            ->join('kamar', 'kamar.id = sewa.kamar_id')
            ->countAllResults();
    }

    public function insertSewa($data)
    {
        return $this->insert($data);
    }

    public function updateSewa($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteSewa($checkoutId)
    {
        return $this->delete($checkoutId);
    }
}
