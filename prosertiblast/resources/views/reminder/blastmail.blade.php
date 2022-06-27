@extends('master')

@section('konten')
    <div class="pagetitle">
      <h1>Email Blast Activity</h1>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <!-- General Form Elements -->
              <form action="{{route('sendmail')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
              @csrf
              <br>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Subject</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="subjek">
                  </div>
                </div>
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
                    <button type="submit" class="btn btn-primary" name="action" value="sendbtn">Quick Send</button>
                  </div>
                </div>
              </form><!-- End General Form Elements -->
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection