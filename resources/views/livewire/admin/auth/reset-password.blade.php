<div>
    <x-slot name='title'>Reset Passowrd</x-slot>
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
                        <h3>Please enter a new password</h3>
                      </div>
                    </div>
                  </div>
                  <form wire:submit="reset_password">
                    <div class="row gy-3 gy-md-4 overflow-hidden">
                      <div class="col-12">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label><br>
                        @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                        <input type="password" class="form-control" name="password" placeholder="New Password" wire:model.live="password">
                      </div>
                      <div class="col-12">
                        <label for="password" class="form-label">Confirm Password <span class="text-danger">*</span></label><br>
                        @error('password_confirmation') <span class="error text-danger">{{ $message }}</span> @enderror
                        <input type="password" class="form-control" name="password"placeholder="Confirm Password" wire:model.live="password_confirmation">
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button type="submit" class="btn bsb-btn-xl btn-primary" >Reset Password</button>
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
    
    