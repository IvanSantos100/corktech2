<?php

namespace CorkTeck\Http\Controllers;

use Illuminate\Http\Request;

use CorkTeck\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CorkTeck\Http\Requests\ClassesRequest;
use CorkTeck\Repositories\ClassesRepository;


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
        $classes = $this->repository->paginate(15);

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
        $class = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $class,
            ]);
        }

        return view('classes.show', compact('class'));
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

        $class = $this->repository->find($id);

        return view('classes.edit', compact('class'));
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

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $class = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Classes updated.',
                'data' => $class->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
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
                'message' => 'Classes deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Classes deleted.');
    }
}
