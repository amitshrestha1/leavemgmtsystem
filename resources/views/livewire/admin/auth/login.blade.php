<div>
<x-slot name='title'>Login</x-slot>
<!-- Login 4 - Bootstrap Brain Component -->
<section class="p-3 p-md-4 p-xl-5">
    <div class="container">
      <div class="card border-light-subtle shadow-sm">
        <div class="row g-0">
          <div class="col-12 col-md-6">
            <img class="img-fluid rounded-start w-100 h-100 object-fit" loading="lazy" src="{{asset('lms/images/auth/leavemanagementsystem.png')}}" alt="BootstrapBrain Logo">
          </div>
          <div class="col-12 col-md-6">
            <div class="card-body p-3 p-md-4 p-xl-5">
              <div class="row">
                <div class="col-12">
                  <div class="mb-5">
                    <h3>Leave Management System</h3>
                  </div>
                </div>
              </div>
              <form wire:submit="login">
                <div class="row gy-3 gy-md-4 overflow-hidden">
                  <div class="col-12">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Email" wire:model.live="email">
                  </div>
                  <div class="col-12">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password"placeholder="Password" wire:model.live="password">
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" class="btn bsb-btn-xl btn-primary" >Log In</button>
                    </div>
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="col-12">
                  <hr class="mt-5 mb-4 border-secondary-subtle">
                  <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                    <a href="{{route('admin.sendlink')}}"wire:navigate class="link-secondary text-decoration-none">Forgot password</a>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

