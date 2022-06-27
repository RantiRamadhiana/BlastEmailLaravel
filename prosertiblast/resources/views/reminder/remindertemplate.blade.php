@extends('master')

@section('konten')
    <div class="pagetitle">
      <h1>Email Reminder Activity</h1>
      <h5>Template Message</h5>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <!-- General Form Elements -->
              <form action="{{route('sendmail')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
              @csrf
              <br>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Subject</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="subjek" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Recipients</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="penerimapesan">
                      <option value="option_select" disabled selected>Select tema ProA</option>
                      @foreach($templatepsan as $dt)
                          <option value="{{ $dt->tema }}" {{$dt->tema == $dt->tema  ? 'selected' : ''}}>{{ $dt->tema }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date Scheduled</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="dateschedule" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputTime" class="col-sm-2 col-form-label">Time Scheduled</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control" name="timeschedule" required>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Text Message</label>
                  <div class="col-sm-10">
                  <input name="pesan" type="hidden">
                  <div id="editor-container"></div>
                  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
                  <script>
                      var quill = new Quill('#editor-container', {
                                      modules: {
                                          toolbar: [
                                              [{ header: [1, 2, 3, 4, 5, 6,  false] }],
                                              [{ 'font': [] }],
                                              [{ 'align': [] }],
                                              ['bold', 'italic', 'underline','strike'],
                                               ['image', 'code-block'],
                                               ['link'],
                                               [{ 'script': 'sub'}, { 'script': 'super' }],
                                               [{ list: 'ordered' }, { list: 'bullet' }],
                                               [{ 'indent': '-1'}, { 'indent': '+1' }],
                                               [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                                               ['clean']
                                          ]
                                      },
                                      theme: 'snow',
                                      placeholder:'isikan pesan'
                                      });

                      function getQuillHtml() { return quill.root.innerHTML; }

                      var form = document.querySelector('form');
                      form.onsubmit = function() {
                          let html = getQuillHtml();
                          var description = document.querySelector('input[name=pesan]');
                          description.value = html;
                          return true;
                      };

                      <?php
                      if (isset($description)) {
                      ?>
                      quill.setContents(<?=$description?>);
                      <?php
                      }
                      ?>
                  </script>
                  </div>
                </div><br><br><br><br>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="action" value="savereminderbtn">Save Reminder</button>
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
              <br>
              <a href="../index.php/deleteallreminder"><button type="button" class="btn btn-primary mr-5" onclick="return confirm('Are you sure delete data?')">
                  delete all data reminder
              </button></a>
              <br><br>
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID reminder</th>
                    <th scope="col">Recipients</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Schedule Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Review</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $no=0;
                  @endphp
                  @forelse ($datareminder as $po)
                  <tr>
                    <th scope="row">{{++$no}}</th>
                    <td>{{$po->idreminder}}</td>
                    <td>{{$po->kelaspelatihan}}</td>
                    <td>{{$po->subject}}</td>
                    <td>{{$po->datetimeschedule}}</td>
                    <td>{{$po->status}}</td>
                     <td>  
                     <a href="">
                     <button type="button" class="btn btn-info">
                      <i class="bi bi-info-circle"></i>
                      </button> </a>
                      &nbsp
                      <a href="../index.php/deletereminder/{{ $po->idreminder }}" onclick="return confirm('Are you sure delete data reminder?')"><button type="button" class="btn btn-info"><i class="bi bi-trash"></i></button></a>
                    </td>
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

       <div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post" action="../index.php/peserta" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Reminder Email</h5>
                      </div>
                      <div class="modal-body">

                        {{ csrf_field() }}

                        <table class="table datatable">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                          $no=0;
                          @endphp
                          @forelse ($emailreminder as $po)
                          <tr>
                            <th scope="row">{{++$no}}</th>
                            <td>{{$po->emailpeserta}}</td>
                          </tr>
                          @empty
                          <td colspan="5" class="table datatable">Tidak Ada Data</td>
                          @endforelse
                        </tbody>
                      </table>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
      </div>
    </section>
@endsection