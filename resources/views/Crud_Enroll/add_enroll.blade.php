@extends('template')
@section('content')
    <div class="container add-news-bg">
        <div class="col-12">
            <h3 class="font-dangrek">វគ្គសិក្សាថ្មី</h3>
            <form method="POST" action="{{ route('admin.enroll.store') }}">
              @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label font-Hanuman-bold">ចំណងជើងជាភាសាខ្មែរ</label>
                  <input type="text" name="title_enroll_kh" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">ចំណងជើងជាអង់គ្លេស</label>
                  <input type="text" name="title_enroll_eng" class="form-control" id="exampleInputPassword1" required>
                </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">អត្ថបទជាភាសាខ្មែរ</label>
                    <textarea class="form-control" id="summernote" name="dsc_en_kh"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold" >អត្ថបទជាអង់គ្លេស</label>
                    <textarea class="form-control" id="summernote2" name="dsc_en_eng"></textarea>
                  </div>
                <button type="submit" class="btn btn-primary font-Hanuman-bold text-white">រួចរាល់</button>
                <a href="{{ route('admin.enroll.index') }}" class="btn btn-danger font-Hanuman-bold text-white">ត្រលប់ក្រោយ</a>
            </form>
        </div>
    </div>
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ $message }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @include('rich-text.rich-text')
@endsection