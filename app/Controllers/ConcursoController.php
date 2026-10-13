<?php

class ConcursoController extends Controller
{
    public function __construct()
    {
        Auth::exigirLogin();
    }

    public function index(): void
    {
        $data = [
            'title' => 'Concursos | MentoriaGestor'
        ];

        $this->view('concursos/index', $data);
    }
}
