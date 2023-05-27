
$('.angka').mask('000.000.000.000.000', {reverse: true});


$("#dokumen_rapbdes").change(function(event) {

    getURL(this);
});

    function getURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#dokumen_rapbdes").val();
        
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 20480000){
                alert('ukuran file tidak boleh > 20 MB !');
                $('#dokumen_rapbdes').val("");
                $('.dokumen_rapbdes').html("Choose file PDF (max-size: 20MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('#dokumen_rapbdes').val("");
            $('.dokumen_rapbdes').html("Choose file PDF (max-size: 20MB)");
            
        }
        
        
    }

    }

    $("#penyampaian").change(function(event) {

        getURL2(this);
    });

        function getURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#penyampaian").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 1024000){
                    alert('ukuran file tidak boleh > 1 Mb !');
                    $('#penyampaian').val("");
                    $('.penyampaian').html("Choose file PDF (max-size: 1MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#penyampaian').val("");
                $('.penyampaian').html("Choose file PDF (max-size: 1MB)");
                
            }
            
            
        }

        }

        $("#bac").change(function(event) {

            getURL3(this);
            });

            function getURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#bac").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'pdf' || cekgb == 'PDF') {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 Mb !');
                        $('#bac').val("");
                        $('.bac').html("Choose file PDF (max-size: 1MB)");
                    }else{
                        
                    }
                    
                }else {
                    alert ("file harus berjenis 'pdf' ");
                    $('#bac').val("");
                    $('.bac').html("Choose file PDF (max-size: 1MB)");
                    
                }
                
                
            }

            }

            $("#foto_musdes").change(function(event) {

                getURL4(this);
            });

            function getURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#foto_musdes").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'jpeg' || cekgb == 'jfif') {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 MB !');
                        $('#foto_musdes').val("");
                        $('.foto_musdes').html("Choose file Image (max-size: 1MB)");
                    }else{
                        
                    }
                    
                }else {
                    alert ("file harus berjenis jpg,jpeg,png,jfif ");
                    $('#foto_musdes').val("");
                    $('.foto_musdes').html("Choose file Image (max-size: 1MB)");
                    
                }
                
                
            }

            }

            $("#keputusan_bpd").change(function(event) {

                getURL5(this);
            });

                function getURL5(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var filename = $("#keputusan_bpd").val();
                    
                    filename = filename.substring(filename.lastIndexOf('\\') + 1);
                    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                    if (cekgb == 'pdf' || cekgb == 'PDF') {
                        if(input.files[0]['size'] > 1024000){
                            alert('ukuran file tidak boleh > 1MB !');
                            $('#keputusan_bpd').val("");
                            $('.keputusan_bpd').html("Choose file PDF (max-size: 1MB)");
                        }else{
                            
                        }
                        
                    }else {
                        alert ("file harus berjenis 'pdf' ");
                        $('#keputusan_bpd').val("");
                        $('.keputusan_bpd').html("Choose file PDF (max-size: 1MB)");
                        
                    }
                    
                    
                }

                }

                $("#evaluasi").change(function(event) {

                    getURL6(this);
                });
                
                    function getURL6(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        var filename = $("#evaluasi").val();
                        
                        filename = filename.substring(filename.lastIndexOf('\\') + 1);
                        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                        if (cekgb == 'pdf' || cekgb == 'PDF') {
                            if(input.files[0]['size'] > 1024000){
                                alert('ukuran file tidak boleh > 1 Mb !');
                                $('#evaluasi').val("");
                                $('.evaluasi').html("Choose file PDF (max-size: 1MB)");
                            }else{
                                
                            }
                            
                        }else {
                            alert ("file harus berjenis 'pdf' ");
                            $('#evaluasi').val("");
                            $('.evaluasi').html("Choose file PDF (max-size: 1MB)");
                            
                        }
                        
                        
                    }
                
                    }

 