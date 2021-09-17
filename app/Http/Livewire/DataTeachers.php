<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\User;

class DataTeachers extends Component
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
        return view('livewire.data-teachers', [
            'teachers' => Teacher::where('nama', 'like', '%'.$this->search.'%')->paginate($this->paginate)
        ]);
    }

    public function addNew()
    {
        // dd('gru');
        $this->dispatchBrowserEvent('show-form');
    }

    public function createTeacher()
    {
        Validator::make($this->state, [
            'nama' => 'required',
            'jk' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        // dd($this->state);
        $user = User::create([
            'name' => $this->state['nama'],
            'email' => $this->state['email'],
            'password' => bcrypt($this->state['password']),
        ]);

        $user->attachRole('guru');

        $teacher = new Teacher;
        $teacher->user_id = $user->id;
        $teacher->nama = $this->state['nama'];
        $teacher->jk = $this->state['jk'];
        $teacher->alamat = $this->state['alamat'];
        $teacher->keterangan = $this->state['keterangan'];
        $teacher->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form');
    }

    public function delete($id)
    {
        // dd('heapus');
        $this->idHapus = $id;

        $this->dispatchBrowserEvent('show-form-delete');
    }

    public function deleteTeacher()
    {
        // dd('delet');
        $teacher = Teacher::find($this->idHapus);

        // dd($teacher->user_id);

        User::destroy($teacher->user_id);

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $teacher = Teacher::find($this->idEdit);
        $this->state['nama'] = $teacher->nama;
        $this->state['jk'] = $teacher->jk;
        $this->state['alamat'] = $teacher->alamat;
        $this->state['keterangan'] = $teacher->keterangan;
        $this->state['email'] = $teacher->user->email;
        $this->state['password'] = null;
        // $this->state = $pelanggaran->toArray();

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateTeacher()
    {
        // dd($this->state);
        $teacher = Teacher::find($this->idEdit);
        $user = User::find($teacher->user_id);

        if($this->state['password']) {
            Validator::make($this->state, [
                'nama' => 'required',
                'jk' => 'required',
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ])->validate();

            $user->password = bcrypt($this->state['password']);
        }

        Validator::make($this->state, [
            'nama' => 'required',
            'jk' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ])->validate();

        $user->name = $this->state['nama'];
        $user->email = $this->state['email'];
        $user->save();

        $teacher->nama = $this->state['nama'];
        $teacher->jk = $this->state['jk'];
        $teacher->alamat = $this->state['alamat'];
        $teacher->keterangan = $this->state['keterangan'];
        $teacher->save();

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
