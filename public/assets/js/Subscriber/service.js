$('#newService').click(function(){

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // var html_option = `<option value=""> شارع </option>`;
    var place_id = $(this).attr('data-id');
    var html_option = ' ' ;
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
                $('#unActiveService').removeClass('active');
                $('#newService').addClass('active');
                $(".mySpace").empty();
                $.each(response.services , function(id , item ){
                    html_option +=  ` <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="property-item rounded overflow-hidden">
                        <div class="position-relative overflow-hidden" style="width: 350px; height: 240px;" >
                            <a href=""><img class="img-fluid w-100 postion-center" src="${item.image}" alt=""></a>
                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"></div>
                        </div>
                        <div class="p-4 pb-0">
                            <h5 class="text-primary mb-3"> <small > Service Title:</small>${ item.title }</h5>
                            <a class="d-block h5 mb-2" href="">${item.content}}</a>
                            <p><i class="fas fa-calendar-alt text-primary me-2"></i>${item.created_at}</p>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-heart text-primary me-2"></i>${item.savedCount} saved</small>
                            <small class="flex-fill text-center border-end py-2"><i class="far fa-bell text-primary me-2"></i> status: ${  item.status ? "Active" : "unActive" }</small>
                        </div>
                    </div>
                    </div>`;
                }); 
            } else {
                alert(response);
            }
            $(".mySpace").html(html_option);
        },
        error: function (data) {
        alert(data.status)
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
        var html_option = ' ';
        $.ajax({
            url : '/subscriber/service/unactive/'+place_id,
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
                    $('#unActiveService').addClass('active');
                    $('#newService').removeClass('active');
                    $(".mySpace").empty();
                    $.each(response.services , function(id , item ){
                        html_option +=  ` <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden" style="width: 350px; height: 240px;" >
                                <a href=""><img class="img-fluid w-100 postion-center" src="${item.image}" alt=""></a>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3"></div>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-3"> <small > Service Title:</small>${ item.title }</h5>
                                <a class="d-block h5 mb-2" href="">${item.content}}</a>
                                <p><i class="fas fa-calendar-alt text-primary me-2"></i>${item.created_at}</p>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-heart text-primary me-2"></i>${item.savedCount} saved</small>
                                <small class="flex-fill text-center border-end py-2"><i class="far fa-bell text-primary me-2"></i> status: ${  item.status ? "Active" : "unActive" }</small>
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
///nothin 




document.getElementById('service-imag').addEventListener("change" , (e) => {
    // alert('kk');
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        const files = e.target.files;
        const output = document.getElementById('file-result');
        for (let i = 0; i <  files.length; i++) {
            if (!files[i].type.match('image')) {continue}
            const picReader = new FileReader();
            // output.empty();
            picReader.addEventListener('load' , function(event){
                const picFile = event.target;
                const dive1 = document.createElement('div');
                dive1.className = 'owl-carousel';
                dive1.className += 'header-carousel';
                const dive2 = document.createElement('div');
                dive1.className = 'owl-carousel-item';
                dive1.appendChild(dive2);
                dive2.innerHTML =  `<img class="img-fluid" src="${picFile.result}">`
                output.appendChild(dive1);
            });
            picReader.readAsDataURL(files[i]);
            
        }
    } else {
        
    }
});