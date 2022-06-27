@extends('master')

@section('konten')
    <div class="pagetitle">
      <h1>Log Email Blast Activity</h1>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Log Status</h5>
              <div class="table-responsive">
                <p>{{$logerror}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection