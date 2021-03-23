@extends('components.template.manager')

@include('components.common.head')
@include('components.common.footer')
@include('components.common.js')

@include('components.header.header')

@section('content')

<div>

</div>


<div class = containar>
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">id</th>
        <th scope="col">名前</th>
        <th scope="col">個数</th>
        <th scope="col">金額</th>
        <th scope="col">登録日時</th>
      </tr>
    </thead>
    @foreach ($stock as $stocks)
    <tbody>
        <tr scope="row">
        <td>{{ $stocks->id }}</td>
        <td>{{ $stocks->name }}</td>
        <td>{{ $stocks->num }}個</td>
        <td>{{ $stocks->price }}円</td>
        <td>{{ $stocks->created_at }}</td>
        </tr>
    </tbody>
  @endforeach
  </table>
</div>


   <!-- ここにかく -->
@endsection