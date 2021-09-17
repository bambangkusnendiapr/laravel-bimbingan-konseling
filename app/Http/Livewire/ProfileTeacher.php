<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\Bimbingan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class ProfileTeacher extends Component
{
    public $state = [];
    public $form = [];

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
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $this->form['nama'] = $teacher->nama;
        $this->form['email'] = $teacher->user->email;
        $this->form['jk'] = $teacher->jk;
        $this->form['alamat'] = $teacher->alamat;
        $this->form['keterangan'] = $teacher->keterangan;

        return view('livewire.profile-teacher', [
            'bimbingan' => Bimbingan::where('teacher_id', $teacher->id)->where('nama', 'like', '%'.$this->search.'%')->paginate($this->paginate)
        ]);
    }

    public function updateProfile()
    {
        $user = User::find(Auth::user()->id);

        Validator::make($this->form, [
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ])->validate();

        $user->name = $this->form['nama'];
        $user->email = $this->form['email'];
        $user->save();

        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $teacher->nama = $this->form['nama'];
        $teacher->jk = $this->form['jk'];
        $teacher->alamat = $this->form['alamat'];
        $teacher->keterangan = $this->form['keterangan'];
        $teacher->save();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    public function updatePassword()
    {
        Validator::make($this->state, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($this->state['password']);
        $user->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form');
    }

    private function resetInput()
    {
        $this->state = null;
    }
}
