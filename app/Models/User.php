<?php

namespace CorkTech\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContracts;
use \Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContracts;


class User extends Model implements AuthenticatableContracts, CanResetPasswordContracts
{
    use Notifiable, Authenticatable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';


    protected $fillable = [
        'name',
        'email',
        'password',
        'centrodistribuicao_id',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'fone',
        'celular',
        'is_permission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function centroDistribuicoes()
    {
        return $this->belongsTo(CentroDistribuicao::class, 'centrodistribuicao_id', 'id');
    }

    public function getSelectCDAttribute()
    {
        if($this->centrodistribuicao_id == 1){
            return $this->centroDistribuicoes->pluck('descricao', 'id');
        }

        return $this->centroDistribuicoes()->pluck('descricao', 'id');
    }


}
