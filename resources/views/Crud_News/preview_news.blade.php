@extends('template')
@section('content')
    <div class="container view-bg-width">
        <div class="col-12">
            <h3 class="font-dangrek font-title ">{!! $news->title_kh !!}</h3>
            <span class="badge bg-info text-dark font-Hanuman-bold">{!! $news->category->title_cate_kh ?? 'None'!!}</span>
            <span>{!! $news->showDate() !!}</span>
            <img src="{{ asset('uploads/image/'.$news->image ) }}" alt="" width="800px">
            <div>
                <p>
                    {!! $news->dsc_kh !!}
                </p>
            </div>
            <a href="{{ route('admin.news.index') }}" class="btn btn-danger font-Hanuman-bold text-white">ត្រលប់ក្រោយ</a>
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