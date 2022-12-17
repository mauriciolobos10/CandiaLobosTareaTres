<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PerroRequest;
use App\Http\Requests\InteraccionRequest;
use App\Repositories\TinderRepository;

class perroController extends Controller
{
    protected TinderRepository $tinderRepo;
    public function __construct(TinderRepository $tinderRepo)
    {
        $this->tinderRepo = $tinderRepo;
    }

    public function guardarPerro(PerroRequest $request)
    {
        return $this->tinderRepo->guardarPerro($request);
    }

    public function verPerro(PerroRequest $request)
    {
        return $this->tinderRepo->verPerro($request);
    }

    public function eliminarPerro(PerroRequest $request)
    {
        return $this->tinderRepo->eliminarPerro($request);
    }

    public function actualizarPerro(PerroRequest $request)
    {
        return $this->tinderRepo->actualizarPerro($request);
    }

    public function guardarInteraccion(InteraccionRequest $request)
    {
        return $this->tinderRepo->guardarInteraccion($request);
    }

    public function verInteresados(Request $request)
    {
        return $this->tinderRepo->verInteresados($request);
    }
}
