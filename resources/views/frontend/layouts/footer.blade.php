</div>

</main>

<footer id="site-footer" class="site-footer background four-columns"style="background:#fffdf5!important;">
				<div class="footer">
					<div class="section-padding">
						<div class="section-container">
							<div class="block-widget-wrap">
								<div class="row">
									<div class="col-lg-4 col-md-6 column-1">
										<div class="block block-menu m-b-20">
											<h2 class="block-title">Contact Us</h2>
											<div class="block-content">
												<ul style="list-style: none;display: inline-block;">
													<li>
														<i class="fa-sharp fa-solid fa-location-dot pr-2 text-center"></i><span></span> H-16, Swadesh Nagar Colony, <br><p class="" style="margin-left: 27px;">Bhopal- 462023</p>
													</li>
													<li>
												     	<a href="tel:1234567890">
                                                            <i class="fa-solid fa-phone pr-2"></i>
                                                            <span>Tel:</span> 1234567890
                                                       </a>
													</li>
													<li>
												    	<i class="fa-solid fa-envelope pr-2"></i>	<span>Email:</span> <a href="mailto:test@gmail.com">test@gmail.com</a>
													</li>
												</ul>
											</div>
										</div>

										<div class="block ">
											<ul class="social-link" style="list-style: none;display: inline-block;">
											<li style=" width: 33px;"><a href="https://twitter.com/shopkart24"><i class="fa-brands fa-twitter"></i></a></li>
											<li style=" width: 33px;"><a href="https://www.instagram.com/shopkartt24/"><i class="fa-brands fa-instagram"></i></i></a></li>
											<li style=" width: 33px;"><a href="https://www.facebook.com/shopkart24/"><i class="fa-brands fa-facebook"></i></i></a></li>
											<li style=" width: 33px;"><a href="https://www.youtube.com/channel/UCd-8OwHsCJkgYsKogxEODkw"><i class="fa-brands fa-youtube"></i></a></li>
											</ul>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 column-2">
										<div class="block block-menu">
											<h2 class="block-title">Customer Services</h2>
											<div class="block-content">
												<ul>
													
													<li>
														<a href="">Track Your Order</a>
													</li>
													<!--<li>-->
													<!--	<a href="">Product Care &amp; Repair</a>-->
													<!--</li>-->
													<!--<li>-->
													<!--	<a href="">Book an Appointment</a>-->
													<!--</li>-->
													<!--<li>-->
													<!--	<a href="">Frequently Asked Questions</a>-->
													<!--</li>-->
													<li>
														<a href="{{('/refund_returns')}}">Shipping &amp; Returns</a>
													</li>
													<li>
														<a href="{{('/refund_returns')}}">Refund  &amp; cancellation </a>
													</li>
													<li>
														<a href="#">Terms &amp; Conditions</a>
													</li>
													<li>
														<a href="{{ ('/privacy-policy') }}">Privacy Policy</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 column-3">
										<div class="block block-menu">
											<h2 class="block-title" >About Us</h2>
											<div class="block-content">
												<ul>
													<li>
														<a href="{{ ('/about') }}">About Us</a>
													</li>
													<li>
														<a href="{{ url('/contact') }}">Contact Us</a>
													</li>
													<li>
														<a href="{{url ('/wishlist')}}">Wishlist</a>
													</li>
													<li>
														<a href="{{url ('/jewelry')}}">Our Products</a>
													</li>
													<li>
														<a href="#">Sitemap</a>
													</li>
													
												</ul>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-6 column-4">
										<div class="block block-menu">
											<h2 class="block-title">Catalog</h2>
											<div class="block-content">
												<ul>
													<li>
														<a href="{{ route('category.show', 2) }}">Earrings</a>
													</li>
													<li>
														<a href="{{ route('category.show', 8) }}">Necklaces</a>
													</li>
													<li>
														<a href="{{ route('category.show', 9) }}">Bracelets</a>
													</li>
													<li>
														<a href="{{ route('category.show', 10) }}">Anklets</a>
													</li>
												
													<li>
														<a href="{{ route('category.show', 11) }}">Rings</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-bottom">
					<div class="section-padding">
						<div class="section-container">
							<div class="block-widget-wrap">
								<div class="row">
									<div class="col">
										<div class="footer-left">
											<p class="copyright text-center" style="color:black;">Copyright © 2023. All Right Reserved</p>
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>


<!-- End of SearchTap -->
</div>


<link rel="dns-prefetch" href="https://swymstore-v3pro-01.swymrelay.com/" crossorigin>
<link rel="dns-prefetch" href="../../swymv3pro-01.azureedge.net/code/swym-shopify.js">
<link rel="preconnect" href="../../swymv3pro-01.azureedge.net/code/swym-shopify.js">
<script id="swym-snippet">
window.swymLandingURL = document.URL;
window.swymCart = {"note":null,"attributes":{},"original_total_price":0,"total_price":0,"total_discount":0,"total_weight":0.0,"item_count":0,"items":[],"requires_shipping":false,"currency":"INR","items_subtotal_price":0,"cart_level_discount_applications":[],"checkout_charge_amount":0};
window.swymPageLoad = function(){
window.SwymProductVariants = window.SwymProductVariants || {};
window.SwymHasCartItems = 0 > 0;
window.SwymPageData = {}, window.SwymProductInfo = {};
var unknown = {et: 0};
window.SwymPageData = unknown;

window.SwymPageData.uri = window.swymLandingURL;
};

if(window.selectCallback){
(function(){
// Variant select override
var originalSelectCallback = window.selectCallback;
window.selectCallback = function(variant){
originalSelectCallback.apply(this, arguments);
try{
  if(window.triggerSwymVariantEvent){
    window.triggerSwymVariantEvent(variant.id);
  }
}catch(err){
  console.warn("Swym selectCallback", err);
}
};
})();
}
window.swymCustomerId = null;
window.swymCustomerExtraCheck = null;

var swappName = ("Wishlist" || "Wishlist");
var swymJSObject = {
pid: "+cpCcwFAZRxLLU5f56GSftYbsfgqKnDaDQqjqhlTkiA=" || "+cpCcwFAZRxLLU5f56GSftYbsfgqKnDaDQqjqhlTkiA=",
interface: "/apps/swym" + swappName + "/interfaces/interfaceStore.php?appname=" + swappName
};
window.swymJSShopifyLoad = function(){
if(window.swymPageLoad) swymPageLoad();
if(!window._swat) {
(function (s, w, r, e, l, a, y) {
r['SwymRetailerConfig'] = s;
r[s] = r[s] || function (k, v) {
  r[s][k] = v;
};
})('_swrc', '', window);
_swrc('RetailerId', swymJSObject.pid);
_swrc('Callback', function(){initSwymShopify();});
}else if(window._swat.postLoader){
_swrc = window._swat.postLoader;
_swrc('RetailerId', swymJSObject.pid);
_swrc('Callback', function(){initSwymShopify();});
}else{
initSwymShopify();
}
}
if(!window._SwymPreventAutoLoad) {
swymJSShopifyLoad();
}
window.swymGetCartCookies = function(){
var RequiredCookies = ["cart", "swym-session-id", "swym-swymRegid", "swym-email"];
var reqdCookies = {};
RequiredCookies.forEach(function(k){
reqdCookies[k] = _swat.storage.getRaw(k);
});
var cart_token = window.swymCart.token;
var data = {
action:'cart',
token:cart_token,
cookies:reqdCookies
};
return data;
}

window.swymGetCustomerData = function(){

return {status:1};

}
</script>

<style id="safari-flasher-pre"></style>
<script>
if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
document.getElementById("safari-flasher-pre").innerHTML = ''
+ '#swym-plugin,#swym-hosted-plugin{display: none;}'
+ '.swym-button.swym-add-to-wishlist{display: none;}'
+ '.swym-button.swym-add-to-watchlist{display: none;}'
+ '#swym-plugin  #swym-notepad, #swym-hosted-plugin  #swym-notepad{opacity: 0; visibility: hidden;}'
+ '#swym-plugin  #swym-notepad, #swym-plugin  #swym-overlay, #swym-plugin  #swym-notification,'
+ '#swym-hosted-plugin  #swym-notepad, #swym-hosted-plugin  #swym-overlay, #swym-hosted-plugin  #swym-notification'
+ '{-webkit-transition: none; transition: none;}'
+ '';
window.SwymCallbacks = window.SwymCallbacks || [];
window.SwymCallbacks.push(function(tracker){
tracker.evtLayer.addEventListener(tracker.JSEvents.configLoaded, function(){
// flash-preventer
var x = function(){
  SwymUtils.onDOMReady(function() {
    var d = document.createElement("div");
    d.innerHTML = "<style id='safari-flasher-post'>"
      + "#swym-plugin:not(.swym-ready),#swym-hosted-plugin:not(.swym-ready){display: none;}"
      + ".swym-button.swym-add-to-wishlist:not(.swym-loaded){display: none;}"
      + ".swym-button.swym-add-to-watchlist:not(.swym-loaded){display: none;}"
      + "#swym-plugin.swym-ready  #swym-notepad, #swym-plugin.swym-ready  #swym-overlay, #swym-plugin.swym-ready  #swym-notification,"
      + "#swym-hosted-plugin.swym-ready  #swym-notepad, #swym-hosted-plugin.swym-ready  #swym-overlay, #swym-hosted-plugin.swym-ready  #swym-notification"
      + "{-webkit-transition: opacity 0.3s, visibility 0.3ms, -webkit-transform 0.3ms !important;-moz-transition: opacity 0.3s, visibility 0.3ms, -moz-transform 0.3ms !important;-ms-transition: opacity 0.3s, visibility 0.3ms, -ms-transform 0.3ms !important;-o-transition: opacity 0.3s, visibility 0.3ms, -o-transform 0.3ms !important;transition: opacity 0.3s, visibility 0.3ms, transform 0.3ms !important;}"
      + "</style>";
    document.head.appendChild(d);
  });
};
setTimeout(x, 10);
});
});
}

// Get the money format for the store from shopify
window.SwymOverrideMoneyFormat = "Rs.;
</script>
<style id="swym-product-view-defaults">
/* Hide when not loaded */
.swym-button.swym-add-to-wishlist-view-product:not(.swym-loaded){
display: none;
}
</style>

<!-- Magic Checkout Code Starts -->

<script>
//    window.widgetIDForMagicCheckout = “shopify-section-header”;
//    window.widgetClassForMagicCheckout = “shopify-section”;
//    window.configForMagicCheckout = {
//     display: {
//         sequence: [“cod”]
//     }
//   };
//  window.nameForMagicCheckout = “”;
window.onDismissMagiCheckout = () => {
location.reload();
}

// window.onCompleteMagiCheckout = (id, price) => {
// }
window.RazorpayMagicBtnConfig = {
dual: false,
showIcon: true,
showSubtext: true,
bgColor: '#ec688d',
title: '', // custom button text
};

window.addEventListener('load',checkBoxCheck);
        function checkBoxCheck(event){
          if(document.getElementById('giftCheck2')){
            document.getElementById('giftCheck2').checked=false;
          }

          if(document.getElementById('giftCheck')){
            document.getElementById('giftCheck').checked=false;
          }

        }
</script>

<input id="rzpKey" type="hidden" name="rzpKey" value="rzp_live_oEnnxwS5n9hfT1">

<script
type="lightJs"
src="../../cdn.razorpay.com/static/shopify/analytics.js"
gtag-conversion-id="AW-316422305"
gtag-conversion-label="oZXrCN2FjeoCEKHx8JYB"
></script>
<script
type="lightJs"
src="../../cdn.razorpay.com/static/shopify/magic-rzp.js"
data-email=""
data-phonenumber=""
></script>

<div id="rzp-spinner-backdrop">
<div id="rzp-spinner">
<div id="loading-indicator">.</div>
</div>
</div>

<style>
#rzp-spinner-backdrop {
position: fixed;
top: 0;
left: 0;
z-index: 9999;
width: 100%;
height: 100%;
background: rgba(0, 0, 0);
visibility: hidden;
opacity: 0;
}
#rzp-spinner-backdrop.show {
visibility: visible;
opacity: 0.4;
}
#rzp-spinner {
visibility: hidden;
opacity: 0;
/* positioning and centering */
position: fixed;
left: 0;
top: 0;
bottom: 0;
right: 0;
margin: auto;
z-index: 10000;
display: flex !important;
align-items: center;
justify-content: center;
}
#rzp-spinner.show {
visibility: visible;
opacity: 1;
}
@keyframes rotate {
0% {
transform: rotate(0);
}
100% {
transform: rotate(360deg);
}
}
#loading-indicator {
border-radius: 50%;
width: 80px;
height: 80px;
border: 4px solid;
border-color: rgb(59, 124, 245) transparent rgb(59, 124, 245) rgb(59, 124, 245) !important;
animation: 1s linear 0s infinite normal none running rotate;
margin-top: 2px;
box-sizing: content-box;
}
</style>

<!-- Magic Checkout Code Ends -->

<!-- "snippets/mlveda-currencies-switcher.liquid" was not rendered, the associated app was uninstalled --><!-- "snippets/mlveda-currencies.liquid" was not rendered, the associated app was uninstalled --><!-- "snippets/mlveda-flag.liquid" was not rendered, the associated app was uninstalled --><!-- "snippets/mlveda-currencies-style.liquid" was not rendered, the associated app was uninstalled -->
<!-- google dynamic remarketing tag for theme.liquid storeya.com -->


<script type="text/javascript">
  window.onload = function() {
if (window.jQuery) {
$(document).ajaxSuccess(function(event, xhr, settings) {
 if (settings.url == "/cart/add.js" || settings.url == "../cart/update.js"){
if(typeof gtag !== "undefined"){
    $.getJSON("../cart.js", function(data) {
  if (!data.items || !data.items.length) return;
  var items = [];
  for (var i = 0; i < data.items.length; i++) {
    var item = data.items[i];
    var tagitem ={id:item.product_id,location_id:item.variant_id,google_business_vertical:'custom'};
    items.push(tagitem);
  }
  var total = parseFloat(data.total_price);
  gtag('event','add_to_cart', {send_to:'AW-11169699495',value:total,currency:data.currency,items:items});
  });}}});
}
}
</script>
<!-- google dynamic remarketing tag for theme.liquid storeya.com End -->
<!-- Google Analytics load on scroll -->
<script>
function analyticsOnScroll() {
  var head = document.getElementsByTagName('head')[0]
  var script = document.createElement('script')
  script.type = 'text/javascript';
  script.src = 'https://www.googletagmanager.com/gtag/js?id=AW-11169699495'
  head.appendChild(script);
  document.removeEventListener('scroll', analyticsOnScroll);
};
document.addEventListener('scroll', analyticsOnScroll);
</script>

<!-- Google tag (gtag.js) -->
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'AW-11169699495');
</script>
<script type="lightJs">
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PD5BR3H');
</script>
<!-- End Google Tag Manager -->
<style> .section-header__title h1 {text-transform: uppercase;} .page-container h1 {color: #ec688d;} </style>
<div id="shopify-block-10482958812443994587" class="shopify-block shopify-app-block"><script id="bikScript" type="text/javascript">
(async function () {
const response = await fetch(
    `https://bikapi.bikayi.app/dm/storeFrontScriptsApiFunctions-getAllScriptSrc/?storeUrl=${Shopify.shop}&storeType=WHATSAPP`,
    {
      method: "GET",
      mode: "cors",
      cache: "no-cache",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json",
      },
      redirect: "follow",
      referrerPolicy: "no-referrer",
    }
);
const sources = await response.json();
sources.data.forEach((src) => {
const scriptTag = document.createElement("script");
scriptTag.setAttribute("src", src);
document.body.appendChild(scriptTag);
});
window.bikWidgetContext = {
currentProduct: {
id: "",
name: "",
variant: {
  id: "",
  name: ""
}
}
}
})();
</script>
<a href="https://bik.ai/" style="z-index: -1; position: fixed; top: -100%; bottom: -100%;"></a>


<script src="{{ url('frontend/js/searchtab.js') }}"></script>
<script src="{{ url('frontend/js/thememin.js') }}"></script>
<script src="{{ url('frontend/js/vendor-script.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('assets/dashboard/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/js/menu.js') }}"></script>

<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
<!-- <script src="{{ asset('assets/dashboard/js/api.js') }}"></script> -->


</div>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
				

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


  

<script type="text/javascript">
    $('.autoplay').slick({
        slidesToShow: 5,
        slidesToScroll: 5,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 440,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
        ]
    });
</script>
  
      <script type="text/javascript">
   
$('.multiple-items').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
   responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
});
		
				
  </script>
  
      <script type="text/javascript">
   
$('.multiple-brand').slick({
  infinite: true,
  slidesToShow: 4,
  slidesToScroll: 4
});
		
				
  </script>
  
  <script>
    $(document).ready(function(){
      $('.single-item').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        centerPadding: '0px',
          autoplay: true, 
      autoplaySpeed: 1000 
      });
    });
    
  </script>
  
  <script>
    $(document).ready(function() {
        $(".navbar-toggler").click(function() {
            $("#navbarSupportedContent").toggleClass("show");
        });
    });
</script>
  
  
</body>


</html>
