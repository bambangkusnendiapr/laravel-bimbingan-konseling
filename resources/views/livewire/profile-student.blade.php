@section('title', 'Profile')
<div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Profile Siswa</h1>
          </div>
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Profile Siswa</li>
          </ol>
          </div>
      </div>
      </div><!-- /.container-fluid -->
  </section>
  
  <!-- Main content -->
  <section class="content">
      
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>300</h3>

                <p>Poin Awal</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $bimbingan->count() }}</h3>

                <p>Jumlah Bimbingan</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-cog"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ 300 - $student->poin }}</h3>

                <p>Pengurangan Poin</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-minus"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $student->poin }}</h3>

                <p>Sisa Poin</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Data Diri</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Ganti Pasword</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <form wire:submit.prevent="updateProfile" class="form-horizontal" wire:ignore.self>
                      <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input wire:model.defer="form.nama" required type="text" class="form-control @error('password') is-invalid @enderror" id="nama">
                          @error('nama')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input wire:model.defer="form.email" type="email" class="form-control @error('email') is-invalid @enderror" id="email">
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="jk" class="col-sm-2 col-form-label">L/P</label>
                        <div class="col-sm-10">
                          <select wire:model.defer="form.jk" id="jk" class="form-control @error('jk') is-invalid @enderror">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
                          @error('jk')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                          <textarea wire:model.defer="form.alamat" class="form-control @error('alamat') is-invalid @enderror"></textarea>
                          @error('alamat')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                          <textarea wire:model.defer="form.keterangan" class="form-control @error('keterangan') is-invalid @enderror"></textarea>
                          @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <form wire:submit.prevent="updatePassword" class="form-horizontal" wire:ignore.self>
                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input wire:model.defer="state.password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password" placeholder="Password">
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password-confirm" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                          <input wire:model.defer="state.password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Simpan Password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Bimbingan</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                        <select wire:model="paginate" class="form-control form-control-sm">
                          <option value="10">10 data per halaman</option>
                          <option value="15">15 data per halaman</option>
                          <option value="20">20 data per halaman</option>
                          <option value="30">30 data per halaman</option>
                          <option value="50">50 data per halaman</option>
                        </select>
                      </div>
                  </div>
                </div>

                <div class="table-responsive-sm">
                  <table class="table table-sm table-striped mt-1">
                      <thead>
                          <tr class="text-center">
                              <th>#</th>
                              <th>Tanggal</th>
                              <th>Pelanggaran</th>
                              <th>Pengurangan Poin</th>
                              <th>Guru</th>
                              <th>Keterangan</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if($bimbingan->isEmpty())
                              <tr>
                                      <td colspan="6" class="text-center font-italic text-danger"><h5>-- Data Tidak Ditemukan --</h5></td>
                              </tr>
                          @else
                              @foreach($bimbingan as $key => $data)
                                  <tr>
                                      <td class="text-center">{{ $bimbingan->firstItem() + $key }}</td>
                                      <td class="text-center">{{ $data->tanggal->format('d F Y') }}</td>
                                      <td class="text-center">{{ $data->pelanggaran->nama }}</td>
                                      <td class="text-center">{{ $data->pelanggaran->poin }}</td>
                                      <td class="text-center">{{ $data->teacher->nama }}</td>
                                      <td class="text-center">{{ $data->keterangan }}</td>
                                  </tr>
                              @endforeach
                          @endif
                      </tbody>
                  </table>
                </div>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $bimbingan->links() }}
                    </ul>
                </nav>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
  </section>
  <!-- /.content -->

  @push('style')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  @endpush


  @push('script')
  <!-- SweetAlert2 -->
  <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- Sweet alert real rashid -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script>
    $(function () {
      window.addEventListener('show-form-delete', event => {
          $('#modal-delete').modal('show');
      });

      window.addEventListener('hide-form-delete', event => {
          $('#modal-delete').modal('hide');

          Swal.fire({
              "title":"Sukses!",
              "text":"Data Berhasil Dihapus",
              "position":"middle-center",
              "timer":2000,
              "width":"32rem",
              "heightAuto":true,
              "padding":"1.25rem",
              "showConfirmButton":false,
              "showCloseButton":false,
              "icon":"success"
          });

      });

      window.addEventListener('show-form-edit', event => {
          $('#modal-edit').modal('show');
          // alert('edit');
      });

      window.addEventListener('hide-form-edit', event => {

          Swal.fire({
              "title":"Sukses!",
              "text":"Data Berhasil Diedit",
              "position":"middle-center",
              "timer":2000,
              "width":"32rem",
              "heightAuto":true,
              "padding":"1.25rem",
              "showConfirmButton":false,
              "showCloseButton":false,
              "icon":"success"
          });

      });

      window.addEventListener('show-form', event => {
          $('#form').modal('show');
          // alert('guru');
      });

      window.addEventListener('hide-form', event => {
        Swal.fire({
            "title":"Sukses!",
            "text":"Password Berhasil Diganti",
            "position":"middle-center",
            "timer":2000,
            "width":"32rem",
            "heightAuto":true,
            "padding":"1.25rem",
            "showConfirmButton":false,
            "showCloseButton":false,
            "icon":"success"
        });

    });

    });
  </script>
  @endpush


</div>