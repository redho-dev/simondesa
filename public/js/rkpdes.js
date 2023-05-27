
$('.angka').mask('000.000.000.000.000', {reverse: true});
$('.pendapatan').mask('000.000.000.000.000', {reverse: true});
$('.pagu_fisik').mask('000.000.000.000.000', {reverse: true});
$('.nominal').mask('000.000.000.000.000', {reverse: true});

$("#sk_tim_rkpdes").change(function(event) {

    getURL(this);
});

    function getURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#sk_tim_rkpdes").val();
        
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 Mb !');
                $('#sk_tim_rkpdes').val("");
                $('.sk_tim_rkpdes').html("Choose file PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('#sk_tim_rkpdes').val("");
            $('.sk_tim_rkpdes').html("Choose file PDF (max-size: 1MB)");
            
        }
        
        
    }

    }

    $("#bac_musdus").change(function(event) {

        getURLb(this);
    });
    
        function getURLb(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#bac_musdus").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 1024000){
                    alert('ukuran file tidak boleh > 1 Mb !');
                    $('#bac_musdus').val("");
                    $('.bac_musdus').html("Choose file PDF (max-size: 1MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#bac_musdus').val("");
                $('.bac_musdus').html("Choose file PDF (max-size: 1MB)");
                
            }
            
            
        }
    
        }

    $("#bac_musrenbangdes").change(function(event) {

        getURL2(this);
    });

        function getURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#bac_musrenbangdes").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 1024000){
                    alert('ukuran file tidak boleh > 1 Mb !');
                    $('#bac_musrenbangdes').val("");
                    $('.bac_musrenbangdes').html("Choose file PDF (max-size: 1MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#bac_musrenbangdes').val("");
                $('.bac_musrenbangdes').html("Choose file PDF (max-size: 1MB)");
                
            }
            
            
        }

        }

        $("#daftar_hadir_musrenbangdes").change(function(event) {

            getURL3(this);
            });

            function getURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#daftar_hadir_musrenbangdes").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'pdf' || cekgb == 'PDF') {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 Mb !');
                        $('#daftar_hadir_musrenbangdes').val("");
                        $('.daftar_hadir_musrenbangdes').html("Choose file PDF (max-size: 1MB)");
                    }else{
                        
                    }
                    
                }else {
                    alert ("file harus berjenis 'pdf' ");
                    $('#daftar_hadir_musrenbangdes').val("");
                    $('.daftar_hadir_musrenbangdes').html("Choose file PDF (max-size: 1MB)");
                    
                }
                
                
            }

            }

            $("#foto_musrenbangdes").change(function(event) {

                getURL4(this);
            });

            function getURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#foto_musrenbangdes").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'jpeg' || cekgb == 'jfif') {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 Mb !');
                        $('#foto_musrenbangdes').val("");
                        $('.foto_musrenbangdes').html("Choose file Image (max-size: 1MB)");
                    }else{
                        
                    }
                    
                }else {
                    alert ("file harus berjenis jpg,jpeg,png,jfif ");
                    $('#foto_musrenbangdes').val("");
                    $('.foto_musrenbangdes').html("Choose file Image (max-size: 1MB)");
                    
                }
                
                
            }

            }

            $("#dokumen_rkpdes").change(function(event) {

                getURL5(this);
            });

                function getURL5(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var filename = $("#dokumen_rkpdes").val();
                    
                    filename = filename.substring(filename.lastIndexOf('\\') + 1);
                    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                    if (cekgb == 'pdf' || cekgb == 'PDF') {
                        if(input.files[0]['size'] > 20480000){
                            alert('ukuran file tidak boleh > 20 MB !');
                            $('#dokumen_rkpdes').val("");
                            $('.dokumen_rkpdes').html("Choose file PDF (max-size: 20MB)");
                        }else{
                            
                        }
                        
                    }else {
                        alert ("file harus berjenis 'pdf' ");
                        $('#dokumen_rkpdes').val("");
                        $('.dokumen_rkpdes').html("Choose file PDF (max-size: 20MB)");
                        
                    }
                    
                    
                }

                }

                $("#bac_blt").change(function(event) {

                    getURL6(this);
                });
                
                    function getURL6(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        var filename = $("#bac_blt").val();
                        
                        filename = filename.substring(filename.lastIndexOf('\\') + 1);
                        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                        if (cekgb == 'pdf' || cekgb == 'PDF') {
                            if(input.files[0]['size'] > 1024000){
                                alert('ukuran file tidak boleh > 1 Mb !');
                                $('#bac_blt').val("");
                                $('.bac_blt').html("Choose file PDF (max-size: 1MB)");
                            }else{
                                
                            }
                            
                        }else {
                            alert ("file harus berjenis 'pdf' ");
                            $('#bac_blt').val("");
                            $('.bac_blt').html("Choose file PDF (max-size: 1MB)");
                            
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