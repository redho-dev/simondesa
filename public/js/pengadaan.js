$(".sk_tpk").change(function(event) {
    var nfile = $(this).val();
    getURLa(this, nfile);
});

function getURLa(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
    
    filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'pdf' || cekgb == 'PDF') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 Mb !');
            $('.sk_tpk').val("");
            $('.label_sk_tpk').html("Choose file PDF (max-size: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'pdf' ");
        $('.sk_tpk').val("");
        $('.label_sk_tpk').html("Choose file PDF (max-size: 1MB)");
        
    }
    
    
}

}

$(".desain").change(function(event) {
    var nfile = $(this).val();
    getURLb(this, nfile);
});

function getURLb(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'pdf' || cekgb == 'PDF') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.desain').val("");
            $('.label_desain').html("Choose file PDF (max-size: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'pdf' ");
        $('.desain').val("");
        $('.label_desain').html("Choose file PDF (max-size: 1MB)");
        
    }
    
    
}

}

$(".foto_0").change(function(event) {
    var nfile = $(this).val();
    getURLc(this, nfile);
});

function getURLc(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'PNG' || cekgb == 'jpeg' || cekgb == 'JPEG') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.foto_0').val("");
            $('.label_foto_0').html("Choose file Image (max: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis jpg/jpeg/png' ");
        $('.foto_0').val("");
        $('.label_foto_0').html("Choose file Image (max: 1MB)");
        
    }
    
    
}

}

$(".foto_50").change(function(event) {
    var nfile = $(this).val();
    getURLd(this, nfile);
});

function getURLd(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'PNG' || cekgb == 'jpeg' || cekgb == 'JPEG') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.foto_50').val("");
            $('.label_foto_50').html("Choose file Image (max: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis jpg/jpeg/png' ");
        $('.foto_50').val("");
        $('.label_foto_50').html("Choose file Image (max: 1MB)");
        
    }
    
    
}

}

$(".foto_100").change(function(event) {
    var nfile = $(this).val();
    getURLe(this, nfile);
});

function getURLe(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'PNG' || cekgb == 'jpeg' || cekgb == 'JPEG') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.foto_100').val("");
            $('.label_foto_100').html("Choose file Image (max: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis jpg/jpeg/png' ");
        $('.foto_100').val("");
        $('.label_foto_100').html("Choose file Image (max: 1MB)");
        
    }
    
    
}

}

$(".prasasti").change(function(event) {
    var nfile = $(this).val();
    getURLf(this, nfile);
});

function getURLf(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'PNG' || cekgb == 'jpeg' || cekgb == 'JPEG') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.prasasti').val("");
            $('.label_prasasti').html("Choose file Image (max: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis jpg/jpeg/png' ");
        $('.prasasti').val("");
        $('.label_prasasti').html("Choose file Image (max: 1MB)");
        
    }
    
    
}

}

$(".foto_papan").change(function(event) {
    var nfile = $(this).val();
    getURLk(this, nfile);
});

function getURLk(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'PNG' || cekgb == 'jpeg' || cekgb == 'JPEG') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.foto_papan').val("");
            $('.label_foto_papan').html("Choose file Image (max: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis jpg/jpeg/png' ");
        $('.foto_papan').val("");
        $('.label_foto_papan').html("Choose file Image (max: 1MB)");
        
    }
    
    
}

}

$(".bast").change(function(event) {
    var nfile = $(this).val();
    getURLg(this, nfile);
});

function getURLg(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'pdf' || cekgb == 'PDF') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.bast').val("");
            $('.label_bast').html("Choose file PDF (max-size: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'pdf' ");
        $('.bast').val("");
        $('.label_bast').html("Choose file PDF (max-size: 1MB)");
        
    }
    
    
}

}

$(".survey_material").change(function(event) {
    var nfile = $(this).val();
    getURLl(this, nfile);
});

function getURLl(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'pdf' || cekgb == 'PDF') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.survey_material').val("");
            $('.label_survey_material').html("Choose file PDF (max-size: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'pdf' ");
        $('.survey_material').val("");
        $('.label_survey_material').html("Choose file PDF (max-size: 1MB)");
        
    }
    
    
}

}

$(".survey_peralatan").change(function(event) {
    var nfile = $(this).val();
    getURLm(this, nfile);
});

function getURLm(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'pdf' || cekgb == 'PDF') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.survey_peralatan').val("");
            $('.label_survey_peralatan').html("Choose file PDF (max-size: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'pdf' ");
        $('.survey_peralatan').val("");
        $('.label_survey_peralatan').html("Choose file PDF (max-size: 1MB)");
        
    }
    
    
}

}

$(".rab").change(function(event) {
    var nfile = $(this).val();
    getURLn(this, nfile);
});

function getURLn(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'pdf' || cekgb == 'PDF') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.rab').val("");
            $('.label_rab').html("Choose file PDF (max-size: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'pdf' ");
        $('.rab').val("");
        $('.label_rab').html("Choose file PDF (max-size: 1MB)");
        
    }
    
    
}

}



$(".foto_barang").change(function(event) {
    var nfile = $(this).val();
    getURLo(this, nfile);
});

function getURLo(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'PNG' || cekgb == 'jpeg' || cekgb == 'JPEG') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.foto_barang').val("");
            $('.label_foto_barang').html("Choose file Image (max: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis jpg/jpeg/png' ");
        $('.foto_barang').val("");
        $('.label_foto_barang').html("Choose file Image (max: 1MB)");
        
    }
    
    
}

}