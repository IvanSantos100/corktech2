<?php

namespace CorkTech\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use CorkTech\Repositories\UsuariosRepository;
use CorkTech\Repositories\CentroDistribuicoesRepository;
use CorkTech\Http\Requests\UserRequest;
use CorkTech\Http\Requests\PasswordRequest;
use Illuminate\Database\QueryException;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $repository;

    private $centroDistribuicoesRepository;


    public function __construct(
        UsuariosRepository $repository,
        CentroDistribuicoesRepository $centroDistribuicoesRepository
    )
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->centroDistribuicoesRepository = $centroDistribuicoesRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function edit(){
        $id = Auth::user()->id;
        $centrodid = Auth::user()->centrodistribuicao_id;
        $usuario = $this->repository->find($id);
        $centroDistribuicoes = $this->centroDistribuicoesRepository->find($centrodid);

        return view('edit', compact('usuario', 'centroDistribuicoes'));
    }

    public function update(UserRequest $request)
    {
        $data = $request->all();

        $id = Auth::user()->id;

        $this->repository->update($data, $id);
        $request->session()->flash('message', ' Dados atualizado com sucesso.');

        return redirect()->action('HomeController@index');
    }

    public function editpassword(){
        $id = Auth::user()->id;
        $usuario = $this->repository->find($id);

        return view('editpassword', compact('usuario'));
    }

    public function updatepassword(PasswordRequest $request)
    {
        $data['password'] = bcrypt($request->password);
        $id = Auth::user()->id;

        $this->repository->update($data, $id);
        $request->session()->flash('message', ' Senha alterada com sucesso.');

        return redirect()->action('HomeController@index');
    }

    public function logout()
    {
        return view('home');
    }
}
