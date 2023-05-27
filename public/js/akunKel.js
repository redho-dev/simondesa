$("#upload_sotk").change(function(event) {

    getURL(this);
});

    function getURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#upload_sotk").val();
        
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 MB !');
                $('#upload_sotk').val("");
                $('.upload_sotk').html("Choose file PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'PDF' ");
            $('#upload_sotk').val("");
            $('.upload_sotk').html("Choose file PDF (max-size: 1MB)");
            
        }
        
        
    }

    }

    $("#upload_sklpm").change(function(event) {

        getURL2(this);
    });
    
        function getURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#upload_sklpm").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 1024000){
                    alert('ukuran file tidak boleh > 1 MB !');
                    $('#upload_sklpm').val("");
                    $('.upload_sklpm').html("Choose file PDF (max-size: 1MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'PDF' ");
                $('#upload_sklpm').val("");
                $('.upload_sklpm').html("Choose file PDF (max-size: 1MB)");
                
            }
            
            
        }
    
        }

        $("#upload_sktaruna").change(function(event) {

            getURL3(this);
        });
        
            function getURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#upload_sktaruna").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'pdf' || cekgb == 'PDF') {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 MB !');
                        $('#upload_sktaruna').val("");
                        $('.upload_sktaruna').html("Choose file PDF (max-size: 1MB)");
                    }else{
                        
                    }
                    
                }else {
                    alert ("file harus berjenis 'PDF' ");
                    $('#upload_sktaruna').val("");
                    $('.upload_sktaruna').html("Choose file PDF (max-size: 1MB)");
                    
                }
                
                
            }
        
            }

            $("#upload_linmas").change(function(event) {

                getURL4(this);
            });
            
                function getURL4(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var filename = $("#upload_linmas").val();
                    
                    filename = filename.substring(filename.lastIndexOf('\\') + 1);
                    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                    if (cekgb == 'pdf' || cekgb == 'PDF') {
                        if(input.files[0]['size'] > 1024000){
                            alert('ukuran file tidak boleh > 1 MB !');
                            $('#upload_linmas').val("");
                            $('.upload_linmas').html("Choose file PDF (max-size: 1MB)");
                        }else{
                            
                        }
                        
                    }else {
                        alert ("file harus berjenis 'PDF' ");
                        $('#upload_linmas').val("");
                        $('.upload_linmas').html("Choose file PDF (max-size: 1MB)");
                        
                    }
                    
                    
                }
            
                }

                $("#upload_pkk").change(function(event) {

                    getURL5(this);
                });
                
                    function getURL5(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        var filename = $("#upload_pkk").val();
                        
                        filename = filename.substring(filename.lastIndexOf('\\') + 1);
                        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                        if (cekgb == 'pdf' || cekgb == 'PDF') {
                            if(input.files[0]['size'] > 1024000){
                                alert('ukuran file tidak boleh > 1 MB !');
                                $('#upload_pkk').val("");
                                $('.upload_pkk').html("Choose file PDF (max-size: 1MB)");
                            }else{
                                
                            }
                            
                        }else {
                            alert ("file harus berjenis 'PDF' ");
                            $('#upload_pkk').val("");
                            $('.upload_pkk').html("Choose file PDF (max-size: 1MB)");
                            
                        }
                        
                        
                    }
                
                    }

                    $("#upload_kantor_desa").change(function(event) {

                        getURL6(this);
                    });
                
                        function getURL6(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            var filename = $("#upload_kantor_desa").val();
                            
                            filename = filename.substring(filename.lastIndexOf('\\') + 1);
                            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                            if (cekgb == 'jpg' || cekgb == 'jpeg'|| cekgb == 'png' || cekgb == 'jfif' || cekgb=='JPG' || cekgb=='JPEG' || cekgb=='PNG' || cekgb=='JFIF') {
                                if(input.files[0]['size'] > 1024000){
                                    alert('ukuran file tidak boleh > 1 Mb !');
                                    $('#upload_kantor_desa').val("");
                                    $('.upload_kantor_desa').html("Choose file Image (max-size: 1MB)");
                                }else{
                                    
                                }
                                
                            }else {
                                alert ("file harus berjenis 'jpg, jpeg, png, jfif' ");
                                $('#upload_kantor_desa').val("");
                                $('.upload_kantor_desa').html("Choose file Image (max-size: 1MB)");
                                
                            }
                            
                            
                        }
                
                        }

                        $("#upload_papan_struktur").change(function(event) {

                            getURL7(this);
                        });
                    
                            function getURL7(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                var filename = $("#upload_papan_struktur").val();
                                
                                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                                if (cekgb == 'jpg' || cekgb == 'jpeg'|| cekgb == 'png' || cekgb == 'jfif' || cekgb=='JPG' || cekgb=='JPEG' || cekgb=='PNG' || cekgb=='JFIF') {
                                    if(input.files[0]['size'] > 1024000){
                                        alert('ukuran file tidak boleh > 1 Mb !');
                                        $('#upload_papan_struktur').val("");
                                        $('.upload_papan_struktur').html("Choose file Image (max-size: 1MB)");
                                    }else{
                                        
                                    }
                                    
                                }else {
                                    alert ("file harus berjenis 'jpg, jpeg, png, jfif' ");
                                    $('#upload_papan_struktur').val("");
                                    $('.upload_papan_struktur').html("Choose file Image (max-size: 1MB)");
                                    
                                }
                                
                                
                            }
                    
                            }

                            $("#upload_kantor_bpd").change(function(event) {

                                getURL8(this);
                            });
                        
                                function getURL8(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    var filename = $("#upload_kantor_bpd").val();
                                    
                                    filename = filename.substring(filename.lastIndexOf('\\') + 1);
                                    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                                    if (cekgb == 'jpg' || cekgb == 'jpeg'|| cekgb == 'png' || cekgb == 'jfif' || cekgb=='JPG' || cekgb=='JPEG' || cekgb=='PNG' || cekgb=='JFIF') {
                                        if(input.files[0]['size'] > 1024000){
                                            alert('ukuran file tidak boleh > 1 Mb !');
                                            $('#upload_kantor_bpd').val("");
                                            $('.upload_kantor_bpd').html("Choose file Image (max-size: 1MB)");
                                        }else{
                                            
                                        }
                                        
                                    }else {
                                        alert ("file harus berjenis 'jpg, jpeg, png, jfif' ");
                                        $('#upload_kantor_bpd').val("");
                                        $('.upload_kantor_bpd').html("Choose file Image (max-size: 1MB)");
                                        
                                    }
                                    
                                    
                                }
                        
                                }