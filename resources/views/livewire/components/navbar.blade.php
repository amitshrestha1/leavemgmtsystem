<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
     
      <div>
        <a class="navbar-brand brand-logo" href="{{route('admin.dashboard')}}"wire:navigate>
          <img src="{{asset("lms/images/Logo.png")}}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{route('admin.dashboard')}}"wire:navigate>
          <img src="{{asset("lms/images/favicon.png")}}" alt="logo" />
        </a>
      </div>
    </div>
   
    <div class="navbar-menu-wrapper d-flex align-items-top"> 
      <div class="me-3 ml-0">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize" id="toggleButton">
          <span class="icon-menu"></span>
        </button>
      </div>
      <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h1 class="welcome-text">@if ($currenttime->hour < 12) 
                      Good Morning,
        @elseif ($currenttime->hour < 18) 
            Good afternoon, 
         @else 
            Good evening,
          @endif 
            <span class="text-black fw-bold">{{Auth()->user()->name}}</span></h1>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
          <a class="nav-link" href="#"data-target="#UserDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            @if($user->image== null)
            <img class="img-xs rounded-circle" src="{{asset("lms/images/profilepicture.png")}}" alt="Profile image"></a>
            @else
            <img class="img-xs rounded-circle" src="{{ asset('storage/' . $user->image) }}" alt="Profile image"> </a>
            @endif
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" id="UserDropdown">
            <div class="dropdown-header text-center">
              @if($user->image== null)
              <img class="img-md img-fluid rounded-circle" src="{{asset("lms/images/profilepicture.png")}}" alt="Profile image">
              @else
              <img class="img-md img-fluid rounded-circle" src="{{ asset('storage/' . $user->image) }}" alt="Profile image">
              @endif
              <p class="mb-1 mt-3 font-weight-semibold">{{$user->name}}</p>
              <p class="fw-light text-muted mb-0">{{$user->email}}</p>
            </div>
            <button class="dropdown-item"wire:click='logout'><i class="dropdown-item-icon mdi mdi-power text-primary me-2" wire:click='logout'></i>Sign Out</button>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>

  @push('scripts')

    
  @endpush
