@extends('layouts.main') @section('content') @section('title', 'Contact Us')
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.Contact Us')}}</h3>
                    {{ Breadcrumbs::render('contact') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="map-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d501726.54073011904!2d106.36556425709519!3d10.754618132789961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529292e8d3dd1%3A0xf15f5aad773c112b!2sHo%20Chi%20Minh%20City%2C%20Vietnam!5e0!3m2!1sen!2s!4v1693032300510!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-details-wrapper section-top-gap-100">
                    <div class="contact-details">
                        <div class="contact-details-single-item">
                            <div class="contact-details-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="contact-details-content contact-phone">
                                <a href="tel:+033 242 0477">033 242 0477</a>
                            </div>
                        </div>

                        <div class="contact-details-single-item">
                            <div class="contact-details-icon">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="contact-details-content contact-phone">
                                <a href="mailto:ebookn097@gmail.com">ebookn097@gmail.com</a>
                                <a href="http://127.0.0.1:8080/">http://127.0.0.1:8080</a>
                            </div>
                        </div>

                        <div class="contact-details-single-item">
                            <div class="contact-details-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="contact-details-content contact-phone">
                                <span>Vietnam</span>
                                <span>Ho Chi Minh City</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-8">
                <div class="contact-form section-top-gap-100">
                    <h3>{{__('messages.Get In Touch')}}</h3>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="default-form-box mb-20">
                                    <label for="contact-name">{{__('messages.Name')}}</label>
                                    <input type="text" id="contact-name" required />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="default-form-box mb-20">
                                    <label for="contact-email">{{__('messages.Email address')}}</label>
                                    <input type="email" id="contact-email" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="default-form-box mb-20">
                                    <label for="contact-subject">{{__('messages.Subject')}}</label>
                                    <input type="text" id="contact-subject" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="default-form-box mb-20">
                                    <label for="contact-message">{{__('messages.Your Message')}}</label>
                                    <textarea id="contact-message" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="contact-submit-btn" type="submit">{{__('messages.SEND MESSAGE')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
