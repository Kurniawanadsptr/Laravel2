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
    'file_eksis',
    'size_file',
    'date_upload',
    'users',
  ];

  public function getSizeHumanAttribute()
  {
    if ($this->size >= 1048576) {
      return round($this->size / 1048576, 2) . ' MB';
    }
    return round($this->size / 1024, 2) . ' KB';
  }
}
