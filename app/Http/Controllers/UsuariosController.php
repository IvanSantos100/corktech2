<?php
/**
 * Created by PhpStorm.
 * User: Pichau
 * Date: 04/04/2017
 * Time: 21:40
 */

namespace CorkTeck\Http\Controllers;

//use CorkTeck\Http\Requests\UsuariosRequest;
use CorkTeck\Repositories\UsuariosRepository;
use Illuminate\Database\QueryException;

class UsuariosController extends Controller
{
    protected $repository;

    public function __construct(UsuariosRepository $repository){
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $usuarios = $this->repository->paginate(10);

        return view('admin.usuarios.index', compact('usuarios'));
    }
}