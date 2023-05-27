
$("#upload_surat").change(function(event) {

    getURL(this);
});

    function getURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#upload_surat").val();
        
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 5120000){
                alert('ukuran file tidak boleh > 5MB !');
                $('#upload_surat').val("");
                $('.upload_surat').html("Choose file PDF (max-size: 5MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('#upload_surat').val("");
            $('.upload_surat').html("Choose file PDF (max-size: 5MB)");
            
        }
        
        
    }

    }

    
$("#upload_daftar_hadir").change(function(event) {

    getURL2(this);
});

    function getURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#upload_daftar_hadir").val();
        
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 5120000){
                alert('ukuran file tidak boleh > 5 MB !');
                $('#upload_daftar_hadir').val("");
                $('.upload_daftar_hadir').html("Choose file PDF (max-size: 5 MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('#upload_daftar_hadir').val("");
            $('.upload_daftar_hadir').html("Choose file PDF (max-size: 5 MB)");
            
        }
        
        
    }

    }

    $("#upload_daftar_hadir2").change(function(event) {

        getURL3(this);
    });
    
        function getURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#upload_daftar_hadir2").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 5120000){
                    alert('ukuran file tidak boleh > 5 MB !');
                    $('#upload_daftar_hadir2').val("");
                    $('.upload_daftar_hadir2').html("Choose file PDF (max-size: 5 MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#upload_daftar_hadir2').val("");
                $('.upload_daftar_hadir2').html("Choose file PDF (max-size: 5 MB)");
                
            }
            
            
        }
    
        }
    

        $("#upload_buku_register").change(function(event) {

            getURL4(this);
        });
        
            function getURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#upload_buku_register").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'pdf' || cekgb == 'PDF') {
                    if(input.files[0]['size'] > 2048000){
                        alert('ukuran file tidak boleh > 2 MB !');
                        $('#upload_buku_register').val("");
                        $('.upload_buku_register').html("Choose file PDF (max-size: 2 MB)");
                    }else{
                        
                    }
                    
                }else {
                    alert ("file harus berjenis 'pdf' ");
                    $('#upload_buku_register').val("");
                    $('.upload_buku_register').html("Choose file PDF (max-size: 2 MB)");
                    
                }
                
                
            }
        
            }

            $("#upload_rekap_penduduk").change(function(event) {

                getURL5(this);
            });
            
                function getURL5(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var filename = $("#upload_rekap_penduduk").val();
                    
                    filename = filename.substring(filename.lastIndexOf('\\') + 1);
                    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                    if (cekgb == 'pdf' || cekgb == 'PDF') {
                        if(input.files[0]['size'] > 5120000){
                            alert('ukuran file tidak boleh > 5 MB !');
                            $('#upload_rekap_penduduk').val("");
                            $('.upload_rekap_penduduk').html("Choose file PDF (max-size: 5 MB)");
                        }else{
                            
                        }
                        
                    }else {
                        alert ("file harus berjenis 'pdf' ");
                        $('#upload_rekap_penduduk').val("");
                        $('.upload_rekap_penduduk').html("Choose file PDF (max-size: 5 MB)");
                        
                    }
                    
                    
                }
            
                }