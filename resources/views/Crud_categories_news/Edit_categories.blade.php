@extends('template')
@section('content')
<div class="container add-category-news-bg" >
    <div class="col-12">
        <h3 class="font-dangrek">កែប្រែប្រភេទព័ត៌មានថ្មី</h3>
        <form method="POST" action="{{ route ('admin.tplan.update', $categoryNews->id) }}">
          @method("PATCH")
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label font-Hanuman-bold">ចំណងជើងជាភាសាខ្មែរ</label>
              <input type="text" name="title_kh" value="{{ $categoryNews->title_kh }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label font-Hanuman-bold">ចំណងជើងជាអង់គ្លេស</label>
              <input type="text" name="title_eng" value="{{ $categoryNews->title_eng }}" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary font-Hanuman-bold text-white" >រួចរាល់</button>
            <a href="{{ route('admin.category.index') }}" class="btn btn-danger font-Hanuman-bold text-white">ត្រលប់ក្រោយ</a>
        </form>
    </div>
</div>
@endsection