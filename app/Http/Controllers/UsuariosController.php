<?php
/**
 * Created by PhpStorm.
 * User: Pichau
 * Date: 04/04/2017
 * Time: 21:40
 */

namespace CorkTeck\Http\Controllers;

use CorkTeck\Http\Requests\UsuariosRequest;
use CorkTeck\Repositories\UsuariosRepository;
use CorkTeck\Repositories\CentroDistribuicoesRepository;
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

    public function create()
    {
        $centroDistribuicoes = $this->centroDistribuicoesRepository->pluck('descricao', 'id');
        return view('admin.usuarios.create', compact('centroDistribuicoes'));
    }

    public function store(UsuariosRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $this->repository->create( $data);
        $url = $request->get('redirect_to', route('admin.usuarios.index'));
        $request->session()->flash('message', 'Usuário cadastrado com sucesso.');

        return redirect()->to($url);
    }

    public function edit($id)
    {
        $usuario = $this->repository->find($id);
        $centroDistribuicoes = $this->centroDistribuicoesRepository->pluck('descricao', 'id');

        return view('admin.usuarios.edit', compact('usuario', 'centroDistribuicoes'));
    }

    public function update(UsuariosRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.usuarios.index'));
        $request->session()->flash('message', ' Usuário atualizado com sucesso.');

        return redirect()->to($url);
    }

    public function show($id)
    {
        $usuario = $this->repository->find($id);

        return view('admin.usuarios.show', compact('usuario'));
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            \Session::flash('message', 'Usuário excluída com sucesso.');
        }catch (QueryException $ex){
            \Session::flash('error', 'Usuário não pode ser excluido. Ele está relacionado com outro registro .');
        }

        return redirect('admin/usuarios');
    }

}