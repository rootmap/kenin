@extends('front-end.layout.master_blank')
@section('content')
    <section id="explore" class="section">
        <div class="small-width-container" style="padding-top: 39px;">
          <div class="explore-the-shelter">
            <h2>{{$page[0]->page_name_menu_name}}</h2>
            <div class="shelter-benefits">
                @foreach ($page as $pages)
                <p style="text-align: justify;">
                    {!!$pages->page_detail!!}
                </p>
                @endforeach
                
            </div>
          </div>
        </div>
    </section>
@endsection