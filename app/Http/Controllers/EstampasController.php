<?php

namespace CorkTech\Http\Controllers;

use CorkTech\Http\Requests\EstampasRequest;
use CorkTech\Repositories\EstampasRepository;
use Illuminate\Http\Request;

class EstampasController extends Controller
{

    /**
     * @var EstampasRepository
     */
    protected $repository;


    public function __construct(EstampasRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $estampas = $this->repository->scopeQuery(function($query){
            return $query->orderBy('descricao','asc');
        })->paginate(25);


        return view('admin.estampas.index', compact('estampas','search'));
    }

    public function create()
    {
        return view('admin.estampas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EstampasRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EstampasRequest $request)
    {
        $estampa = $this->repository->create($request->all());

        if($request->file('estampa_file'))
            $this->images($request, $estampa->id);

        $url = $request->get('redirect_to', route('admin.estampas.index'));
        $request->session()->flash('message', 'Estampa cadastrado com sucesso.');

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
        $estampa = $this->repository->find($id);

        return view('admin.estampas.show', compact('estampa'));
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

        $estampa = $this->repository->find($id);

        $url = \Storage::url($estampa['estampa']);
        $caminho = asset($url);

        return view('admin.estampas.edit', compact('estampa','caminho'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  EstampasUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(EstampasRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

        if($request->file('estampa_file'))
            $this->images($request, $id);

        $url = $request->get('redirect_to', route('admin.estampas.index'));
        $request->session()->flash('message', 'Estampa cadastrado com sucesso.');

        return redirect()->to($url);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Estampas excluída com sucesso.');

        $filename = "estampa-{$id}.png";
        if (file_exists('images/'.$filename)) {
            unlink('images/thumbnail/'.$filename);
            unlink('images/'.$filename);
        }

        $url = $request->get('redirect_to', route('admin.estampas.index'));

        return redirect()->to($url);
    }

    public function images(Request $request, $id){

        $image = $request->file('estampa_file');

        $input['imagename'] = 'estampa-'.$id.'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('images/thumbnail');

        $img = \Image::make($image->getRealPath(),array(

            'width' => 100,

            'height' => 100,

            'grayscale' => false

        ));

        $img->save($destinationPath.'/'.$input['imagename']);

        $destinationPath = public_path('images');

        $image->move($destinationPath, $input['imagename']);

    }
}
