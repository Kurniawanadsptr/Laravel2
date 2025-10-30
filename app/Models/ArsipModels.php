<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipModels extends Model
{
  protected $table = 'data_arsip';
  protected $primaryKey = 'id_arsip';

  protected $fillable = [
    'id_arsip',
    'file',
    'name_file',
    'no_surat',
    'judul',
    'file_eksis',
    'jenis_dokumen',
    'kategori',
    'size_file',
    'date_upload',
    'users_id',
  ];
  public function user(){
    return $this->belongsTo(User::class, 'users_id', 'id_user');
  }
}
