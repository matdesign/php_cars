<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'cars'; //give different table name
    protected $primaryKey = 'id';  //make a different primary key

    protected $fillable = ['name', 'founded','description'];
    protected $hidden = ['updated_at'];
    protected $visible = ['id','name', 'founded', 'description'];

    public function carmodels() {
        return $this->hasMany(CarModel::class);
    }

    //define a has many through relationship
    public function engines() {
        return $this->hasManyThrough(
            Engine::class,
            CarModel::class,
            'car_id', //foreignkey on car_model table
            'model_id' //foreign key on engine table
        );
    }

    //define a has one through relationship
    public function productionDate()
    {
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,
            'car_id',  //foriegin key
            'model_id'

        );
    }
}

