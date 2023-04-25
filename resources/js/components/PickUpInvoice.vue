<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content" style="@media print{color: black}">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="invoice">
                            <div class="blue-tag"></div>
                            <div class="row">
                                <div class="col-7">

                                </div>
                                <div class="col-5">
                                    <h1 class="document-type display-4"><span class="red">Tens</span><i
                                            class="fa fa-earth-asia blue"></i></h1>
                                    <p class="text-right"><strong>Ref. Code <em>P{{ invoice.created_at | invoiceDate }}-{{profile.id }}</em></strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9">
                                    <br><br><br><br>
                                    <hr>
                                    <p>
                                        <strong>{{ invoice.name }}</strong><br>
                                        Réf. Code <em v-show="profile.type == 'Customer'">C{{ invoice.created_at |
                                            invoiceDate }}</em>
                                        <em v-show="profile.type == 'Administrator'">A{{ invoice.created_at | invoiceDate
                                        }}</em>
                                        <em v-show="profile.type == 'Driver'">D{{ invoice.created_at | invoiceDate }}</em>
                                        <em v-show="profile.type == 'Staff'">S{{ invoice.created_at | invoiceDate
                                        }}</em><br>
                                        {{ invoice.phone }}<br>
                                        {{ invoice.date | myDate }}
                                    </p>
                                </div>
                                <div class="col-3">
                                    <p class="text-right">
                                        <strong>Tens<i class="fa fa-earth-asia"></i>, inc</strong><br>
                                        Address<br>
                                        Address
                                    </p>
                                </div>
                            </div>
                            <br>
                            <br>
                            <h6>Payment Due : {{ invoice.date|date }}</h6>
                            <br>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Quantité</th>
                                        <th>Unité</th>
                                        <th>PU HT</th>
                                        <th>TVA</th>
                                        <th>Total HT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Audits et rapports mensuels</td>
                                        <td>1</td>
                                        <td>Jour</td>
                                        <td class="text-right">500,00€</td>
                                        <td>20%</td>
                                        <td class="text-right">500,00€</td>
                                    </tr>
                                    <tr>
                                        <td>Génération des rapports d'activité</td>
                                        <td>4</td>
                                        <td>Rapport</td>
                                        <td class="text-right">800,00€</td>
                                        <td>20%</td>
                                        <td class="text-right">3 200,00€</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-8">
                                </div>
                                <div class="col-4">
                                    <table class="table table-sm text-right">
                                        <tr>
                                            <td><strong>Total HT</strong></td>
                                            <td class="text-right">3 700,00€</td>
                                        </tr>
                                        <tr>
                                            <td>TVA 20%</td>
                                            <td class="text-right">740,00€</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total TTC</strong></td>
                                            <td class="text-right">4 440,00€</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <p class="conditions">
                                For your kind settlement
                                <br>
                                And with our thanks.
                                <br><br>
                                Terms of payment: payment upon receipt of invoice, before {{ invoice.date | date }}.
                                <br>
                                No discount granted for early payment.
                                <br>
                                Payment by bank transfer or credit card.
                                <br><br>
                                In the event of late payment, fixed compensation for recovery costs: MYR40
                                (Act 1986s)
                            </p>

                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="blue-tag"></div>
                            <div class="d-flex justify-content-start">
                                <div class="button mx-2">
                                    <a @click="printMe" rel="noopener" target="_blank" class="btn bg-blue"><i
                                            class="fas fa-print"></i> Print</a>
                                </div>
                                <div class="button mx-2">
                                    <a @click="makePayment" type="button" class="btn btn-light">
                                        <i class="fas fa-credit-card"></i> Pay
                                    </a>
                                </div>
                            </div>
                            <p class="bottom-page text-right">
                                90TECH SAS - N° SIRET 80897753200015 RCS METZ<br>
                                6B, Rue aux Saussaies des Dames - 57950 MONTIGNY-LES-METZ 03 55 80 42 62 -
                                www.90tech.fr<br>
                                Code APE 6201Z - N° TVA Intracom. FR 77 808977532<br>
                                IBAN FR76 1470 7034 0031 4211 7882 825 - SWIFT CCBPFRPPMTZ
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- Modal -->
        <form class="form" autocomplete="off" novalidate>
            <div class="modal fade" id="paymentModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 9em;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <div class="checkout">
                                    <div class="credit-card-box">
                                        <div class="flip">
                                            <div class="front">
                                                <i class="fa-solid fa-wifi fa-rotate-270 mt-4 mx-2" style="font-size:25px"></i>
                                                <div class="logo">
                                                    <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834"
                                                        style="enable-background:new 0 0 47.834 47.834;">
                                                        <g>
                                                            <g>
                                                                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                                                                               c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                                                                               c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                                                                               M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                                                                               c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                                                                               c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                                                                               l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                                                                               C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                                                                               C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                                                                               c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                                                                               h-3.888L19.153,16.8z" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="number">{{ cardnumber }} {{ cardnumber1 }} {{ cardnumber2 }} {{ cardnumber3 }}</div>
                                                <div class="card-holder">
                                                    <label>Card holder</label>
                                                    <div>{{cardholder }}</div>
                                                </div>
                                                <div class="card-expiration-date">
                                                    <label>Expires</label>
                                                    <div>{{ cardexpirationyear }}/{{ cardexpirationyear }}</div>
                                                </div>
                                            </div>
                                            <div class="back">
                                                <div class="strip"></div>
                                                <div class="logo">
                                                    <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834"
                                                        style="enable-background:new 0 0 47.834 47.834;">
                                                        <g>
                                                            <g>
                                                                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                                                                               c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                                                                               c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                                                                               M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                                                                               c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                                                                               c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                                                                               l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                                                                               C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                                                                               C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                                                                               c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                                                                               h-3.888L19.153,16.8z" />
                                                            </g>
                                                        </g>
                                                    </svg>

                                                </div>
                                                <div class="ccv">
                                                    <label>CCV</label>
                                                    <div>{{ cardccv }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-white" style="margin-top: 9em;">
                                <fieldset>
                                    <label for="card-number">Card Number</label>
                                    <input type="num" v-model="cardnumber" class="form-control input-cart-number"
                                        maxlength="4" />
                                    <input type="num" v-model="cardnumber1" class="form-control input-cart-number"
                                        maxlength="4" />
                                    <input type="num" v-model="cardnumber2" class="form-control input-cart-number"
                                        maxlength="4" />
                                    <input type="num" v-model="cardnumber3" class="form-control input-cart-number"
                                        maxlength="4" />
                                </fieldset>
                                <fieldset>
                                    <label for="card-holder">Card holder</label>
                                    <input type="text" v-model="cardholder" class="form-control" />
                                </fieldset>
                                <fieldset class="fieldset-expiration">
                                    <label for="card-expiration-month">Expiration date</label>
                                    <div class="select form-group">
                                        <select v-model="cardexpirationmonth" class="text-dark">
                                            <option></option>
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>06</option>
                                            <option>07</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                        </select>
                                    </div>
                                    <div class="select">
                                        <select v-model="cardexpirationyear" class="text-dark">
                                            <option></option>
                                            <option>2016</option>
                                            <option>2017</option>
                                            <option>2018</option>
                                            <option>2019</option>
                                            <option>2020</option>
                                            <option>2021</option>
                                            <option>2022</option>
                                            <option>2023</option>
                                            <option>2024</option>
                                            <option>2025</option>
                                            <option>2026</option>
                                            <option>2027</option>
                                            <option>2028</option>
                                            <option>2029</option>
                                            <option>2030</option>
                                            <option>2031</option>
                                            <option>2032</option>
                                            <option>2033</option>
                                        </select>
                                    </div>
                                </fieldset>
                                <fieldset class="fieldset-ccv">
                                    <label for="card-ccv">CCV</label>
                                    <input type="text" class="form-control" v-model="cardccv" maxlength="3" />
                                </fieldset>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="makePayment">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import Axios from 'axios';
export default {
    props: ['profile', 'parentData'],
    data() {
        return {
            invoice: {},
            pickUp: false,
            payment: false,
            cardholder: '####',
            cardnumber: '####',
            cardnumber1: '####',
            cardnumber2: '####',
            cardnumber3: '####',
            cardexpirationmonth: '',
            cardexpirationyear: '',
            cardccv: '###'
        }
    },
    mounted() {
        console.log('Component mounted.');
    },
    created() {
        this.generateInvoice();
        this.$root.$on('message-from-pickUp', (msg) => {
            this.pickUp = msg;
        })
    },
    methods: {
        printMe() {
            window.print();
        },
        generateInvoice() {
            Axios.get('api/pickUp/' + this.profile.phone).then(({ data }) => this.invoice = data);
        },
        makePayment() {
            if (this.payment == false) {
                this.payment = true
                $("#paymentModal").modal("show");
            } else {
                this.payment = false
                $("#paymentModal").modal("hide");
            }
        }
    }
}
</script>
