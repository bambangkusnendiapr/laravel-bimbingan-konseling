<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Bimbingan;
use App\Models\Pelanggaran;

class DataBimbingan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $foo;
    public $search = '';
    public $page = 1;

    public $state = [];
    public $idHapus = null;
    public $idEdit = null;

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
        return view('livewire.data-bimbingan', [
            'bimbingan' => Bimbingan::where('nama', 'like', '%'.$this->search.'%')->paginate($this->paginate),
            'students' => Student::all(),
            'teachers' => Teacher::all(),
            'pelanggarans' => Pelanggaran::all(),
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createBimbingan()
    {
        Validator::make($this->state, [
            'tanggal' => 'required',
            'student' => 'required',
            'pelanggaran' => 'required',
            'teacher' => 'required',
            'keterangan' => 'required',
        ])->validate();

        $student = Student::find($this->state['student']);
        $pelanggaran = Pelanggaran::find($this->state['pelanggaran']);

        $student->poin -= $pelanggaran->poin;
        $student->save();

        $bimbingan = new Bimbingan;
        $bimbingan->tanggal = $this->state['tanggal'];
        $bimbingan->nama = $student->nama;
        $bimbingan->pelanggaran_id = $this->state['pelanggaran'];
        $bimbingan->student_id = $this->state['student'];
        $bimbingan->teacher_id = $this->state['teacher'];
        $bimbingan->keterangan = $this->state['keterangan'];
        $bimbingan->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form');
    }

    public function delete($id)
    {
        $this->idHapus = $id;

        $this->dispatchBrowserEvent('show-form-delete');
    }

    public function deleteBimbingan()
    {
        $bimbingan = Bimbingan::find($this->idHapus); //ambil satu data bimbingan
        $student = Student::find($bimbingan->student_id); //ambil satu data student dari id di bimbingan
        $pelanggaran = Pelanggaran::find($bimbingan->pelanggaran_id); // ambil satu data pelanggaran dari id di bimbingan

        $student->poin += $pelanggaran->poin; // penambahan poin ke siswa karena menghapus bimbingan
        $student->save();

        Bimbingan::destroy($this->idHapus);

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $bimbingan = Bimbingan::find($this->idEdit);
        $this->state['tanggal']  = $bimbingan->tanggal->format('Y-m-d');
        $this->state['student'] = $bimbingan->student_id;
        $this->state['pelanggaran'] = $bimbingan->pelanggaran_id;
        $this->state['teacher'] = $bimbingan->teacher_id;
        $this->state['keterangan'] = $bimbingan->keterangan;
        // $this->state = $pelanggaran->toArray();

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateBimbingan()
    {
        Validator::make($this->state, [
            'tanggal' => 'required',
            'student' => 'required',
            'pelanggaran' => 'required',
            'teacher' => 'required',
            'keterangan' => 'required',
        ])->validate();

        $bimbingan = Bimbingan::find($this->idEdit);
        $student = Student::find($bimbingan->student_id);
        $pelanggaran = Pelanggaran::find($bimbingan->pelanggaran_id);

        if($this->state['student'] == $student->id && $this->state['pelanggaran'] == $pelanggaran->id) {
            
            $bimbingan->pelanggaran_id = $this->state['pelanggaran'];
            $bimbingan->student_id = $this->state['student'];
            
        } else if($this->state['student'] == $student->id && $this->state['pelanggaran'] != $pelanggaran->id) {

            $student->poin += $pelanggaran->poin; //tambahkan poin pelanggaran sebelumnya
            $pelanggaran_pilih = Pelanggaran::find($this->state['pelanggaran']); // ambil data pelanggaran yang dipilih
            $student->poin -= $pelanggaran_pilih->poin; //mengurangi poin pelanggaran yang dipilih

            $student->save();

            $bimbingan->pelanggaran_id = $this->state['pelanggaran']; //input ke tabel bimbingan

        } else if($this->state['student'] != $student->id && $this->state['pelanggaran'] == $pelanggaran->id) {

            $student->poin += $pelanggaran->poin; //tambahkan poin pelanggaran sebelumnya
            $student->save();

            $student_pilih = Student::find($this->state['student']);
            $student_pilih->poin -= $pelanggaran->poin;
            $student_pilih->save();

            $bimbingan->student_id = $this->state['student'];
            $bimbingan->nama = $student_pilih->nama;

        } else {
            $student->poin += $pelanggaran->poin; //tambahkan poin pelanggaran sebelumnya
            $student->save();

            $student_pilih = Student::find($this->state['student']);
            $pelanggaran_pilih = Pelanggaran::find($this->state['pelanggaran']);

            $student_pilih->poin -= $pelanggaran_pilih->poin;
            $student_pilih->save();

            $bimbingan->nama = $student_pilih->nama;
            $bimbingan->pelanggaran_id = $this->state['pelanggaran'];
            $bimbingan->student_id = $this->state['student'];
        }

        $bimbingan->tanggal = $this->state['tanggal'];
        $bimbingan->teacher_id = $this->state['teacher'];
        $bimbingan->keterangan = $this->state['keterangan'];
        $bimbingan->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    public function resetField()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->state = null;
    }
}
