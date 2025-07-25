@extends('frontend.layouts.main')

@section('main-container')

    <style>
        #shopify-section-header .megamenu {
            line-height: 1;
        }

        #shopify-section-header .megamenu a {
            font-size: 0.9em;
        }

        #shopify-section-header .site-nav__dropdown-link--second-level {
            font-size: 0.9em;
        }

        #shopify-section-header .h5 a {
            color: #ec688d;
        }

        #shopify-section-header .mobile-nav .appear-delay-2 a {
            color: #ec688d;
        }

        #shopify-section-header .mobile-nav .appear-delay-3 a {
            color: #9b006f;
        }
     
}
    </style>
    </div>
    
    
     <div class="container">
        <div class="row mt-5">
           <h1 class="text-center">Keep in touch with us</h1> 
           <p class="text-center">We’re talking about jewellery gift sets, of course –<br> and we’ve got a bouquet of beauties for yourself or someone you love.</p>
        </div>
    </div>
    

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif
    
    <main class="main-content" id="MainContent">
        <div id="shopify-section-page-contact-template" class="card shopify-section">
            <div class="page-width page-width--narrow page-content page-content--with-blocks">
                <header class="section-header">
                    <h1 class="section-header__title">Contact Us</h1>
                </header>
                <div class="rte text-spacing">

                </div>
            </div>
            <div class="page-blocks">
                <div>
                    <div class="index-section">
                        <div class="page-width page-width--narrow">
                            <div class="form-vertical">
                                <form method="post" action="{{ url('/contact') }}"
                                    id="contact-page-contact-template-0" accept-charset="UTF-8" class="contact-form"><input
                                        type="hidden" name="form_type" value="contact" /><input type="hidden"
                                        name="utf8" value="✓" />
                                 @csrf
                                    <div class="grid grid--small">
                                        <div class="grid__item medium-up--one-half">
                                            <label for="ContactFormName-page-contact-template-0">Name</label>
                                            <input type="text" id="ContactFormName-page-contact-template-0"
                                                class="input-full" name="contact[name]" autocapitalize="words"
                                                value="">
                                        </div>

                                        <div class="grid__item medium-up--one-half">
                                            <label for="ContactFormEmail-page-contact-template-0">Email</label>
                                            <input type="email" id="ContactFormEmail-page-contact-template-0"
                                                class="input-full" name="contact[email]" autocorrect="off"
                                                autocapitalize="off" value="">
                                        </div>
                                    </div><label for="ContactFormMessage-page-contact-template-0">Message</label>
                                    <textarea rows="5" id="ContactFormMessage-page-contact-template-0" class="input-full" name="contact[body]"></textarea>

                                    <button type="submit" class="btn" style="background:#ec688d; color:white;">
                                        Submit
                                    </button>


                                    <p data-spam-detection-disclaimer>This site is protected by reCAPTCHA and the Google <a
                                            href="https://policies.google.com/privacy">Privacy Policy</a> and <a
                                            href="https://policies.google.com/terms">Terms of Service</a> apply.</p>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </main>
        @endsection
