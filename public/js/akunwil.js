
$("#upload_dasar_hukum").change(function(event) {

    getURL(this);
});

    function getURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#upload_dasar_hukum").val();
        
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 Mb !');
                $('#upload_dasar_hukum').val("");
                $('.upload_dasar_hukum').html("Choose file PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('#upload_dasar_hukum').val("");
            $('.upload_dasar_hukum').html("Choose file PDF (max-size: 1MB)");
            
        }
        
        
    }

    }

    $("#upload_batas_utara").change(function(event) {

        getURL2(this);
    });

        function getURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#upload_batas_utara").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'jpg' || cekgb == 'jpeg'|| cekgb == 'png' || cekgb == 'jfif' || cekgb=='JPG' || cekgb=='JPEG' || cekgb=='PNG' || cekgb=='JFIF') {
                if(input.files[0]['size'] > 1024000){
                    alert('ukuran file tidak boleh > 1 Mb !');
                    $('#upload_batas_utara').val("");
                    $('.upload_batas_utara').html("Choose file Image (max-size: 1MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'jpg, jpeg, png, jfif' ");
                $('#upload_batas_utara').val("");
                $('.upload_batas_utara').html("Choose file Image (max-size: 1MB)");
                
            }
            
            
        }

        }

        $("#upload_batas_selatan").change(function(event) {

            getURL3(this);
            });

            function getURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#upload_batas_selatan").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'jpg' || cekgb == 'jpeg'|| cekgb == 'png' || cekgb == 'jfif' || cekgb=='JPG' || cekgb=='JPEG' || cekgb=='PNG' || cekgb=='JFIF') {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 Mb !');
                        $('#upload_batas_selatan').val("");
                        $('.upload_batas_selatan').html("Choose file Image (max-size: 1MB)");
                    }else{
                        
                    }
                    
                }else {
                    alert ("file harus berjenis 'jpg, jpeg, png, jfif' ");
                    $('#upload_batas_selatan').val("");
                    $('.upload_batas_selatan').html("Choose file Image (max-size: 1MB)");
                    
                }
                
                
            }

            }

            $("#upload_batas_barat").change(function(event) {

                getURL4(this);
            });

            function getURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#upload_batas_barat").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'jpg' || cekgb == 'jpeg'|| cekgb == 'png' || cekgb == 'jfif' || cekgb=='JPG' || cekgb=='JPEG' || cekgb=='PNG' || cekgb=='JFIF') {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 Mb !');
                        $('#upload_batas_barat').val("");
                        $('.upload_batas_barat').html("Choose file Image (max-size: 1MB)");
                    }else{
                        
                    }
                    
                }else {
                    alert ("file harus berjenis 'jpg, jpeg, png, jfif' ");
                    $('#upload_batas_barat').val("");
                    $('.upload_batas_barat').html("Choose file Image (max-size: 1MB)");
                    
                }
                
                
                
            }

            }

            $("#upload_batas_timur").change(function(event) {

                getURL5(this);
            });

                function getURL5(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var filename = $("#upload_batas_timur").val();
                    
                    filename = filename.substring(filename.lastIndexOf('\\') + 1);
                    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                    if (cekgb == 'jpg' || cekgb == 'jpeg'|| cekgb == 'png' || cekgb == 'jfif' || cekgb=='JPG' || cekgb=='JPEG' || cekgb=='PNG' || cekgb=='JFIF') {
                        if(input.files[0]['size'] > 1024000){
                            alert('ukuran file tidak boleh > 1 Mb !');
                            $('#upload_batas_timur').val("");
                            $('.upload_batas_timur').html("Choose file Image (max-size: 1MB)");
                        }else{
                            
                        }
                        
                    }else {
                        alert ("file harus berjenis 'jpg, jpeg, png, jfif' ");
                        $('#upload_batas_timur').val("");
                        $('.upload_batas_timur').html("Choose file Image (max-size: 1MB)");
                        
                    }
                    
                    
                    
                }

                }

                $("#upload_peta_batas").change(function(event) {

                    getURL6(this);
                });
                
                    function getURL6(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        var filename = $("#upload_peta_batas").val();
                        
                        filename = filename.substring(filename.lastIndexOf('\\') + 1);
                        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                        if (cekgb == 'jpg' || cekgb == 'jpeg'|| cekgb == 'png' || cekgb == 'jfif' || cekgb=='JPG' || cekgb=='JPEG' || cekgb=='PNG' || cekgb=='JFIF') {
                            if(input.files[0]['size'] > (1024000*5)){
                                alert('ukuran file tidak boleh > 5 Mb !');
                                $('#upload_peta_batas').val("");
                                $('.upload_peta_batas').html("Choose file Image (max-size: 5MB)");
                            }else{
                                
                            }
                            
                        }else {
                            alert ("file harus berjenis 'jpg, jpeg, png, jfif' ");
                            $('#upload_peta_batas').val("");
                            $('.upload_peta_batas').html("Choose file Image (max-size: 5MB)");
                            
                        }
                        
                        
                    }
                
                    }

                    $("#sk_camat_blt").change(function(event) {

                        getURL7(this);
                    });
                    
                        function getURL7(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            var filename = $("#sk_camat_blt").val();
                            
                            filename = filename.substring(filename.lastIndexOf('\\') + 1);
                            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                            if (cekgb == 'pdf' || cekgb == 'PDF') {
                                if(input.files[0]['size'] > 1024000){
                                    alert('ukuran file tidak boleh > 1 Mb !');
                                    $('#sk_camat_blt').val("");
                                    $('.sk_camat_blt').html("Choose file PDF (max-size: 1MB)");
                                }else{
                                    
                                }
                                
                            }else {
                                alert ("file harus berjenis 'pdf' ");
                                $('#sk_camat_blt').val("");
                                $('.sk_camat_blt').html("Choose PDF (max-size: 1MB)");
                                
                            }
                            
                            
                        }
                    
                        }