@extends('template')
@section('content')
@include('rich-text.rich-text')
<div class="container" style="margin-top: 20px; background-color: white; height: 950px; padding: 50px; margin-bottom: 50px;">
        <div class="col-12">
          <h3 class="font-dangrek">ឯកសារបណ្តុះបណ្តាល</h3>
            <form method="POST" action="{{ route('admin.news.update', $tdocs->id) }}">
              @method('PUT')
              @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label font-Hanuman-bold">ចំណងជើងជាភាសាខ្មែរ</label>
                  <input type="text" name="title_kh" value="{{ $tdocs->title_kh }}" class="form-control" id="exampleInputEmail1" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">ចំណងជើងជាអង់គ្លេស</label>
                  <input type="text" name="title_eng" value="{{ $tdocs->title_eng }}" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">អត្ថបទជាភាសាខ្មែរ</label>
                    <textarea class="form-control" id="summernote" name="dsc_kh"></textarea>
                  </div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">អត្ថបទជាអង់គ្លេស</label>
                    <textarea class="form-control" id="summernote2" name="dsc_eng"></textarea>
                  </div>
                <button type="submit" class="btn btn-primary font-Hanuman-bold text-white" >រួចរាល់</button>
                <a href="{{ route('admin.tdocs.index') }}" class="btn btn-danger font-Hanuman-bold text-white">ត្រលប់ក្រោយ</a>
            </form>
        </div>
    </div>
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ $message }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
@endsection