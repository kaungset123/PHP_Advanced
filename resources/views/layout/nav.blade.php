<div  id="nav_div" class="container-fluid p-0 "  >
    <nav class="navbar navbar-expand-lg " >
        <div class="container-fluid ">
            <a class="navbar-brand text-white" href="/">
                <img src="{{asset('/images/emoji.png')}}" width="40" height="40">
                <span style="font-size: 20px;" >Smile Shopingu</span>
            </a>
            <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-black" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="<?php echo URL_ROOT . "admin";?>">Admin Panel</a>
                    </li>
                    <li id="drop_wrap" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul id="drop_list" class="dropdown-menu">
                            <li><a class="dropdown-item text-black" href="#">Action</a></li>
                            <li><a class="dropdown-item text-black" href="#">Another action</a></li>
                            <li><a class="dropdown-item text-black" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled text-black" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="box-shadow: 1px 1px 9px rebeccapurple; border:none;">
                    <button class="btn btn-outline-success" type="submit" id="search_button" style="border:none; color:white; box-shadow: 1px 2px 7px black;">Search</button>
                </form>
            </div>
        </div>
    </nav>

</div>