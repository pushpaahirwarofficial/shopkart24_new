@extends('frontend.layouts.main')

@section('main-container')
<style>
 .card-text {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 4.5em; /* (line-height) * (number of lines you want to show) */
        }
        
        .image-container {
            position: relative;
        }
        .add-to-cart-btn {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: none;
        }
        .image-container:hover .add-to-cart-btn {
                display: block;
                background: black;
                color: white;
                padding-right: 20px;
                padding-left: 46px;
                padding-top: 9px;
                padding-bottom: 9px;
                border-radius: 11px;
                width: 200px;
                }
                
</style>

  <div class="container">
        <div class="row mb-5 mt-4">
            <div class="col-12 col-md-5">
                <img src="https://caketheme.com/html/mojuri/media/banner/banner-1-3.jpg" class="img-fluid" alt="Your Image">
            </div>
            <div class="col-12 col-md-7 mt-3">
                <h1 style=" font-size: 28px;">Welcome to Shopkart24</h1>
                <p>Hello everyone i am ..... director of Shopkart24. I am a youtuber turned into entrepreneur, i need travelling as much as food. Shopkart24 is like a dream or we can say idea which came in my mind during my B.tech days. I was dreaming about shopkart24 where i can provide the various items in best affordable prices without compromising the quality</p>
                <p>Initially i started my journey with instagram and then  switch it to website for the convenience of the customer. Here anyone can easily track their order and also easily able to get the all products with proper details. I learnt so many things as a seller by using so many ecommerce websites and soon will add reliable and effective sellers over here with keep that negative points in mind which sellers are facing on other websites. My moto is to make policies by keeping in mind both sellers and customers.</p>
                <p><b>....</b><br>Director</p>
            </div>
        </div>
        
        <hr>
        <div class="row mt-5">
            <div class="col-12 col-md-6 mb-4">
            <h1 class="text-center">Our Mission</h1>
                <p class="text-center">Shopkart24 is not only customer oriented platform i want this to be Seller oriented also. So my mission is to make a platform like Shopkart24 where both Seller & Customer will be happy. Currently we don’t have any seller but in future you will get one stop beauty solution over here.</p>
                            </div>
            <div class="col-12 col-md-6">
                <h1 class="text-center">Our Goal</h1>
                <p class="text-center">To make Shopkart24 best multi vendor platform within next 2 years.</p>
                
            </div>
        </div>
    </div>
<div id="CollectionAjaxResult" class="collection-content">
<div id="CollectionAjaxContent">
<div class="page-width">




</div>
</div>
</div>



@endsection