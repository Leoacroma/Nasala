@extends('template')
@section('content')
    <div class="container add-news-bg">
        <div class="col-12">
            <h3 class="font-dangrek">បង្កើត បណ្ណាល័យ</h3>
            <form method="POST" action="{{ route('admin.library.store') }}" enctype="multipart/form-data">
              @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label font-Hanuman-bold">ចំណងជើងជាភាសាខ្មែរ</label>
                  <input type="text" name="title_kh" value="{{ $lib->title_kh }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">ចំណងជើងជាអង់គ្លេស</label>
                  <input type="text" name="title_eng" value="{{ $lib->title_eng }}" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">ប្រភេទបណ្ណាល័យ : </label>
                    <select name="cate_id" id="">
                      @foreach ($categorylibrary as $item)
                          <option value="{{ $item -> id }}">{{ $item -> title_lib_cate_kh }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">FILE</label>
                    <input type="file" name="file" class="form-control" id="exampleInputPassword1" required> 
                  </div>
                <button type="submit" class="btn btn-primary font-Hanuman-bold text-white">រួចរាល់</button>
                <a href="{{ route('admin.library.index') }}" class="btn btn-danger font-Hanuman-bold text-white">ត្រលប់ក្រោយ</a>
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