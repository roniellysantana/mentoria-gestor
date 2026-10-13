<?php

class HomeController extends Controller
{
    public function __construct()
    {
        Auth::exigirLogin();
    }

    public function index(): void
    {
        $data = [
            'title' => 'Início | MentoriaGestor'
        ];

        $this->view('home/index', $data);
    }
}
