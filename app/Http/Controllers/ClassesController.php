<?php

namespace CorkTech\Http\Controllers;

use Illuminate\Http\Request;

use CorkTech\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CorkTech\Http\Requests\ClassesRequest;
use CorkTech\Repositories\ClassesRepository;


class ClassesController extends Controller
{

    /**
     * @var ClassesRepository
     */
    protected $repository;

    public function __construct(ClassesRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $classes = $this->repository->paginate(10);

        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClassesRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClassesRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('admin.classes.index'));
        $request->session()->flash('message', 'Classe cadastrado com sucesso.');

        return redirect()->to($url);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classe = $this->repository->find($id);

        return view('admin.classes.show', compact('classe'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classe = $this->repository->find($id);

        return view('admin.classes.edit', compact('classe'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ClassesRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(ClassesRequest $request, $id)
    {

        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('admin.classes.index'));
        $request->session()->flash('message', 'Classe atualizada com sucesso.');

        return redirect()->to($url);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            \Session::flash('message', 'Classe excluída com sucesso.');
        }catch (QueryException $ex){
            \Session::flash('error', 'Classe não pode ser excluido. Ele está relacionado com outro registro .');
        }

        return redirect('admin/classes');
    }
}
