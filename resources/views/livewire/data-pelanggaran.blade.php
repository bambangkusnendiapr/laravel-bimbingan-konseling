@section('title', 'Pelanggaran')
@section('data-bimbingan', 'menu-open')
@section('data_bimbingan', 'active')
@section('pelanggaran', 'active')
<div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Jenis Pelanggaran</h1>
          </div>
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Jenis Pelanggaran</li>
          </ol>
          </div>
      </div>
      </div><!-- /.container-fluid -->
  </section>
  
  <!-- Main content -->
  <section class="content">
      
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <button wire:click.prevent="addNew" type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</button>
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

                  <div class="col-md-4 offset-md-4">
                      <div class="form-group">
                          <div class="input-group input-group-sm">
                              <input wire:model="search" type="text" class="form-control form-control-sm" placeholder="Cari Nama">
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                              </div>
                          </div>
                          <!-- <input  type="text" class="form-control form-control-sm w-100" placeholder="Cari Nama"> -->
                      </div>
                  </div>
              </div>

                <div class="table-responsive-sm">
                  <table class="table table-sm table-striped mt-1">
                      <thead>
                          <tr class="text-center">
                              <th>#</th>
                              <th>Nama</th>
                              <th>Pengurangan Poin</th>
                              <th>Keterangana</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if($pelanggaran->isEmpty())
                              <tr>
                                      <td colspan="5" class="text-center font-italic text-danger"><h5>-- Data Tidak Ditemukan --</h5></td>
                              </tr>
                          @else
                              @foreach($pelanggaran as $key => $data)
                                  <tr>
                                      <td class="text-center">{{ $pelanggaran->firstItem() + $key }}</td>
                                      <td class="text-center">{{ $data->nama }}</td>
                                      <td class="text-center">{{ $data->poin }}</td>
                                      <td class="text-center">{{ $data->keterangan }}</td>
                                      <td class="text-right">
                                          <button wire:click.prevent="edit({{ $data->id }})" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                          <button wire:click.prevent="delete({{ $data->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                      </td>
                                  </tr>
                              @endforeach
                          @endif
                      </tbody>
                  </table>
                </div>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $pelanggaran->links() }}
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

  <!-- Modal Tambah Data -->
  <div class="modal fade" id="form" wire:ignore.self>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Form Tambah Data Jenis Pelanggaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="createPelanggaran">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama">Nama Jenis Pelanggaran</label>
              <input wire:model.defer="state.nama" required type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Jenis Pelanggaran" autofocus>
              @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="poin">Pengurangan Poin</label>
              <input wire:model.defer="state.poin" required type="number" class="form-control @error('poin') is-invalid @enderror" id="poin">
              @error('poin')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea wire:model.defer="state.keterangan" required id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan"></textarea>
              @error('keterangan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal Edit Data -->
  <div class="modal fade" id="modal-edit" wire:ignore.self>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h4 class="modal-title">Form Edit Data Jenis Pelanggaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent="updatePelanggaran">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama">Nama Jenis Pelanggaran</label>
              <input wire:model.defer="state.nama" required type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Jenis Pelanggaran" autofocus>
              @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="poin">Pengurangan Poin</label>
              <input wire:model.defer="state.poin" required type="number" class="form-control @error('poin') is-invalid @enderror" id="poin">
              @error('poin')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea wire:model.defer="state.keterangan" required id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan"></textarea>
              @error('keterangan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning">Edit</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal Delete Data -->
  <div class="modal fade" id="modal-delete" wire:ignore.self>
      <div class="modal-dialog">
          <div class="modal-content bg-danger">
          <div class="modal-header">
              <h4 class="modal-title">Hapus Data Pelanggaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
              <div class="modal-body">
                  <h5>Yakin ingin hapus data ?</h5>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                  <button wire:click.prevent="deletePelanggaran" type="button" class="btn btn-outline-light">Lanjut Hapus</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
  <!-- /.modal-dialog -->
  </div>

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
          $('#modal-edit').modal('hide');

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
      });

      window.addEventListener('hide-form', event => {
        $('#form').modal('hide');

        Swal.fire({
            "title":"Sukses!",
            "text":"Data Berhasil Ditambahkan",
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