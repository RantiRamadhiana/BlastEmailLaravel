@extends('master')
@section('konten')
    <div class="pagetitle">
      <h1>Template Voucher Blast Email</h1>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <!-- Import Excel -->
        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form method="post" action="../index.php/templatevoucher" enctype="multipart/form-data">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Import Template Pesan</h5>
                </div>
                <div class="modal-body">
                  {{ csrf_field() }}
                  <label>Pilih file excel</label>
                  <div class="form-group">
                    <input type="file" name="file" required="required">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Import</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
            <br>
              <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                  Import Template Voucher
              </button>
              &nbsp 
              <a href="../index.php/download/vouchertemplate.xlsx">
              <button type="button" class="btn btn-primary mr-5">
                  Unduh template voucher
              </button>
              </a>
                 &nbsp &nbsp &nbsp <a href="../index.php/deleteallvoucher"><button type="button" class="btn btn-primary mr-5" onclick="return confirm('Are you sure delete voucher template?')">
                  delete all data
              </button></a>
               <br><br><br>
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">No.Registrasi</th>
                    <th scope="col">Nama Peserta</th>
                    <th scope="col">Email</th>
                    <th scope="col">Voucher Code</th>
                    <th scope="col">Tema</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @php
                $no=0;
                @endphp
                @forelse ($voucher as $vo)
                  <tr>
                    <th scope="row">{{++$no}}</th>
                    <td>{{$vo->idtemplate}}</td>
                    <td>{{$vo->nama}}</td>
                    <td>{{$vo->email}}</td>
                    <td>{{$vo->voucher_code}}</td>
                    <td>{{$vo->tema}}</td>
                    <td><a href="../index.php/deletevoucher/{{ $vo->idtemplate }}" onclick="return confirm('Are you sure delete template?')"><button type="button" class="btn btn-info"><i class="bi bi-trash"></i></button></a></td>
                  </tr>
                  @empty
                  <td colspan="6" class="table datatable">Tidak Ada Data</td>
                  @endforelse
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
