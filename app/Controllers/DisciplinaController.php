<?php

class DisciplinaController extends Controller
{
    public function __construct()
    {
        Auth::exigirLogin();
    }

    public function index(): void
    {
        $data = [
            'title' => 'Disciplinas | MentoriaGestor'
        ];

        $this->view('disciplinas/index', $data);
    }
}
