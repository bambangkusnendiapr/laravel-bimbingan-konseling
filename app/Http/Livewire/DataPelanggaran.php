<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Models\Pelanggaran;
use Livewire\WithPagination;

class DataPelanggaran extends Component
{
    public $state = [];
    public $idHapus = null;
    public $idEdit = null;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $foo;
    public $search = '';
    public $page = 1;

    protected $queryString = [
        'foo',
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.data-pelanggaran', [
            'pelanggaran' => Pelanggaran::where('nama', 'like', '%'.$this->search.'%')->paginate($this->paginate)
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createPelanggaran()
    {
        Validator::make($this->state, [
            'nama' => 'required',
            'poin' => 'required',
        ])->validate();

        $pelanggaran = new Pelanggaran;
        $pelanggaran->nama = $this->state['nama'];
        $pelanggaran->poin = $this->state['poin'];
        $pelanggaran->keterangan = $this->state['keterangan'];
        $pelanggaran->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form');
    }

    private function resetInput()
    {
        $this->state = null;
    }

    public function delete($id)
    {
        // dd('heapus');
        $this->idHapus = $id;

        $this->dispatchBrowserEvent('show-form-delete');
    }

    public function deletePelanggaran()
    {
        $pelanggaran = Pelanggaran::find($this->idHapus);

        $pelanggaran->delete();

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $pelanggaran = Pelanggaran::find($this->idEdit);
        $this->state = $pelanggaran->toArray();

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updatePelanggaran()
    {
        Validator::make($this->state, [
            'nama' => 'required',
            'poin' => 'required',
        ])->validate();

        $pelanggaran = Pelanggaran::find($this->idEdit);
        $pelanggaran->nama = $this->state['nama'];
        $pelanggaran->poin = $this->state['poin'];
        $pelanggaran->keterangan = $this->state['keterangan'];
        $pelanggaran->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }
}
