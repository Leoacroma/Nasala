@extends('template')
@section('content')
@include('rich-text.rich-text')
    <div class="container edit-news-bg">
        <div class="col-12">
            <h3 class="font-dangrek">កែប្រែព័ត៌មាន</h3>
            <form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
              @method("PUT")
              @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label font-Hanuman-bold">ចំណងជើងជាភាសាខ្មែរ</label>
                  <input type="text" name="title_kh" value="{{ $news -> title_kh }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label font-Hanuman-bold" >ចំណងជើងជាអង់គ្លេស</label>
                  <input type="text" name="title_eng" value="{{ $news -> title_eng }}" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">ប្រភេទព័ត៌មាន​ : </label>
                    <select name="categories_id" id="">
                      @foreach ($cate as $item)
                          <option value="{{ $item -> id }}">{{ $item -> title_cate_kh }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold" >ចំណងជើងជាភាសាខ្មែរ</label>
                    <textarea class="form-control" id="summernote" name="dsc_kh"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold" >ចំណងជើងជាអង់គ្លេស</label>
                    <textarea class="form-control" id="summernote2" name="dsc_eng"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold" >ចំណងជើងជាអង់គ្លេស</label>
                    <input type="text" name="dsc_eng" value="{{ $news -> dsc }}" class="form-control" id="exampleInputPassword1" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">រូបភាព</label>
                    <img src="/uploads/image/{{$news -> image }}" alt="" width="150px" style="margin: 10px">
                    <input type="file" name="image" class="form-control" required>
                  </div>
                <button type="submit" class="btn btn-primary font-Hanuman-bold text-white">រួចរាល់</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-danger font-Hanuman-bold text-white" >ត្រលប់ក្រោយ</a>
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