$(document).ready(function(){
    // var province_id_check = $('#province').val();
    // if(province_id_check != ''){
    //     var district_id_check = $('#district').val();
    //     $.ajax({
    //         url: urlAddressDistrict,
    //         method: "GET",
    //         data: {province_id:province_id_check},
    //         success: function(data){
    //             var district = data.districts;
    //             var options = '';
    //             options += '<option>' + 'Choose District' + '</option>';
    //             for(var i = 0; i < district.length; i++){
    //                 var district_id = district[i].id;
    //                 var district_name = district[i].name;
    //                 if(district_id == district_id_check){
    //                     options += '<option value="'+district_id+'" selected>'+district_name+'</option>';
    //                 } else {
    //                     options += '<option value="'+district_id+'">'+district_name+'</option>';
    //                 }
    //             }
    //             $('#district').html(options);
    //         }
    //     });
    // }
    $('#province').change(function(){
        var province_id = $(this).val();
        $.ajax({
            url: urlAddressDistrict,
            method: "GET",
            data: {province_id:province_id},
            success: function(data){
                var district = data.districts;
                var options = '';
                options += '<option>' + 'Choose District' + '</option>';
                for(var i = 0; i < district.length; i++){
                    var district_id = district[i].id;
                    var district_name = district[i].name;
                    options += '<option value="'+district_id+'">'+district_name+'</option>';
                }
                $('#district').html(options);
            }
        });        
    });

    // $('#district').change(function(){
    //     var district_id = $(this).val();
    //     $.ajax({
    //         url: urlAddressDistrict,
    //         method: "GET",
    //         data: {district_id:district_id},
    //         success: function(data){
    //             var ward = data.wards;
    //             var options = '';
    //             options += '<option>' + 'Choose Ward' + '</option>';
    //             for(var i = 0; i < ward.length; i++){
    //                 var ward_id = ward[i].id;
    //                 var ward_name = ward[i].name;
    //                 options += '<option value="'+ward_id+'">'+ward_name+'</option>';
    //             }
    //             $('#ward').html(options);
    //         }
    //     });        
    // });
    //nếu người dùng chọn tỉnh/thành phố khác thì xuất hiện xã/phường khác, dùng onkeychange
    $('#district').on('change', function(){
        var district_id = $(this).val();
        $.ajax({
            url: urlAddressWard,
            method: "GET",
            data: {district_id:district_id},
            success: function(data){
                var ward = data.wards;
                var options = '';
                options += '<option>' + 'Choose Ward' + '</option>';
                for(var i = 0; i < ward.length; i++){
                    var ward_id = ward[i].id;
                    var ward_name = ward[i].name;
                    options += '<option value="'+ward_id+'">'+ward_name+'</option>';
                }
                $('#ward').html(options);
            }
        });        
    });
});