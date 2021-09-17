<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\User;

class DataStudents extends Component
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
        return view('livewire.data-students', [
            'students' => Student::where('nama', 'like', '%'.$this->search.'%')->paginate($this->paginate)
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createStudent()
    {
        Validator::make($this->state, [
            'nama' => 'required',
            'jk' => 'required',
            'poin' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        // dd($this->state);
        $user = User::create([
            'name' => $this->state['nama'],
            'email' => $this->state['email'],
            'password' => bcrypt($this->state['password']),
        ]);

        $user->attachRole('siswa');

        $student = new Student;
        $student->user_id = $user->id;
        $student->nama = $this->state['nama'];
        $student->jk = $this->state['jk'];
        $student->poin = $this->state['poin'];
        $student->alamat = $this->state['alamat'];
        $student->keterangan = $this->state['keterangan'];
        $student->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form');
    }

    public function delete($id)
    {
        $this->idHapus = $id;

        $this->dispatchBrowserEvent('show-form-delete');
    }

    public function deleteStudent()
    {
        $student = Student::find($this->idHapus);

        User::destroy($student->user_id);

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $student = Student::find($this->idEdit);
        $this->state['nama'] = $student->nama;
        $this->state['jk'] = $student->jk;
        $this->state['poin'] = $student->poin;
        $this->state['alamat'] = $student->alamat;
        $this->state['keterangan'] = $student->keterangan;
        $this->state['email'] = $student->user->email;
        $this->state['password'] = null;
        // $this->state = $pelanggaran->toArray();

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateStudent()
    {
        $student = Student::find($this->idEdit);
        $user = User::find($student->user_id);

        if($this->state['password']) {
            Validator::make($this->state, [
                'nama' => 'required',
                'jk' => 'required',
                'poin' => 'required',
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ])->validate();

            $user->password = bcrypt($this->state['password']);
        }

        Validator::make($this->state, [
            'nama' => 'required',
            'jk' => 'required',
            'poin' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ])->validate();

        $user->name = $this->state['nama'];
        $user->email = $this->state['email'];
        $user->save();

        $student->nama = $this->state['nama'];
        $student->jk = $this->state['jk'];
        $student->poin = $this->state['poin'];
        $student->alamat = $this->state['alamat'];
        $student->keterangan = $this->state['keterangan'];
        $student->save();

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
