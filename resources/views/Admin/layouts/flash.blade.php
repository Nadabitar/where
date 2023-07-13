@if (Session('success'))
<div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{Session('success')}}
</div>
@endif
@if(Session('errors'))

<div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul>
        @foreach ($errors->all() as $item)
            <li>{{$item}}</li>
        @endforeach
    </ul>
 
  </div>
@endif