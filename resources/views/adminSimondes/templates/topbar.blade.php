<header class="header">
    <div class="logo-container">
        <a href="/admin" class="logo">
            <img src="/storage/image/logo.png" width="35" height="35" alt="SIMONDes" />
            <span style="font-weight: bold; vertical-align: middle;" class="text-dark text-5">SIMONDes</span>
        </a>
        
        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
        
    </div>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" style="position: absolute; right: 650px;" role="alert">
            <strong>Harap Periksa Pemilihan Desa</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
        </div>
    @endif
    <!-- start: search & user box -->
    <div class="header-right">  
        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-bs-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="/assets/irban/img/!logged-user.jpg" alt="Joseph Doe" class="rounded-circle" data-lock-picture="/assets/irban/img/!logged-user.jpg" />
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                    <span class="name">{{ $infos->name }}</span>
                    <span class="role">{{ $infos->obrik }}</span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="/"><i class="bx bx-home-circle"></i> Website</a>
                    </li>                    
                    <li>
                        <a role="menuitem" tabindex="-1" href="/logoutAdmin"><i class="bx bx-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
    
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

<script>
jQuery(document).ready(function(){
jQuery('#kecamatanss').change(function(){
    let kecamatan=jQuery(this).val();
    jQuery.ajax({
        url:'/irban/getDesa',
        type:'post',
        data:'kecamatan='+kecamatan+'&_token={{ csrf_token() }}',
        success:function(result){            
            jQuery('#desa').html(result);
        }
    })
})
});
</script>