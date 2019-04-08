@extends('layouts.app')

@section('content')

  <form method="POST" action="{{route('order.store')}}">
    @csrf

    <div class="row">
      <div class="col-md-10">
        <div class="form-group">
          <label for="phone">Телефон</label>
          <input required class="form-control" id="phone" name="phone" placeholder="Телефон">
          <small id="emailHelp" class="form-text text-muted">Система идентифицирует Вас по номеру телефона.</small>
        </div>
        <div class="form-group">
          <label for="name">Имя</label>
          <input required class="form-control" id="name" name="name" placeholder="Имя">
        </div>
        <div class="form-group">
          <label for="address">Адрес</label>
          <input required class="form-control" id="address" name="address" placeholder="Адрес">
        </div>
        <div class="form-group">
          <label for="rate">Тариф</label>
          <select class="form-control" id="rate" name="rate_id">
            @foreach($rates as $item)
              <option data-days="{{$item->days_numbers()}}" value="{{$item->id}}">{{$item->name}} - {{$item->price}}&#8381;</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="day">Первый день доставки</label>
          <select class="form-control" id="day" name="day_number">
            @foreach($days as $item)
              <option value="{{$item->id}}">{{$item->number}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="control-buttons">
          <button type="submit" class="btn btn-outline-primary"><i class="far fa-save"></i> Сохранить</button>
        </div>
      </div>
    </div>
  </form>

@endsection
