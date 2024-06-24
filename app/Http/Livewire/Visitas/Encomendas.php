<?php

namespace App\Http\Livewire\Visitas;

use Livewire\Component;
use App\Interfaces\ClientesInterface;
use Livewire\WithPagination;
use App\Models\Comentarios;

class Encomendas extends Component
{
    use WithPagination;

    private ?object $clientesRepository = NULL;
    protected ?object $clientes = NULL;
    public string $idCliente = "";

    private ?object $encomendasDetail = NULL;
    public ?string $encomendaID = "";
    public ?string $encomendaName = "";

    public int $perPage = 10;
    public int $pageChosen = 1;
    public int $numberMaxPages;
    public int $totalRecords = 0;

    public ?string $comentarioEncomenda = "";

    private ?object $detailsEncomenda = NULL;
    public ?object $comentario = NULL;

    public function boot(ClientesInterface $clientesRepository)
    {
        $this->clientesRepository = $clientesRepository;
    }

    private function initProperties(): void
    {
        if (isset($this->perPage)) {
            session()->put('perPage', $this->perPage);
        } elseif (session('perPage')) {
            $this->perPage = session('perPage');
        } else {
            $this->perPage = 10;
        }

    }

    public function mount($cliente)
    {
        $this->initProperties();
        $this->idCliente = $cliente;

        //$this->idCliente = "AJ19073058355,4450000-1";

        $this->restartDetails();

    }


    public function gotoPage($page)
    {
        $this->pageChosen = $page;
        $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
    }


    public function previousPage()
    {
        if ($this->pageChosen > 1) {
            $this->pageChosen--;
            $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }
        else if($this->pageChosen == 1){
            $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }

    }

    public function nextPage()
    {
        if ($this->pageChosen < $this->numberMaxPages) {
            $this->pageChosen++;

            $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        }
    }

    public function getPageRange()
    {
        $currentPage = $this->pageChosen;
        $lastPage = $this->numberMaxPages;

        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $currentPage + 2);


        return range($start, $end);
    }

    public function isCurrentPage($page)
    {
        return $page == $this->pageChosen;
    }

    public function updatedperPage(): void
    {
        $this->resetPage();
        session()->put('perPage', $this->perPage);


        $this->restartDetails();

    }

    public function restartDetails()
    {
        $this->detailsEncomenda = $this->clientesRepository->getEncomendasCliente($this->perPage,$this->pageChosen,$this->idCliente);
        $getInfoClientes = $this->clientesRepository->getNumberOfPagesEncomendasCliente($this->perPage,$this->idCliente);

        $this->numberMaxPages = $getInfoClientes["nr_paginas"];
        $this->totalRecords = $getInfoClientes["nr_registos"];

    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }

    public function comentarioModal($id,$name)
    {
        $this->restartDetails();

        $this->encomendaID = $id;
        $this->encomendaName = $name;

        $this->comentarioEncomenda = "";

        $this->dispatchBrowserEvent('openComentarioModal');

    }

    public function sendComentario($idEncomenda)
    {
        if (empty($this->comentarioEncomenda)) {
            $message = "O campo de comentário está vazio!";
            $status = "error";
        } else {
            $response = $this->clientesRepository->sendComentarios($idEncomenda, $this->comentarioEncomenda, "encomendas");

            $responseArray = $response->getData(true);

            if ($responseArray["success"] == true) {
                $message = "Comentário adicionado com sucesso!";
                $status = "success";
            } else {
                $message = "Não foi possível adicionar o comentário!";
                $status = "error";
            }
        }

        // Reinicia os detalhes da encomenda
        $this->restartDetails();

        // Exibe a mensagem usando o evento do navegador
        $this->dispatchBrowserEvent('checkToaster', ["message" => $message, "status" => $status]);
    }



    public function verComentario($idEncomenda)
    {
        // Carrega o comentário correspondente
        $comentario = Comentarios::with('user')->where('stamp', $idEncomenda)->where('tipo', 'encomendas')->get();

        // Define o comentário para exibir no modal
        $this->comentario = $comentario;

        $this->restartDetails();
        // Dispara o evento para abrir o modal
        $this->dispatchBrowserEvent('abrirModalVerComentario');
    }


    public function detalheEncomendaModal($id)
    {

        $this->encomendaID = $id;

        $this->restartDetails();

        $this->dispatchBrowserEvent('openDetalheEncomendaModal');
    }



    public function render()
    {
        return view('livewire.visitas.encomendas',["detalhesEncomenda" => $this->detailsEncomenda]);
    }
}
