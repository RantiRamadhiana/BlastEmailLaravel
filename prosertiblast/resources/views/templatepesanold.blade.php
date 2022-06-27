@extends('master')

@section('konten')
    <div class="pagetitle">
      <h1>Template Message Activity</h1>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <!-- General Form Elements -->
              <form action="{{route('savetemplate')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
              @csrf
              <br>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Tema</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="subjek" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Message Template</label>
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
                          description.value = quill.getText();
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
                    <button type="submit" class="btn btn-primary" name="action" value="savetemplatebtn">Save Template</button>
                  </div>
                </div>
              </form><!-- End General Form Elements -->
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List Message Template</h5>
              <br>
              <a href="../index.php/deletealltemplate"><button type="button" class="btn btn-primary mr-5" onclick="return confirm('Are you sure delete data?')">
                  delete all template
              </button></a>
              <br><br>
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID template</th>
                    <th scope="col">Kode template</th>
                    <th scope="col">Message Template</th>
                    <th scope="col">Review</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $no=0;
                  @endphp
                  @forelse ($templatemsg as $po)
                  <tr>
                    <th scope="row">{{++$no}}</th>
                    <td>{{$po->idtemplate}}</td>
                    <td>{{$po->kodetemplate}}</td>
                    <td>{{$po->templatemsg}}</td>
                    <td>  
                      <a href="../index.php/deletetemplate/{{ $po->idtemplate }}" onclick="return confirm('Are you sure delete template message?')"><button type="button" class="btn btn-info"><i class="bi bi-trash"></i></button></a>
                    </td>
                  </tr>
                  @empty
                  <td colspan="4" class="table datatable">Tidak Ada Data</td>
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