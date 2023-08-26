@extends('layouts.main') @section('content') @section('title', 'FAQ')
<style>
    .justified {
        text-align: justify;
    }
</style>
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.FAQ')}}</h3>
                    {{ Breadcrumbs::render('faq') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="faq-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="faq-content">
                    <h5>{{__('messages.Below are frequently')}}</h5>
                    <p class="justified">{{__('messages.By exploring the following')}}</p>
                </div>
            </div>
        </div>
        <div class="faq-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="faq-accordian">
                        <div class="faq-accordian-single-item">
                            <input id="item-1" name="accordian-item" type="radio" checked="" />
                            <label for="item-1">{{__('messages.How do I access eBooks online?')}}</label>
                            <div class="item-content">
                                <p>
                                    {{__('messages.Accessing our ebooks is simple')}}
                                </p>
                            </div>
                        </div>
                        <div class="faq-accordian-single-item">
                            <input id="item-2" name="accordian-item" type="radio" />
                            <label for="item-2">{{__('messages.I purchased an eBook, but I can not find a download option. How can I access the content?')}}</label>
                            <div class="item-content">
                                <p>{{__('messages.Our eBooks are designed for online')}}</p>
                            </div>
                        </div>
                        <div class="faq-accordian-single-item">
                            <input id="item-3" name="accordian-item" type="radio" />
                            <label for="item-3">{{__('messages.Do I need any special software to read the ebooks online?')}}</label>
                            <div class="item-content">
                                <p>{{__('messages.No special software is required to read our ebooks online')}}</p>
                            </div>
                        </div>
                        <div class="faq-accordian-single-item">
                            <input id="item-4" name="accordian-item" type="radio" />
                            <label for="item-4">{{__('messages.Can I access the ebooks from any device?')}}</label>
                            <div class="item-content">
                                <p>{{__('messages.you can access')}}</p>
                            </div>
                        </div>
                        <div class="faq-accordian-single-item">
                            <input id="item-5" name="accordian-item" type="radio" />
                            <label for="item-5">{{__('messages.Are there any restrictions')}}</label>
                            <div class="item-content">
                                <p>{{__('messages.We want you to have a great reading experience')}}</p>
                            </div>
                        </div>
                        <div class="faq-accordian-single-item">
                            <input id="item-6" name="accordian-item" type="radio" />
                            <label for="item-6">{{__('messages.Can I share the online ebook reading link with others?')}}</label>
                            <div class="item-content">
                                <p>{{__('messages.While we encourage you to share your enthusiasm for reading')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
