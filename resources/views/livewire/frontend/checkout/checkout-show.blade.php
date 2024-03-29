<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>{{__('customlang.checkOut')}}</h4>
            <hr>
            @if ($this->totalProductAmount!='0')
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            {{__('customlang.itemTotalAmount')}} :
                            <span class="float-end">{{$appSetting->currency}} {{$this->totalProductAmount}}</span>
                        </h4>
                        <hr>
                        <small dir="{{app()->getLocale()=='ar'?'rtl':'ltr'}}">*  {{__('customlang.itemswillbedeliveredin')}} 3 - 5 {{__('customlang.days')}}.</small>
                        <br/>
                        <small>* {{__('customlang.Taxandotherchargesareincluded')}}</small>
                    </div>
                </div>
                <div class="col-md-12" dir="{{app()->getLocale()=='ar'?'rtl':'ltr'}}">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            {{__('customlang.basicInformation')}}
                        </h4>
                        <hr>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>{{__('customlang.fullName')}}</label>
                                    <input type="text" wire:model.defer="fullname" id="fullname" class="form-control" placeholder="Enter Full Name" />
                                    @error('fullname') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>{{__('customlang.phonrNumber')}}</label>
                                    <input type="number" wire:model.defer="phone" id="phone" class="form-control" placeholder="Enter Phone Number" />
                                    @error('phone') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>{{__('customlang.emailAddress')}}</label>
                                    <input type="email" wire:model.defer="email" id="email" class="form-control" placeholder="Enter Email Address" />
                                    @error('email') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Pin-code (Zip-code)</label>
                                    <input type="text" wire:model.defer="pincode" id="pincode" class="form-control" placeholder="Enter Pin-code" />
                                    @error('pincode') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>{{__('customlang.fullAddress')}}</label>
                                    <textarea wire:model.defer="address" id="address" class="form-control" rows="2" placeholder="Enter Full Address"></textarea>
                                    @error('address') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3" wire:ignore>
                                    <label class="mb-1">{{__('customlang.SelectPaymentMode')}}:</label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <button wire:loading.attr="disabled" class="nav-link active fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>

                                            <button wire:loading.attr="disabled" class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                <h6>{{__('customlang.CashonDeliveryMode')}}</h6>
                                                <hr/>
                                                <button type="button" wire:loading.attr="disabled" wire:click="codOrder" class="btn btn-primary">
                                                    <span wire:loading.remove wire:target="codOrder">
                                                        {{__('customlang.placeOrder')}} (Cash on Delivery)
                                                    </span>
                                                    <span wire:loading wire:target="codOrder">
                                                        Placeing Order ...
                                                    </span>

                                                </button>

                                            </div>
                                            <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <h6>{{__('customlang.OnlinePaymentMode')}}</h6>
                                                <hr/>
                                                {{-- <button type="button" wire:loading.attr="disabled" class="btn btn-warning">Pay Now (Online Payment)</button> --}}
                                                <div>
                                                    <div id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>
                </div>

            </div>
            @else
             <div class="card card-body shadow text-center p-md-5">
                 <h4>{{__('customlang.noItemInCartToCheckOut')}}</h4>
                 <a href="{{url('collections')}}" class="btn btn-warning">{{__('customlang.shopNow')}}</a>
             </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')

<script src="https://www.paypal.com/sdk/js?client-id=Ac-06sCFUVimv_m64CRzqsY2Rndl-J6065nWuLYNnvJZkTrhGweTMlNVDIIMgVDbnblisasD-CCALkoD&currency=USD"></script>
<script>
    paypal.Buttons({
        onClick: function()  {

            // Show a validation error if the checkbox is not checked
            if (!document.getElementById('fullname').value
              ||!document.getElementById('phone').value
              ||!document.getElementById('email').value
              ||!document.getElementById('pincode').value
              ||!document.getElementById('address').value )
            {
              Livewire.emit('validationForALL');
              return false;
            }else
            {
                @this.set('fullname',document.getElementById('fullname').value);
                @this.set('phone',document.getElementById('phone').value);
                @this.set('email',document.getElementById('email').value);
                @this.set('pincode',document.getElementById('pincode').value);
                @this.set('address',document.getElementById('address').value);

            }
            },
        // Order is created on the server and the order id is returned
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units:[{
                    amount:{
                        value:{{$this->totalProductAmount}}
                    }
                }]

            });
            },

            onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(orderData) {
                console.log('Captur Result',orderData,JSON.stringify(orderData,null,2));
                const transaction= orderData.purchase_units[0].payments.captures[0];

                if(transaction.status == "COMPLETED")
                {

                    Livewire.emit('transactionEmit',transaction.id);

                }

            });
          }
        }).render('#paypal-button-container');

    </script>

@endpush
