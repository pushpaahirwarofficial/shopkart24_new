@extends('frontend.layouts.main')

@section('main-container')
    <style>
        body {
            color: black !important;
            font-weight: 300 !important;
        }
    </style>

    <div class="container">
        <div class="row">
            <h1>Delivery & Returns</h1>

            <h3>SHIPPING:</h3>
            <p><b>COD & ONLINE PRE-PAID</b></p>
            <p>We offer shipping for all orders across India. Currently, we do not provide international shipping.</p>

            <p><b>ONLINE PRE-PAID ORDERS</b></p>
            <p>60rs Shipping charges on overall order and if you shop above 500rs shipping is free. Note: FREE SHIPPING ONLY ON PREPAID ORDERS</p>

            <p><b>PAY ON DELIVERY/ CASH ON DELIVERY/ONLINE PREPAID ORDERS</b></p>
            <ul>
                <li>A shipping fee of INR 60/- is applicable to orders below INR 500/-. </li>
                <li>FREE SHIPPING is provided for orders valued above INR 500/-. </li>
                <li>No FREE SHIPPING on cod orders and you have to pay 90rs COD CHARGES. </li>
                <li>For orders exceeding INR 3000/-, only prepaid orders are accepted. </li>
                <li>All prices (MRP or Discounted Rates) include GST. </li>
            </ul>

            <p><b>EXPRESS DELIVERY:</b></p>
            <p>Standard shipping for Express Delivery Tag Products is within 5-7 business days, with variations based on the shipping address and pin code. You will receive a notification on your registered contact number and email once the order is shipped.</p>

            <p><b>Exchange services are not available; we exclusively offer Replacement or Store Credit options for Cash-on-delivery (COD) and Pay-on-delivery (POD) orders.</b></p>

            <p><b>STANDARD DELIVERY:</b></p>
            <p>Our courier partners deliver from Monday to Saturday, excluding public holidays, with a delivery window from 10:00 AM to 6:00 PM. Shipping durations differ based on the product, as indicated on respective product pages. Standard shipping typically takes 3-7 business days, while make-to-order items may require an additional 5-7 days. If an order includes multiple products, the longest shipping time applies.</p>

            <p><b>DELIVERY PROCEDURE & NOTIFICATIONS:</b></p>
            <ul>
                <li>A notification will be sent to the registered contact number and email address upon the order being shipped from our warehouse. </li>
                <li>Address changes are permitted if the order has not been shipped. Once the status is “Ready to Ship” with an AWB No, it will be processed at the provided address. </li>
                <li>It is mandatory to include an email address in each order for effective communication. </li>
                <li>Upon shipping, the customer will receive an SMS on their registered number and an email containing the order and tracking details. </li>
                <li>The company is not responsible for delays caused by natural disasters or unforeseeable events. </li>
                <li>We will aid in tracking parcels in case of issues arising from the delivery partner’s side. </li>
                <li>Refrain from disclosing any OTP to the delivery partner until your order has been successfully delivered to you at your given shipping address. </li>
            </ul>

            <p><b>NOTE</b></p>
            <p>If a customer rejects three separate Cash on Delivery (COD) / Pay on Delivery (POD) orders, the system will automatically designate them for prepaid orders exclusively in the future. For any further information on delivery or shipping details contact us at:</p>
            <ul>
                <li>Email ID</li>
                <li>Contact Us</li>
                <li>Business Hours</li>
            </ul>

            <h2>RETURN & REFUNDS</h2>

            <p><b>The timeline to raise a return request is within 72 hours from the date of order delivery. Kindly ensure that you have an unboxing video of the delivered package to facilitate a seamless return process.</b></p>

            <p><b>(A) For PAY ON DELIVERY/CASH ON DELIVERY orders:</b><br>
                Store credits or replacement for the same product will be provided, depending on the selected return resolution.
            </p>
            <p><b>Refunds cannot be transferred to any other payment method.</b></p>
            <p>Once we receive your return order, we will send you an email to confirm the receipt of the parcel and proceed with your selected mode of resolution method.</p>

            <p>
                <b>(B) For ONLINE PRE-PAID ORDERS (Net Banking/Debit Card/Credit Card/UPI/ Other Wallets)</b>
            </p>
            <ul>
                <li>We will reimburse the original source account within 7-10 business days of upon receiving the items with original labels and tags, excluding the delivery fee. </li>
                <li>For orders paid with a card, the refund will be credited to the same card used during the order placement. </li>
                <li>For orders paid through UPI, the refund will be transferred to the same UPI source used during the order placement. </li>
                <li>Upon receiving your return, you will receive an email confirming the parcel’s receipt, and we will proceed to process your refund. </li>
                <li>Refrain from disclosing the OTP to the pickup partner until the order has been officially handed over to them. </li>
            </ul>

            <p><b>(I) REFUNDS – 50:50 – ONLINE PREPAID & CREDIT NOTE</b></p>
            <ul>
                <li>Refunds to the original source account will be processed within 7-10 business days after receiving the items with original labels and tags, excluding the delivery fee. </li>
                <li>If the order was paid with a card, the refund will be credited to the same card used during the order placement. </li>
                <li>For orders paid via UPI, the refund will be transferred to the same UPI source used during the order placement. </li>
                <li>Upon receiving your return, an email confirming the parcel’s receipt will be sent, and we will proceed to process your refund. </li>
                <li>The store credit used in the order will be reversed to the registered account with us. </li>
            </ul>

            <p><b>(II) REFUNDS – 50:50 – CASH/PAY ON DELIVERY & CREDIT NOTE</b></p>
            <p><b>Store credits or replacement for the same product will be provided, depending on the selected return resolution. Refunds cannot be transferred to any other payment method.</b></p>
            <p>Once we receive your return order, we will send you an email to confirm the receipt of the parcel and proceed with your selected mode of resolution method.</p>

            <p><b>(III) EXCHANGE – CASH/PAY ON DELIVERY OR ONLINE PREPAID</b></p>
            <p>At the moment, exchange services are not available. If you prefer items in a different style, colour or size, you can return the items you do not need and place a new order with the desired design, style, colour or size with the help of the store credit available in your registered account.</p>

            <p><b>(IV) REPLACEMENT – CASH/PAY ON DELIVERY OR ONLINE PREPAID</b></p>
            <p>We offer a replacement option regardless of your chosen payment method for the order. All the replacement are subjected to stock availability. Note: The replacement option is available for the products that are received by you as broken, damaged or any other product defect Only. The product image or unboxing video must be shared over email for validation. If the product is out of stock, we will process a store credit for the raised replacement order request.</p>

            <p><b>(C ) ONLINE RETURN</b></p>
            <p>We provide a complimentary Return Pick-Up Service nationwide. The pickup option is accessible when you initiate your return request. Each order has a single return option, meaning one order allows one return. The courier person will attempt reverse pick-up a maximum of 3 times. If the customer is unable to hand over the return order to the courier partner within the specified attempts, they should choose the self-return option. For any issues related to the reverse pick-up, please contact our customer support team.</p>

            <p><b>(D) SELF – RETURN</b></p>
            <p>Customers have the option to return products by self -shipping them to our warehouse. Kindly drop an email to us at info@shopkart24.com with the details of the respective courier partner’s name along with the tracking number. Only upon receiving your return order, we will send a confirmation email and proceed with your selected resolution. For specific pin codes without return pick-up service, it is advisable to self-ship the returned items to our warehouse. Please notify us by emailing info@shopkart24.com with details of the courier partner’s name and tracking number. Note: In such cases, the shipping charges of INR 60/- will be reimbursed via store credit once the return is verified at our end. Self-ship refunds will be processed within 7-10 business days. </p>

          
            <p><b>(G) REFUND POLICY</b></p>
            <p>Upon successfully receiving the returned product, a refund will be initiated to the original payment source within 7-10 business days. Refunds for COD orders will be issued as store credit. Orders placed using prepaid methods (Net Banking/Debit Card/Credit Card/UPI/ Other Wallets) will receive refunds back to the original source account.</p>

            <p><b>(H) REFUND PROCEDURE & TIMELINES</b></p>
            <p>Upon receiving the returned products, an email will be sent to confirm receipt. The email will also detail the resolution process. Refunds will be initiated within 7-10 business days. Note: We are not liable for any delays caused by banks or payment gateways during the refund process.</p>

            <p><b>CONTACT</b></p>
            <p>For any questions or assistance regarding our Delivery & Return Policies, please contact us:</p>
            <ul>
                <li>Email ID: info@shopkart24.com</li>
                <li>Contact Number: +91-9999950946</li>
                <li>Business Hours: Monday to Saturday, 10:00 AM to 6:00 PM (excluding public holidays)</li>
            </ul>

            <p><b>THANK YOU FOR YOUR PATIENCE & UNDERSTANDING</b></p>
            <p>Our team at shopkart24.com is dedicated to providing you with a seamless shopping experience. Your satisfaction is our top priority, and we strive to maintain the highest standards in our products and services.</p>
        </div>
    </div>
@endsection
