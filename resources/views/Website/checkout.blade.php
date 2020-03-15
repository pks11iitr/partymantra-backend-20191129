<form action="{{$data['url']}}" method="POST" name="payment_form" style="display:none">
    @csrf
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="{{$api_key}}"
        data-amount="{{$data['total']??0}}"
        data-currency="INR"
        data-order_id="{{$data['orderid']??''}}"
        data-buttontext="Pay with Razorpay"
        data-name='Party Mantra'
        data-description="{{$data['description']??''}}"
        data-image="{{env('APP_URL')}}/theme/img/tplogo.png"
        data-prefill.name="{{$data['name']??''}}"
        data-prefill.email="{{$data['email']??''}}"
        data-prefill.contact="{{$data['mobile']??''}}"
        data-theme.color="#F37254"
    ></script>
    <input type="hidden" custom="Hidden Element" name="hidden">
</form>
<div style="display:none">
    <script>
        window.onload = function(){
            document.getElementsByClassName('razorpay-payment-button')[0].click()
        }
    </script>
</div>
