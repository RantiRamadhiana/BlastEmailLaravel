@extends('master')

@section('konten')
    <div class="pagetitle">
      <h1>Whatsapp Reminder Activity</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
             
              <!-- General Form Elements -->
             <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
              @csrf
               <br>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Recipients</label>
                   <div class="col-sm-10">
                     <select class="form-select" aria-label="Default select example" name="penerimapesan">
                      <option value="option_select" disabled selected>Select ProA Class</option>
                      @foreach($pesertaproa as $dt)
                          <option value="{{ $dt->kelaspelatihan }}" {{$dt->kelaspelatihan == $dt->kelaspelatihan  ? 'selected' : ''}}>{{ $dt->kelaspelatihan}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Text Message</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="textmsg" id="textmsg" style="height: 100px;"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date Scheduled</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputTime" class="col-sm-2 col-form-label">Time Scheduled</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control">
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                  <a href="../index.php/sendwa">
                    <button type="submit" class="btn btn-primary">Send WA</button>
                    </a>
                  </div>
                </div>
              </form><!-- End General Form Elements -->
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Review</h5>

              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Recipients</th>
                    <th scope="col">Message</th>
                    <th scope="col">Schedule Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Log Message</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Ciscoclass</td>
                    <td>Reminder Live session untuk tanggal berikut silahkan klik link zoom yang tertera5</td>
                    <td>2022-06-25</td>
                    <td>Scheduled</td>
                     <td><button type="button" class="btn btn-info"><i class="bi bi-info-circle"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Redhat CSE class</td>
                    <td>Reminder Live session untuk tanggal berikut silahkan klik link zoom yang tertera</td>
                    <td>2022-05-25</td>
                    <td>finished</td>
                     <td><button type="button" class="btn btn-info"><i class="bi bi-info-circle"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection