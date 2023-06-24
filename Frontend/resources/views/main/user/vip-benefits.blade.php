@extends('layouts.main')
@section('content')
@section('title', 'VIP Benefits')

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">VIP Benefits</h3>
                        {{ Breadcrumbs::render('vipBenefits') }}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->
        <!-- ...::::Start Privacy Policy  Section:::... -->
        <div class="privacy-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="privacy-policy-wrapper">
                            <div class="privacy-single-item">
                                @php
                                    $user = session()->get('user');
                                    $is_vip = $user['is_vip'];
                                    $vip_experied_date = $user['valid_vip'];
                                    $today = date("Y-m-d");
                                    $vip_experied_date = date("d-m-Y", strtotime($vip_experied_date));
                                    $today = date("d-m-Y", strtotime($today));
                                @endphp
                                <h4>Your VIP Available To: <span class="text-danger">{{ $vip_experied_date }}</span></h4>

                            </div> <!--
                            <!-- Start Privacy Policy Single Item -->
                            <!-- Start Privacy Policy Single Item -->
                            <div class="privacy-single-item">
                                <h4>What is VIP?</h4>

                                <p>
                                    Step into the enchanting world of a VIP at your local bookstore and unlock a treasure trove of exclusive benefits that will elevate your reading experience to new heights. As a distinguished book lover, you deserve nothing short of the finest treatment, and the VIP perks of a bookstore will transport you into a realm of literary luxury.</p>
                            </div> <!-- Start Privacy Policy Single Item -->
                            <!-- Start Privacy Policy Single Item -->
                            <div class="privacy-single-item">
                                <h4>What are the benefits of VIP?</h4>
                                <p>First and foremost, as a VIP, you will be greeted with personalized attention and tailored recommendations from knowledgeable staff members. Whether you're seeking the latest bestseller, a hidden gem from a lesser-known author, or a classic masterpiece, the expert book aficionados will guide you through the labyrinthine shelves, ensuring you discover literary treasures perfectly suited to your tastes.</p>
                            </div> <!-- Start Privacy Policy Single Item -->
                            <!-- Start Privacy Policy Single Item -->
                            <div class="privacy-single-item">
                                <h4>How to become a VIP?</h4>
                                <p>Moreover, VIP membership grants you coveted access to pre-release books, enabling you to embark on literary adventures before the rest of the world. Imagine the thrill of being among the privileged few who can delve into the pages of eagerly awaited novels, immersing yourself in stories yet untold, and engaging in conversations with fellow VIPs about the latest literary sensations.</p>
                            </div> <!-- Start Privacy Policy Single Item -->
                            <!-- Start Privacy Policy Single Item -->
                            <div class="privacy-single-item">
                                <h4>How to maintain VIP?</h4>
                                <p>To further enhance your bookish journey, VIP benefits often extend to exclusive author events and book signings. Prepare to meet the brilliant minds behind your favorite works, as esteemed authors share their inspiration and insights during intimate gatherings reserved solely for VIP members. Immerse yourself in thought-provoking discussions, exchange ideas, and forge connections with fellow literary enthusiasts who share your passion for the written word.</p>
                            </div> <!-- Start Privacy Policy Single Item -->
                            <!-- Start Privacy Policy Single Item -->
                            <div class="privacy-single-item">
                                <h4>How to use VIP?</h4>
                                <p>Unleash the power of knowledge with VIP access to special lectures, literary workshops, and book clubs. Expand your horizons through captivating presentations by renowned speakers, engaging in lively debates, and immersing yourself in intellectual dialogue. These unique opportunities foster personal growth, enabling you to delve deeper into the realms of literature, broaden your perspectives, and nurture a lifelong love affair with books.</p>
                            </div> <!-- Start Privacy Policy Single Item -->
                            <!-- Start Privacy Policy Single Item -->
                            <div class="privacy-single-item">
                                <h4>And some more benefits of VIP?</h4>
                                <p>The VIP experience extends beyond the bookstore itself, with exclusive discounts and promotions tailored exclusively for members. From special pricing on new releases to limited-edition book sets and collector's items, your VIP status ensures that your literary acquisitions are not only a source of endless enjoyment but also a testament to your refined taste and discerning eye for quality.</p>
                            </div> <!-- Start Privacy Policy Single Item -->
                            <!-- Start Privacy Policy Single Item -->
                            <div class="privacy-single-item">
                                <h4>Now and future more </h4>
                                <p>Furthermore, VIP benefits often encompass convenient services, such as reserved seating in cozy reading nooks, priority access to cozy cafes nestled within the bookstore, and complimentary refreshments to savor as you lose yourself in the pages of your latest find. Indulge in moments of solitude or engage in stimulating conversations with like-minded individuals as you bask in the tranquil ambiance of a sanctuary designed to ignite your literary passions.</p>
                            </div> <!-- Start Privacy Policy Single Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ...::::End Privacy Policy Section:::... -->
@endsection
