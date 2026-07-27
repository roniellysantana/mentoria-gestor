<?php

class RelatorioController extends Controller
{
    public function index(): void
    {
        $data = [
            'title' => 'Relatórios | MentoriaGestor'
        ];

        $this->view('relatorios/index', $data);
    }
}