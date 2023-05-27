<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu bg-info">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <div class="nav toggle mt-3" style="width: 40vw;">
            @if($infos->role == 'adminDesa')
            <span class="text-white ">ADMIN DESA {{ strtoupper($infos->asal->asal.', Kecamatan
                '.$infos->asal->kecamatan) }}</span>
            @elseif($infos->role == 'irban_wilayah')
            <span class="text-dark">ADMIN IRBAW WILAYAH</span>
            @endif
        </div>
        <nav class="nav navbar-nav bg-info">

            <ul class=" navbar-right">

                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <img src="/img/admin.png" alt="">{{ $infos->username }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:;"> Profile</a>
                        <a class="dropdown-item" href="/">Web Utama</a>
                        <form action="/logoutDesa" method="post">
                            @csrf
                            <button class="dropdown-item" type="submit"><i class="fa fa-sign-out pull-right"></i>
                                Log Out</button>
                        </form>
                    </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>

                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->