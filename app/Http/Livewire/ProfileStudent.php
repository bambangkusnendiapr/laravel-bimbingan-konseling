<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\Bimbingan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class ProfileStudent extends Component
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
        $student = Student::where('user_id', Auth::user()->id)->first();

        $this->form['nama'] = $student->nama;
        $this->form['email'] = $student->user->email;
        $this->form['jk'] = $student->jk;
        $this->form['alamat'] = $student->alamat;
        $this->form['keterangan'] = $student->keterangan;

        return view('livewire.profile-student', [
            'bimbingan' => Bimbingan::where('student_id', $student->id)->where('nama', 'like', '%'.$this->search.'%')->paginate($this->paginate),
            'student' => $student
        ]);
    }
}
