<!--modal-->
<div class="modal" role="dialog" aria-labelledby="foo" id="payment-modal" >
    <div class="modal-dialog" id="commonModalContainer">
            <div class="modal-content main-bg-color">
                <div class="modal-header main-bg-color" id="commonModalHeader">
                    <h4 class="modal-title" id="commonModalTitle">Payment</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="login-inner-div">
                        <form id="payment-form">
                            <div id="payment-element">
                              <!--Stripe.js injects the Payment Element-->
                            </div>
                            <button id="submit">
                              <div class="spinner hidden" id="spinner"></div>
                              <span id="button-text">Pay now</span>
                            </button>
                            <div id="payment-message" class="hidden"></div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>