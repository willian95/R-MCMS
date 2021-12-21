<script>
        
    const app = new Vue({
        el: '#dev-coupon',
        data(){
            return{
                productSearch:"",
                selectedProducts:[],
                selectedProductsDetail:[],
                products:[],
                
                userSearch:"",
                users:[],
                selectedUsers:[],
                selectedUsersDetail:[],

                isDiscountTotal:"carrito",
                discountType:"porcentual",
                discountAmount:"",
                endDate:"",

                allUsers:false,
                allProducts:false,

                couponCode:"",
                
                showMenu:false,
                loading:false
            }
        },
        methods:{   

            generateRandomCode(){
                var result           = '';
                var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for ( var i = 0; i < 10; i++ ) {
                    result += characters.charAt(Math.floor(Math.random() * 
                charactersLength));
                }
                this.couponCode = result;
            },
            currencyFormatDE(num) {
                return (
                    num
                    .toFixed(2) // always two decimal digits
                    .replace('.', ',') // replace decimal point character with ,
                    .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
                ) // use . as a 
            },
            searchProduct(){

                axios.post("{{ url('products/search') }}", {search: this.productSearch}).then(res => {

                    this.products = res.data.products

                })

            },

            searchUser(){

                axios.post("{{ url('clients/search') }}", {search: this.userSearch}).then(res => {

                    this.users = res.data.users

                })

            },
            addToSelectedProducts(id, product){

                if(this.selectedProducts.includes(id)){

                    this.removeSelectedProducts(id)

                }else{

                    this.selectedProducts.push(id)
                    this.selectedProductsDetail.push(product)                        

                }

            },
            removeSelectedProducts(id){

                this.selectedProducts.forEach((item, index) =>{

                    if(item == id){
                        this.selectedProducts.splice(index, 1)
                    }

                })

                this.selectedProductsDetail.forEach((item, index) =>{

                    if(item.id == id){
                        this.selectedProductsDetail.splice(index, 1)
                    }

                })


            },
            addToSelectedUsers(id, user){

                if(this.selectedUsers.includes(id)){

                    this.removeSelectedUsers(id)

                }else{

                    this.selectedUsers.push(id)
                    this.selectedUsersDetail.push(user)                        

                }

            },
            removeSelectedUsers(id){

                this.selectedUsers.forEach((item, index) =>{

                    if(item == id){
                        this.selectedUsers.splice(index, 1)
                    }

                })

                this.selectedUsersDetail.forEach((item, index) =>{

                    if(item.id == id){
                        this.selectedUsersDetail.splice(index, 1)
                    }

                })


            },

            store(){

                if(this.validateCouponInfo()){
                    this.loading = true
                    axios.post("{{ url('coupons/store') }}", {discountType: this.discountType, discountAmount: this.discountAmount, totalDiscount: this.isDiscountTotal, endDate: this.endDate, allUsers: this.allUsers, allProducts: this.allProducts, couponCode: this.couponCode, products: this.selectedProductsDetail, users: this.selectedUsersDetail})
                    .then(res => {
                        this.loading = false
                        
                        if(res.data.success == true){

                            swal({
                                "icon": "success",
                                "text": res.data.msg 
                            }).then(ans => {

                                window.location.href="{{ url('/admin/coupon/index') }}"

                            })

                        }else{

                            swal({
                                "icon": "error",
                                "text": res.data.msg 
                            })

                        }


                    })
                    .catch(err => {
                        this.loading = false
                        $.each(err.response.data.errors, function(key, value){
                            alertify.error(value[0])
                        });
                    })
                }

                

            },

            validateCouponInfo(){

                if(this.allUsers == false && this.selectedUsersDetail.length == 0){
                    
                    alertify.error("Debes seleccionar usuarios")
                    
                    return false
                }

                if(this.allProducts == false && this.selectedProductsDetail.length == 0){
                    
                    alertify.error("Debes seleccionar productos")
                    
                    return false
                }

                return true

            },

            fetch(page = 1){

                this.page = page

                axios.get("{{ url('/admin/size/fetch/') }}"+"/"+page)
                .then(res => {

                    this.sizes = res.data.sizes
                    this.pages = Math.ceil(res.data.sizesCount / 20)

                })
                .catch(err => {
                    $.each(err.response.data.errors, function(key, value){
                        alert(value)
                    });
                })

            },
            isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            },
            toggleMenu(){

                if(this.showMenu == false){
                    $("#menu").addClass("show")
                    this.showMenu = true
                }else{
                    $("#menu").removeClass("show")
                    this.showMenu = false
                }

            }


        },
        mounted(){
            
            this.fetch()

        }

    })

</script>