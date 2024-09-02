<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      {{-- <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i> --}}


      {{-- <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ps-4 me-auto">
        <a id="navbarMinimize" onclick="navbarMinimize(this)" class="nav-link text-body p-0">
        <div class="sidenav-toggler-inner">
        <i class="sidenav-toggler-line"></i>
        <i class="sidenav-toggler-line"></i>
        <i class="sidenav-toggler-line"></i>
        </div>
        </a>
        </div>
        <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
        <ul class="navbar-nav justify-content-end ms-auto">
        <li class="nav-item d-xl-none ps-3 pe-0 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
        <div class="sidenav-toggler-inner">
        <i class="sidenav-toggler-line"></i>
        <i class="sidenav-toggler-line"></i>
        <i class="sidenav-toggler-line"></i>
        </div>
        </a>
         </li>
        </ul>
        </div> --}}
      



      <a class="navbar-brand m-0 bg-gradient-success" href="#" >
        <img src="/img/outline_menu_white_24dp.png"  class="navbar-brand-img h-100" alt="sidenavmenu_icon">
        
          
        <span class="ms-1  font-weight-bold text-white">Options</span>
      </a>
      <hr class="horizontal light mt-0 mb-2">
    </div>
    
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        
        
       
        {{ $slot }}

      </ul>
    </div>
    
   <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <hr class="horizontal light mt-0 mb-2">
      <div class="mx-auto  d-block">
        <a href="#"><img src="/img/1-OFFICE LOGO.png" style="filter: grayscale(100%);"  width="25%" class="mx-auto  d-block pb-2"></a>
      </div>
    </div>  
  </aside>