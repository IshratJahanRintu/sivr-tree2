<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;
protected $fillable=[
    'title',
    'parent_id'
];
    public function parent(){
        return $this->belongsTo(Node::class,'parent_id');
    }
    public function children(){
        return $this->hasMany(Node::class,'parent_id');
    }

}
