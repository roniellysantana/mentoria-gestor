<?php

class DisciplinaController extends Controller
{
    public function index(): void
    {
        $data = [
            'title' => 'Disciplinas | MentoriaGestor'
        ];

        $this->view('disciplinas/index', $data);
    }
}