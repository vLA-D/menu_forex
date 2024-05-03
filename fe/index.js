const { createApp } = Vue

const API_URL = `http://localhost/api`

createApp({
    data() {
        return {
            selectedCurrency: null,
            amount: null,
            calculation: null,
            order: null,
            email: null,
            currencies: []
        }
    },

    created() {
        this.fetchData()
    },

    computed: {
        isDisabled: function() {
            return !/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.email)

        }
    },

    methods: {
        async fetchData() {
            const url = `${API_URL}/currencies`
            let response = await (await fetch(url)).json()

            this.currencies = await response.data.map((item) => ({...item}))

            this.selectedCurrency = this.currencies[0]
        },

        isNumber(event) {
            const keysAllowed = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.'];
            const keyCodesAllowed = [8, 37, 38, 39, 40];

            if (keyCodesAllowed.includes(event.keyCode)) {
                return;
            }

            if (!keysAllowed.includes(event.key)) {
                event.preventDefault()
            }
        },

        async calculate() {
            // call BE to calculate
            const url = `${API_URL}/currencies/${this.selectedCurrency.id}/calculate`
            const requestOptions = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ amount: this.amount })
            };

            let response = await (await fetch(url, requestOptions)).json()

            this.calculation = {
                discount_amount: response.discount_amount,
                discount_percentage: response.discount_percentage,
                exchange_rate: response.exchange_rate,
                purchased_amount: response.purchased_amount,
                total_price: response.total_price,
                symbol: this.selectedCurrency.symbol
            };
        },

        cancel() {
            this.selectedCurrency = this.currencies[0]
            this.calculation = null;
            this.amount = null;
            this.email = null;
        },

        async confirm() {
            // Call order creation endpoint
            const url = `${API_URL}/orders`
            const requestOptions = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    amount: this.amount,
                    email: this.email,
                    purchased_currency_id: this.selectedCurrency.id
                })
            };

            let response = await (await fetch(url, requestOptions)).json()

            this.order = {
                discount_amount: response.data.discount_amount,
                discount_percentage: response.data.discount_percentage,
                exchange_rate: response.data.exchange_rate,
                purchased_amount: response.data.purchased_amount,
                total_price: response.data.total_price,
                created_at: response.data.created_at,
                selected_symbol: this.selectedCurrency.symbol
            };
        },

        clear() {
            this.cancel();

            this.order = null
        }
    }
}).mount('#app')
