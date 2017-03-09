<?php

namespace CorkTeck\Http\Controllers;

use Illuminate\Http\Request;

use CorkTeck\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CorkTeck\Http\Requests\EstampasCreateRequest;
use CorkTeck\Http\Requests\EstampasUpdateRequest;
use CorkTeck\Repositories\EstampasRepository;
use CorkTeck\Validators\EstampasValidator;


class EstampasController extends Controller
{

    /**
     * @var EstampasRepository
     */
    protected $repository;

    /**
     * @var EstampasValidator
     */
    protected $validator;

    public function __construct(EstampasRepository $repository, EstampasValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $estampas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $estampas,
            ]);
        }

        return view('estampas.index', compact('estampas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EstampasCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EstampasCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $estampa = $this->repository->create($request->all());

            $response = [
                'message' => 'Estampas created.',
                'data'    => $estampa->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $estampa,
            ]);
        }

        return view('estampas.show', compact('estampa'));
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

        return view('estampas.edit', compact('estampa'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  EstampasUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(EstampasUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $estampa = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Estampas updated.',
                'data'    => $estampa->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Estampas deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Estampas deleted.');
    }
}
