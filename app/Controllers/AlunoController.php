<?php

class AlunoController extends Controller
{
    public function index(): void
    {
        $data = [
            'title' => 'Alunos | MentoriaGestor'
        ];

        $this->view('alunos/index', $data);
    }
}