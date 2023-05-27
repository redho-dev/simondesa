
$("#lra_semester1").change(function(event) {

    getURL(this);
});

    function getURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#lra_semester1").val();
        
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 5120000){
                alert('ukuran file tidak boleh > 5MB !');
                $('#lra_semester1').val("");
                $('.lra_semester1').html("Choose file PDF (max-size: 5MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('#lra_semester1').val("");
            $('.lra_semester1').html("Choose file PDF (max-size: 5MB)");
            
        }
        
        
    }

    }

    
$("#surat_lra").change(function(event) {

    getURL2(this);
});

    function getURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#surat_lra").val();
        
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 MB !');
                $('#surat_lra').val("");
                $('.surat_lra').html("Choose file PDF (max-size: 1 MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('#surat_lra').val("");
            $('.surat_lra').html("Choose file PDF (max-size: 1 MB)");
            
        }
        
        
    }

    }

    $("#lkpd").change(function(event) {

        getURL3(this);
    });
    
        function getURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#lkpd").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 10240000){
                    alert('ukuran file tidak boleh > 10 MB !');
                    $('#lkpd').val("");
                    $('.lkpd').html("Choose file PDF (max-size: 10 MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#lkpd').val("");
                $('.lkpd').html("Choose file PDF (max-size: 10 MB)");
                
            }
            
            
        }
    
        }
    

        $("#surat_lkpd").change(function(event) {

            getURL4(this);
        });
        
            function getURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#surat_lkpd").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'pdf' || cekgb == 'PDF') {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 MB !');
                        $('#surat_lkpd').val("");
                        $('.surat_lkpd').html("Choose file PDF (max-size: 1 MB)");
                    }else{
                        
                    }
                    
                }else {
                    alert ("file harus berjenis 'pdf' ");
                    $('#surat_lkpd').val("");
                    $('.surat_lkpd').html("Choose file PDF (max-size: 1 MB)");
                    
                }
                
                
            }
        
            }

            $("#perdes_pertanggungjawaban").change(function(event) {

                getURL5(this);
            });
            
                function getURL5(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var filename = $("#perdes_pertanggungjawaban").val();
                    
                    filename = filename.substring(filename.lastIndexOf('\\') + 1);
                    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                    if (cekgb == 'pdf' || cekgb == 'PDF') {
                        if(input.files[0]['size'] > 5120000){
                            alert('ukuran file tidak boleh > 5 MB !');
                            $('#perdes_pertanggungjawaban').val("");
                            $('.perdes_pertanggungjawaban').html("Choose file PDF (max-size: 5 MB)");
                        }else{
                            
                        }
                        
                    }else {
                        alert ("file harus berjenis 'pdf' ");
                        $('#perdes_pertanggungjawaban').val("");
                        $('.perdes_pertanggungjawaban').html("Choose file PDF (max-size: 5 MB)");
                        
                    }
                    
                    
                }
            
                }

                $("#dok_lppd").change(function(event) {
                   getURL6(this);
                });
                
                    function getURL6(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        var filename = $("#dok_lppd").val();
                        
                        filename = filename.substring(filename.lastIndexOf('\\') + 1);
                        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                        if (cekgb == 'pdf' || cekgb == 'PDF') {
                            if(input.files[0]['size'] > 10240000){
                                alert('ukuran file tidak boleh > 10 MB !');
                                $('#dok_lppd').val("");
                                $('.dok_lppd').html("Choose file PDF (max-size: 10 MB)");
                            }else{
                                
                            }
                            
                        }else {
                            alert ("file harus berjenis 'pdf' ");
                            $('#dok_lppd').val("");
                            $('.dok_lppd').html("Choose file PDF (max-size: 10 MB)");
                            
                        }
                        
                        
                    }
                
                    }

                    $("#surat_lppd").change(function(event) {

                        getURL7(this);
                    });
                    
                        function getURL7(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            var filename = $("#surat_lppd").val();
                            
                            filename = filename.substring(filename.lastIndexOf('\\') + 1);
                            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                            if (cekgb == 'pdf' || cekgb == 'PDF') {
                                if(input.files[0]['size'] > 1024000){
                                    alert('ukuran file tidak boleh > 1 MB !');
                                    $('#surat_lppd').val("");
                                    $('.surat_lppd').html("Choose file PDF (max-size: 1 MB)");
                                }else{
                                    
                                }
                                
                            }else {
                                alert ("file harus berjenis 'pdf' ");
                                $('#surat_lppd').val("");
                                $('.surat_lppd').html("Choose file PDF (max-size: 1 MB)");
                                
                            }
                            
                            
                        }
                    
                        }