<div>
    <x-slot name='title'>Forgot Password</x-slot>
    <!-- Login 4 - Bootstrap Brain Component -->
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="card border-light-subtle shadow-sm">
                <div class="row g-0">
                    <div class="col-12 col-md-6">
                        <img class="img-fluid rounded-start w-100 h-100 object-fit" loading="lazy"
                            src="{{ asset('lms/images/auth/leavemanagementsystem.png') }}" alt="BootstrapBrain Logo">
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <h3>Find your account</h3>
                                    </div>
                                </div>
                            </div>
                            <form wire:submit="SendMail">
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Please enter your email to search for you account</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            wire:model.live="email">
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn bsb-btn-xl btn-primary">Send Link</button>
                                    </div>
                                    <div wire:loading wire:target="SendMail">  
                                        Sending Mail
                                    </div>
                                </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
