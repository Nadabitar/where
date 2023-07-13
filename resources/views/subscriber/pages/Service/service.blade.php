@extends('subscriber.app')

@section('content')
@include('subscriber.partial.navbar')

        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
          <div class="container">
              <div class="row g-2">
                  <div class="col-md-10">
                      <div class="row g-2">
                          <div class="col-md-4">
                              <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                          </div>
                          <div class="col-md-4">
                              <select class="form-select border-0 py-3">
                                  <option selected>Service Type</option>
                                  <option value="1">New Service</option>
                                  <option value="2">Old Service</option>
                                  <option value="3">Un-Active  Service</option>
                              </select>
                          </div>
                          <div class="col-md-4">
                              <select class="form-select border-0 py-3">
                                  <option selected>Coments</option>
                                  <option value="1">Location 1</option>
                                  <option value="2">Location 2</option>
                                  <option value="3">Location 3</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2">
                      <button class="btn btn-dark border-0 w-100 py-3">Search</button>
                  </div>
              </div>
          </div>
      </div>
      <!-- Search End -->

<section class="service-section">
    <div class="container">
        <div class="row">
          <h1 class="add-service-text">عرض خدمة جديدة</h1>
            <div class="col-md-12">
                <div class="table-wrap">
                  @if (count($services) != 0)
                    <table class="table table-responsive-xl">
                      <thead>
                        <tr>
                          <th>صورة</th>
                          <th>عنوان الخدمة</th>
                          <th>وصف الخدمة</th>
                          <th>الحالة</th>
                          <th>أدوات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($services as $service)
                          <tr class="alert" role="alert">
                            <td>
                              <span class="s-photo">
                                <img src="{{$service->gallery[0]->url}}" alt="">
                              </span>
                            </td>
                            <td>
                              <div class="pl-3 email">
                                <span>{{$service->title}}</span>
                                <span>Added: {{$service->created_at}}</span>
                              </div>
                            </td>
                            <td>{{$service->content}}</td>
                              <td class="status"><span class=" {{$service->status == true ? 'active' : 'waiting'}}">
                              {{$service->status == true ? 'Active' : 'Un-Active'}}
                            </span></td>
                            <td>
                                <ul class="s-action">
                                  <li data-bs-toggle="modal" data-bs-target="#showPlace{{$service->id}}" style="color:var(--primary)" class="s-show">
                                    <i class="fa fa-eye"></i>
                                    Show
                                               <!-- Modal -->
                                               <div class="modal fade" id="showPlace{{$service->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <@php
                                                  $service = \App\Models\Service::where('id' ,$service->id)->first();
                                                @endphp
                                            <div class="modal-dialog modal-dialog-centered model-xl">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">اسم الخدمة:{{$service->title}}</h1>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                  <div class="modal-body">
                                                      <h2 class="fs-5">وصف الخدمة: {{$service->content}}</h2>
                                                    
                                                      <hr>
                                                      <div id="carouselExampleFade" class="carousel slide carousel-fade">
                                                        <div class="carousel-inner">
                                                            {{-- @foreach ($service->gallery[0]->url as $item) --}}
                                                            <div class="carousel-item active">
                                                              <img src="{{$service->gallery[0]->url}}" class="d-block w-100" alt="...">
                                                            </div>
                                                            {{-- @endforeach --}}
                                                        </div>
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                          <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                          <span class="visually-hidden">Next</span>
                                                        </button>
                                                      </div>
                                                  </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn" style="color:var(--primary)" data-bs-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
  
                                  </li>


                                  <li style="color:var(--dark)" class="s-up">
                                    <i class="fa fa-pen"></i>
                                    <a  style="color:var(--dark)" href="{{route('Service.show.update.form' , $service->id)}}"> Update</a>
                                  </li>
                                  <li style="color:var(--secondary)" class="s-del">
                                    <i class="fa fa-trash"></i>
                                    <a style="color:var(--secondary)" href="{{route('Service.delete' , $service->id)}}">Delete</a>
                                  </li>
                                </ul>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>    
                  @else
                    <section class="hero is-fullheight is-info">          
                      <div class="hero-body">
                          <h3 class="title ">
                            <a href="">
                              <i class="fa fa-map-signs" aria-hidden="true"></i> <strong>عذراً</strong>
                            </a>
                          </h3>
                          <h4 class="subtitle">
                            لا يوجد خدمات ليتم عرضها
                          </h4>
                          <a class="go-to" href="{{route('Service.show')}}">إضافة خدمة</a>
                      </div>
                    </section>
                  @endif
                </div>
            </div>
        </div>
    </div>
</section>




@endsection