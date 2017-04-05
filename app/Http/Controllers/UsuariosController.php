<?php
/**
 * Created by PhpStorm.
 * User: Pichau
 * Date: 04/04/2017
 * Time: 21:40
 */

namespace CorkTech\Http\Controllers;

//use CorkTech\Http\Requests\UsuariosRequest;
use CorkTech\Repositories\UsuariosRepository;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use Illuminate\Database\QueryException;

class UsuariosController extends Controller
{
    protected $repository;

    private $centroDistribuicoesRepository;

    public function __construct(
        UsuariosRepository $repository,
        CentroDistribuicoesRepository $centroDistribuicoesRepository
    ){
        $this->repository = $repository;
        $this->centroDistribuicoesRepository = $centroDistribuicoesRepository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $usuarios = $this->repository->paginate(10);

        return view('admin.usuarios.index', compact('usuarios'));
    }
}