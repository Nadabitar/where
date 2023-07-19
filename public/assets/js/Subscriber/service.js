$('#newService').click(function(){

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // var html_option = `<option value=""> شارع </option>`;
    var place_id = $(this).attr('data-id');
    var html_option ;
    $.ajax({
        url : '/subscriber/service/new/'+place_id,
        type : "get" ,
        dataType: 'json',
        CORS: true ,
        contentType:'application/json',
        secure: true,
        headers: {
        'Access-Control-Allow-Origin': '*',
        },
        beforeSend: function (xhr) {
        xhr.setRequestHeader ("Authorization", "Basic " + btoa(""));
        },
        data : {
            // "_token":"{{ csrf_token() }}",
            'id': place_id,
        },
        success: function(response) {
            if (response.status) {
                $(".mySpace").empty();
                $.each(response.service , function(item){
                    //  `<option value='`+id+`'> `+name+`</option>`
                    html_option +=  ` <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="property-item rounded overflow-hidden">
                        <div class="position-relative overflow-hidden"
                        style="width: 350px;
                        height: 240px;" 
                        >
                            <a href=""><img class="img-fluid w-100 postion-center" src="{{$service->gallery[0]->url}}" alt=""></a>
                            {{-- <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$services->isAd == true? إعلان : خدمة}}</div> --}}
                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"></div>
                        </div>
                        <div class="p-4 pb-0">
                            <h5 class="text-primary mb-3"> <small > Service Title:</small>{{$service->title}}</h5>
                            <a class="d-block h5 mb-2" href="">{{$service->content}}</a>
                            <p><i class="fas fa-calendar-alt text-primary me-2"></i>{{$service->created_at}}</p>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-heart text-primary me-2"></i>{{$service->isSaved->count()}} saved</small>
                            <small class="flex-fill text-center border-end py-2"><i class="far fa-bell text-primary me-2"></i> status: {{$service->status ? "Active" : "unActive" }}</small>
                        </div>
                    </div>
                                    </div>`;
                }); 
            } else {
                alert(response);
            }
            $('.mySpace').html(html_option);
        },
        error: function (data) {
        alert(data.status)
    }
    });
});

$('#activeService').click(function(){
  
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // var html_option = `<option value=""> شارع </option>`;
        var place_id = $(this).attr('data-id');
        var html_option ;
        $.ajax({
            url : '/subscriber/service/new/'+place_id,
            type : "get" ,
            dataType: 'json',
            CORS: true ,
            contentType:'application/json',
            secure: true,
            headers: {
            'Access-Control-Allow-Origin': '*',
            },
            beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Basic " + btoa(""));
            },
            data : {
                // "_token":"{{ csrf_token() }}",
                'id': place_id,
            },
            success: function(response) {
                if (response.status) {
                    $(".mySpace").empty();
                    $.each(response.service , function(item){
                        //  `<option value='`+id+`'> `+name+`</option>`
                        html_option +=  ` <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden"
                            style="width: 350px;
                            height: 240px;" 
                            >
                                <a href=""><img class="img-fluid w-100 postion-center" src="{{$service->gallery[0]->url}}" alt=""></a>
                                {{-- <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$services->isAd == true? إعلان : خدمة}}</div> --}}
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"></div>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-3"> <small > Service Title:</small>{{$service->title}}</h5>
                                <a class="d-block h5 mb-2" href="">{{$service->content}}</a>
                                <p><i class="fas fa-calendar-alt text-primary me-2"></i>{{$service->created_at}}</p>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-heart text-primary me-2"></i>{{$service->isSaved->count()}} saved</small>
                                <small class="flex-fill text-center border-end py-2"><i class="far fa-bell text-primary me-2"></i> status: {{$service->status ? "Active" : "unActive" }}</small>
                            </div>
                        </div>
                                        </div>`;
                    }); 
                } else {
                    alert(response);
                }
                $('.mySpace').html(html_option);
            },
            error: function (data) {
            console.log(data)
        }
        });
});

$('#unActiveService').click(function(){
    
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // var html_option = `<option value=""> شارع </option>`;
        var place_id = $(this).attr('data-id');
        var html_option ;
        $.ajax({
            url : '/subscriber/service/new/'+place_id,
            type : "get" ,
            dataType: 'json',
            CORS: true ,
            contentType:'application/json',
            secure: true,
            headers: {
            'Access-Control-Allow-Origin': '*',
            },
            beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Basic " + btoa(""));
            },
            data : {
                // "_token":"{{ csrf_token() }}",
                'id': place_id,
            },
            success: function(response) {
                if (response.status) {
                    $(".mySpace").empty();
                    $.each(response.service , function(item){
                        //  `<option value='`+id+`'> `+name+`</option>`
                        html_option +=  ` <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden"
                            style="width: 350px;
                            height: 240px;" 
                            >
                                <a href=""><img class="img-fluid w-100 postion-center" src="{{$service->gallery[0]->url}}" alt=""></a>
                                {{-- <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$services->isAd == true? إعلان : خدمة}}</div> --}}
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"></div>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-3"> <small > Service Title:</small>{{$service->title}}</h5>
                                <a class="d-block h5 mb-2" href="">{{$service->content}}</a>
                                <p><i class="fas fa-calendar-alt text-primary me-2"></i>{{$service->created_at}}</p>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-heart text-primary me-2"></i>{{$service->isSaved->count()}} saved</small>
                                <small class="flex-fill text-center border-end py-2"><i class="far fa-bell text-primary me-2"></i> status: {{$service->status ? "Active" : "unActive" }}</small>
                            </div>
                        </div>
                                        </div>`;
                    }); 
                } else {
                    alert(response);
                }
                $('.mySpace').html(html_option);
            },
            error: function (data) {
            console.log(data)
        }
        });
});
