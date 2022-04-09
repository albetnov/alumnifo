<div>
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('{{ asset('assets/admin') }}/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Sign Up!</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-body">
                            <form role="form text-left">
                                <div class="mb-3">
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : 'is-valid' }}"
                                        placeholder="Name" aria-label="Name" aria-describedby="email-addon"
                                        wire:model="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : 'is-valid' }}"
                                        placeholder="Email" aria-label="Email" aria-describedby="email-addon"
                                        wire:model="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : 'is-valid' }}"
                                        placeholder="Password" aria-label="Password" aria-describedby="password-addon"
                                        wire:model="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-info text-left">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                        checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms
                                            and Conditions</a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}"
                                        class="text-dark font-weight-bolder">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
